<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CanyoKuy</title>
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
        .reset-container { max-width: 450px; width: 100%; }
        .reset-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        .logo { margin-bottom: 30px; }
        .logo h1 { font-size: 32px; color: #2F6B5E; }
        .logo span { color: #e74c3c; }
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
        .alert { padding: 12px; border-radius: 12px; margin-bottom: 20px; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .alert-success { background: #d4edda; color: #155724; }
        .info-token {
            background: #fff3cd;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-card">
            <div class="logo">
                <h1>Canyo<span>Kuy</span></h1>
                <p>Buat Password Baru</p>
            </div>

            <div class="info-token">
                <i class="fas fa-info-circle"></i> Anda sedang mereset password menggunakan token.
            </div>

            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.reset-password.post') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
                </div>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Reset Password
                </button>
            </form>
            <a href="{{ route('admin.login') }}" class="btn-back">← Kembali ke Login</a>
        </div>
    </div>
</body>
</html>