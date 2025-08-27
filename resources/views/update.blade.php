@extends('layouts.admin')

@section('title', 'Edit Attendance')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4 fw-bold text-primary">Edit Attendance</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" value="{{ $attendance->student->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Attendance Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                        <option value="Late" {{ $attendance->status == 'Late' ? 'selected' : '' }}>Late</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Attendance</button>
                <a href="{{ route('attendance.manage', ['date' => $attendance->date]) }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
