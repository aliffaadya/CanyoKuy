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
            padding: 20px 0;
            /* UBAH INI: Dari sticky menjadi relative agar tidak ikut di-scroll */
            position: relative; 
            background-color: #FAFDFE;
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
            background: #2F6B5E;
            padding: 8px 24px 8px 10px;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 800;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            font-weight: 600;
            flex-wrap: wrap;
            background: #2F6B5E;
            padding: 10px 30px;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            transition: 0.2s;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-links a:hover {
            color: #ffdec2;
        }

        .wa-icon {
            width: 36px;
            height: 36px;
            transition: 0.2s;
            border-radius: 40px;
            border: 2px solid white;
            object-fit: cover;
        }

        .wa-icon:hover {
            transform: scale(1.05);
        }

        /* ========== HERO SECTION (3 GAMBAR BERJEJER) ========== */
        .hero-section {
            width: 100%;
            height: 350px;
            display: flex; 
            overflow: hidden;
        }

        .hero-section img {
            width: 33.333%; 
            height: 100%;
            object-fit: cover;
        }

/* ========== TITLE BANNER ========== */
        .title-banner {
            background-color: #2F6B5E; /* Diubah ke warna hijau tema */
            padding: 24px 0;
            margin-bottom: 30px;
        }

        .banner-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .banner-title {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            text-shadow: none; /* Bayangan dihilangkan karena kontras sudah bagus */
        }

        .banner-price-box {
            text-align: right;
        }

        .banner-price-label {
            font-size: 16px;
            font-weight: 700;
            color: #e0f2f1; /* Sedikit lebih redup dari putih */
            margin-bottom: 4px;
        }

        .banner-price-value {
            font-size: 24px;
            font-weight: 800;
            color: #ffdec2; /* Warna oranye muda agar harga langsung terlihat jelas */
        }

        /* ========== DETAIL PAKET ========== */
        .detail-section {
            padding: 10px 0 80px 0;
        }

        .detail-desc {
            font-size: 16px;
            color: #000000;
            font-weight: 700;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }

        .detail-facilities h3,
        .detail-info h3 {
            font-size: 18px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 16px;
        }

        .facilities-list, .info-list {
            list-style: none;
        }

        .facilities-list li, .info-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 15px;
            color: #000000;
            font-weight: 600;
        }

        .facilities-list li i, .info-list li i {
            color: #2F6B5E;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ========== VIDEO THUMBNAILS DI BAWAH ========== */
        .thumbnail-gallery {
            display: flex;
            gap: 16px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .video-thumbnail {
            position: relative;
            width: calc(33.333% - 11px);
            min-width: 200px;
            height: 120px;
            cursor: pointer;
        }

        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .video-thumbnail .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: rgba(255, 255, 255, 0.85);
            font-size: 40px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
            pointer-events: none; 
            transition: 0.3s;
        }

        .video-thumbnail:hover .play-icon {
            color: white;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-thumbnail.active {
            border: 3px solid #3498db;
        }

        /* Tombol Pesan */
        .action-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-book {
            background: #2F6B5E;
            border: none;
            padding: 14px 40px;
            border-radius: 40px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .btn-book:hover {
            background: #1e4a40;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .banner-container {
                flex-direction: column;
                text-align: center;
            }
            .banner-price-box {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .container-navbar {
                justify-content: center !important;
                gap: 20px;
            }
            .nav-links {
                justify-content: center;
                padding: 15px;
            }
            .hero-section {
                height: 180px; 
            }
            .video-thumbnail {
                width: 100%;
            }
        }
    </style>
</head>

<body>

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
                <a href="{{ url('/cekBSooking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <a href="https://wa.me/628123456789" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>

        </div>
    </div>

    <div class="hero-section">
        <img src="{{ asset('images/camp.jpg') }}" alt="Camp View 1">
        <img src="{{ asset('images/camp.jpg') }}" alt="Camp View 2">
        <img src="{{ asset('images/camp.jpg') }}" alt="Camp View 3">
    </div>

    <div class="title-banner">
        <div class="banner-container">
            <h1 class="banner-title">Paket Canyoneering Camp</h1>
            <div class="banner-price-box">
                <div class="banner-price-label">Mulai Dari</div>
                <div class="banner-price-value">Rp 330.000</div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="detail-section">
            <p class="detail-desc">
                Paket Canyoneering Camp merupakan paket petualangan yang memberikan pengalaman lebih lengkap dengan fasilitas menginap di lokasi kegiatan. Paket ini cocok bagi peserta yang ingin menikmati suasana alam lebih lama serta mengikuti kegiatan fun camp bersama peserta lainnya.
            </p>

            <div class="detail-grid">
                <div class="detail-facilities">
                    <h3>Fasilitas yang Didapat:</h3>
                    <ul class="facilities-list">
                        <li><i class="fas fa-circle"></i> Tenda kapasitas 3 orang</li>
                        <li><i class="fas fa-circle"></i> Matras tidur</li>
                        <li><i class="fas fa-circle"></i> Guide perjalanan profesional</li>
                        <li><i class="fas fa-circle"></i> Safety gear lengkap</li>
                        <li><i class="fas fa-circle"></i> Dokumentasi foto atas dan bawah</li>
                        <li><i class="fas fa-circle"></i> Konsumsi POP Mie 1x</li>
                        <li><i class="fas fa-circle"></i> Teh hangat</li>
                    </ul>
                </div>

                <div class="detail-info">
                    <h3>Informasi Tambahan:</h3>
                    <ul class="info-list">
                        <li><i class="fas fa-circle"></i> Sistem perjalanan: Menginap (Camping)</li>
                        <li><i class="fas fa-circle"></i> Cocok untuk: Peserta yang ingin pengalaman lebih lama</li>
                        <li><i class="fas fa-circle"></i> Disarankan membawa perlengkapan pribadi tambahan</li>
                    </ul>
                </div>
            </div>

            <div class="thumbnail-gallery">
                <div class="video-thumbnail active">
                    <img src="{{ asset('images/camp.jpg') }}" alt="Video 1">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
                <div class="video-thumbnail">
                    <img src="{{ asset('images/camp.jpg') }}" alt="Video 2">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
                <div class="video-thumbnail">
                    <img src="{{ asset('images/camp.jpg') }}" alt="Video 3">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
            </div>

            <div class="action-container">
                <button class="btn-book" onclick="alert('✨ Terima kasih! Silakan lanjutkan ke proses pemesanan.')">Pesan Sekarang</button>
            </div>
            
        </div>
    </div>

</body>

</html>