@extends('layouts.admin')

@section('title', 'Attendance Records')

@section('head')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .table thead th {
        background-color: #f8f9fa;
        color: #343a40;
    }
    .badge {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 12px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">
            <i class="bi bi-calendar-check-fill me-2"></i> Attendance Records
        </h4>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body bg-light rounded-4">
            <form method="GET" action="{{ route('admin.attendance.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="date" class="form-label mb-1 text-muted fw-semibold">Select Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control rounded-3 shadow-sm" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 shadow-sm">
                        <i class="bi bi-funnel-fill me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance Records -->
    @forelse($attendances as $date => $records)
        <div class="card mb-4 shadow-sm border-0 rounded-4">
            <div class="card-header bg-dark text-white rounded-top-4">
                <strong><i class="bi bi-calendar-event me-2"></i>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0 align-middle text-center datatable-{{ $loop->index }}">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Student Name</th>
                                <th>Roll No</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $index => $attendance)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-capitalize fw-medium">{{ $attendance->student->name }}</td>
                                <td class="text-muted">{{ $attendance->student->roll_number }}</td>
                                <td>
                                    @php
                                        $statusColor = match($attendance->status) {
                                            'Present' => 'success',
                                            'Absent' => 'danger',
                                            'Late' => 'warning',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ $attendance->status }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info shadow-sm">No attendance records found.</div>
    @endforelse
</div>
@endsection

@section('scripts')
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Init -->
<script>
    $(document).ready(function () {
        @foreach($attendances as $index => $records)
            $('.datatable-{{ $loop->index }}').DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                //dom: 'frtip', // This enables lengthMenu, filter, table, pagination, etc.
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    zeroRecords: "No matching records found",
                }
            });
        @endforeach
    });
</script>

@endsection
