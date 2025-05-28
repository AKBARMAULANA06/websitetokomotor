<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/vendor/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/vendor/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/admin/dist/css/adminlte.min.css">
    <!-- Custom CSS -->
    <style>
        /* Body dengan gambar motor sebagai background */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Source Sans Pro', sans-serif;
            background: url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #ffffff;
            overflow: hidden;
            position: relative;
        }

        /* Parallax Effect */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            z-index: -1;
            animation: parallax 20s linear infinite;
        }

        @keyframes parallax {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Kotak login */
        .login-box {
            width: 400px;
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Card dengan glassmorphism */
        .card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.7);
        }

        /* Header card dengan gradient animation */
        .card-header {
            background: linear-gradient(135deg, rgba(255, 69, 0, 0.8), rgba(255, 140, 0, 0.8));
            color: white;
            text-align: center;
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            animation: gradientAnimation 5s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card-header a {
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-decoration: none;
            letter-spacing: 1.5px;
        }

        /* Body card */
        .card-body {
            padding: 30px;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
        }

        .login-box-msg {
            margin: 0 0 25px;
            text-align: center;
            color: #cccccc;
            font-size: 18px;
        }

        /* Input group */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group-text {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-right: none;
            color: #ffffff;
        }

        .form-control {
            border-left: none;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff4500;
            box-shadow: 0 0 10px rgba(255, 69, 0, 0.5);
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
        }

        /* Tombol login dengan neon glow effect */
        .btn-primary {
            background: linear-gradient(135deg, #ff4500, #ff8c00);
            border: none;
            transition: all 0.3s ease;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 12px;
            border-radius: 8px;
            color: #ffffff;
            box-shadow: 0 0 10px rgba(255, 69, 0, 0.5);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff8c00, #ff4500);
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 69, 0, 0.8);
        }

        /* Alert dan feedback */
        .alert {
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.5);
            color: #ff6666;
        }

        .invalid-feedback {
            display: block;
            margin-top: 5px;
            color: #ff6666;
            font-size: 14px;
        }

        /* Ikon */
        .fas {
            color: #ffffff;
        }

        /* Tampilan Registrasi */
        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #ff4500;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/vendor/admin/index2.html" class="h1"><b>SELES </b>MOTOR</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger">{{ session('loginError') }}</div>
                @endif

                <form action="/login/do" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <!-- Tambahkan Link Registrasi -->
                <div class="register-link">
                    <p>Don't have an account? <a href="/register">Register here</a></p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/vendor/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/vendor/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/vendor/admin/dist/js/adminlte.min.js"></script>
</body>

</html>
