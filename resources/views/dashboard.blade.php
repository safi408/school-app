@extends('layouts.admin')
@section('title') Admin Dashboard @endsection

@section('content')
<style>
    .card-3d {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
        transform-style: preserve-3d;
        will-change: transform;
    }

    .card-3d:hover {
        transform: rotateY(6deg) rotateX(3deg) scale(1.05);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    .card-3d i {
        transition: transform 0.4s ease;
    }

    .card-3d:hover i {
        transform: scale(1.15) rotate(5deg);
    }
</style>

<div class="container-fluid py-4">
    <h3 class="mb-4 fw-bold text-dark">Welcome to admin Dashboard</h3>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Students Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-3d bg-primary text-white border-0 rounded-4 shadow">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-white-50 fw-semibold mb-1">Total Students</h6>
                        <h3 class="fw-bold" id="studentCount">0</h3>
                    </div>
                    <i class="fas fa-user-circle fa-2x text-white-50 ms-auto"></i>
                </div>
            </div>
        </div>

        <!-- Teachers Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-3d bg-success text-white border-0 rounded-4 shadow">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-white-50 fw-semibold mb-1">Total Teachers</h6>
                        <h3 class="fw-bold" id="teacherCount">0</h3>
                    </div>
                    <i class="fas fa-user-tie fa-2x text-white-50 ms-auto"></i>
                </div>
            </div>
        </div>

        <!-- Classes Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-3d bg-danger text-white border-0 rounded-4 shadow">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-white-50 fw-semibold mb-1">Total Classes</h6>
                        <h3 class="fw-bold" id="classCount">0</h3>
                    </div>
                    <i class="fas fa-school fa-2x text-white-50 ms-auto"></i>
                </div>
            </div>
        </div>

        <!-- Subjects Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card card-3d bg-info text-white border-0 rounded-4 shadow">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-white-50 fw-semibold mb-1">Total Subjects</h6>
                        <h3 class="fw-bold" id="courseCount">0</h3>
                    </div>
                    <i class="fas fa-book-open fa-2x text-white-50 ms-auto"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Recent Notices -->
    <div class="mt-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold"><i class="fas fa-bell me-2 text-warning"></i>Recent Notices</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse ($notices as $notice)
                        <li class="list-group-item">
                            <i class="fas fa-circle text-success me-2 small"></i> {{ $notice->title }}
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No recent notices available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Pure JavaScript Counter Animation
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerText = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    document.addEventListener("DOMContentLoaded", function () {
        animateValue("studentCount", 0, {{ $student }}, 1000);
        animateValue("teacherCount", 0, {{ $teacher }}, 1000);
        animateValue("classCount", 0, {{ $class }}, 1000);
        animateValue("courseCount", 0, {{ $course }}, 1000);

        // Chart.js Overview Chart
        const ctx = document.getElementById('overviewChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Students', 'Teachers', 'Classes', 'Subjects'],
                datasets: [{
                    label: 'Total Count',
                    data: [{{ $student }}, {{ $teacher }}, {{ $class }}, {{ $course }}],
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.7)',
                        'rgba(25, 135, 84, 0.7)',
                        'rgba(220, 53, 69, 0.7)',
                        'rgba(13, 202, 240, 0.7)'
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(13, 202, 240, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
</script>
@endsection
