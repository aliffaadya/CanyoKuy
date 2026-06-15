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
            background: transparent;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .container-navbar {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
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

        /* Tombol Hamburger Menu (Sembunyi di laptop) */
        .menu-toggle {
            display: none;
            background: transparent;
            border: none;
            color: white;
            font-size: 26px;
            cursor: pointer;
            z-index: 101;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Ikon WhatsApp Melayang (Floating Button) */
        .floating-wa {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999;
            transition: transform 0.2s ease;
        }

        .floating-wa .wa-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .floating-wa:hover {
            transform: scale(1.1);
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
            border-radius: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* ========== RESPONSIVE ========== */
        @media (max-width: 1050px) {
            .guide-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .logo-img {
                width: 48px;
                height: 48px;
            }

            .logo-text {
                font-size: 20px;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 75px;
                left: 24px;
                right: 24px;
                background: rgba(10, 46, 43, 0.95);
                padding: 20px;
                border-radius: 16px;
                gap: 20px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(8px);
                z-index: 100;
            }

            .nav-links.active {
                display: flex;
            }

            .nav-links a {
                font-size: 18px;
                width: 100%;
                text-align: center;
                padding: 8px 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .nav-links a:last-child {
                border-bottom: none;
            }

            .guide-title {
                font-size: 32px;
            }

            .guide-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR dengan hamburger menu (WA tidak di dalam menu) -->
    <div class="navbar">
        <div class="container-navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="logo-img">
            </div>

            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div class="nav-links" id="navLinks">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/#paketWisata') }}">Paket Wisata</a>
                <a href="{{ url('/cekBooking') }}">Cek Booking</a>
                <a href="{{ url('/#testimoni') }}">Testimoni</a>
                <a href="{{ url('/guide') }}">Tour Guide</a>
                <!-- WA TIDAK ADA DI SINI, hanya di floating button -->
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6283150774897" target="_blank" class="floating-wa">
        <img src="{{ asset('images/wa.png') }}" alt="WhatsApp" class="wa-icon">
    </a>

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
        // Toggle menu untuk HP
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const navLinks = document.getElementById('navLinks');

            if (menuToggle && navLinks) {
                menuToggle.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    const icon = menuToggle.querySelector('i');
                    if (navLinks.classList.contains('active')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });

                const links = navLinks.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', () => {
                        navLinks.classList.remove('active');
                        if (menuToggle.querySelector('i')) {
                            menuToggle.querySelector('i').className = 'fas fa-bars';
                        }
                    });
                });
            }
        });

        // ========== LOGIKA TOUR GUIDE (TIDAK DIUBAH) ==========
        async function loadGuidesFromDB() {
            try {
                const response = await fetch('/api/guides');
                const result = await response.json();

                if (result.success && result.data.length > 0) {
                    const sortedData = result.data.sort((a, b) => {
                        return (a.id || 0) - (b.id || 0);
                    });
                    renderGuides(sortedData);
                } else {
                    document.getElementById('guidesContainer').innerHTML = '<p style="text-align: center; color: white;">Belum ada data tour guide.</p>';
                }
            } catch (error) {
                console.error('Error loading guides:', error);
                document.getElementById('guidesContainer').innerHTML = '<p style="text-align: center; color: white;">Gagal memuat data tour guide.</p>';
            }
        }

        function renderGuides(guides) {
            const container = document.getElementById('guidesContainer');
            const firstRow = guides.slice(0, 4);
            const secondRow = guides.slice(4);

            let html = '';

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

            container.innerHTML = html;
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadGuidesFromDB();
        });
    </script>
</body>

</html>