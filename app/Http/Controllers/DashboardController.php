<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
    //
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function dashboard(){
        $notices = Notice::all();
        $student = Student::count();
        $teacher = Teacher::count();
        $class = SchoolClass::count();
        $course = Course::count();
        return view('dashboard',compact('notices','student','teacher','class','course'));
    }
}
