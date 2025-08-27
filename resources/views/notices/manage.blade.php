@extends('layouts.admin')
@section('title')
    Manage Notices
@endsection
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>  All Notices</h5>
        </div>
        <div class="card-body">
            @if(session('warning'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($notices->isEmpty())
                <div class="alert alert-info">No notices found.</div>
            @else
                <ul class="list-group">
                    @foreach($notices as $notice)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $notice->title }}</strong><br>
                                <small class="text-muted">{{ $notice->created_at->format('d M, Y') }}</small>
                            </div>
                 <a href="{{ route('notices.delete.notice', $notice->id) }}" 
                        onclick="return confirm('Are you sure you want to delete this notice?');"
                        class="btn btn-sm btn-danger">
                        <i class="fas fa-times"></i>
                    </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
