<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;


class AttendenceController extends Controller
{
    //
        public function create()
    {
        $students = Student::all();
        return view('welcome', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $student_id, 'date' => $request->date],
                ['status' => $status]
            );
        }

        return redirect()->back()->with('success', 'Attendance marked successfully.');
    }

   


public function index(Request $request)
{
    $dateFilter = $request->input('date');

    if ($dateFilter) {
        // Filter specific date
        $attendancesQuery = Attendance::with('student')
            ->whereDate('date', $dateFilter)
            ->get()
            ->groupBy('date');
    } else {
        // All records
        $attendancesQuery = Attendance::with('student')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date');
    }

    return view('show', [
        'attendances' => $attendancesQuery,
    ]);
}





public function showAttendanceRecords()
{
    // Fetch records grouped by date
    $attendances = Attendance::with('student')
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy('date'); // Group by date

    return view('show', compact('attendances'));
}


public function manage()
{
    $dates = Attendance::select('date')->distinct()->orderBy('date', 'desc')->get();
    return view('manage', compact('dates'));
}



public function edit($id)
{
    $attendance = Attendance::with('student')->findOrFail($id);
    return view('update', compact('attendance'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Present,Absent'
    ]);

    $attendance = Attendance::findOrFail($id);
    $attendance->status = $request->status;
    $attendance->save();

    return redirect()->route('attendance.manage', ['date' => $attendance->date])
        ->with('success', 'Attendance updated successfully.');
}

public function destroy($id)
{
    $attendance = Attendance::findOrFail($id);
    $date = $attendance->date; // Save date to redirect with filter
    $attendance->delete();

    return redirect()->route('attendance.manage', ['date' => $date])
        ->with('error', 'Attendance record deleted successfully.');
}



}
