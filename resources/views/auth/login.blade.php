<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>  Login | School Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon via CDN -->
   <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/3135/3135768.png">


    <!-- Bootstrap & FontAwesome -->
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
            margin: 0;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            max-width: 420px;
            width: 100%;
            color: #fff;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.7s ease;
        }

        .login-box h2 {
            font-weight: 700;
            margin-bottom: 30px;
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
            background-color: transparent;
            border-color: black;
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
        }

        .input-group-text {
            background-color: rgba(128, 0, 128, 0.445);
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
            background-color: rgba(0, 0, 0, 0.317);
        }

        .form-check-label, .text-muted, .text-muted a {
            color: #e0e0e0 !important;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.4);
            color: #fff;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(30px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2><i class="fas fa-user-shield me-2"></i>School Login</h2>

    {{-- Invalid Credentials --}}
    @if ($errors->has('email') && session('errors')->first('email') === trans('auth.failed'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-triangle-exclamation me-2"></i>
            <div>{{ $errors->first('email') }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label text-white">Email address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control"
                       name="email" id="email" placeholder="Enter email" autocomplete="email">
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label text-white">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control"
                       name="password" id="password" placeholder="Enter password" autocomplete="current-password">
            </div>
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <!-- Submit -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-custom">Login</button>
        </div>

        <!-- Forgot/Register Links -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="d-block text-decoration-none text-muted" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
            @if (Route::has('register'))
           
              <div class="d-flex justify-content-center align-items-center mt-2 gap-1">
    <small class="text-muted mb-0">Don't have an account?</small>
    <a class="text-decoration-none text-white fw-bold" href="{{ route('register') }}">
        Register here
    </a>
</div>

         
            @endif
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
