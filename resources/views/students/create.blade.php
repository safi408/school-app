@extends('layouts.admin')
@section('title') Add Student @endsection

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Main Content -->
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-user-plus me-2"></i>
                    <h5 class="mb-0">Add Student</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('students.save.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter student name">
                            @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                            @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Class -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-list"></i> Class</label>
                            <select name="class_id" class="form-select">
                                <option value="">-- Select Class --</option>
                                @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Roll Number -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-id-badge"></i> Roll Number</label>
                            <input type="text" name="roll_number" class="form-control" placeholder="Enter roll number">
                            @error('roll_number')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-image"></i> Student Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-phone"></i> Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                            @error('phone')
                            <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Student
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
