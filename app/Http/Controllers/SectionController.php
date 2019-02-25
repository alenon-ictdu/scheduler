<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Faculty;
use App\Subject;
use App\Schedule;
use Session;

class SectionController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	$sections = Section::orderBy('created_at', 'desc')->get();

        $cantDelete = [];
        $schedules = Schedule::all();
        foreach ($schedules as $row) {
            if (!in_array($row->section_id, $cantDelete)) {
                array_push($cantDelete, $row->section_id);
            }
        }

    	return view('admin.section.index')
    		->with('pageTitle', 'Sections')
            ->with('cantDelete', $cantDelete)
    		->with('sections', $sections);
    }

    public function create() {
    	return view('admin.section.create')
    		->with('pageTitle', 'Section :: Create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|max:191',
    		'name' => 'required|max:191',
    		'year' => 'required|not_in:none'
    	]);

    	$section = New Section;
    	$section->code = $request->code;
    	$section->name = $request->name;
    	$section->year = $request->year;
    	$section->save();

    	Session::flash('success', 'Section has been added.');

    	return redirect()->route('section.index');
    }

    public function edit($id) {
    	$section = Section::find($id);

    	return view('admin.section.edit')
    		->with('section', $section)
    		->with('pageTitle', 'Section :: Edit');
    }

    public function update(Request $request, $id) {
    	$this->validate($request, [
    		'code' => 'required|max:191',
    		'name' => 'required|max:191',
    		'year' => 'required|not_in:none'
    	]);

    	$section = Section::find($id);
    	$section->code = $request->code;
    	$section->name = $request->name;
    	$section->year = $request->year;
    	$section->save();

    	Session::flash('success', 'Section has been updated.');

    	return redirect()->route('section.index');
    }

    public function destroy($id) {
    	$section = Section::find($id);
    	$section->delete();

    	Session::flash('info', 'Section has been deleted.');

    	return redirect()->route('section.index');
    }

    public function show(Request $request) {
        if($request->ajax()) {
            $section = Section::find($request->id);

            return response()->json($section);
        }
    }

    public function scheduleCreate($id) {
    	$ctr = 0;
    	$schedule = Schedule::where('section_id', $id)->get();
    	$section = Section::find($id);
    	$faculties = Faculty::all();
    	$subjects = Subject::all();

    	return view('admin.section.schedule-create')
    		->with('pageTitle', 'Section :: Schedule')
    		->with('subjects', $subjects)
    		->with('ctr', $ctr)
    		->with('faculties', $faculties)
    		->with('schedule', $schedule)
    		->with('section', $section);
    }

    public function scheduleStore(Request $request, $id) {
    	if (in_array('none', $_POST)) {
            // show a error message
            Session::flash('error', 'Invalid Input');

            return redirect()->back();
        }

        print_r($_POST);
        $scheduleArr = [];
        $x = 0;
        $counter = 1;
        foreach ($_POST as $key => $value) {
            if ($key == '_token') {
                continue;
            }

            if($counter == 1) {
                $subject = $value;
                $counter = $counter + 1;
                // echo $subject;
                continue;
            }

            if ($counter == 2) {
                $teacher = $value;
                $counter = $counter + 1;
                continue;
            }

            if ($counter == 3) {
                $day = $value;
                $counter = $counter + 1;
                continue;
            }

            if ($counter == 4) {
                $start = $value;
                $counter = $counter + 1;
                continue;
            }

            if ($counter == 5) {
                $end = $value;
                $scheduleArr[$x] = [
                    'subject' => $subject,
                    'teacher' => $teacher,
                    'day' => $day,
                    'start' => $start,
                    'end' => $end
                ];
                $x = $x + 1;
                $counter = 1;
                continue;
            }
        }

        $scheduleArr = json_decode(json_encode($scheduleArr));
        print_r($scheduleArr);

        // reset all schedule
        $schedules = Schedule::where('section_id', $id)->get();
        foreach ($schedules as $row) {
        	$s = Schedule::find($row->id);
        	$s->delete();
        }

        // then add
        foreach ($scheduleArr as $row) {
            $scheduleE = Schedule::where([['section_id', $id], ['subject_id', $row->subject], ['teacher_id', $row->teacher], ['day', $row->day], ['start', $row->start], ['end', $row->end]])->first();
            if ($scheduleE === null || $scheduleE == '') { 
                // if not exist create new
                $schedule = New Schedule;
                $schedule->section_id = $id;
                $schedule->subject_id = $row->subject;
                $schedule->teacher_id = $row->teacher;
                $schedule->day = $row->day;
                $schedule->start = $row->start;
                $schedule->end = $row->end;
                $schedule->save();
            } else {
                // else update
                $scheduleE->section_id = $id;
                $scheduleE->subject_id = $row->subject;
                $scheduleE->teacher_id = $row->teacher;
                $scheduleE->day = $row->day;
                $scheduleE->start = $row->start;
                $scheduleE->end = $row->end;
                $scheduleE->save();
            }
        }

        Session::flash('success', 'Schedule has been updated.');

        return redirect()->route('section.schedule', $id);
    }

    public function schedule($id) {
    	$ctr = 1;
    	$section = Section::find($id);
    	$schedule = Schedule::where('section_id', $id)->get();

    	$schedArr = [];
    	$x = 0;
    	foreach ($schedule as $row) {
    		$subject = Subject::find($row->subject_id);
    		$teacher = Faculty::find($row->teacher_id);
    		$schedArr[$x++] = [
    			'id' => $row->id,
    			'section_id' => $row->section_id,
    			'subject_id' => $row->subject_id,
    			'subject_code' => $subject->code,
    			'subject_description' => $subject->description,
    			'teacher_id' => $row->teacher_id,
    			'teacher_name' => $teacher->firstname. ' ' .$teacher->middlename. ' ' .$teacher->lastname,
    			'day' => $row->day,
    			'start' => $start  = date("H:i", strtotime($row->start)),
    			'end' => $end  = date("H:i", strtotime($row->end))
    		];
    	}

    	$schedArr = json_decode(json_encode($schedArr));
    	// print_r($schedArr);
    	return view('admin.section.schedule')
    		->with('pageTitle', 'Section :: Schedule')
    		->with('section', $section)
    		->with('ctr', $ctr)
    		->with('schedule', $schedArr);
    }
}
