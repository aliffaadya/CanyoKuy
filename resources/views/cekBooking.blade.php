<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Booking - CanyoKuy</title>
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

        /* ========== HALAMAN CEK BOOKING ========== */
        .booking-page {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background-image: url('{{ asset("images/booking.jpg") }}');
            background-size: cover;
            background-position: center 30%;
            background-repeat: no-repeat;
            opacity: 90%;
        }

        /* Efek blur + gradient overlay - LEBIH ATMOSFERIK */
        .booking-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            backdrop-filter: blur(1px);
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
            z-index: 0;
        }

        .booking-page .container {
            position: relative;
            z-index: 1;
        }

        .booking-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 100px 0 80px 0;
        }

        .booking-form-container {
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        .booking-title {
            margin-top: -150px;
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 50px;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        /* Search row */
        .search-row {
            display: flex;
            align-items: center;
            gap: 0;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 60px;
            backdrop-filter: blur(8px);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-input {
            flex: 1;
            padding: 16px 24px;
            background: transparent;
            border: none;
            font-size: 16px;
            color: white;
            font-family: 'Inter', sans-serif;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-weight: 400;
        }

        .search-select {
            flex: 0.6;
            padding: 16px 20px;
            background: transparent;
            border: none;
            border-left: 1px solid rgba(255, 255, 255, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 16px;
            color: white;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            outline: none;
        }

        .search-select option {
            background: #1e2a3e;
            color: white;
        }

        .search-btn {
            background: rgba(47, 107, 94, 0.9);
            border: none;
            padding: 16px 36px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .search-btn:hover {
            background: #2F6B5E;
        }


        @media (max-width: 768px) {
            .booking-title {
                font-size: 28px;
            }
            .search-row {
                flex-direction: column;
                border-radius: 24px;
            }
            .search-input, .search-select, .search-btn {
                width: 100%;
                border: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            }
            .search-select {
                border-left: none;
                border-right: none;
            }
            .search-btn {
                border-radius: 0;
            }
            .booking-content {
                padding: 120px 0 80px 0;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR dengan link ke halaman utama -->
    <div class="navbar">
        <div class="container-navbar"
            style="width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
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

    <!-- HALAMAN CEK BOOKING -->
    <div class="booking-page">
        <div class="container">
            <div class="booking-content">
                <div class="booking-form-container">
                    <h1 class="booking-title">Cek Kode Booking mu Disini</h1>
                    <div class="search-row">
                        <input type="text" class="search-input" placeholder="Masukkan kode booking">
                        <select class="search-select">
                            <option value="">Pilih Paket</option>
                            <option value="roundtrip">Paket Round Trip</option>
                            <option value="camp">Paket Camp</option>
                        </select>
                        <button class="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>