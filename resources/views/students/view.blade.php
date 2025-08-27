<style>
    .bg-purple{
        background-color: purple;
    }
    .bg-teal{
        background-color: teal;
    }
</style>
@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <a href="{{ route('students.manage.student') }}" class="btn btn-secondary mb-4">
        <i class="fas fa-arrow-left"></i> Back to Student List
    </a>

    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-user-graduate me-2"></i> Student Details
            </h4>
        </div>

        <div class="card-body row p-4">
            <div class="col-md-4 text-center mb-4">
                @if($student->image)
                    <img src="{{ asset('storage/' . $student->image) }}" class="img-thumbnail rounded-circle shadow" alt="Student Image" style="width: 200px; height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/200" class="img-thumbnail rounded-circle shadow" alt="No Image">
                @endif
                {{-- <h5 class="mt-3 text-primary">{{ $student->name }}</h5> --}}
                <h5 class="mt-3 text-primary">{{ ucfirst($student->name) }}</h5>
            </div>

            <div class="col-md-8">
                <table class="table table-borderless table-striped">
                    <tbody>
                        <tr>
                            <th class="text-muted"><i class="fas fa-envelope me-2"></i>Email</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted"><i class="fas fa-list-alt me-2"></i>Class</th>
                            {{-- <td><span class="badge bg-info text-dark">{{ $student->SchoolClass->class_name ?? 'N/A' }}</span></td> --}}
        @php
                                            $className = $student->SchoolClass->class_name;

                                            $badgeColor = match($className) {
                                                '1st' => 'bg-primary',
                                                '2nd' => 'bg-secondary',
                                                '3rd' => 'bg-success',
                                                '4th' => 'bg-danger',
                                                '5th' => 'bg-warning text-dark',
                                                '6th' => 'bg-info text-dark',
                                                '7th' => 'bg-dark',
                                                '8th' => 'bg-light text-dark',
                                                '9th' => 'bg-purple text-white',   // custom class, define in CSS if needed
                                                '10th' => 'bg-teal text-white',    // custom class, define in CSS if needed
                                                default => 'bg-muted text-dark',
                                            };
                                        @endphp

<td><span class="badge {{ $badgeColor }}">{{ $className }}</span></td>

                        </tr>
                        <tr>
                            <th class="text-muted"><i class="fas fa-id-card me-2"></i>Roll Number</th>
                            <td>{{ $student->roll_number }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted"><i class="fas fa-phone me-2"></i>Phone</th>
                            <td>{{ $student->phone }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Registered On</th>
                            <td>{{ $student->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>

            
            </div>
        </div>
    </div>
</div>
@endsection
