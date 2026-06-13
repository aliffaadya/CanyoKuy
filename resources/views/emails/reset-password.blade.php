<!DOCTYPE html>
<html>
<head>
    <title>Reset Password CanyoKuy</title>
</head>
<body>
    <h2>Reset Password CanyoKuy</h2>
    <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
    <p>Klik link di bawah ini untuk mereset password Anda:</p>
    <p>
        <a href="{{ $resetLink }}" style="background: #2F6B5E; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
    </p>
    <p>Atau copy link ini: {{ $resetLink }}</p>
    <p>Link ini akan kadaluarsa dalam 24 jam.</p>
    <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
</body>
</html>