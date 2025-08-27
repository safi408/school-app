@extends('layouts.admin')

@section('title', 'Edit Timetable Entry')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Timetable Entry</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('timetable.update', $timetable->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label for="class_id" class="form-label">Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ $timetable->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="day_of_week" class="form-label">Day of Week</label>
                    <select name="day_of_week" id="day_of_week" class="form-select" required>
                        <option value="">Select Day</option>
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                            <option value="{{ $day }}" {{ $timetable->day_of_week == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Lunch Break Checkbox -->
                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" value="1" id="is_lunch" name="is_lunch"
                            {{ $timetable->is_lunch ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_lunch">
                            This is a Lunch Break
                        </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-select">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ $timetable->subject_id == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="teacher_id" class="form-label">Teacher</label>
                    <select name="teacher_id" id="teacher_id" class="form-select">
                        <option value="">Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $timetable->teacher_id == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control"
                           value="{{ \Carbon\Carbon::parse($timetable->start_time)->format('H:i') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control"
                           value="{{ \Carbon\Carbon::parse($timetable->end_time)->format('H:i') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="room_number" class="form-label">Room Number (optional)</label>
                    <input type="text" name="room_number" class="form-control"
                           value="{{ $timetable->room_number }}">
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Update Timetable
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Disable Subject/Teacher if Lunch Break -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lunchCheckbox = document.getElementById('is_lunch');
        const subjectSelect = document.getElementById('subject_id');
        const teacherSelect = document.getElementById('teacher_id');

        function toggleFields() {
            const isLunch = lunchCheckbox.checked;
            subjectSelect.disabled = isLunch;
            teacherSelect.disabled = isLunch;

            if (isLunch) {
                subjectSelect.selectedIndex = 0;
                teacherSelect.selectedIndex = 0;
            }
        }

        lunchCheckbox.addEventListener('change', toggleFields);
        toggleFields(); // run once on load
    });
</script>
@endsection
