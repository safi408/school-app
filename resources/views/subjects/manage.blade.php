@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-danger text-white fw-bold">
                        <i class="fas fa-list me-2"></i> Subjects List
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered m-0" id="subjectTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject Name</th>
                                        <th>Class Name</th>
                                        <th>Teacher Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td class="align-middle">{{ $subject->id }}</td>
                                            <td class="align-middle">
                                               @php
    $colors = [
        'Math' => 'bg-primary',
        'English' => 'bg-success',
        'Science' => 'bg-warning text-dark',
        'Computer' => 'bg-info',
        'Urdu' => 'bg-danger',
        'Islamiyat' => 'bg-dark',
        // fallback
        'default' => 'bg-light text-dark'
    ];

    $colorClass = $colors[$subject->subject_name] ?? $colors['default'];
@endphp

<span class="badge {{ $colorClass }}">{{ $subject->subject_name }}</span>

                                            </td>
                                            {{-- <td class="align-middle">
                                                <span class="badge bg-success">{{ $subject->SchoolClass->class_name }}</span>
                                            </td> --}}
                                                                           <td>
    @php
        $className = $subject->SchoolClass->class_name;
        $badgeColor = match($className) {
            '9th' => 'bg-primary',
            '10th' => 'bg-success',
            '11th' => 'bg-warning text-dark',
            '12th' => 'bg-danger',
            default => 'bg-info text-dark',
        };
    @endphp
    <span class="badge {{ $badgeColor }}">{{ $className }}</span>
</td>
                                  <td class="align-middle">
    {{ ucwords($subject->Teacher->name) }}
</td>


                                      <td class="align-middle">
    <a href="{{ route('subjects.view.subject', $subject->id) }}"
       class="btn btn-sm btn-info me-1">
        <i class="bi bi-eye-fill"></i> View
    </a>
    <a href="{{ route('subjects.edit.subject', $subject->id) }}"
       class="btn btn-sm btn-warning me-1">
        <i class="bi bi-pencil-square"></i> Edit
    </a>
    <a href="{{ route('subjects.delete.subject', $subject->id) }}"
       class="btn btn-sm btn-danger"
       onclick="return confirm('Are you sure you want to delete this subject {{ $subject->id }}?')">
        <i class="bi bi-trash"></i> Delete
    </a>
</td>

                                        </tr>
                                    @endforeach

                                    @if($subjects->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No subjects found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- ✅ DataTables Scripts --}}
@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function () {
            $('#subjectTable').DataTable();
        });
    </script>
@endsection
