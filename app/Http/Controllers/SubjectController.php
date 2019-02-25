<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\Subject;
use App\Schedule;
use App\Section;
use Session;

class SubjectController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	$subjects = Subject::orderBy('created_at', 'desc')->get();

        $cantDelete = [];
        $schedules = Schedule::all();
        foreach ($schedules as $row) {
            if (!in_array($row->subject_id, $cantDelete)) {
                array_push($cantDelete, $row->subject_id);
            }
        }

    	return view('admin.subject.index')
    		->with('pageTitle', 'Subjects')
            ->with('cantDelete', $cantDelete)
    		->with('subjects', $subjects);
    }

    public function create() {
    	return view('admin.subject.create')
    		->with('pageTitle', 'Subject :: Create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'code' => 'required|max:191',
    		'description' => 'required|max:191'
    	]);

    	$subject = New Subject;
    	$subject->code = $request->code;
    	$subject->description = $request->description;
    	$subject->save();

    	Session::flash('success', 'Subject has been added.');

    	return redirect()->route('subject.index');
    }

    public function edit($id) {
    	$subject = Subject::find($id);

    	return view('admin.subject.edit')
    		->with('subject', $subject)
    		->with('pageTitle', 'Subject :: Edit');
    }

    public function update(Request $request, $id) {
    	$this->validate($request, [
    		'code' => 'required|max:191',
    		'description' => 'required|max:191'
    	]);

    	$subject = Subject::find($id);
    	$subject->code = $request->code;
    	$subject->description = $request->description;
    	$subject->save();

    	Session::flash('success', 'Subject has been updated.');

    	return redirect()->route('subject.index');
    }

    public function destroy($id) {
    	$subject = Subject::find($id);
    	$subject->delete();

    	Session::flash('info', 'Subject has been deleted.');

    	return redirect()->route('subject.index');
    }

    public function show(Request $request) {
        if($request->ajax()) {
            $subject = Subject::find($request->id);

            return response()->json($subject);
        }
    }
}
