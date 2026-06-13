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

        /* Tombol Login Admin */
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

        .admin-login-btn i {
            font-size: 16px;
        }

        /* ========== HALAMAN TOUR GUIDE ========== */
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

        .guide-title {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            color: white;
            margin-top: 50px;
            margin-bottom: 50px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 40px;
            margin-bottom: 30px;
        }

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
                <a href="{{ route('admin.login') }}" class="admin-login-btn" title="Login Admin">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin</span>
                </a>
            </div>
        </div>
    </div>

    <div class="guide-page">
        <div class="container">
            <div class="guide-content">
                <h1 class="guide-title">Our Tour Guide</h1>

                <!-- TEMPAT GUIDE AKAN DI-RENDER OLEH JAVASCRIPT -->
                <div id="guidesContainer"></div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengambil data guide dari API
        async function loadGuidesFromDB() {
            try {
                const response = await fetch('/api/guides');
                const result = await response.json();
                
                if (result.success && result.data.length > 0) {
                    renderGuides(result.data);
                } else {
                    // Tampilkan pesan jika tidak ada data
                    document.getElementById('guidesContainer').innerHTML = '<p style="text-align: center; color: white;">Belum ada data tour guide.</p>';
                }
            } catch (error) {
                console.error('Error loading guides:', error);
                document.getElementById('guidesContainer').innerHTML = '<p style="text-align: center; color: white;">Gagal memuat data tour guide.</p>';
            }
        }

        // Fungsi untuk merender guide ke dalam grid
        function renderGuides(guides) {
            const container = document.getElementById('guidesContainer');
            
            // Bagi data menjadi 2 baris (masing-masing 4 card) atau sesuai jumlah
            const firstRow = guides.slice(0, 4);
            const secondRow = guides.slice(4, 8);
            
            let html = '';
            
            // Baris pertama
            if (firstRow.length > 0) {
                html += '<div class="guide-grid">';
                firstRow.forEach(guide => {
                    html += `
                        <div class="guide-card">
                            <img src="${guide.image || '/images/default-avatar.jpg'}" alt="${escapeHtml(guide.name)}" class="guide-img" onerror="this.src='/images/default-avatar.jpg'">
                            <div class="guide-name">${escapeHtml(guide.name)}</div>
                            <div class="guide-skill">${escapeHtml(guide.skill)}</div>
                        </div>
                    `;
                });
                html += '</div>';
            }
            
            // Baris kedua
            if (secondRow.length > 0) {
                html += '<div class="guide-grid">';
                secondRow.forEach(guide => {
                    html += `
                        <div class="guide-card">
                            <img src="${guide.image || '/images/default-avatar.jpg'}" alt="${escapeHtml(guide.name)}" class="guide-img" onerror="this.src='/images/default-avatar.jpg'">
                            <div class="guide-name">${escapeHtml(guide.name)}</div>
                            <div class="guide-skill">${escapeHtml(guide.skill)}</div>
                        </div>
                    `;
                });
                html += '</div>';
            }
            
            // Jika total guide kurang dari 4, hanya tampilkan satu baris
            if (guides.length <= 4 && guides.length > 0) {
                // sudah ditangani di atas
            }
            
            container.innerHTML = html;
        }

        // Fungsi untuk mengamankan teks dari XSS
        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        // Load data saat halaman siap
        document.addEventListener('DOMContentLoaded', function() {
            loadGuidesFromDB();
        });
    </script>
</body>

</html>