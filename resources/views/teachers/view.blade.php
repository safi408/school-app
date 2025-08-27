@extends('layouts.admin')

@section('title') Teacher Details @endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-info text-white">
            <h4><i class="bi bi-eye-fill me-2"></i> Teacher Details</h4>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                @if($teacher->image)
                    <img src="{{ asset('storage/' . $teacher->image) }}" class="rounded-circle shadow" width="120" height="120" alt="Teacher Image">
                @else
                    <span class="badge bg-secondary">No Image</span>
                @endif
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> {{ $teacher->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $teacher->email }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $teacher->phone }}</li>
                <li class="list-group-item"><strong>Education:</strong> {{ $teacher->education }}</li>
            </ul>

            <div class="mt-4">
                <a href="{{ route('teachers.manage.teacher') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
