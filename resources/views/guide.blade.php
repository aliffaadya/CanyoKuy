<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Guide - CanyoKuy</title>
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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
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

        /* ========== HALAMAN TOUR GUIDE - BACKGROUND PROPORSIONAL ========== */
        .guide-page {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background-image: url('{{ asset("images/guide.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Overlay gelap agar teks terbaca */
        .guide-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.45) 100%);
            z-index: 0;
        }

        .guide-page .container {
            position: relative;
            z-index: 1;
        }

        .guide-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            padding: 120px 0 80px 0;
        }

        /* Judul */
        .guide-title {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-top: 50px;
            margin-bottom: 50px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        /* Grid 4 kolom */
        .guide-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        /* Card */
        .guide-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .guide-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        /* Foto kotak */
        .guide-img {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            object-fit: cover;
        }

        .guide-name {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 6px;
        }

        .guide-skill {
            font-size: 13px;
            color: #ffdec2;
            font-weight: 500;
        }

        @media (max-width: 1050px) {
            .guide-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .guide-title {
                font-size: 32px;
            }

            .guide-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

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

    <div class="navbar">
        <div class="container-navbar"
            style="width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-img">
            </div>
            <div class="nav-links">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/#paketWisata') }}">Paket Wisata</a>
                <a href="{{ url('/cekBooking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <a href="https://wa.me/628123456789" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>
        </div>
    </div>

    <div class="guide-page">
        <div class="container">
            <div class="guide-content">
                <h1 class="guide-title">Our Tour Guide</h1>

                <div class="guide-grid">
                    <div class="guide-card">
                        <img src="{{ asset('images/via.jpg') }}" alt="Via" class="guide-img">
                        <div class="guide-name">Via</div>
                        <div class="guide-skill">Chief Tour Guide</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/Faren.jpg') }}" alt="Faren" class="guide-img">
                        <div class="guide-name">Faren</div>
                        <div class="guide-skill">Lead Hiking Guide</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/Dori.jpeg') }}" alt="Dori" class="guide-img">
                        <div class="guide-name">Dori</div>
                        <div class="guide-skill">Safety & Rescue Officer</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/lembut.jpeg') }}" alt="Lembut" class="guide-img">
                        <div class="guide-name">Kicut</div>
                        <div class="guide-skill">Nature Guide</div>
                    </div>
                </div>

                <div class="guide-grid">
                    <div class="guide-card">
                        <img src="{{ asset('images/nurmala.jpeg') }}" alt="Nurmala" class="guide-img">
                        <div class="guide-name">u'ang</div>
                        <div class="guide-skill">Camping Specialist</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/yaya.jpeg') }}" alt="Yaya" class="guide-img">
                        <div class="guide-name">Yaya</div>
                        <div class="guide-skill">Eco Tourism Guide</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/badhog.jpeg') }}" alt="Badog" class="guide-img">
                        <div class="guide-name">Belut</div>
                        <div class="guide-skill">Climbing Guide</div>
                    </div>

                    <div class="guide-card">
                        <img src="{{ asset('images/timun_suri_new.png') }}" alt="Kucrit" class="guide-img">
                        <div class="guide-name">Timun Suri</div>
                        <div class="guide-skill">Photography Guide</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>