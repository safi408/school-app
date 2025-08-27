<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Student;

class StudentController extends Controller
{
    //
    public function student(){
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }
    public function save_student(Request $request){
        $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|unique:students,email',
        'class_id'    => 'required|exists:school_classes,id',
        'roll_number' => 'required|string|max:50|unique:students,roll_number',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'phone'       => 'nullable|string|max:15',
        ]);

         $imageAddress = "asad".time().'.'.$request->image->getClientOriginalExtension();
         $request->image->StoreAs('students', $imageAddress,'public');
         $student = new Student;
         $student->name = $request->name;
         $student->email = $request->email;
         $student->class_id = $request->class_id;
         $student->roll_number = $request->roll_number;
         $student->image = "students/".$imageAddress;
         $student->phone = $request->phone;
         $student->save();
         return back()->with('success', 'Student added successfully!');
    }
    public function manage_student(){
        $students = Student::all();
        return view('students.manage', compact('students'));
    }
    public function view_student($id){
      $student = Student::find($id);
      return view('students.view', compact('student'));
    }
    public function delete($id){
      $student = Student::find($id);
      $student->delete();
      return back()->with('success', 'Student deleted successfully!');
    }
    public function edit($id){
      $student = Student::find($id);
      $classes = SchoolClass::all();
      return view('students.update', compact('student','classes'));
    }
    public function update(Request $request,$id){
         $student = Student::findOrFail($id);

    // Validate request
    $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|unique:students,email,' . $student->id,
        'class_id'    => 'required|exists:school_classes,id',
        'roll_number' => 'required|string|max:50|unique:students,roll_number,' . $student->id,
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'phone'       => 'nullable|string|max:15',
    ]);

    // Update fields
    $student->name = $request->name;
    $student->email = $request->email;
    $student->class_id = $request->class_id;
    $student->roll_number = $request->roll_number;
    $student->phone = $request->phone;

    // Handle new image upload
    if ($request->hasFile('image')) {
        // Optionally delete old image from storage
        if ($student->image && \Storage::disk('public')->exists($student->image)) {
            \Storage::disk('public')->delete($student->image);
        }

        $imageAddress = 'asad' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('students', $imageAddress, 'public');
        $student->image = 'students/' . $imageAddress;
    }

    $student->save();
         return redirect()->route('students.manage.student')->with('success', 'Student updated successfully!');
    }
}
