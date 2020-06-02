<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Student;
use App\Subject;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;




class AdminController extends Controller
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
        return view('admins.dashboard');
    }

    /******************************************/
    /************ TEACHER SECTION *************/
    /******************************************/

    public function teacher()
    {
        $teachers = Teacher::all();
        return view('admins.list_teacher', compact('teachers'));
    }

    public function teacherCreate()
    {
        return view('admins.add_teacher');
    }
    public function teacherStore(Request $request)
    {
        
        $this->validate($request, [
            'name'              =>  'required|max:191', // size:191
            'dob'               =>  'required|date',
            'phone_no'          =>  'required|digits_between:10,10|numeric',
            'gender'            =>  'required|integer',
            'email'             =>  'required|unique:users|unique:teachers',
            'address'           =>  'required|string|max:55',
            'specialization'    =>  'required|string',
            'photo'             =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'          =>  'required|string|min:8|confirmed',
        ]);

        if ($file = $request->file('photo')) {
           $destinationPath = 'public/photos/'; // upload path
           $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
           $file->move($destinationPath, $profileImage);
        }

        // for user  data.
        $user_data = array(
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => 'teacher',
            'password'  => Hash::make($request->password)
        );
        
        // first insert data into user table.       
        $user_insert = User::create($user_data); 

        // for teacher data.
        $teacher_data = [
            'user_id'           =>  ($user_insert->id)?$user_insert->id:0,
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'email'             =>  $request->email,
            'phone_no'          =>  $request->phone_no,
            'gender'            =>  $request->gender,
            'address'           =>  $request->address,
            'specialization'    =>  $request->specialization,
            'photo'             =>  ($profileImage)?$profileImage:NULL
        ];

        // second insert teacher with user id.
        $user_teacher_insert = Teacher::create($teacher_data); 

        if($user_teacher_insert && $user_insert){
            return redirect()->route("admin.teachers.index")
                ->withSuccess('Great! teacher has been successfully added.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Teacher couldn\'t added.');
        }
    }
    public function teacherEdit(Teacher $teacher)
    {
        return view('admins.edit_teacher', compact('teacher'));
    }

    public function teacherUpdate(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name'              =>  'required|max:191', // size:191
            'dob'               =>  'required|date',
            'phone_no'          =>  'required|digits_between:10,10|numeric',
            'gender'            =>  'required|integer',
            'email'             =>  'unique:users|unique:teachers',
            'address'           =>  'required|string|max:55',
            'specialization'    =>  'required|string',
            'photo'             =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'          =>  'nullable|string|min:8',
        ]);
        // get teacher data.
        $teacher = Teacher::findOrFail($request->id);
        // teacher photo update.
        $profileImage  = '';
        if ($file = $request->file('photo')) {
           $destinationPath = 'public/photos/'; // upload path
           $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
           $file->move($destinationPath, $profileImage);
        }
        // for user  data.
        $user_data = array(
            'name'      => $request->name
        );
        // for password
        if(!is_null($request->password)){
            $user_data['password'] = Hash::make($request->password); //bcrypt
        }
        // for email.            
        if(!is_null($request->email)){
            $user_data['email'] = $request->email;
        }
        // first insert data into user table.       
        $user_update = User::where('id', $request->user_id)->update($user_data); 

        // for teacher data.
        $teacher_data = [
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'email'             =>  ($request->email)?$request->email:$teacher->email,
            'phone_no'          =>  $request->phone_no,
            'gender'            =>  $request->gender,
            'address'           =>  $request->address,
            'specialization'    =>  $request->specialization,
            'photo'             =>  ($profileImage)?$profileImage:$teacher->photo
        ];

        // second insert teacher with user id.
        $user_teacher_udpate = Teacher::where('id', $request->id)->update($teacher_data); 

        if($user_teacher_udpate && $user_update){
            return redirect()->route("admin.teachers.index")
                ->withSuccess('Great! teacher has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Teacher couldn\'t update.');
        }
    }

    public function teacherDelete($id)
    {       
        $teacher = Teacher::findOrFail($id);
        $user_teacher = User::findOrFail($teacher->user_id);
        if($teacher->delete() && $user_teacher->delete()){
            return redirect()->route('admin.teachers.index')->with('success','Teacher deleted successfully.');
        } else {
            return redirect()->back()->with('error',' Teacher couldn\'t delete, please try again.');
        }
    }


    /******************************************/
    /************ STUDENT SECTION *************/
    /******************************************/

    public function student()
    {
        $students = Student::all();
        return view('admins.list_student', compact('students'));
    }

    public function studentCreate()
    {
        return view('admins.add_student');
    }
    public function studentStore(Request $request)
    {
        
        $this->validate($request, [
            'name'              =>  'required|max:191', // size:191
            'dob'               =>  'required|date',
            'phone_no'          =>  'required|digits_between:10,10|numeric',
            'gender'            =>  'required|integer',
            'email'             =>  'required|unique:users|unique:students',
            'address'           =>  'required|string|max:55',
            'photo'             =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'          =>  'required|string|min:8|confirmed',
        ]);

        if ($file = $request->file('photo')) {
           $destinationPath = 'public/photos/'; // upload path
           $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
           $file->move($destinationPath, $profileImage);
        }

        // for user  data.
        $user_data = array(
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => 'student',
            'password'  => Hash::make($request->password)
        );
        
        // first insert data into user table.       
        $user_insert = User::create($user_data); 

        // for student data.
        $student_data = [
            'user_id'           =>  ($user_insert->id)?$user_insert->id:0,
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'email'             =>  $request->email,
            'phone_no'          =>  $request->phone_no,
            'gender'            =>  $request->gender,
            'address'           =>  $request->address,
            'photo'             =>  ($profileImage)?$profileImage:NULL
        ];

        // second insert student with user id.
        $user_student_insert = Student::create($student_data); 

        if($user_student_insert && $user_insert){
            return redirect()->route("admin.students.index")
                ->withSuccess('Great! Student has been successfully added.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Student couldn\'t added.');
        }
    }
    public function studentEdit(Student $student)
    {
        return view('admins.edit_student', compact('student'));
    }

    public function studentUpdate(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name'              =>  'required|max:191', // size:191
            'dob'               =>  'required|date',
            'phone_no'          =>  'required|digits_between:10,10|numeric',
            'gender'            =>  'required|integer',
            'email'             =>  'unique:users|unique:students',
            'address'           =>  'required|string|max:55',
            'photo'             =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'          =>  'nullable|string|min:8',
        ]);
        // get student data.
        $student = Student::findOrFail($request->id);
        // student photo update.
        $profileImage  = '';
        if ($file = $request->file('photo')) {
           $destinationPath = 'public/photos/'; // upload path
           $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
           $file->move($destinationPath, $profileImage);
        }
        // for user  data.
        $user_data = array(
            'name'      => $request->name
        );
        // for password
        if(!is_null($request->password)){
            $user_data['password'] = Hash::make($request->password); //bcrypt
        }
        // for email.            
        if(!is_null($request->email)){
            $user_data['email'] = $request->email;
        }
        // first insert data into user table.       
        $user_update = User::where('id', $request->user_id)->update($user_data); 

        // for student data.
        $student_data = [
            'name'              =>  $request->name,
            'dob'               =>  $request->dob,
            'email'             =>  ($request->email)?$request->email:$student->email,
            'phone_no'          =>  $request->phone_no,
            'gender'            =>  $request->gender,
            'address'           =>  $request->address,
            'photo'             =>  ($profileImage)?$profileImage:$student->photo
        ];

        // second insert student with user id.
        $user_student_udpate = Student::where('id', $request->id)->update($student_data); 

        if($user_student_udpate && $user_update){
            return redirect()->route("admin.students.index")
                ->withSuccess('Great! Student has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Student couldn\'t update.');
        }
    }

    public function studentDelete($id)
    {       
        $student = Student::findOrFail($id);
        $user_student = User::findOrFail($student->user_id);
        if($student->delete() && $user_student->delete()){
            return redirect()->route('admin.students.index')->with('success','Student deleted successfully.');
        } else {
            return redirect()->back()->with('error',' Student couldn\'t delete, please try again.');
        }
    }


    /******************************************/
    /************ SUBJECT SECTION *************/
    /******************************************/

    public function subject()
    {
        $subjects = Subject::all();
        return view('admins.list_subject', compact('subjects'));
    }

    public function subjectCreate()
    {   
        $teachers = Teacher::all();
        return view('admins.add_subject', compact('teachers'));
    }
    public function subjectStore(Request $request)
    {
        $this->validate($request, [
            'teacher_id'        =>  'required|integer',
            'name'              =>  'required|max:100',
            'code'              =>  'required|string',
            'type'              =>  '', 
        ]);

        //subject data.
        $subject_data = [
            'teacher_id'        =>  ($request->teacher_id)?$request->teacher_id:0,
            'name'              =>  $request->name,
            'code'              =>  $request->code
        ];

        if(Subject::create($subject_data)){
            return redirect()->route("admin.subjects.index")
                ->withSuccess('Great! Subject has been successfully added.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Subject couldn\'t added.');
        }
    }
    public function subjectEdit(Subject $subject)
    {
        $teachers = Teacher::all();
        return view('admins.edit_subject', compact('subject','teachers'));
    }

    public function subjectUpdate(Request $request)
    {
        $this->validate($request, [
            'teacher_id'        =>  'required|integer',
            'name'              =>  'required|max:100',
            'code'              =>  'required|string',
            'type'              =>  '', 
        ]);

        //subject data.
        $subject_data = [
            'teacher_id'        =>  ($request->teacher_id)?$request->teacher_id:0,
            'name'              =>  $request->name,
            'code'              =>  $request->code
        ];

        if(Subject::where('id', $request->id)->update($subject_data)){
            return redirect()->route("admin.subjects.index")
                ->withSuccess('Great! Subject has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Subject couldn\'t update.');
        }
    }

    public function subjectDelete($id)
    {       
        $subject = Subject::findOrFail($id);
        if($subject->delete()){
            return redirect()->route('admin.subjects.index')->with('success','Subject deleted successfully.');
        } else {
            return redirect()->back()->with('error','Subject couldn\'t delete, please try again.');
        }
    }


    /******************************************/
    /************ ASSIGNMENT SECTION *************/
    /******************************************/

    public function assignment()
    {
        $assignments = Assignment::all();
        return view('admins.list_assignment', compact('assignments'));
    }

    public function assignmentCreate()
    {   
        $subjects = Subject::all();
        $students = Teacher::all();
        return view('admins.add_assignment', compact('subjects','students'));
    }
    public function assignmentStore(Request $request)
    {
        $this->validate($request, [
            // 'subject_id'        =>  'required|integer',
            // 'student_id'        =>  'required|integer',
            // 'name'              =>  'required|max:100',
            // 'detail'            =>  'max:100',
            // 'document'          =>  'max:100',
            'feedback'          =>  'required|string',
            'status'            =>  '', 
        ]);

        //assignment data.
        $assignment_data = [
            // 'subject_id'        =>  ($request->subject_id)?$request->subject_id:0,
            // 'student_id'        =>  ($request->student_id)?$request->student_id:0,
            // 'name'              =>  $request->name,
            // 'detail'            =>  $request->detail
            // 'document'          =>  $request->
            'feedback'          =>  $request->feedback,
            'status'            =>  $request->status
        ];

        if(Assignment::create($assignment_data)){
            return redirect()->route("admin.assignments.index")
                ->withSuccess('Great! Assignment has been successfully added.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Assignment couldn\'t added.');
        }
    }
    public function assignmentEdit(Assignment $assignment)
    {
        $subjects = Subject::all();
        $students = Student::all();
        return view('admins.edit_assignment', compact('assignment','subjects','students'));
    }

    public function assignmentUpdate(Request $request)
    {
        $this->validate($request, [
            'subject_id'        =>  'required|integer',
            'student_id'        =>  'required|integer',
            'name'              =>  'required|max:100',
            'detail'            =>  'max:255',
            'document'          =>  'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,txt,rtf|max:3072',
            'feedback'          =>  'required|string',
            'status'            =>  '', 
        ]);

        // prepare for document
        if ($files = $request->file('document')) {
           $destinationPath = 'public/assignments/'; // upload path
           $assignmentFile = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $assignmentFile);
        }

        //assignment data.
        $assignment_data = [
            'subject_id'        =>  ($request->subject_id)?$request->subject_id:0,
            'student_id'        =>  ($request->student_id)?$request->student_id:0,
            'name'              =>  $request->name,
            'detail'            =>  $request->detail,
            'status'            =>  ($request->status)?'1':'0',
            'feedback'          =>  $request->feedback,
        ];
        if(!is_null($request->file('document'))){
            $assignment_data['document']  = $assignmentFile;
        }
        
        if(Assignment::where('id', $request->id)->update($assignment_data)){
            return redirect()->route("admin.assignments.index")
                ->withSuccess('Great! Assignment has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Assignment couldn\'t update.');
        }
    }

    public function assignmentDelete($id)
    {       
        $assignment = Assignment::findOrFail($id);
        if($assignment->delete()){
            return redirect()->route('admin.assignments.index')->with('success','Assignment deleted successfully.');
        } else {
            return redirect()->back()->with('error','Assignment couldn\'t delete, please try again.');
        }
    }

    /******************************************/
    /************ MEETING SECTION *************/
    /******************************************/

    public function meeting()
    {

        // $zoom = new \MacsiDigital\Zoom\Support\Entry;
        // $user = new \MacsiDigital\Zoom\User($zoom);
        // dd($user);

        $user = \Zoom::user()->find('me');
        $meetings = $user->meetings()->get();
        // dd($meetings);

        // $meetings = LiveStream::all();
        return view('admins.list_meeting', compact('meetings'));
    }

    public function meetingCreate()
    {
        return view('admins.add_meeting');
    }
    public function meetingStore(Request $request)
    {
         
        $this->validate($request, [
            'name'              =>  'required|max:191', 
            'agenda'            =>  'required|string|max:2000',
            'start_time'        =>  'required|date',
            'duration'          =>  'numeric|max:30',
            'password'          =>  'nullable|string|min:8',
        ]);
        // dd(str_replace( 'T', '', $request->start_time ));
        $data =  [
            'topic' => $request->name,
            'agenda' => $request->agenda,
            'type' => 2,
            'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time )),
            'timezone' => 'Asia/Kathmandu',
            'duration' => $request->duration,
            'password' => $request->password,
            'settings' => [
                'join_before_host'  =>  false,
                'host_video'        =>  false,
                'participant_video' => false,
                'mute_upon_entry'   => false,
                'enforce_login'     => false,
                'auto_recording'    => "none",
                'alternative_hosts' => ""
            ]
        ];

        // dd($data);

        // Save Method
        // $meeting = Zoom::meeting()->make([...]); 
        // Zoom::user()->find('id')->meetings()->save($meeting); 
        // Create Method
        // $created = \Zoom::user()->find('id')->meetings()->create($data);
        
        $user = \Zoom::user()->find('me');
        if($user->meetings()->create($data)){
            return redirect()->route("admin.meetings.index")
                ->withSuccess('Great! Meeting has been successfully added.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Meeting couldn\'t added.');
        }
    }
    public function meetingEdit($meeting_id)
    {
        $meeting =  \Zoom::meeting()->find($meeting_id);
        return view('admins.edit_meeting', compact('meeting'));
    }

    public function meetingUpdate(Request $request)
    {
       
        $this->validate($request, [
            'name'              =>  'required|max:191', 
            'agenda'            =>  'required|string|max:2000',
            'start_time'        =>  'required|date',
            'duration'          =>  'numeric|max:30',
            'password'          =>  'nullable|string|min:8',
        ]);

        $data =  [
            'topic' => $request->name,
            'agenda' => $request->agenda,
            'type' => 2,
            'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time )),
            'timezone' => 'Asia/Kathmandu',
            'duration' => $request->duration,
            'password' => $request->password,
            'settings' => [
                'join_before_host'  =>  false,
                'host_video'        =>  false,
                'participant_video' => false,
                'mute_upon_entry'   => false,
                'enforce_login'     => false,
                'auto_recording'    => "none",
                'alternative_hosts' => ""
            ]
        ];
        
        if(\Zoom::meeting()->find($request->id)->update($data)){
            return redirect()->route("admin.meetings.index")
                ->withSuccess('Great! Meeting has been successfully updated.');
        } else {            
            return redirect()->back()
                ->withErrors('error','Meeting couldn\'t update.');
        }
    }
    public function meetingEnd($id)
    {       
        $meeting = \Zoom::meeting()->find($id);
        dd($meeting);
        if($meeting->endMeeting()){
            return redirect()->route('admin.meetings.index')->with('success','Meeting ended successfully.');
        } else {
            return redirect()->back()->with('error',' Meeting couldn\'t end, please try again.');
        }
    }
    public function meetingDelete($id)
    {       
        $meeting = \Zoom::meeting()->find($id);
        if($meeting->delete()){
            return redirect()->route('admin.meetings.index')->with('success','Meeting deleted successfully.');
        } else {
            return redirect()->back()->with('error',' Meeting couldn\'t delete, please try again.');
        }
    }
    
}
