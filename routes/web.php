<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// By default redirect to appropriate dashboard as per user type.
Route::get('/', function () {
    return Redirect::to('login');
});
// Logout Hook.
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});
// Auth routes.
Auth::routes();

// for handing /home route.
Route::get('/home', function(){
    
    if(Auth::User()->isAdmin()){
        return Redirect::to('/admin');
    } else if(Auth::User()->isTeacher()) {
        return Redirect::to('/teacher');
    } else if(Auth::User()->isStudent()) {
        return Redirect::to('/student');
    } else {
        Auth::logout();
        return Redirect::to('login');
    }

});


// Admin Routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {

    Route::get('/', 'AdminController@index')->name('admin');
    // for teacher 
    Route::group(['prefix'  =>   'teachers'], function() {
        Route::get('/', 'AdminController@teacher')->name('admin.teachers.index');
        Route::get('/create', 'AdminController@teacherCreate')->name('admin.teachers.create');
        Route::post('/store', 'AdminController@teacherStore')->name('admin.teachers.store');
        Route::get('/{teacher}/edit', 'AdminController@teacherEdit')->name('admin.teachers.edit');
        Route::post('/update', 'AdminController@teacherUpdate')->name('admin.teachers.update');
        Route::get('/{teacher}/delete', 'AdminController@teacherDelete')->name('admin.teachers.delete');
    });
    // for student 
    Route::group(['prefix'  =>   'students'], function() {
        Route::get('/', 'AdminController@student')->name('admin.students.index');
        Route::get('/create', 'AdminController@studentCreate')->name('admin.students.create');
        Route::post('/store', 'AdminController@studentStore')->name('admin.students.store');
        Route::get('/{student}/edit', 'AdminController@studentEdit')->name('admin.students.edit');
        Route::post('/update', 'AdminController@studentUpdate')->name('admin.students.update');
        Route::get('/{student}/delete', 'AdminController@studentDelete')->name('admin.students.delete');
    });
    // for subject 
    Route::group(['prefix'  =>   'subjects'], function() {
        Route::get('/', 'AdminController@subject')->name('admin.subjects.index');
        Route::get('/create', 'AdminController@subjectCreate')->name('admin.subjects.create');
        Route::post('/store', 'AdminController@subjectStore')->name('admin.subjects.store');
        Route::get('/{subject}/edit', 'AdminController@subjectEdit')->name('admin.subjects.edit');
        Route::post('/update', 'AdminController@subjectUpdate')->name('admin.subjects.update');
        Route::get('/{subject}/delete', 'AdminController@subjectDelete')->name('admin.subjects.delete');
    });
    // for assignment 
    Route::group(['prefix'  =>   'assignments'], function() {
        Route::get('/', 'AdminController@assignment')->name('admin.assignments.index');
        Route::get('/create', 'AdminController@assignmentCreate')->name('admin.assignments.create');
        Route::post('/store', 'AdminController@assignmentStore')->name('admin.assignments.store');
        Route::get('/{assignment}/edit', 'AdminController@assignmentEdit')->name('admin.assignments.edit');
        Route::post('/update', 'AdminController@assignmentUpdate')->name('admin.assignments.update');
        Route::get('/{assignment}/delete', 'AdminController@assignmentDelete')->name('admin.assignments.delete');
    });

    // for zoom meeting 
    Route::group(['prefix'  =>   'meetings'], function() {
        Route::get('/', 'AdminController@meeting')->name('admin.meetings.index');
        Route::get('/create', 'AdminController@meetingCreate')->name('admin.meetings.create');
        Route::post('/store', 'AdminController@meetingStore')->name('admin.meetings.store');
        Route::get('/{meeting}/edit', 'AdminController@meetingEdit')->name('admin.meetings.edit');
        Route::post('/update', 'AdminController@meetingUpdate')->name('admin.meetings.update');
        Route::get('/{meeting}/end', 'AdminController@meetingEnd')->name('admin.meetings.end');
        Route::get('/{meeting}/delete', 'AdminController@meetingDelete')->name('admin.meetings.delete');
    });






});

// Tacher Routes
Route::group(['middleware' => ['auth', 'teacher'], 'prefix' => 'teacher'], function () {
    // dd('here');
    Route::get('/', 'TeacherController@index')->name('teacher');
    // for assignment 
    Route::group(['prefix'  =>   'assignments'], function() {
        Route::get('/', 'TeacherController@assignment')->name('teacher.assignments.index');
        // Route::get('/create', 'TeacherController@assignmentCreate')->name('teacher.assignments.create');
        // Route::post('/store', 'TeacherController@assignmentStore')->name('teacher.assignments.store');
        Route::get('/{assignment}/edit', 'TeacherController@assignmentEdit')->name('teacher.assignments.edit');
        Route::post('/update', 'TeacherController@assignmentUpdate')->name('teacher.assignments.update');
        Route::get('/{assignment}/delete', 'TeacherController@assignmentDelete')->name('teacher.assignments.delete');
        
    });
    Route::group(['prefix'  =>   'meetings'], function() {
        Route::get('/', 'TeacherController@meeting')->name('teacher.meetings.index');
    });
});
// Studnet Routes
Route::group(['middleware' => ['auth', 'student'], 'prefix' => 'student'], function () {
    Route::get('/', 'StudentController@index')->name('student');
    // for assignment 
    Route::group(['prefix'  =>   'assignments'], function() {
        Route::get('/', 'StudentController@assignment')->name('student.assignments.index');
        Route::get('/create', 'StudentController@assignmentCreate')->name('student.assignments.create');
        Route::post('/store', 'StudentController@assignmentStore')->name('student.assignments.store');
        Route::get('/{assignment}/edit', 'StudentController@assignmentEdit')->name('student.assignments.edit');
        Route::post('/update', 'StudentController@assignmentUpdate')->name('student.assignments.update');
        Route::get('/{assignment}/delete', 'StudentController@assignmentDelete')->name('student.assignments.delete');        
    });
    Route::group(['prefix'  =>   'meetings'], function() {
        Route::get('/', 'StudentController@meeting')->name('student.meetings.index');
    });    
});

