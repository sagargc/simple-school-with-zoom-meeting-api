<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        return view('teachers.dashboard');
    }


     /******************************************/
    /************ ASSIGNMENT SECTION *************/
    /******************************************/

    public function assignment()
    {
        $assignments = Assignment::all();
        return view('teachers.list_assignment', compact('assignments'));
    }

    // public function assignmentCreate()
    // {   
        
    //     $subjects = Subject::all();
    //     $student = Student::where('user_id', Auth::user()->id)->first();
    //     if(is_null($student)){
    //         return redirect()->back()
    //             ->with('warning','Student profile couldn\'t found.');
    //     }
    //     return view('teachers.add_assignment', compact('subjects','student'));
    // }
    // public function assignmentStore(Request $request)
    // {
    //     $this->validate($request, [
    //         'subject_id'        =>  'required|integer',
    //         'id'                =>  'required|integer',
    //         'name'              =>  'required|max:100',
    //         'detail'            =>  'max:255',
    //         'document'          =>  'required|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt,rtf|max:3072',
    //         'status'            =>  '', 
    //         // 'feedback'          =>  'required|string',
    //     ]);
    //     // prepare for document
    //     if ($files = $request->file('document')) {
    //        $destinationPath = 'public/assignments/'; // upload path
    //        $assignmentFile = date('YmdHis') . "." . $files->getClientOriginalExtension();
    //        $files->move($destinationPath, $assignmentFile);
    //     }

    //     //assignment data.
    //     $assignment_data = [
    //         'subject_id'        =>  ($request->subject_id)?$request->subject_id:0,
    //         'student_id'        =>  ($request->id)?$request->id:0,
    //         'name'              =>  $request->name,
    //         'detail'            =>  $request->detail,
    //         'document'          =>  ($assignmentFile)?$assignmentFile:NULL,
    //         'status'            =>  ($request->status)?'1':'0'
    //         // 'feedback'          =>  $request->feedback,
    //     ];

    //     if(Assignment::create($assignment_data)){
    //         return redirect()->route("student.assignments.index")
    //             ->withSuccess('Great! Assignment has been successfully added.');
    //     } else {            
    //         return redirect()->back()
    //             ->with('error','Assignment couldn\'t added.');
    //     }
    // }
    public function assignmentEdit(Assignment $assignment)
    {   
        $subjects = Subject::all();
        $student = Student::findOrFail($assignment->student_id);
        if(is_null($student)){
            return redirect()->back()
                ->with('warning','Student profile couldn\'t found.');
        }
        return view('teachers.edit_assignment', compact('assignment','subjects','student'));
    }

    public function assignmentUpdate(Request $request)
    {  
        $this->validate($request, [
            'status'            =>  '', 
            'feedback'          =>  'required|string',
        ]);

        //assignment data.
        $assignment_data = [
            'status'            =>  ($request->status)?'1':'0',
            'feedback'          =>  $request->feedback,
        ];

        if(Assignment::where('id', $request->id)->update($assignment_data)){
            return redirect()->route("teacher.assignments.index")
                ->withSuccess('Great! Assignment feedback has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Assignment feedback couldn\'t update.');
        }
    }

    public function assignmentDelete($id)
    {       
        $assignment = Assignment::findOrFail($id);
        if($assignment->delete()){
            return redirect()->route('teacher.assignments.index')->with('success','Assignment deleted successfully.');
        } else {
            return redirect()->back()->with('error','Assignment couldn\'t delete, please try again.');
        }
    }

    public function meeting()
    {
        // Ony get live or upcoming meetings.
        $meetings = \Zoom::user()->find('me')->meetings()->where('type', '=', 'live')->where('type', '=' ,'upcoming')->get();
        return view('teachers.list_meeting', compact('meetings'));
    }
}
