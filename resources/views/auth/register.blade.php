<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | School Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #667eea, #764ba2);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      padding: 20px;
    }

    .register-box {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 40px;
      max-width: 500px;
      width: 100%;
      color: #fff;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
      animation: fadeIn 0.7s ease;
    }

    .register-box h3 {
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }

    .form-label {
      color: #fff;
      font-weight: 600;
    }

    .form-control {
      background-color: transparent;
      border: 1px solid rgba(255, 255, 255, 0.4);
      color: #fff;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
      border-color: #fff;
      box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
    }

    .input-group-text {
      background-color: transparent;
      border: none;
      color: #fff;
    }

    .btn-custom {
      background-color: #ffffff;
      color: #333;
      font-weight: 600;
      border-radius: 10px;
    }

    .btn-custom:hover {
      background-color: #f1f1f1;
    }

    .text-muted,
    .text-muted a {
      color: #e0e0e0 !important;
    }

    .alert-danger {
      background-color: rgba(255, 0, 0, 0.2);
      border: 1px solid rgba(255, 0, 0, 0.4);
      color: #fff;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<div class="register-box">
  <h3><i class="fas fa-user-plus me-2"></i>Create Account</h3>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Full Name -->
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input id="name" type="text" name="name" value="{{ old('name') }}"
        class="form-control @error('name') is-invalid @enderror" placeholder="Your name" autofocus>
      </div>
      @error('name')
      <small class="text-danger d-block mt-1">{{ $message }}</small>
      @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com">
      </div>
      @error('email')
      <small class="text-danger d-block mt-1">{{ $message }}</small>
      @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input id="password" type="password" name="password"
               class="form-control @error('password') is-invalid @enderror" placeholder="Password">
      </div>
      @error('password')
      <small class="text-danger d-block mt-1">{{ $message }}</small>
      @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
      <label for="password-confirm" class="form-label">Confirm Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-check-double"></i></span>
        <input id="password-confirm" type="password" name="password_confirmation"
               class="form-control" placeholder="Repeat password">
      </div>
    </div>

    <!-- Submit -->
    <div class="d-grid mb-3">
      <button type="submit" class="btn btn-custom">
        <i class="fas fa-user-plus me-1"></i> Register
      </button>
    </div>

    <!-- Login link -->
    @if (Route::has('login'))
    <div class="text-center">
      <span class="text-muted">Already have an account?</span>
      <a class="d-block text-decoration-none text-white fw-bold" href="{{ route('login') }}">
        Login here
      </a>
    </div>
    @endif

  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
