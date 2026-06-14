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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .admin-login-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 16px;
            border-radius: 40px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .admin-login-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .booking-page {
            position: relative;
            min-height: 100vh;
            width: 100%;
            background-image: url('{{ asset("images/booking.jpg") }}');
            background-size: cover;
            background-position: center 30%;
            background-repeat: no-repeat;
        }

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
            padding: 120px 0 80px 0;
        }

        .booking-form-container {
            text-align: center;
            max-width: 800px;
            width: 100%;
            margin-top: -50px;
        }

        .booking-title {
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-bottom: 40px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        .search-row {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 60px;
            backdrop-filter: blur(8px);
            padding: 5px;
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
        }

        .search-btn {
            background: rgba(47, 107, 94, 0.95);
            border: none;
            border-radius: 50px;
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
            transform: scale(1.02);
        }

        .result-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 30px;
            margin-top: 30px;
            text-align: left;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            display: none;
        }

        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2F6B5E;
        }

        .result-header h3 {
            color: #2F6B5E;
            font-size: 20px;
            font-weight: 700;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
        }

        .status-waiting {
            background: #fff3cd;
            color: #856404;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .status-pending {
            background: #cfe2ff;
            color: #084298;
        }

        .result-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .result-item {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 12px;
        }

        .result-item label {
            font-size: 11px;
            color: #6b7a8a;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 5px;
        }

        .result-item .value {
            font-size: 15px;
            font-weight: 600;
            color: #1e2a3e;
        }

        .result-item-full {
            grid-column: span 2;
        }

        .rejection-box {
            background: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 15px;
            margin-top: 15px;
            border-radius: 12px;
        }

        .rejection-box label {
            font-size: 12px;
            font-weight: 700;
            color: #dc2626;
            display: block;
            margin-bottom: 8px;
        }

        .rejection-box .rejection-text {
            font-size: 14px;
            color: #991b1b;
            line-height: 1.5;
        }

        .not-found {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
            color: #e74c3c;
            display: none;
        }

        .not-found i {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .loading-spinner {
            display: none;
            text-align: center;
            margin-top: 30px;
            color: white;
        }

        .loading-spinner i {
            font-size: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .reset-btn {
            background: rgba(47, 107, 94, 0.9);
            border: none;
            padding: 12px 24px;
            border-radius: 40px;
            color: white;
            cursor: pointer;
            margin-top: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .reset-btn:hover {
            background: #2F6B5E;
        }

        @media (max-width: 768px) {
            .booking-title { font-size: 28px; }
            .search-row { flex-direction: column; border-radius: 24px; }
            .search-input, .search-btn { width: 100%; border-radius: 40px; }
            .booking-content { padding: 150px 0 80px 0; }
            .result-grid { grid-template-columns: 1fr; }
            .result-item-full { grid-column: span 1; }
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

    <div class="booking-page">
        <div class="container">
            <div class="booking-content">
                <div class="booking-form-container">
                    <h1 class="booking-title">Cek Kode Booking mu Disini</h1>
                    <div class="search-row">
                        <input type="text" id="searchInput" class="search-input" placeholder="Masukkan kode booking" value="">
                        <button class="search-btn" onclick="checkBooking()">Search</button>
                    </div>

                    <div id="loadingSpinner" class="loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p>Mencari data...</p>
                    </div>

                    <div id="resultCard" class="result-card">
                        <div class="result-header">
                            <h3><i class="fas fa-receipt"></i> Detail Booking</h3>
                            <span id="statusBadge" class="status-badge"></span>
                        </div>
                        <div class="result-grid">
                            <div class="result-item">
                                <label>Kode Booking</label>
                                <div class="value" id="resultKode">-</div>
                            </div>
                            <div class="result-item">
                                <label>Nama Lengkap</label>
                                <div class="value" id="resultNama">-</div>
                            </div>
                            <div class="result-item">
                                <label>WhatsApp</label>
                                <div class="value" id="resultWA">-</div>
                            </div>
                            <div class="result-item">
                                <label>Paket Wisata</label>
                                <div class="value" id="resultPaket">-</div>
                            </div>
                            <div class="result-item">
                                <label>Tanggal Keberangkatan</label>
                                <div class="value" id="resultTanggal">-</div>
                            </div>
                            <div class="result-item">
                                <label>Total Pembayaran</label>
                                <div class="value" id="resultTotal">-</div>
                            </div>
                            <div class="result-item">
                                <label>DP Dibayar</label>
                                <div class="value" id="resultDP">-</div>
                            </div>
                            <div class="result-item">
                                <label>Sisa Pembayaran</label>
                                <div class="value" id="resultSisa">-</div>
                            </div>
                            <div class="result-item">
                                <label>Tanggal Booking</label>
                                <div class="value" id="resultCreated">-</div>
                            </div>
                        </div>
                        
                        <!-- Tempat untuk menampilkan alasan penolakan -->
                        <div id="rejectionContainer" style="display: none;"></div>
                        
                        <button class="reset-btn" onclick="resetSearch()">
                            <i class="fas fa-search"></i> Cek Kode Lain
                        </button>
                    </div>

                    <div id="notFoundCard" class="not-found">
                        <i class="fas fa-search"></i>
                        <h3>Booking Tidak Ditemukan</h3>
                        <p>Kode booking yang Anda masukkan tidak valid. Silakan periksa kembali.</p>
                        <button class="reset-btn" onclick="resetSearch()" style="margin-top: 20px;">
                            <i class="fas fa-arrow-left"></i> Coba Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function checkBooking() {
            const bookingCode = document.getElementById('searchInput').value.trim().toUpperCase();
            
            if (!bookingCode) {
                alert('Silakan masukkan kode booking terlebih dahulu!');
                return;
            }

            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('resultCard').style.display = 'none';
            document.getElementById('notFoundCard').style.display = 'none';

            try {
                const response = await fetch(`/api/bookings/check/${encodeURIComponent(bookingCode)}`);
                const result = await response.json();

                document.getElementById('loadingSpinner').style.display = 'none';

                if (result.success && result.data) {
                    displayBookingResult(result.data);
                } else {
                    document.getElementById('notFoundCard').style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('loadingSpinner').style.display = 'none';
                alert('Terjadi kesalahan. Periksa koneksi internet Anda.');
            }
        }

        function displayBookingResult(booking) {
            let statusText = '';
            let statusClass = '';

            if (booking.payment_status === 'paid') {
                statusText = '✅ Sudah Diverifikasi';
                statusClass = 'status-paid';
            } else if (booking.payment_status === 'waiting_confirmation') {
                statusText = '⏳ Menunggu Verifikasi';
                statusClass = 'status-waiting';
            } else if (booking.payment_status === 'rejected') {
                statusText = '❌ Ditolak';
                statusClass = 'status-rejected';
            } else {
                statusText = '🕐 Menunggu Pembayaran';
                statusClass = 'status-pending';
            }

            const tanggalBerangkat = new Date(booking.booking_date).toLocaleDateString('id-ID', {
                year: 'numeric', month: 'long', day: 'numeric'
            });

            const tanggalBooking = new Date(booking.created_at).toLocaleDateString('id-ID', {
                year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'
            });

            document.getElementById('statusBadge').className = `status-badge ${statusClass}`;
            document.getElementById('statusBadge').textContent = statusText;
            document.getElementById('resultKode').textContent = booking.booking_code;
            document.getElementById('resultNama').textContent = booking.customer_name;
            document.getElementById('resultWA').textContent = booking.phone;
            document.getElementById('resultPaket').textContent = booking.package_name;
            document.getElementById('resultTanggal').textContent = tanggalBerangkat;
            document.getElementById('resultTotal').textContent = 'Rp ' + (booking.total_price || 0).toLocaleString('id-ID');
            document.getElementById('resultDP').textContent = 'Rp ' + (booking.dp_amount || 0).toLocaleString('id-ID');
            document.getElementById('resultSisa').textContent = 'Rp ' + (booking.remaining_amount || 0).toLocaleString('id-ID');
            document.getElementById('resultCreated').textContent = tanggalBooking;

            // TAMPILKAN ALASAN PENOLAKAN JIKA STATUS REJECTED
            const rejectionContainer = document.getElementById('rejectionContainer');
            if (booking.payment_status === 'rejected' && booking.rejection_reason) {
                rejectionContainer.style.display = 'block';
                rejectionContainer.innerHTML = `
                    <div class="rejection-box">
                        <label><i class="fas fa-exclamation-triangle"></i> Alasan Penolakan:</label>
                        <div class="rejection-text">${booking.rejection_reason}</div>
                        <p style="font-size: 12px; color: #991b1b; margin-top: 10px;">
                            <i class="fas fa-info-circle"></i> Silakan hubungi admin untuk informasi lebih lanjut.
                        </p>
                    </div>
                `;
            } else {
                rejectionContainer.style.display = 'none';
                rejectionContainer.innerHTML = '';
            }

            document.getElementById('resultCard').style.display = 'block';
        }

        function resetSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchInput').focus();
            document.getElementById('resultCard').style.display = 'none';
            document.getElementById('notFoundCard').style.display = 'none';
        }

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                checkBooking();
            }
        });
    </script>
</body>

</html>