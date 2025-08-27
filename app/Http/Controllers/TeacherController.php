<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    //
    public function index(){
        return view('teachers.create');
    }
    public function save_teacher(Request $request){
          $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:teachers,email',
        'phone' => 'required|string|max:15',
        'education' => 'nullable|string|max:255',
    ]);
       $imageAddress = "asad".time().'.'.$request->image->getClientOriginalExtension();
       $request->image->StoreAs('teachers', $imageAddress,'public');
       $teacher = new Teacher;
       $teacher->image = "teachers/".$imageAddress;
       $teacher->name = $request->name;
       $teacher->email = $request->email;
       $teacher->phone = $request->phone;
       $teacher->education = $request->education;
       $teacher->save();
       return back()->with('success', 'Teacher added successfully!');
    }
    public function manage_teacher(){
        $teachers = Teacher::all();
        return view('teachers.manage',compact('teachers'));
    }
    public function delete($id){
       $teacher = Teacher::find($id);
       $teacher->delete();
          return back()->with('error', 'Teacher deleted successfully!');
    }
    public function edit($id){
       $teacher = Teacher::find($id);
       return view('teachers.update', compact('teacher'));
    }
    public function update(Request $request, $id)
{
    $teacher = Teacher::findOrFail($id);

    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'name' => 'required|string|max:255',
        'email' => 'required',
        'phone' => 'required|string|max:15',
        'education' => 'nullable|string|max:255',
    ]);

    // Handle image update
    if ($request->hasFile('image')) {
        // Optional: Delete old image
        if ($teacher->image && \Storage::disk('public')->exists($teacher->image)) {
            \Storage::disk('public')->delete($teacher->image);
        }

        $imageName = 'asad' . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('teachers', $imageName, 'public');
        $teacher->image = 'teachers/' . $imageName;
    }

    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->phone = $request->phone;
    $teacher->education = $request->education;
    $teacher->save();

    return redirect()->route('teachers.manage.teacher')->with('success', 'Teacher updated successfully!');
}

public function show($id)
{
    $teacher = Teacher::findOrFail($id); // agar teacher nahi mila to 404 show hoga
    return view('teachers.view', compact('teacher'));
}


}
