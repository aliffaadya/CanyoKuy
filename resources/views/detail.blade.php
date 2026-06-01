<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Camp - CanyoKuy</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #1e2a3e;
            line-height: 1.5;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ========== NAVBAR ========== */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 16px;
            background: #ffffff;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .container-navbar {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border: 2px solid #4199CC;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #1f3b4c, #ff6b35);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            font-weight: 600;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #2c3e4e;
            transition: 0.2s;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-links a:hover {
            color: #ff6b35;
        }

        .nav-links a.active {
            color: #ff6b35;
        }

        .wa-icon {
            width: 36px;
            height: 36px;
            transition: 0.2s;
            border-radius: 50%;
            object-fit: cover;
        }

        .wa-icon:hover {
            transform: scale(1.05);
        }

        /* ========== DETAIL PAKET ========== */
        .detail-section {
            padding: 60px 0;
        }

        .detail-back {
            margin-bottom: 30px;
        }

        .detail-back a {
            text-decoration: none;
            color: #ff6b35;
            font-weight: 600;
            transition: 0.2s;
        }

        .detail-back a:hover {
            transform: translateX(-5px);
            display: inline-block;
        }

        .detail-title {
            font-size: 36px;
            font-weight: 800;
            color: #1e2a3e;
            margin-bottom: 24px;
        }

        .detail-desc {
            font-size: 16px;
            color: #6b7a8a;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        /* Grid 2 kolom */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }

        /* Fasilitas */
        .detail-facilities h3,
        .detail-info h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 20px;
            border-left: 4px solid #ff6b35;
            padding-left: 16px;
        }

        .facilities-list {
            list-style: none;
        }

        .facilities-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            font-size: 15px;
            color: #4a5b6e;
        }

        .facilities-list li i {
            color: #2F6B5E;
            font-size: 18px;
            width: 24px;
        }

        /* Informasi Tambahan Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item {
            background: #f8fafc;
            padding: 16px;
            border-radius: 16px;
        }

        .info-label {
            font-size: 13px;
            color: #8a9aae;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #1e2a3e;
        }

        /* Harga & Tombol */
        .detail-price-section {
            background: linear-gradient(135deg, #fefaf7 0%, #fff5ed 100%);
            border-radius: 24px;
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .price-label {
            font-size: 14px;
            color: #8a9aae;
            font-weight: 500;
        }

        .price-value {
            font-size: 36px;
            font-weight: 800;
            color: #ff6b35;
        }

        .price-value small {
            font-size: 16px;
            font-weight: 500;
            color: #8a9aae;
        }

        .btn-book {
            background: #ff6b35;
            border: none;
            padding: 14px 40px;
            border-radius: 40px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-book:hover {
            background: #e05a2a;
            transform: scale(1.02);
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .detail-price-section {
                flex-direction: column;
                text-align: center;
            }
            .detail-title {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .nav-links {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="container-navbar"
            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-img">
                <span class="logo-text">CanyoKuy</span>
            </div>
            <div class="nav-links">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/#paketWisata') }}">Paket Wisata</a>
                <a href="{{ url('/cek-booking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <a href="https://wa.me/628123456789" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>
        </div>
    </div>

    <!-- DETAIL PAKET -->
    <div class="container">
        <div class="detail-section">
            <div class="detail-back">
                <a href="{{ url('/#paketWisata') }}">← Kembali ke Paket Wisata</a>
            </div>

            <h1 class="detail-title">Paket Canyoneering Camp</h1>
            <p class="detail-desc">
                Paket Canyoneering Camp merupakan paket petualangan yang memberikan pengalaman lebih lengkap dengan fasilitas menginap di lokasi kegiatan. Paket ini cocok bagi peserta yang ingin menikmati suasana alam lebih lama serta mengikuti kegiatan fun camp bersama peserta lainnya.
            </p>

            <div class="detail-grid">
                <!-- Fasilitas -->
                <div class="detail-facilities">
                    <h3>Fasilitas yang Didapat:</h3>
                    <ul class="facilities-list">
                        <li><i class="fas fa-check-circle"></i> Tenda kapasitas 3 orang</li>
                        <li><i class="fas fa-check-circle"></i> Matras tidur</li>
                        <li><i class="fas fa-check-circle"></i> Guide perjalanan profesional</li>
                        <li><i class="fas fa-check-circle"></i> Safety gear lengkap</li>
                        <li><i class="fas fa-check-circle"></i> Dokumentasi foto atas dan bawah</li>
                        <li><i class="fas fa-check-circle"></i> Konsumsi POP Mie 1x</li>
                        <li><i class="fas fa-check-circle"></i> Teh hangat</li>
                    </ul>
                </div>

                <!-- Informasi Tambahan -->
                <div class="detail-info">
                    <h3>Informasi Tambahan:</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Sistem perjalanan</div>
                            <div class="info-value">Menginap (Camping)</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Cocok untuk</div>
                            <div class="info-value">Peserta yang ingin pengalaman lebih lama</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Disarankan membawa</div>
                            <div class="info-value">Perlengkapan pribadi tambahan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Harga & Tombol Pesan -->
            <div class="detail-price-section">
                <div>
                    <div class="price-label">Mulai Dari</div>
                    <div class="price-value">Rp 330.000 <small>/orang</small></div>
                </div>
                <button class="btn-book" onclick="alert('✨ Terima kasih! Silakan lanjutkan ke proses pemesanan.')">Pesan Sekarang</button>
            </div>
        </div>
    </div>

</body>

</html>