@extends('layouts.admin')

@section('title', 'Class Timetable')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i> Manage Timetable</h5>
        </div>
        <div class="card-body">

            <!-- Filter by Class Dropdown -->
            <form method="GET" class="mb-4">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <label for="classFilter" class="form-label fw-semibold">Select Class</label>
                        <select id="classFilter" class="form-select shadow-sm border-primary"
                                onchange="window.location.href=this.value">
                            <option value="{{ route('timetables.list') }}" {{ !isset($id) ? 'selected' : '' }}>
                                -- Select Class --
                            </option>
                            @foreach($allclasses as $allclass)
                                <option value="{{ route('timetable.class', $allclass->id) }}"
                                    {{ isset($id) && $id == $allclass->id ? 'selected' : '' }}>
                                    {{ $allclass->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Show Only If a Class is Selected -->
            @if(isset($timetables) && isset($class))
                <div class="alert alert-info mb-3">
                    Showing Timetable for <strong>{{ $class->class_name }}</strong>
                </div>

                @if($timetables->count())
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle text-center shadow-sm rounded-3">
                        <thead class="table-primary text-dark fw-semibold">
                            <tr>
                                <th>📘 Subject</th>
                                <th>👨‍🏫 Teacher</th>
                                <th>📅 Day</th>
                                <th>⏰ Time</th>
                                <th>🏫 Room</th>
                                <th>⚙️ Actions</th>
                            </tr>
                        </thead>
<tbody>
@foreach($timetables as $day => $entries)
    <!-- Day Header -->
    <tr class="table-secondary fw-bold text-center">
        <td colspan="6">{{ $day }}</td>
    </tr>

    @foreach($entries as $timetable)
        @if($timetable->is_lunch)
            {{-- Lunch Break Row --}}
            <tr class="bg-warning-subtle fw-semibold text-center">
                <td colspan="6">
                    🍽 <span class="text-warning">Lunch Break</span>
                    ({{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }}
                    -
                    {{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }})
                    on <strong>{{ $timetable->day_of_week }}</strong>
                    @if($timetable->room_number)
                        — Room: {{ $timetable->room_number }}
                    @endif

                    <div class="mt-2">
                        <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('timetable.destroy', $timetable->id) }}"
                              method="POST" class="d-inline-block"
                              onsubmit="return confirm('Are you sure to delete this Lunch Break?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @else
            {{-- Normal Period Row --}}
            <tr>
                <td class="text-primary">{{ $timetable->Course->subject_name ?? 'N/A' }}</td>
                <td>{{ $timetable->teacher->name ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-primary text-white px-3 py-2 rounded-pill">{{ $timetable->day_of_week }}</span>
                </td>
                <td>
                    <span class="text-success fw-semibold">{{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }}</span>
                    -
                    <span class="text-danger fw-semibold">{{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}</span>
                </td>
                <td>
                    @if($timetable->room_number)
                        <span class="badge bg-secondary">{{ $timetable->room_number }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('timetable.destroy', $timetable->id) }}"
                          method="POST" class="d-inline-block"
                          onsubmit="return confirm('Are you sure to delete this entry?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
@endforeach
</tbody>



                    </table>
                </div>
                @else
                    <div class="alert alert-warning">No timetable found for this class.</div>
                @endif
            @endif

        </div>
    </div>
</div>
@endsection
