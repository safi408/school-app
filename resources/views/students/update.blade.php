@extends('layouts.admin')
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Student</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('students.update.student', $student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user me-1"></i> Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" placeholder="Enter student name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" placeholder="Enter email">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-list me-1"></i> Class</label>
                            <select name="class_id" class="form-select">
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-id-badge me-1"></i> Roll Number</label>
                            <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number', $student->roll_number) }}" placeholder="Enter roll number">
                            @error('roll_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-image me-1"></i> Student Image</label>
                            <input type="file" name="image" class="form-control">
                            @if ($student->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $student->image) }}" width="80" class="rounded shadow" alt="Student Image">
                            </div>
                            @endif
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-phone me-1"></i> Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" placeholder="Enter phone number">
                            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-save me-1"></i> Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
