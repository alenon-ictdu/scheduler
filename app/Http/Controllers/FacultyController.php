<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\Subject;
use App\Schedule;
use App\Section;
use Session;

class FacultyController extends Controller
{
    public function __construct() {
    	return $this->middleware('auth');
    }

    public function index() {
    	$faculties = Faculty::orderBy('created_at', 'desc')->get();

        $cantDelete = [];
        $schedules = Schedule::all();
        foreach ($schedules as $row) {
            if (!in_array($row->teacher_id, $cantDelete)) {
                array_push($cantDelete, $row->teacher_id);
            }
        }

    	return view('admin.faculty.index')
    		->with('pageTitle', 'Faculties')
            ->with('cantDelete', $cantDelete)
    		->with('faculties', $faculties);
    }

    public function create() {
    	return view('admin.faculty.create')
    		->with('pageTitle', 'Faculty :: Create');
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'firstname' => 'required|max:191',
    		'middlename' => 'max:191',
    		'lastname' => 'required|max:191'
    	]);

    	$faculty = New Faculty;
    	$faculty->firstname = $request->firstname;
    	$faculty->middlename = $request->middlename;
    	$faculty->lastname = $request->lastname;
    	$faculty->save();

    	Session::flash('success', 'Teacher has been added.');

    	return redirect()->route('faculty.index');
    }

    public function edit($id) {
    	$faculty = Faculty::find($id);

    	return view('admin.faculty.edit')
    		->with('faculty', $faculty)
    		->with('pageTitle', 'Faculty :: Edit');
    }

    public function update(Request $request, $id) {
    	$this->validate($request, [
    		'firstname' => 'required|max:191',
    		'middlename' => 'max:191',
    		'lastname' => 'required|max:191'
    	]);

    	$faculty = Faculty::find($id);
    	$faculty->firstname = $request->firstname;
    	$faculty->middlename = $request->middlename;
    	$faculty->lastname = $request->lastname;
    	$faculty->save();

    	Session::flash('success', 'Teacher has been updated.');

    	return redirect()->route('faculty.index');
    }

    public function destroy($id) {
    	$faculty = Faculty::find($id);
    	$faculty->delete();

    	Session::flash('info', 'Teacher has been deleted.');

    	return redirect()->route('faculty.index');
    }

    public function show(Request $request) {
        if($request->ajax()) {
            $faculty = Faculty::find($request->id);
            /*$member->firstname = $request->firstname;
            $member->middlename = $request->middlename;
            $member->lastname = $request->lastname;
            $member->save();*/

            return response()->json($faculty);
        }
    }

}
