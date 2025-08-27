<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Course;

class SubjectController extends Controller
{
    //
    public function subject(){
        $classes = SchoolClass::all();
        $teachers = Teacher::all();
        return view('subjects.create',compact('classes','teachers'));
    }
    public function save_subject(Request $request){
     $request->validate([
        'subject_name' => 'required|string|max:255',
        'class_id' => 'required|exists:school_classes,id',
        'teacher_id' => 'required|exists:teachers,id',
    ]);
     $subject = new Course;
     $subject->subject_name = $request->subject_name;
     $subject->class_id = $request->class_id;
     $subject->teacher_id = $request->teacher_id;
     $subject->save();
     return back()->with('success', 'Subject added successfully!');
    }
    public function manage_subject(){
        $subjects = Course::all();
        return view('subjects.manage',compact('subjects'));
    }
    public function edit($id){
      $subject = Course::find($id);
      $classes = SchoolClass::all();
      $teachers = Teacher::all();
      return view('subjects.update',compact('subject','classes','teachers'));
    }
    public function update(Request $request,$id){
   $request->validate([
        'subject_name' => 'required|string|max:255',
        'class_id'     => 'required|exists:school_classes,id',
        'teacher_id'   => 'required|exists:teachers,id',
    ]);

    $subject = Course::findOrFail($id);

    $subject->subject_name = $request->subject_name;
    $subject->class_id     = $request->class_id;
    $subject->teacher_id   = $request->teacher_id;
    $subject->save();

    return redirect()->route('subjects.manage.subject')->with('success', 'Subject updated successfully!');
    }

    public function delete($id){
      $subject = Course::find($id);
      $subject->delete();
    return redirect()->back()->with('warning', 'Subject deleted successfully!');
    }
  
      public function show($id)
    {
        // Load course with related class and teacher
        $course = Course::with(['schoolClass', 'teacher'])->findOrFail($id);

        return view('subjects.view', compact('course'));
    }

}
