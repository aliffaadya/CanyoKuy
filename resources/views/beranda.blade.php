<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CanyoKuy</title>
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

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            flex-wrap: wrap;
            gap: 16px;
            background: transparent;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .container-navbar {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border: 2px solid white;
        }

        .logo-text {
            font-size: 24px;
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
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            transition: 0.2s;
            font-size: 16px;
            cursor: pointer;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .nav-links a:hover {
            color: #ffdec2;
        }

        .wa-icon {
            width: 40px;
            height: 40px;
            transition: 0.2s;
            border-radius: 40px;
            border: 2px solid white;
            object-fit: cover;
        }

        .wa-icon:hover {
            transform: scale(1.05);
        }

        /* ========== HERO SECTION ========== */
        .hero-section {
            background-image: url('{{ asset("images/bg.jpg") }}');
            background-size: cover;
            background-position: center 45%;
            background-repeat: no-repeat;
            color: white;
            border-radius: 0 0 40px 40px;
            margin-bottom: 80px;
            position: relative;
            min-height: 600px;
        }

        @media (max-width: 768px) {
            .hero-section {
                background-position: center 60%;
                min-height: 450px;
            }
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.55) 0%, rgba(0, 0, 0, 0.35) 100%);
            border-radius: 0 0 40px 40px;
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .hero-content {
            text-align: center;
            padding: 160px 24px 100px 24px;
        }

        .hero-content h1 {
            font-size: 56px;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .hero-content h1 .small-top {
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 4px;
            display: block;
            margin-bottom: 12px;
            opacity: 0.9;
        }

        .hero-content h1 .big-title {
            font-size: 64px;
            font-weight: 800;
            display: block;
            background: linear-gradient(125deg, #ffffff, #ffdec2);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-content p {
            font-size: 18px;
            max-width: 600px;
            margin: 24px auto 0;
            opacity: 0.95;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .hero-content {
                padding: 130px 24px 70px 24px;
            }

            .hero-content h1 .big-title {
                font-size: 44px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .navbar {
                flex-direction: column;
                text-align: center;
            }

            .nav-links {
                justify-content: center;
            }
        }

        /* ========== PAKET WISATA ========== */
        .paket-section {
            margin: 80px 0;
        }

        .paket-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .paket-header h2 {
            font-size: 36px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 12px;
        }

        .paket-header p {
            font-size: 16px;
            color: #6b7a8a;
        }

        .paket-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .paket-card {
            display: flex;
            background: rgba(229, 224, 224, 0.5);
            transition: all 0.3s ease;
            padding: 20px;
            gap: 24px;
        }

        .paket-card:hover {
            background: rgba(229, 224, 224, 0.7);
            transform: translateY(-6px);
        }

        .paket-img {
            width: 350px;
            height: 350px;
            object-fit: cover;
            flex-shrink: 0;
            border-radius: 24px;
        }

        .paket-info {
            padding: 8px 16px 8px 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .paket-name {
            font-size: 26px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 12px;
        }

        .paket-desc {
            font-size: 16px;
            color: #6b7a8a;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .paket-price {
            font-size: 23px;
            font-weight: 700;
            color: #1e2a3e;
            margin-bottom: 20px;
        }

        .paket-btn {
            display: inline-block;
            background: transparent;
            border: 2px solid #1e2a3e;
            color: #1e2a3e;
            padding: 12px 32px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            text-align: center;
            align-self: flex-end;
        }

        .paket-btn:hover {
            background: #1e2a3e;
            color: white;
        }

        /* ========== GET TO KNOW SECTION ========== */
        .get-to-know-wrapper {
            position: relative;
            margin: 80px 0;
            min-height: 500px;
            margin-top: 100px;
        }

        .get-to-know-left-bg {
            position: absolute;
            width: 55%;
            height: 500px;
            left: 170px;
            top: 0;
            background: #2F6B5E;
        }

        .get-to-know-content {
            position: absolute;
            left: 8%;
            top: 50%;
            transform: translateY(-50%);
            max-width: 45%;
            color: white;
        }

        .get-to-know-label {
            font-size: 14px;
            letter-spacing: 4px;
            color: white;
            font-weight: 600;
            margin-bottom: 16px;
            display: inline-block;
            opacity: 0.8;
        }

        .get-to-know-title {
            font-size: 36px;
            font-weight: 800;
            color: white;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .get-to-know-desc {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
            margin-bottom: 32px;
            font-size: 15px;
        }

        .get-to-know-btn {
            display: inline-block;
            background: transparent;
            border: 2px solid white;
            padding: 10px 28px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            transition: 0.2s;
            text-decoration: none;
        }

        .get-to-know-btn:hover {
            background: white;
            color: #2F6B5E;
        }

        .get-to-know-right-img {
            position: absolute;
            width: 40%;
            height: 400px;
            left: 49%;
            top: 10%;
            background-image: url('{{ asset("images/air_terjun.jpg") }}');
            background-size: cover;
            background-position: center;
        }

        /* ========== TOUR GUIDE SECTION ========== */
        .tour-guide-wrapper {
            position: relative;
            margin: 80px 0;
            min-height: 500px;
        }

        .tour-guide-left-img {
            position: absolute;
            width: 40%;
            height: 400px;
            left: 170px;
            top: 10%;
            background-image: url('{{ asset("images/guide.jpg") }}');
            background-size: cover;
            background-position: center;
            z-index: 2;
        }

        .tour-guide-right-bg {
            position: absolute;
            width: 55%;
            height: 500px;
            right: 170px;
            top: 0;
            background: #2F6B5E;
        }

        .tour-guide-content {
            position: absolute;
            right: 8%;
            top: 50%;
            transform: translateY(-50%);
            max-width: 45%;
            color: white;
        }

        .tour-guide-label {
            font-size: 14px;
            letter-spacing: 4px;
            color: white;
            font-weight: 600;
            margin-bottom: 16px;
            display: inline-block;
            opacity: 0.8;
        }

        .tour-guide-title {
            font-size: 36px;
            font-weight: 800;
            color: white;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .tour-guide-desc {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
            margin-bottom: 32px;
            font-size: 15px;
        }

        .tour-guide-btn {
            display: inline-block;
            background: transparent;
            border: 2px solid white;
            padding: 10px 28px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            transition: 0.2s;
            text-decoration: none;
        }

        .tour-guide-btn:hover {
            background: white;
            color: #2F6B5E;
        }

        /* ========== TESTIMONI CAROUSEL ========== */
        .testimoni-section {
            padding: 60px 0 80px 0;
            background: #ffffff;
        }

        .testimoni-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .testimoni-header h2 {
            font-size: 36px;
            font-weight: 700;
            color: #1e2a3e;
        }

        .testimoni-carousel {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 60px;
        }

        .testimoni-track {
            display: flex;
            gap: 30px;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .testimoni-card {
            flex: 0 0 calc(33.333% - 20px);
            background: rgba(229, 224, 224, 0.5);
            border-radius: 24px;
            padding: 30px 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .testimoni-card:hover {
            background: rgba(229, 224, 224, 0.7);
            transform: translateY(-6px);
        }

        .quote-icon {
            margin-bottom: 20px;
        }

        .quote-icon i {
            font-size: 40px;
            color: #2F6B5E;
            opacity: 0.6;
        }

        .testimoni-text {
            font-size: 15px;
            font-weight: 500;
            line-height: 1.5;
            color: #1e2a3e;
            margin-bottom: 20px;
        }

        .testimoni-rating {
            margin-bottom: 16px;
        }

        .testimoni-rating i {
            color: #FFCC00;
            font-size: 16px;
            margin: 0 2px;
        }

        .testimoni-name {
            font-size: 14px;
            font-weight: 600;
            color: #1e2a3e;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: #2F6B5E;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .carousel-btn:hover {
            background: #235a4e;
            transform: translateY(-50%) scale(1.05);
        }

        .carousel-btn i {
            color: white;
            font-size: 20px;
        }

        .carousel-btn.prev {
            left: 0;
        }

        .carousel-btn.next {
            right: 0;
        }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 40px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background: #d0d5da;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            width: 24px;
            background: #2F6B5E;
            border-radius: 10px;
        }

        /* ========== FOOTER - SEPERTI WONDERLAND ========== */
        .footer {
            background: #0a2e2b;
            color: rgba(255, 255, 255, 0.8);
            padding: 60px 0 30px 0;
        }

        .footer-container {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1.2fr;
            gap: 50px;
        }

        .footer-col h3 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: 800;
            color: white;
            margin-bottom: 16px;
            display: inline-block;
        }

        .footer-desc {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-links {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            list-style: none;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .footer-links li a:hover {
            color: #ff6b35;
            padding-left: 5px;
        }

        .footer-contact {
            list-style: none;
        }

        .footer-contact li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-contact i {
            width: 20px;
            color: #ff6b35;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        @media (max-width: 1050px) {
            .paket-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .paket-card {
                max-width: 600px;
                margin: 0 auto;
            }
        }

        @media (max-width: 900px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .testimoni-card {
                flex: 0 0 calc(100% - 20px);
            }
            .get-to-know-wrapper,
            .tour-guide-wrapper {
                min-height: auto;
                margin: 60px 0;
            }
            .get-to-know-left-bg,
            .tour-guide-right-bg {
                position: relative;
                width: 100%;
                height: auto;
                padding: 50px 24px;
                left: auto;
                right: auto;
            }
            .get-to-know-content,
            .tour-guide-content {
                position: relative;
                left: auto;
                right: auto;
                top: auto;
                transform: none;
                max-width: 100%;
                text-align: center;
            }
            .get-to-know-right-img,
            .tour-guide-left-img {
                position: relative;
                width: 90%;
                height: 280px;
                left: auto;
                right: auto;
                margin: -30px auto 0 auto;
            }
            .get-to-know-title,
            .tour-guide-title {
                font-size: 30px;
            }
        }

        @media (max-width: 700px) {
            .paket-card {
                flex-direction: column;
                padding: 20px;
            }
            .paket-img {
                width: 100%;
                height: 250px;
            }
            .paket-info {
                padding: 0;
            }
            .paket-btn {
                align-self: stretch;
                text-align: center;
            }
            .testimoni-carousel {
                padding: 0 40px;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="container-navbar"
            style="width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-img">
                <span class="logo-text">CanyoKuy</span>
            </div>
            <div class="nav-links">
                <a href="#">Beranda</a>
                <a href="#paketWisata">Paket Wisata</a>
                <a href="/cekBooking">Cek Booking</a>
                <a href="#testimoni">Testimoni</a>
                <a href="/guide">Tour Guide</a>
                <a href="https://wa.me/628123456789" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>
        </div>
    </div>

    <!-- HERO SECTION -->
    <div class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>
                    <span class="small-top">WELCOME TO YOUR</span>
                    <span class="big-title">Canyoneering</span>
                </h1>
                <p>Mari jelajahi air terjun sambil canyoneering. Temukan keindahan alam tersembunyi dan sensasi
                    petualangan yang tak terlupakan bersama CanyoKuy.</p>
            </div>
        </div>
    </div>

    <!-- PAKET WISATA -->
    <div class="container" id="paketWisata">
        <div class="paket-section">
            <div class="paket-header">
                <h2>Paket Wisata</h2>
                <p>Pilih paket yang sesuai dengan keinginanmu</p>
            </div>
            <div class="paket-grid">
                <div class="paket-card">
                    <img src="{{ asset('images/round_trip.jpg') }}" alt="Paket Round Trip" class="paket-img">
                    <div class="paket-info">
                        <div>
                            <div class="paket-name">Paket Round Trip</div>
                            <div class="paket-desc">Paket ini cocok bagi peserta yang ingin menikmati suasana alam lebih lama</div>
                            <div class="paket-price">Rp 300.000</div>
                        </div>
                        <a href="#" class="paket-btn">Lihat Detail</a>
                    </div>
                </div>
                <div class="paket-card">
                    <img src="{{ asset('images/camp.jpg') }}" alt="Paket Camp" class="paket-img">
                    <div class="paket-info">
                        <div>
                            <div class="paket-name">Paket Camp</div>
                            <div class="paket-desc">Paket ini cocok bagi peserta yang ingin menikmati kegiatan alam dalam satu hari</div>
                            <div class="paket-price">Rp 330.000</div>
                        </div>
                        <a href="#" class="paket-btn">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GET TO KNOW SECTION -->
    <div class="get-to-know-wrapper">
        <div class="get-to-know-left-bg">
            <div class="get-to-know-content">
                <span class="get-to-know-label">GET TO KNOW</span>
                <h2 class="get-to-know-title">Air Terjun Mandin Damar</h2>
                <p class="get-to-know-desc">
                    Air terjun eksotis dengan tebing alami yang cocok untuk aktivitas canyoneering. Airnya yang jernih,
                    bebatuan yang menantang, dan pemandangan alam yang masih asri.
                </p>
                <a href="https://maps.app.goo.gl/iRXUAssJTah6TtEn9" class="get-to-know-btn">Jelajah Sekarang</a>
            </div>
        </div>
        <div class="get-to-know-right-img"></div>
    </div>

    <!-- TOUR GUIDE SECTION -->
    <div class="tour-guide-wrapper">
        <div class="tour-guide-left-img"></div>
        <div class="tour-guide-right-bg">
            <div class="tour-guide-content">
                <span class="tour-guide-label">TOUR GUIDE</span>
                <h2 class="tour-guide-title">KPA ULIN</h2>
                <p class="tour-guide-desc">
                    KPA Ulin adalah Kelompok Pencinta Alam berbasis di Kabupaten Tanah Bumbu, Kalimantan Selatan, berdiri sejak 4 Mei 2016. 
                    Berfokus pada kegiatan alam bebas (gunung, gua, tebing, hutan, pantai), edukasi lingkungan, pelatihan keselamatan (caving, panjat tebing), 
                    serta aksi sosial. Aktif di kawasan Geopark Meratus, Gua Liang Bangkai, dan Air Terjun Mandin Damar.
                </p>
                <a href="https://www.instagram.com/kpa_ulin/" class="tour-guide-btn">Kenalan Yuk</a>
            </div>
        </div>
    </div>

    <!-- TESTIMONI CAROUSEL -->
    <div class="testimoni-section" id="testimoni">
        <div class="container">
            <div class="testimoni-header">
                <h2>Apa Yang Mereka Katakan Tentang Kami</h2>
            </div>
            <div class="testimoni-carousel">
                <button class="carousel-btn prev" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="testimoni-track" id="testimoniTrack">
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "SUKA DEH ORANG ORANGNYA PADA SOLID KAYAK KELAS A2 :V"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- NOHA -</div>
                    </div>
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "KALI LINUX?! KOMPAK SEPERTI SCRIPT, SOLID SAMPAI AKHIR!!"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- KALI LINUX -</div>
                    </div>
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "NOHA KEREN BANGET!!"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- NOHA -</div>
                    </div>
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "Pengalaman tak terlupakan! Guide nya ramah dan profesional!"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- Ahmad -</div>
                    </div>
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "Spot air terjunnya keren banget! Next mau kesini lagi!"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- Siti -</div>
                    </div>
                    <div class="testimoni-card">
                        <div class="quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimoni-text">
                            "Safety pertama, puas banget sama pelayanannya!"
                        </div>
                        <div class="testimoni-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimoni-name">- Budi -</div>
                    </div>
                </div>
                <button class="carousel-btn next" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="carousel-dots" id="carouselDots"></div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <div class="footer-logo">CanyoKuy</div>
                    <p class="footer-desc">Mari jelajahi air terjun sambil canyoneering. Temukan keindahan alam tersembunyi dan sensasi petualangan yang tak terlupakan.</p>
                </div>
                <div class="footer-col">
                    <h3>Menu</h3>
                    <ul class="footer-links">
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#paketWisata">Paket Wisata</a></li>
                        <li><a href="/cekBooking">Cek Booking</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                        <li><a href="/guide">Tour Guide</a></li>
                        <li><a href="#">Wa Admin</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Kontak</h3>
                    <ul class="footer-contact">
                        <li><i class="fab fa-whatsapp"></i> +62 812 3456 789</li>
                        <li><i class="far fa-envelope"></i> info@canyokuy.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Tanah Bumbu, Kalimantan Selatan</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© CanyoKuy - 2025 | Petualangan Alam Bersama KPA Ulin</p>
            </div>
        </div>
    </footer>

    <script>
        // Carousel functionality
        const track = document.getElementById('testimoniTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('carouselDots');
        
        let currentIndex = 0;
        const cards = document.querySelectorAll('.testimoni-card');
        const cardsPerView = 3;
        const totalCards = cards.length;
        const totalSlides = Math.ceil(totalCards / cardsPerView);
        
        // Create dots
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
        
        function updateDots() {
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, i) => {
                if (i === currentIndex) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        }
        
        function goToSlide(index) {
            if (index < 0) index = 0;
            if (index >= totalSlides) index = totalSlides - 1;
            currentIndex = index;
            const scrollAmount = currentIndex * (cards[0].offsetWidth + 30) * cardsPerView;
            track.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            updateDots();
        }
        
        prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
        nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
        
        // Update on window resize
        window.addEventListener('resize', () => {
            goToSlide(currentIndex);
        });
    </script>
</body>

</html>