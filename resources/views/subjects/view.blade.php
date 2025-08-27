@extends('layouts.admin')

@section('title') View Subject @endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-eye-fill me-2"></i> Subject Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Subject Name</th>
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

    $colorClass = $colors[$course->subject_name] ?? $colors['default'];
@endphp

<span class="badge {{ $colorClass }}">{{ $course->subject_name }}</span>
                </tr>
                <tr>
                    <th>Class Name</th>
                    <td>
                        <span class="badge bg-info">
                            {{ $course->schoolClass->class_name ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Teacher Name</th>
                    <td>{{ $course->teacher->name ?? 'N/A' }}</td>
                </tr>
            </table>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection
