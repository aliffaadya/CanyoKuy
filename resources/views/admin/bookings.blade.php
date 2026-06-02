<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: #2F6B5E;
            color: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
            text-align: center;
        }

        .info-box {
            background: #fff3cd;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-back {
            background: #2F6B5E;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-database"></i> Admin Panel - CanyoKuy</h1>
            <p>Halaman admin untuk verifikasi pemesanan</p>
        </div>

        <div class="info-box">
            <i class="fas fa-info-circle" style="font-size: 24px;"></i>
            <h3>Mode Demo (Tanpa Database)</h3>
            <p>Data pemesanan akan masuk ke WhatsApp Admin.<br>
            Untuk production, silakan aktifkan database dan controller BookingController.</p>
            <br>
            <p><strong>📌 Untuk sementara, cek pemesanan di WhatsApp: 08123456789</strong></p>
        </div>

        <div style="text-align: center;">
            <a href="{{ url('/') }}" class="btn-back">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>