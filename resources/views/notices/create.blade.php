@extends('layouts.admin')
@section('title')
    Add Notice
@endsection
@section('content')
        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   @endif
      <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Create Notice</h5>
      </div>
      <div class="card-body">
        <form action="{{route('notices.save.notice')}}" method="post">
            @csrf
          <div class="mb-3">
            <label for="noticeTitle" class="form-label">Notice Title</label>
            <input type="text" class="form-control" id="noticeTitle" name="title" placeholder="Enter notice title">
            @error('title')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-success float-end">Submit Notice</button>
        </form>
      </div>
    </div>
  </div>

@endsection