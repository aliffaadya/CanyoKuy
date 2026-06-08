<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket Round Trip - CanyoKuy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* ========== HERO SECTION ========== */
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

        .img-tengah {
            object-fit: cover;
            object-position: center bottom;
        }

        .img-kanan {
            object-fit: cover;
            object-position: center 85%;
        }

        /* ========== TITLE BANNER ========== */
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

        /* ========== VIDEO THUMBNAILS ========== */
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
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            pointer-events: none;
            transition: 0.3s;
        }

        .video-thumbnail:hover .play-icon {
            color: white;
            transform: translate(-50%, -50%) scale(1.1);
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-book:hover {
            background: #1e4a40;
            transform: translateY(-2px);
        }

        /* ========== MODAL POPUP ========== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(3px);
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            max-width: 450px;
            width: 90%;
            animation: slideIn 0.3s ease;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #2F6B5E, #1e4a40);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .modal-header .success-icon {
            font-size: 60px;
            margin-bottom: 10px;
        }

        .modal-header h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .modal-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .modal-body {
            padding: 25px;
        }

        .package-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 16px;
            margin: 10px 0;
        }

        .package-summary h4 {
            color: #2F6B5E;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item .label {
            color: #666;
        }

        .summary-item .value {
            font-weight: 600;
            color: #1e2a3e;
        }

        .summary-item.total .value {
            color: #e74c3c;
            font-size: 18px;
            font-weight: bold;
        }

        .countdown-text {
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            background: #fff3cd;
            border-radius: 10px;
            color: #856404;
        }

        .countdown-number {
            font-size: 24px;
            font-weight: bold;
            color: #e74c3c;
        }

        .modal-footer {
            padding: 20px 25px 25px;
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
            transition: all 0.3s;
        }

        .btn-close {
            background: #e0e0e0;
            color: #666;
        }

        .btn-close:hover {
            background: #c0c0c0;
        }

        .btn-redirect {
            background: #2F6B5E;
            color: white;
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
            margin-right: 8px;
            vertical-align: middle;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

            .banner-title-group {
                align-items: center;
            }

            .banner-badges {
                justify-content: center;
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
                <a href="{{ url('/cekBooking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <a href="https://wa.me/628123456789" target="_blank">
                    <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
                </a>
            </div>

        </div>
    </div>

    <div class="hero-section">
        <img src="{{ asset('images/round_trip.jpg') }}" alt="Round Trip View 1">

        <img src="{{ asset('images/sinoha.jpg') }}" alt="Round Trip View 2" class="img-tengah">

        <img src="{{ asset('images/pp.jpg') }}" alt="Round Trip View 3" class="img-kanan">
    </div>

    <div class="title-banner">
        <div class="banner-container">
            <div class="banner-title-group">
                <h1 class="banner-title">Paket Round Trip</h1>
                <div class="banner-badges">
                    <span class="badge highlight"><i class="fas fa-fire"></i> Sisa Kuota: 5 Orang</span>
                    <span class="badge"><i class="fas fa-users"></i> Tour Guide: Tim A</span>
                </div>
            </div>
            <div class="banner-price-box">
                <div class="banner-price-label">Mulai Dari</div>
                <div class="banner-price-value">Rp 300.000 <small style="font-size: 14px;">/orang</small></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="detail-section">
            <p class="detail-desc">
                Paket Canyoneering PP merupakan paket perjalanan pulang-pergi yang dirancang bagi peserta yang ingin
                merasakan pengalaman seru canyoneering di Air Terjun Mandin Damar tanpa menginap. Paket ini cocok bagi
                pemula maupun peserta yang ingin menikmati kegiatan alam dalam satu hari dengan pendampingan guide
                berpengalaman.
            </p>

            <div class="detail-grid">
                <div class="detail-facilities">
                    <h3>Fasilitas yang Didapat:</h3>
                    <ul class="facilities-list">
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
                        <li><i class="fas fa-circle"></i> Lokasi: Air Terjun Mandin Damar</li>
                        <li><i class="fas fa-circle"></i> Sistem perjalanan: Pulang–Pergi (Tanpa Menginap)</li>
                        <li><i class="fas fa-circle"></i> Cocok untuk: Pemula dan peserta harian</li>
                    </ul>
                </div>
            </div>

            <div class="thumbnail-gallery">
                <div class="video-thumbnail">
                    <img src="{{ asset('images/round_trip.jpg') }}" alt="Video 1">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
                <div class="video-thumbnail">
                    <img src="{{ asset('images/round_trip.jpg') }}" alt="Video 2">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
                <div class="video-thumbnail">
                    <img src="{{ asset('images/round_trip.jpg') }}" alt="Video 3">
                    <i class="fas fa-play-circle play-icon"></i>
                </div>
            </div>

            <div class="action-container">
                <button class="btn-book" onclick="showBookingPopup()">Pesan Sekarang</button>
            </div>

        </div>
    </div>

    <!-- MODAL POPUP -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="success-icon">✅</div>
                <h2>Konfirmasi Pemesanan</h2>
                <p>Anda akan dialihkan ke halaman pemesanan</p>
            </div>
            <div class="modal-body">
                <div class="package-summary">
                    <h4>📋 Ringkasan Paket</h4>
                    <div class="summary-item">
                        <span class="label">Paket</span>
                        <span class="value">Paket Round Trip</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Harga</span>
                        <span class="value">Rp 300.000 /orang</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Sisa Kuota</span>
                        <span class="value">5 Orang</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Tour Guide</span>
                        <span class="value">Tim A</span>
                    </div>
                    <div class="summary-item total">
                        <span class="label">DP (50%)</span>
                        <span class="value">Rp 150.000</span>
                    </div>
                </div>
                <div class="countdown-text">
                    ⏱️ Mengalihkan ke halaman pemesanan dalam
                    <span class="countdown-number" id="countdown">3</span> detik
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeModal()">Batal</button>
                <button class="btn-redirect" onclick="redirectToBooking()">Lanjutkan →</button>
            </div>
        </div>
    </div>

    <script>
        let countdownInterval;
        let modal = document.getElementById('bookingModal');
        let isRedirecting = false;

        function showBookingPopup() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            isRedirecting = false;

            modal.style.display = 'flex';

            let seconds = 3;
            const countdownElement = document.getElementById('countdown');
            countdownElement.textContent = seconds;

            countdownInterval = setInterval(() => {
                if (!isRedirecting && seconds > 1) {
                    seconds--;
                    countdownElement.textContent = seconds;
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

            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            const btnRedirect = document.querySelector('.btn-redirect');
            btnRedirect.innerHTML = '<span class="loading-spinner"></span> Mengalihkan...';
            btnRedirect.disabled = true;

            // Simpan data paket Round Trip ke session storage
            const packageData = {
                id: 2,
                name: 'Paket Round Trip',
                price: 300000,
                price_formatted: 'Rp 300.000',
                dp: 150000,
                dp_formatted: 'Rp 150.000',
                sisa: 150000,
                sisa_formatted: 'Rp 150.000',
                dp_percent: '50%',
                quota: '5 Orang',
                guide: 'Tim A'
            };

            sessionStorage.setItem('selected_package', JSON.stringify(packageData));

            // Redirect ke halaman booking ROUND TRIP
            setTimeout(() => {
                window.location.href = "{{ route('booking.roundtrip') }}";
            }, 500);
        }

        function closeModal() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
            modal.style.display = 'none';
            isRedirecting = false;
        }

        window.onclick = function (event) {
            if (event.target === modal) {
                closeModal();
            }
        }

        document.querySelectorAll('.video-thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function () {
                document.querySelectorAll('.video-thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>