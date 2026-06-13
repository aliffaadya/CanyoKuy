<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a3c34 0%, #2F6B5E 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .forgot-container { max-width: 450px; width: 100%; }
        .forgot-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        .logo { margin-bottom: 30px; }
        .logo h1 { font-size: 32px; color: #2F6B5E; }
        .logo span { color: #e74c3c; }
        .logo p { color: #666; font-size: 14px; margin-top: 8px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .form-group input {
            width: 100%; padding: 14px 16px;
            border: 2px solid #e0e0e0; border-radius: 16px;
            font-size: 16px;
        }
        .form-group input:focus {
            outline: none; border-color: #2F6B5E;
            box-shadow: 0 0 0 3px rgba(47,107,94,0.1);
        }
        .btn-submit {
            width: 100%; padding: 14px;
            background: #2F6B5E; color: white;
            border: none; border-radius: 16px;
            font-size: 16px; font-weight: 600;
            cursor: pointer;
        }
        .btn-submit:hover { background: #1e4a40; }
        .btn-back {
            display: block; margin-top: 20px;
            color: #2F6B5E; text-decoration: none;
        }
        .alert {
            padding: 12px; border-radius: 12px; margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .token-box {
            background: #f0f7f5;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            word-break: break-all;
        }
        .token-text {
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
            color: #2F6B5E;
            background: white;
            padding: 8px;
            border-radius: 8px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="logo">
                <h1>Canyo<span>Kuy</span></h1>
                <p>Reset Password</p>
            </div>

            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('reset_token'))
            <div class="token-box">
                <p><strong>🔑 Token Reset Password Anda:</strong></p>
                <div class="token-text">{{ session('reset_token') }}</div>
                <p style="font-size: 12px; margin-top: 10px;">
                    Simpan token ini, lalu klik link di bawah untuk reset password.
                </p>
                <a href="{{ route('admin.reset-password.form', ['token' => session('reset_token')]) }}" 
                   style="display: inline-block; margin-top: 10px; color: #2F6B5E; font-weight: 600;">
                    ➡️ Klik di sini untuk reset password
                </a>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.forgot-password.post') }}">
                @csrf
                <div class="form-group">
                    <label>Email Admin</label>
                    <input type="email" name="email" placeholder="admin@canyokuy.com" required>
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Kirim Token Reset
                </button>
            </form>
            <a href="{{ route('admin.login') }}" class="btn-back">← Kembali ke Login</a>
        </div>
    </div>
</body>
</html>