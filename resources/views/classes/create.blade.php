@extends('layouts.admin')

@section('title')
    Save Classes
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Main Content -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Add New Class</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('classes.save.class') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Class Name</label>
                            <input
                                type="text"
                                class="form-control @error('class_name') is-invalid @enderror"
                                id="class_name"
                                name="class_name"
                                placeholder="Enter class name (e.g., Class 1)">
                            @error('class_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i> Save Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
