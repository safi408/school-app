@extends('layouts.admin')
@section('content')
       @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   @endif
   <div class="container mt-3">
       <div class="row">
          <form action="{{route('teachers.save.teacher')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow rounded">
               <div class="card-header"><h4 class="mb-0">Teacher Registration Form</h4></div>
               <div class="card-body">
                   <div class="mb-3">
          <label for="image" class="form-label">Upload Image</label>
          <input class="form-control" type="file" id="image" name="image">
           @error('image')
               <span class="text-danger">{{$message}}</span>
           @enderror
        </div>

        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name">
             @error('name')
               <span class="text-danger">{{$message}}</span>
           @enderror
        </div>
  
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com">
             @error('email')
               <span class="text-danger">{{$message}}</span>
           @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
             @error('phone')
               <span class="text-danger">{{$message}}</span>
           @enderror
        </div>

        <div class="mb-3">
          <label for="education" class="form-label">Education</label>
          <input type="text" class="form-control" id="education" name="education" placeholder="e.g., M.Sc, B.Ed">
             @error('education')
               <span class="text-danger">{{$message}}</span>
           @enderror
        </div>

               </div>

               <div class="card-footer">
                 <button type="submit" class="btn btn-success float-end">Add Teacher</button>
               </div>

            </div>
          </form>
       </div>
   </div>
@endsection