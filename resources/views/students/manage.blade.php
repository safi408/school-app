@extends('layouts.admin')

@section('title') Manage Student @endsection

@section('content')

<style>
    .bg-purple {
        background-color: purple !important;
    }

    .bg-teal {
        background-color: teal !important;
    }

    /* 🔄 Badge Auto Animation */
    .animated-badge {
        animation: pulseColor 3s infinite alternate ease-in-out;
    }

    @keyframes pulseColor {
        0% {
            filter: brightness(100%);
            transform: scale(1);
        }
        50% {
            filter: brightness(115%);
            transform: scale(1.05);
        }
        100% {
            filter: brightness(100%);
            transform: scale(1);
        }
    }

    .badge {
        transition: all 0.3s ease-in-out;
        cursor: default;
    }

    .badge:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        opacity: 0.9;
    }

    tbody tr {
        transition: background-color 0.3s ease;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

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
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-users me-2"></i> Student List</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="studentsTable" class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Class</th>
                            <th>Roll No</th>
                            <th>Image</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($students as $index => $student)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    @php
                                        $className = $student->SchoolClass->class_name ?? 'No Class';
                                        $badgeColor = match($className) {
                                            '11th' => 'bg-primary',
                                            '12th' => 'bg-secondary',
                                            '3rd' => 'bg-success',
                                            '4th' => 'bg-danger',
                                            '5th' => 'bg-warning text-dark',
                                            '6th' => 'bg-info text-dark',
                                            '7th' => 'bg-dark',
                                            '8th' => 'bg-light text-dark',
                                            '9th' => 'bg-purple text-white',
                                            '10th' => 'bg-teal text-white',
                                            default => 'bg-muted text-dark',
                                        };
                                    @endphp
                                    <span class="badge animated-badge {{ $badgeColor }}">{{ $className }}</span>
                                </td>
                                <td><span class="badge bg-secondary">{{ $student->roll_number }}</span></td>
                                <td>
                                    @if($student->image)
                                        <img src="{{ asset('storage/' . $student->image) }}" alt="Student Image" class="rounded-circle shadow" height="40" width="40">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    <a href="{{ route('students.edit.student', $student->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('students.view.student', $student->id) }}" class="btn btn-sm btn-success me-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('students.delete.student', $student->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No students found.</td>
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
            $('#studentsTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 100],
                "order": [[0, 'desc']],
                "columnDefs": [
                    { "orderable": false, "targets": [5, 7] }
                ],
                "language": {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Students..."
                }
            });
        });
    </script>
@endsection
