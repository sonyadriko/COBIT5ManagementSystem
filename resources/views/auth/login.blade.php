<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .login-header {
            background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 50vh;
            position: relative;
        }

        .login-header .mask {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .login-header .content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            margin-top: 20%;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-card .form-control {
            border-radius: 10px;
        }

        .login-card .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
        }

        .login-card .btn {
            border-radius: 10px;
            background: linear-gradient(90deg, #6c63ff, #4b4ce3);
            color: white;
        }

        .login-card .btn:hover {
            background: linear-gradient(90deg, #4b4ce3, #6c63ff);
        }
    </style>
</head>

<body class="bg-light">

    <main class="main-content">
        <!-- Header Section -->
        {{-- <section class="login-header">
            <span class="mask"></span>
            <div class="content">
                <h1>Welcome Back!</h1>
                <p>Please log in to continue</p>
            </div>
        </section> --}}

        <!-- Login Form Section -->
        <section class="min-vh-100 d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card login-card p-4">
                            <div class="card-body">
                                <h3 class="text-center mb-4">Login</h3>
                                <form method="POST" action="{{ route('login') }}" role="form text-left">
                                    @csrf

                                    <!-- Email Input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i
                                                    class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" placeholder="Email"
                                                name="email" value="{{ old('email') }}" required autofocus>
                                        </div>
                                        @error('email')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" required>
                                        </div>
                                        @error('password')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember_me">
                                        <label class="form-check-label" for="remember_me">Remember me</label>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary w-100">Log in</button>
                                    </div>
                                </form>

                                <!-- Forgot Password -->
                                <div class="text-center mt-3">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted">Forgot your
                                            password?</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
