@extends('layouts.admin')

@section('title', 'Class Timetable')

@section('content')
<div class="container my-5">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i> Show Timetable</h5>
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
                                <option value="{{ route('timetable.cls', $allclass->id) }}"
                                    {{ isset($id) && $id == $allclass->id ? 'selected' : '' }}>
                                    {{ $allclass->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Show Timetable -->
            @if(isset($timetables) && isset($class))
                <div class="alert alert-info mb-3">
                    Showing Timetable for <strong>{{ $class->class_name }}</strong>
                </div>

                @if($timetables->count())

                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        $timeSlots = [];

                        // Create unique time slots from timetable
                        foreach($timetables as $tt) {
                            $start = \Carbon\Carbon::parse($tt->start_time)->format('H:i');
                            $end = \Carbon\Carbon::parse($tt->end_time)->format('H:i');
                            $key = $start . '-' . $end;
                            $timeSlots[$key] = ['start' => $start, 'end' => $end];
                        }

                        $timeSlots = array_values($timeSlots);

                        // Sort slots by start time
                        usort($timeSlots, function ($a, $b) {
                            return strtotime($a['start']) - strtotime($b['start']);
                        });
                    @endphp

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered text-center align-middle shadow-sm">
                            <thead class="table-primary">
                                <tr>
                                    <th>⏰ Time</th>
                                    @foreach($days as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
<tbody>
    @foreach($timeSlots as $slot)
        @php
            $hasLunchBreak = false;
            $lunchEntry = null;

            // Check if any entry in this time slot is a lunch break
            foreach($days as $day) {
                $found = $timetables->first(function($t) use ($slot, $day) {
                    return $t->day_of_week === $day &&
                        \Carbon\Carbon::parse($t->start_time)->format('H:i') === $slot['start'] &&
                        \Carbon\Carbon::parse($t->end_time)->format('H:i') === $slot['end'] &&
                        $t->is_lunch;
                });

                if ($found) {
                    $hasLunchBreak = true;
                    $lunchEntry = $found;
                    break; // break loop after first lunch found
                }
            }
        @endphp

        @if($hasLunchBreak)
            {{-- Single full-width Lunch Row --}}
          <tr class="bg-warning-subtle fw-semibold text-center">
    <td colspan="{{ count($days) + 1 }}">
        🍽 <strong class="text-warning">Lunch Break</strong>
        ({{ \Carbon\Carbon::createFromFormat('H:i', $slot['start'])->format('h:i A') }} -
        {{ \Carbon\Carbon::createFromFormat('H:i', $slot['end'])->format('h:i A') }})
        <br>
        <span class="text-dark">Day: <strong>{{ $lunchEntry->day_of_week }}</strong></span>
        @if($lunchEntry && $lunchEntry->room_number)
            — Room: {{ $lunchEntry->room_number }}
        @endif
    </td>
</tr>

        @else
            {{-- Normal subject row --}}
            <tr>
                <th class="bg-light text-dark">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot['start'])->format('h:i A') }} -
                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot['end'])->format('h:i A') }}
                </th>

                @foreach($days as $day)
                    @php
                        $entry = $timetables->first(function($t) use ($slot, $day) {
                            return $t->day_of_week === $day &&
                                \Carbon\Carbon::parse($t->start_time)->format('H:i') === $slot['start'] &&
                                \Carbon\Carbon::parse($t->end_time)->format('H:i') === $slot['end'];
                        });
                    @endphp

                    <td>
                        @if($entry)
                            <div class="p-2 rounded bg-white border text-start small">
                                <strong class="badge bg-primary">
                                    {{ $entry->Course->subject_name ?? '—' }}
                                </strong><br>
                                <span class="text-dark">{{ $entry->teacher->name ?? '-' }}</span><br>
                                <span class="text-muted">Room: {{ $entry->room_number ?? '-' }}</span>
                            </div>
                        @else
                            <span class="text-muted">–</span>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endif
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
