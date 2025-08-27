            @extends('layouts.admin')

            @section('title', 'Manage Attendance')

            @section('head')
                <!-- DataTables CSS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
            @endsection

            @section('content')
            <div class="container mt-5">
                <h4 class="mb-4 fw-bold text-primary">Manage Attendance</h4>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Select Date Dropdown -->
                <form method="GET" action="{{ route('attendance.manage') }}">
                    <div class="mb-3">
                        <label for="date" class="form-label fw-semibold">Select Date:</label>
                        <select name="date" id="date" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Choose a Date --</option>
                            @foreach($dates as $date)
                                <option value="{{ $date->date }}" {{ request('date') == $date->date ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($date->date)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <!-- Attendance Table -->
                @if(request('date'))
                    @php
                        $attendances = \App\Models\Attendance::with('student')->where('date', request('date'))->get();
                    @endphp

                    @if($attendances->count() > 0)
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Attendance for {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="attendance-table" class="table table-bordered mb-0">
                                        <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student Name</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            @foreach($attendances as $key => $attendance)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $attendance->student->name ?? 'N/A' }}</td>
                                                    <td>
                                                    <span class="badge 
                                                        @if($attendance->status == 'Present') bg-success 
                                                        @elseif($attendance->status == 'Absent') bg-danger 
                                                        @elseif($attendance->status == 'Late') bg-warning 
                                                        @else bg-secondary 
                                                        @endif">
                                                        {{ $attendance->status }}
                                                    </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <form action="{{ route('attendance.delete', $attendance->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info mt-4">No attendance found for selected date.</div>
                    @endif
                @endif
            </div>

            <!-- Include JS scripts directly -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#attendance-table').DataTable({
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search attendance..."
                        }
                    });
                });
            </script>
            @endsection
