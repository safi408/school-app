<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | School Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .reset-card {
            max-width: 450px;
            width: 100%;
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .reset-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #4e54c8;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4e54c8;
        }
    </style>
</head>
<body>

<div class="reset-card">
    <h4 class="text-center reset-title"><i class="fas fa-unlock-alt me-2"></i>Reset Your Password</h4>

    @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            @error('email')
                <small class="text-danger d-block mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Send Password Reset Link
            </button>
        </div>

        <!-- Back to Login -->
        @if (Route::has('login'))
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                    <i class="fas fa-arrow-left me-1"></i> Back to Login
                </a>
            </div>
        @endif
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
