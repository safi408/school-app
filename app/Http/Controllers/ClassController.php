<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    //
    public function class(){
        return view('classes.create');
    }
    public function save_class(Request $request)
{
    $request->validate([
        'class_name' => 'required|string|max:100|unique:school_classes,class_name',
    ]);

    $class = new SchoolClass;
    $class->class_name = $request->class_name;
    $class->save();

    return redirect()->back()->with('success', 'Class added successfully!');
}
 public function manage_class(){
    $classes = SchoolClass::all();
    return view('classes.manage',compact('classes'));
 }
 public function delete($id){
    $class = SchoolClass::find($id);
    $class->delete();
    return redirect()->back()->with('error', 'Class deleted successfully!');
 }
}
