@extends('layouts.admin')

@section('title', 'Mark Attendance')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Mark Attendance</h4>

   @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <form method="POST" action="{{ route('attendance.store') }}">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Select Date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="table-responsive">
            <table id="attendanceTable" class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->roll_number }}</td>
                        <td>
                            <select name="attendance[{{ $student->id }}]" class="form-select form-select-sm" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="Late">Late</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
    </form>
</div>
@endsection

@section('scripts')
    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#attendanceTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "ordering": false, // Status column sorting disabled
                "language": {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Students..."
                }
            });
        });
    </script>
@endsection
