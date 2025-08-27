@extends('layouts.admin')
@section('content')
          @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   @endif
    <div class="container mt-5">
    <h2>Add New Subject</h2>
    <form action="{{route('subjects.save.subject')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="subject_name" class="form-label">Subject Name</label>
            <input type="text" name="subject_name" class="form-control" id="subject_name" placeholder="Enter Subject Name">
            @error('subject_name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="class_id" class="form-label">Class</label>
            <select name="class_id" id="class_id" class="form-select">
                <option value="">Select Class</option>
                 @foreach ($classes as $class)
                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                 @endforeach
                <!-- Add more class options dynamically from DB -->
            </select>
              @error('class_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-select">
                <option value="">Select Teacher</option>
                @foreach ($teachers as $teacher)
                        <option value="{{$teacher->id}}">Mr. {{$teacher->name}}</option>
                @endforeach
                <!-- Add more teacher options dynamically from DB -->
            </select>
               @error('teacher_id')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>
</div>
@endsection