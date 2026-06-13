<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fb;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* ========== SISI KIRI (HIJAU + MELENGKUNG) ========== */
        .login-left {
            flex: 0 0 42%;
            background: #2F6B5E;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 80px;
            color: white;
            z-index: 1;
        }

        .login-left::after {
            content: '';
            position: absolute;
            top: -10%;
            bottom: -10%;
            right: -120px;
            width: 240px;
            background: #2F6B5E;
            border-radius: 50%;
            z-index: -1;
        }

        .left-subtitle {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .left-brand {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: 1px;
            line-height: 1.1;
        }

        /* Tombol Kembali ke Beranda */
        .back-to-home {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 40px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .back-to-home:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateX(-3px);
        }

        .back-to-home i {
            font-size: 14px;
        }

        /* ========== SISI KANAN (FORM LOGIN) ========== */
        .login-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            z-index: 2;
        }

        .login-container {
            max-width: 480px;
            width: 100%;
            text-align: center;
            padding-left: 40px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid white;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: none;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #2F6B5E;
            border-radius: 4px;
            font-size: 16px;
            background: transparent;
            font-family: inherit;
            color: #333;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(47, 107, 94, 0.15);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 40px;
            font-size: 14px;
            color: #4a5568;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .form-options input[type="checkbox"] {
            accent-color: #2F6B5E;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .form-options a {
            color: #4a5568;
            text-decoration: none;
            transition: color 0.2s;
        }

        .form-options a:hover {
            color: #2F6B5E;
            text-decoration: underline;
        }

        .btn-action-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        .btn-login {
            padding: 14px 40px;
            background: #2F6B5E;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #1e4a40;
        }

        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .info-demo {
            padding: 12px;
            background: rgba(47, 107, 94, 0.1);
            border-radius: 8px;
            font-size: 13px;
            color: #2F6B5E;
            text-align: center;
            border: 1px dashed #2F6B5E;
        }

        @media (max-width: 900px) {
            body {
                flex-direction: column;
            }

            .login-left {
                flex: none;
                padding: 60px 20px 40px;
                align-items: center;
                text-align: center;
            }

            .login-left::after {
                display: none;
            }

            .left-brand {
                font-size: 32px;
            }

            .login-container {
                padding-left: 0;
            }

            .back-to-home {
                top: 15px;
                left: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- TOMBOL KEMBALI KE BERANDA -->
    <a href="{{ route('beranda') }}" class="back-to-home">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <div class="login-left">
        <div class="left-subtitle">DASHBOARD</div>
        <div class="left-brand">ADMIN LOGIN</div>
    </div>

    <div class="login-right">
        <div class="login-container">

            <img src="{{ asset('images/logo.jpg') }}" alt="Logo CanyoKuy" class="logo-img">

            <h1 class="welcome-title">WELCOME BACK!</h1>
            <p class="welcome-subtitle">Please login to view your dashboard</p>

            @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="User Name" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="btn-action-wrapper">
                    <button type="submit" class="btn-login">
                        LOGIN
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>

</html>