<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Camp - CanyoKuy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .navbar {
            padding: 20px 0;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .hero-section {
            width: 100%;
            height: 350px;
            display: flex;
            overflow: hidden;
        }

        .hero-section img {
            width: 33.333%;
            height: 350px;
            object-fit: cover;
            object-position: center;
        }

        .hero-section img:last-child {
            object-position: center bottom;
        }

        .title-banner {
            background-color: #2F6B5E;
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

        .banner-title-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .banner-title {
            font-size: 32px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.2;
        }

        .banner-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .badge.highlight {
            background: #ffdec2;
            color: #2F6B5E;
            border: 1px solid #ffdec2;
            box-shadow: 0 2px 8px rgba(255, 222, 194, 0.4);
        }

        .badge-full {
            background: #e74c3c;
            color: white;
            border: 1px solid #e74c3c;
        }

        .banner-price-box {
            text-align: right;
        }

        .banner-price-label {
            font-size: 16px;
            font-weight: 700;
            color: #e0f2f1;
            margin-bottom: 4px;
        }

        .banner-price-value {
            font-size: 24px;
            font-weight: 800;
            color: #ffdec2;
        }

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

        .facilities-list,
        .info-list {
            list-style: none;
        }

        .facilities-list li,
        .info-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 15px;
            color: #000000;
            font-weight: 600;
        }

        .facilities-list li i,
        .info-list li i {
            color: #2F6B5E;
            font-size: 12px;
            margin-top: 4px;
        }

        .thumbnail-gallery {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .video-thumbnail {
            display: flex;
            justify-content: center;
        }

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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-book:hover:not(:disabled) {
            background: #1e4a40;
            transform: translateY(-2px);
        }

        .btn-book:disabled {
            background: #95a5a6;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: #ffffff;
            border-radius: 24px;
            max-width: 500px;
            width: 90%;
            animation: slideInBooking 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        @keyframes slideInBooking {
            from {
                transform: translateY(20px) scale(0.95);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #2F6B5E 0%, #1e4a40 100%);
            color: white;
            padding: 30px 20px 25px;
            text-align: center;
        }

        .success-icon-wrap {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(4px);
        }

        .success-icon-wrap i {
            font-size: 34px;
            color: #ffffff;
        }

        .modal-header h2 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .modal-header p {
            font-size: 13.5px;
            opacity: 0.85;
        }

        .modal-body {
            padding: 24px;
        }

        .package-summary {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .package-summary h4 {
            color: #1e2a3e;
            margin-bottom: 16px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px dashed #cbd5e1;
            padding-bottom: 12px;
        }

        .package-summary h4 i {
            color: #2F6B5E;
            font-size: 18px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 14px;
        }

        .summary-item .label {
            color: #64748b;
        }

        .summary-item .value {
            font-weight: 600;
            color: #0f172a;
        }

        .summary-item.total {
            margin-top: 10px;
            padding-top: 15px;
            border-top: 1px dashed #cbd5e1;
        }

        .summary-item.total .label {
            color: #0f172a;
            font-weight: 700;
        }

        .summary-item.total .value {
            color: #2F6B5E;
            font-size: 18px;
            font-weight: 800;
        }

        .countdown-text {
            text-align: center;
            padding: 14px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            color: #166534;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .countdown-number {
            font-size: 16px;
            font-weight: 800;
            color: #15803d;
        }

        .modal-footer {
            padding: 0 24px 24px;
            display: flex;
            gap: 12px;
        }

        .btn-close,
        .btn-redirect {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .btn-close {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-close:hover {
            background: #e2e8f0;
            color: #1e2a3e;
        }

        .btn-redirect {
            background: #2F6B5E;
            color: white;
            box-shadow: 0 4px 12px rgba(47, 107, 94, 0.2);
        }

        .btn-redirect:hover {
            background: #1e4a40;
            transform: translateY(-2px);
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid white;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .floating-help-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 48px;
            height: 48px;
            background: #2F6B5E;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            cursor: pointer;
            z-index: 999;
            transition: all 0.3s ease;
            border: 2px solid #ffffff;
        }

        .floating-help-btn:hover {
            background: #1e4a40;
            transform: scale(1.08);
        }

        .modal-roadmap {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 99999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        .modal-roadmap-content {
            background: #ffffff;
            border-radius: 24px;
            max-width: 1000px;
            width: 92%;
            padding: 35px 30px;
            position: relative;
            animation: slideIn 0.3s ease;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            max-height: 90vh;
            overflow-y: auto;
        }

        .close-roadmap {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 28px;
            font-weight: 600;
            color: #a0aec0;
            cursor: pointer;
        }

        .close-roadmap:hover {
            color: #2F6B5E;
        }

        .modal-roadmap-content h2 {
            font-size: 24px;
            font-weight: 800;
            color: #2F6B5E;
            margin-bottom: 35px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .roadmap-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .roadmap-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .roadmap-item {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 20px 15px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #eef2f7;
        }

        .roadmap-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(47, 107, 94, 0.1);
            border-color: #2F6B5E;
        }

        .icon-wrapper {
            width: 65px;
            height: 65px;
            background: #e0f2f1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            position: relative;
        }

        .icon-wrapper i {
            font-size: 28px;
            color: #2F6B5E;
        }

        .step-number {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ffdec2;
            color: #2F6B5E;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            font-size: 13px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .step-content h4 {
            font-size: 15px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 8px;
        }

        .step-content p {
            font-size: 12px;
            color: #6b7a8a;
            line-height: 1.4;
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .banner-container {
                flex-direction: column;
                text-align: center;
            }

            .banner-title-group {
                align-items: center;
            }

            .banner-badges {
                justify-content: center;
            }

            .banner-price-box {
                text-align: center;
            }

            .roadmap-row {
                grid-template-columns: repeat(2, 1fr);
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

            .floating-help-btn {
                bottom: 20px;
                right: 20px;
                width: 42px;
                height: 42px;
                font-size: 18px;
            }

            .roadmap-row {
                grid-template-columns: 1fr;
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
                <a href="{{ url('/cekBooking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <a href="https://wa.me/6283150774897" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>
        </div>
    </div>

    <div class="hero-section">
        <img src="{{ asset('images/camp.jpg') }}" alt="Camp View 1">
        <img src="{{ asset('images/camp_oren.jpg') }}" alt="Camp View 2">
        <img src="{{ asset('images/pinus_camp.jpg') }}" alt="Camp View 3">
    </div>

    <div class="title-banner">
        <div class="banner-container">
            <div class="banner-title-group">
                <h1 class="banner-title">Paket Camp</h1>
                <div class="banner-badges">
                    <span class="badge highlight" id="quotaBadge"><i class="fas fa-fire"></i> Sisa Kuota: --</span>
                    <span class="badge" id="scheduleBadge"><i class="fas fa-calendar-alt"></i> Jadwal: --</span>
                </div>
            </div>
            <div class="banner-price-box">
                <div class="banner-price-label">Mulai Dari</div>
                <div class="banner-price-value">Rp 330.000 <small style="font-size: 14px;">/orang</small></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="detail-section">
            <p class="detail-desc">
                Paket Canyoneering Camp merupakan paket petualangan yang memberikan pengalaman lebih lengkap dengan
                fasilitas menginap di lokasi kegiatan. Paket ini cocok bagi peserta yang ingin menikmati suasana alam
                lebih lama serta mengikuti kegiatan fun camp bersama peserta lainnya.
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
                <div class="video-thumbnail">
                    <video autoplay muted loop playsinline width="250">
                        <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="video-thumbnail">
                    <video autoplay muted loop playsinline width="250">
                        <source src="{{ asset('videos/video6.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="video-thumbnail">
                    <video autoplay muted loop playsinline width="250">
                        <source src="{{ asset('videos/video3.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="video-thumbnail">
                    <video autoplay muted loop playsinline width="250">
                        <source src="{{ asset('videos/video4.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="action-container">
                <button class="btn-book" id="btnBook" onclick="showBookingPopup()">Pesan Sekarang</button>
            </div>
        </div>
    </div>

    <div class="floating-help-btn" onclick="openRoadmapModal()">
        <i class="fas fa-question"></i>
    </div>

    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="success-icon-wrap"><i class="fas fa-check"></i></div>
                <h2>Konfirmasi Pemesanan</h2>
                <p>Anda akan segera dialihkan ke halaman pemesanan</p>
            </div>
            <div class="modal-body">
                <div class="package-summary">
                    <h4><i class="fas fa-receipt"></i> Ringkasan Paket</h4>
                    <div class="summary-item">
                        <span class="label">Paket</span>
                        <span class="value">Paket Camp</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Harga</span>
                        <span class="value">Rp 330.000 /orang</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Sisa Kuota</span>
                        <span class="value" id="modalQuota">--</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Tour Guide</span>
                        <span class="value">Tim B</span>
                    </div>
                    <div class="summary-item total">
                        <span class="label">Total Minimal</span>
                        <span class="value">Rp 330.000</span>
                    </div>
                </div>
                <div class="countdown-text">
                    <i class="fas fa-spinner fa-spin"></i> Mengalihkan otomatis dalam
                    <span class="countdown-number" id="countdown">5</span> detik
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeModal()">Batal</button>
                <button class="btn-redirect" onclick="redirectToBooking()">Lanjutkan <i
                        class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>

    <div id="roadmapModal" class="modal-roadmap">
        <div class="modal-roadmap-content">
            <span class="close-roadmap" onclick="closeRoadmapModal()">&times;</span>
            <h2><i class="fas fa-route"></i> Alur Pemesanan CanyoKuy</h2>
            <div class="roadmap-container">
                <div class="roadmap-row">
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">1</span><i class="fas fa-compass"></i></div>
                        <div class="step-content">
                            <h4>Pilih Paket Wisata</h4>
                            <p>Tentukan pilihan paket wisata yang Anda inginkan.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">2</span><i class="fas fa-hiking"></i></div>
                        <div class="step-content">
                            <h4>Pelajari Informasi</h4>
                            <p>Baca info detail paket, lalu klik <b>Pesan Sekarang</b>.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">3</span><i
                                class="fas fa-file-signature"></i></div>
                        <div class="step-content">
                            <h4>Isi Form Booking</h4>
                            <p>Lengkapi formulir secara teliti.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">4</span><i class="fas fa-receipt"></i></div>
                        <div class="step-content">
                            <h4>Upload Bukti Transfer</h4>
                            <p>Upload bukti transfer ke rekening resmi.</p>
                        </div>
                    </div>
                </div>
                <div class="roadmap-row">
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">5</span><i class="fas fa-qrcode"></i></div>
                        <div class="step-content">
                            <h4>Kode Booking & WA</h4>
                            <p>Dapatkan kode unik, hubungi Admin via WA.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">6</span><i class="fas fa-user-check"></i>
                        </div>
                        <div class="step-content">
                            <h4>Verifikasi Admin</h4>
                            <p>Admin akan memeriksa validasi form.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">7</span><i class="fas fa-tasks"></i></div>
                        <div class="step-content">
                            <h4>Pantau Status</h4>
                            <p>Cek status pemesanan secara berkala.</p>
                        </div>
                    </div>
                    <div class="roadmap-item">
                        <div class="icon-wrapper"><span class="step-number">8</span><i class="fas fa-users"></i></div>
                        <div class="step-content">
                            <h4>Grup Koordinasi</h4>
                            <p>Gabung ke grup koordinasi perjalanan! 🎉</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let countdownInterval;
        let modal = document.getElementById('bookingModal');
        let isRedirecting = false;

        function showBookingPopup() {
            // Cek kuota sebelum buka popup
            const quotaBadge = document.querySelector('.badge.highlight');
            if (quotaBadge && quotaBadge.classList.contains('badge-full')) {
                alert('❌ Maaf, kuota sudah penuh! Tidak dapat melakukan pemesanan.');
                return;
            }

            if (countdownInterval) clearInterval(countdownInterval);
            isRedirecting = false;
            if (modal) modal.style.display = 'flex';
            else { redirectToBooking(); return; }

            let seconds = 5;
            const countdownElement = document.getElementById('countdown');
            if (countdownElement) countdownElement.textContent = seconds;

            countdownInterval = setInterval(() => {
                if (!isRedirecting && seconds > 1) {
                    seconds--;
                    if (countdownElement) countdownElement.textContent = seconds;
                }
                if (seconds <= 1 && !isRedirecting) {
                    clearInterval(countdownInterval);
                    redirectToBooking();
                }
            }, 1000);
        }

        function redirectToBooking() {
            if (isRedirecting) return;
            isRedirecting = true;
            if (countdownInterval) clearInterval(countdownInterval);

            const packageData = {
                id: 1, name: 'Paket Camp', price: 330000, price_formatted: 'Rp 330.000', guide: 'Tim B'
            };
            sessionStorage.setItem('selected_package', JSON.stringify(packageData));
            window.location.href = "{{ route('booking.camp') }}";
        }

        function closeModal() {
            if (countdownInterval) clearInterval(countdownInterval);
            if (modal) modal.style.display = 'none';
            isRedirecting = false;
        }

        function openRoadmapModal() {
            const roadmapModal = document.getElementById('roadmapModal');
            if (roadmapModal) roadmapModal.style.display = "flex";
        }

        function closeRoadmapModal() {
            const roadmapModal = document.getElementById('roadmapModal');
            if (roadmapModal) roadmapModal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target === modal) closeModal();
            const roadmapModal = document.getElementById('roadmapModal');
            if (event.target === roadmapModal) closeRoadmapModal();
        };

        async function loadSchedule() {
            try {
                const response = await fetch('/api/schedules');
                const result = await response.json();

                if (result.success && result.data.length > 0) {
                    const nearestSchedule = result.data[0];
                    const remainingQuota = nearestSchedule.quota - (nearestSchedule.filled || 0);
                    const formattedDate = new Date(nearestSchedule.schedule_date).toLocaleDateString('id-ID', {
                        year: 'numeric', month: 'long', day: 'numeric'
                    });

                    const quotaBadge = document.querySelector('.badge.highlight');
                    const scheduleBadge = document.getElementById('scheduleBadge');
                    const modalQuota = document.getElementById('modalQuota');
                    const btnBook = document.getElementById('btnBook');

                    if (scheduleBadge) {
                        scheduleBadge.innerHTML = `<i class="fas fa-calendar-alt"></i> Jadwal: ${formattedDate}`;
                    }

                    if (modalQuota) {
                        modalQuota.textContent = `${remainingQuota} Peserta`;
                    }

                    // CEK KUOTA
                    if (remainingQuota <= 0) {
                        // Kuota habis
                        if (quotaBadge) {
                            quotaBadge.classList.remove('highlight');
                            quotaBadge.classList.add('badge-full');
                            quotaBadge.innerHTML = `<i class="fas fa-ban"></i> Kuota Penuh!`;
                        }
                        if (btnBook) {
                            btnBook.disabled = true;
                            btnBook.style.background = '#95a5a6';
                            btnBook.style.cursor = 'not-allowed';
                            btnBook.title = 'Maaf, kuota sudah penuh!';
                        }
                    } else {
                        // Kuota tersedia
                        if (quotaBadge) {
                            quotaBadge.classList.remove('badge-full');
                            quotaBadge.classList.add('highlight');
                            quotaBadge.innerHTML = `<i class="fas fa-fire"></i> Sisa Kuota: ${remainingQuota} Peserta`;
                        }
                        if (btnBook) {
                            btnBook.disabled = false;
                            btnBook.style.background = '#2F6B5E';
                            btnBook.style.cursor = 'pointer';
                        }
                    }
                }
            } catch (error) {
                console.error('Error loading schedule:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            loadSchedule();
            // Refresh setiap 10 detik
            setInterval(loadSchedule, 10000);
        });
    </script>
</body>

</html>