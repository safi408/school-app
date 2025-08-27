<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;
use App\Models\timetable;
use Illuminate\Support\Facades\Validator;

class TimetableController extends Controller
{
    //
           public function create()
    {
        $classes =  SchoolClass::all();
        $subjects = Course::all();
        $teachers = Teacher::all();
        return view('timetable', compact('classes', 'subjects', 'teachers'));
    }

        // Store New Timetable Entry
   public function store(Request $request)
{
    $validated = $request->validate([
        'class_id' => 'required|exists:school_classes,id',
        'day_of_week' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
    ]);

    $timetable = new Timetable();
    $timetable->class_id = $request->class_id;
    $timetable->day_of_week = $request->day_of_week;
    $timetable->start_time = $request->start_time;
    $timetable->end_time = $request->end_time;
    $timetable->room_number = $request->room_number;

    if ($request->has('is_lunch')) {
        $timetable->is_lunch = true;
        $timetable->subject_id = null;
        $timetable->teacher_id = null;
    } else {
        $timetable->is_lunch = false;
        $timetable->subject_id = $request->subject_id;
        $timetable->teacher_id = $request->teacher_id;
    }

    $timetable->save();

    return redirect()->back()->with('success', 'Timetable added successfully!');
}

   

public function manage_time()
{
    $allclasses = SchoolClass::all(); // For dropdown
    return view('managetime', compact('allclasses'));
}



public function manageClassTimetable($id)
{
    $class = SchoolClass::findOrFail($id);
    $allclasses = SchoolClass::all();

    $timetables = Timetable::where('class_id', $id)
        ->with(['Course', 'Teacher'])
        ->orderByRaw("
            FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
        ")
        ->orderBy('day_of_week')
        ->orderBy('start_time', 'desc') // change to 'desc' if needed
        ->get()
        ->groupBy('day_of_week'); // group by day in controller

    return view('managetime', compact('timetables', 'class', 'id', 'allclasses'));
}





   // Show the class filter and optionally class timetable
    public function index()
    {
        $allclasses = SchoolClass::all(); // Adjust model name if needed
        return view('showtime', compact('allclasses'));
    }

    // Show timetable for selected class
    public function showClassTimetable($id)
    {
        $class = SchoolClass::findOrFail($id);
        $allclasses = SchoolClass::all();

        $timetables = Timetable::with(['Course', 'teacher'])
            ->where('class_id', $id)
            ->orderBy('end_time','desc')
            ->get();

        return view('showtime', compact('class', 'allclasses', 'timetables', 'id'));
    }







public function edit($id)
{
    $timetable = Timetable::findOrFail($id);
    $classes = SchoolClass::all();
    $subjects = Course::all();
    $teachers = Teacher::all();

    return view('updatetime', compact('timetable', 'classes', 'subjects', 'teachers'));
}


public function update(Request $request, $id)
{
    $isLunch = $request->has('is_lunch');

    // Validation
    $rules = [
        'class_id'     => 'required|exists:school_classes,id',
        'day_of_week'  => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
        'start_time'   => 'required|date_format:H:i',
        'end_time'     => 'required|date_format:H:i|after:start_time',
        'room_number'  => 'nullable|string|max:50',
    ];

    if (!$isLunch) {
        $rules['subject_id'] = 'required|exists:courses,id';
        $rules['teacher_id'] = 'required|exists:teachers,id';
    }

    $request->validate($rules);

    // Find timetable entry
    $timetable = Timetable::findOrFail($id);

    // Update fields
    $timetable->class_id     = $request->class_id;
    $timetable->subject_id   = $isLunch ? null : $request->subject_id;
    $timetable->teacher_id   = $isLunch ? null : $request->teacher_id;
    $timetable->day_of_week  = $request->day_of_week;
    $timetable->start_time   = $request->start_time;
    $timetable->end_time     = $request->end_time;
    $timetable->room_number  = $request->room_number;
    $timetable->is_lunch     = $isLunch;

    $timetable->save();

    return redirect()->route('timetables.list')->with('success', 'Timetable updated successfully.');
}


public function destroy($id)
{
    $timetable = Timetable::findOrFail($id);
    $timetable->delete();

    return redirect()->route('timetables.list')->with('success', 'Timetable deleted successfully.');
}


}
