@extends('layouts.admin')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5">
        <div class="card shadow rounded border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bi bi-person-badge-fill me-2"></i> Teacher List
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="teachersTable" class="table table-bordered table-hover table-striped m-0 align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Education</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                                <tr class="text-center">
                                    <td>{{ $teacher->id }}</td>
                                    <td>
                                        @if($teacher->image)
                                            <img src="{{ asset('storage/' . $teacher->image) }}" height="50" width="50" class="rounded-circle shadow-sm" alt="Teacher Image">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $teacher->education }}</span>
                                    </td>
                                  <td>
    <a href="{{ route('teachers.view.teacher', $teacher->id) }}" class="btn btn-sm btn-info me-1">
        <i class="bi bi-eye-fill"></i> View
    </a>
    <a href="{{ route('teachers.edit.teacher', $teacher->id) }}" class="btn btn-sm btn-warning me-1">
        <i class="bi bi-pencil-square"></i> Edit
    </a>
    <a href="{{ route('teachers.delete.teacher', $teacher->id) }}"
       onclick="return confirm('Are you sure you want to delete this teacher?')"
       class="btn btn-sm btn-danger">
        <i class="bi bi-trash"></i> Delete
    </a>
</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No teachers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#teachersTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [1, 6] } // disable sorting on image & actions
                ]
            });
        });
    </script>
@endsection
