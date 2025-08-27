@extends('layouts.admin')

@section('head')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
@if (session('error'))
    <div class="container mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h5 class="mb-0"><i class="fas fa-layer-group me-2"></i>All Classes</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="classTable" class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>#ID</th>
                                    <th>Class Name</th>
                                    <th>Total Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($classes as $class)
                                    <tr>
                                        <td>{{ $class->id }}</td>
                                        <td class="fw-semibold text-start ps-3">{{ $class->class_name }}</td>
                                        <td>
                                            <span class="badge bg-success rounded-pill">
                                                {{ $class->Student->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('classes.delete.class', $class->id) }}"
                                               class="btn btn-sm btn-outline-danger rounded-pill">
                                                <i class="fas fa-trash-alt me-1"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted">No classes found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted small text-end">
                    Last updated: {{ now()->format('d M, Y h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th,
    .table td {
        vertical-align: middle !important;
    }
    .table td .badge {
        font-size: 0.85rem;
    }
</style>
@endsection

@section('scripts')
    <!-- jQuery must come first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#classTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    search: "🔍 Search:",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
    </script>
@endsection
