<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\TimetableController;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/student', function() {
  return view('welcome');
});

// Route::get('/time', function() {
//    return view('timetable');
// });


Route::middleware(['auth'])->group(function() {

//Start TimeTable
Route::get('/time', [TimetableController::class, 'create'])->name('timetables.create');
Route::post('/timetables/store', [TimetableController::class, 'store'])->name('timetable.store');
Route::get('/timetable/list', [TimetableController::class, 'manage_time'])->name('timetables.list');
Route::get('/timetable/class/{id}', [TimetableController::class, 'manageClassTimetable'])->name('timetable.class');


Route::get('/timetable', [TimetableController::class, 'index'])->name('timetables.listed');
Route::get('/timetables/show/{id}', [TimetableController::class, 'showClassTimetable'])->name('timetable.cls');


Route::get('/timetable/{id}/edit', [TimetableController::class, 'edit'])->name('timetable.edit');
Route::put('/timetable/{id}', [TimetableController::class, 'update'])->name('timetable.update');
Route::delete('/timetable/{id}', [TimetableController::class, 'destroy'])->name('timetable.destroy');
//End Timetable

// Start Attendance
Route::get('/attendance/mark', [AttendenceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/mark', [AttendenceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/records', [AttendenceController::class, 'showAttendanceRecords'])->name('attendance.records');
Route::get('/admin/attendance', [AttendenceController::class, 'index'])->name('admin.attendance.index');
Route::get('/attendance/manage', [AttendenceController::class, 'manage'])->name('attendance.manage');
Route::get('/attendance/{id}/edit', [AttendenceController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{id}/update', [AttendenceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{id}', [AttendenceController::class, 'destroy'])->name('attendance.delete');
// End Attendance


 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');

Route::prefix('classes')->group(function () {

      Route::get('/add/class', [ClassController::class, 'class'])->name('classes.add.class');
      Route::post('/save/class', [ClassController::class, 'save_class'])->name('classes.save.class');
      Route::get('/manage/class', [ClassController::class, 'manage_class'])->name('classes.manage.class');
      Route::get('/delete/class/{id}', [ClassController::class, 'delete'])->name('classes.delete.class');

   });


  Route::prefix('students')->group(function() {

     Route::get('/add/student', [StudentController::class, 'student'])->name('students.add.student');
     Route::post('/save/student', [StudentController::class, 'save_student'])->name('students.save.student');
     Route::get('manage/student', [StudentController::class, 'manage_student'])->name('students.manage.student');
     Route::get('/student/view/{id}',[StudentController::class, 'view_student'])->name('students.view.student');
     Route::get('/student/delete/{id}',[StudentController::class, 'delete'])->name('students.delete.student');
     Route::get('/student/edit/{id}', [StudentController::class, 'edit'])->name('students.edit.student');
     Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('students.update.student');

});


Route::prefix('teachers')->group(function() {

    Route::get('/teacher/add', [TeacherController::class, 'index'])->name('teachers.add.teacher');
    Route::post('/teacher/save', [TeacherController::class, 'save_teacher'])->name('teachers.save.teacher');
    Route::get('/teacher/manage', [TeacherController::class, 'manage_teacher'])->name('teachers.manage.teacher');
    Route::get('/teacher/delete/{id}', [TeacherController::class, 'delete'])->name('teachers.delete.teacher');
    Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.edit.teacher');
    Route::post('/teacher/update/{id}', [TeacherController::class, 'update'])->name('teachers.update.teacher');
    Route::get('/teachers/view/{id}', [TeacherController::class, 'show'])->name('teachers.view.teacher');

});

Route::prefix('subjects')->group(function() {

      Route::get('/subject/add', [SubjectController::class, 'subject'])->name('subjects.add.subject');
      Route::post('/subject/save', [SubjectController::class, 'save_subject'])->name('subjects.save.subject');
      Route::get('/subject/manage', [SubjectController::class, 'manage_subject'])->name('subjects.manage.subject');
      Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subjects.edit.subject');
      Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('subjects.update.subject');
      Route::get('/subject/delete/{id}', [SubjectController::class, 'delete'])->name('subjects.delete.subject');
      Route::get('/subjects/view/{id}', [SubjectController::class, 'show'])->name('subjects.view.subject');

});

Route::prefix('notices')->group(function() {
  Route::get('/notice/add', [NoticeController::class, 'notice'])->name('notices.add.notice');
  Route::post('/notice/save', [NoticeController::class, 'save_notice'])->name('notices.save.notice');
  Route::get('/notice/manage', [NoticeController::class, 'manage_notice'])->name('notices.manage.notice');
  Route::get('/notice/delete/{id}', [NoticeController::class, 'delete'])->name('notices.delete.notice');
});

});


Auth::routes();


