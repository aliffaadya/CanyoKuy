@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    /* ========== DASHBOARD UI STYLES - PIXEL PERFECT ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-green: #29604c;
        --banner-green: #4da674;
        --bg-color: #f7f9fa;
        --text-dark: #1e293b;
        --text-gray: #64748b;
        --card-bg: #ffffff;
    }

    body, .content-wrapper, .main-content {
        background-color: var(--bg-color) !important;
        font-family: 'Inter', sans-serif;
    }

    /* Layout Utama */
    .dashboard-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        align-items: start;
        padding-top: 20px;
    }

    /* Header Banner */
    .welcome-banner {
        background: linear-gradient(120deg, #4da674 0%, #29604c 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        position: relative;
        margin-bottom: 30px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(77, 166, 116, 0.2);
    }

    .welcome-banner::after, .welcome-banner::before {
        content: '';
        position: absolute;
        border-radius: 50%;
    }
    .welcome-banner::after {
        top: -50%; right: -10%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
    }
    .welcome-banner::before {
        bottom: -50%; left: 20%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 70%);
    }

    .banner-date { font-size: 14px; font-weight: 500; margin-bottom: 20px; opacity: 0.9; }
    .welcome-banner h1 { font-size: 32px; font-weight: 700; margin: 0 0 8px 0; color: white; }
    .welcome-banner p { font-size: 15px; opacity: 0.9; margin: 0; }

    .section-title { font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 16px; }

    /* Grid Statistik */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 30px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
    }

    .card-pending { border-bottom: 4px solid #cddc39; }
    .card-success { border-bottom: 4px solid #4da674; }
    .card-danger { border-bottom: 4px solid #e53935; }

    .stat-number { font-size: 42px; font-weight: 800; margin-bottom: 12px; line-height: 1; }
    .card-pending .stat-number { color: #afb42b; }
    .card-success .stat-number { color: #4da674; }
    .card-danger .stat-number { color: #e53935; }

    .stat-title { font-size: 16px; font-weight: 700; color: var(--text-dark); }

    /* Grid Detail Bawah */
    .details-grid { display: grid; grid-template-columns: 1fr 1.8fr; gap: 20px; }

    .detail-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        display: flex; flex-direction: column; justify-content: center;
    }

    .sisa-kuota-number {
        font-size: 72px; font-weight: 800; color: var(--primary-green);
        text-align: center; line-height: 1; margin-top: 10px;
    }

    .event-card { background: #f0fdf4; border-radius: 16px; padding: 20px; }
    .event-card-header { display: flex; align-items: flex-start; gap: 15px; }
    .event-icon { font-size: 24px; color: var(--primary-green); margin-top: 2px; }
    .event-info h4 { font-size: 15px; font-weight: 700; color: var(--text-dark); margin: 0 0 8px 0; line-height: 1.4; }
    .event-info p { font-size: 14px; color: var(--text-gray); margin: 0; line-height: 1.5; }

    /* Kalender */
    .calendar-card {
        background: var(--card-bg); border-radius: 24px; padding: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03); margin-bottom: 30px;
    }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; font-weight: 700; font-size: 16px; color: var(--text-dark); margin-bottom: 20px; }
    .calendar-nav { display: flex; gap: 15px; color: var(--text-gray); cursor: pointer; }
    
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; }
    .cal-day-name { font-size: 13px; font-weight: 700; color: var(--text-dark); margin-bottom: 15px; }
    .cal-date { font-size: 14px; color: var(--text-gray); padding: 8px 0; margin-bottom: 5px; border-radius: 8px; font-weight: 500; }
    .cal-active { background: var(--banner-green); color: white !important; border-radius: 10px; font-weight: 700; box-shadow: 0 4px 10px rgba(77, 166, 116, 0.4); }

    /* Tabel Booking Terbaru */
    .recent-bookings { background: var(--card-bg); border-radius: 24px; padding: 24px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03); }
    .recent-table { width: 100%; border-collapse: collapse; }
    .recent-table th { text-align: left; font-size: 14px; font-weight: 700; color: var(--text-dark); padding-bottom: 15px; border-bottom: 1px solid #f1f5f9; }
    .recent-table td { padding: 15px 0; font-size: 14px; color: var(--text-dark); border-bottom: 1px solid #f8fafc; }
    .recent-table tr:last-child td { border-bottom: none; }
    .td-name { font-weight: 500; }
    .td-paket { color: var(--text-gray); }

    @media (max-width: 1024px) { .dashboard-wrapper { grid-template-columns: 1fr; } }
</style>

<div class="dashboard-wrapper">
    <div class="main-column">
        
        <div class="welcome-banner">
            <div class="banner-date" id="currentDateBanner"></div>
            <h1>Welcome back, Admin!</h1>
            <p>Pantau pembaruan data dan aktivitas booking terbaru di sini.</p>
        </div>

        <div class="section-title">Stats</div>
        
        <div class="stats-grid">
            <div class="stat-card card-pending">
                <div class="stat-number" id="valPending">0</div>
                <div class="stat-title">Pesanan Pending</div>
            </div>
            
            <div class="stat-card card-success">
                <div class="stat-number" id="valSuccess">0</div>
                <div class="stat-title">Pesanan Diterima</div>
            </div>
            
            <div class="stat-card card-danger">
                <div class="stat-number" id="valRejected">0</div>
                <div class="stat-title">Pesanan Ditolak</div>
            </div>
        </div>

        <div class="details-grid">
            <div>
                <div class="section-title">Sisa Kuota</div>
                <div class="detail-card" style="height: 180px;">
                    <div class="sisa-kuota-number" id="valRemainingQuota">0</div>
                    <div style="text-align: center; color: var(--text-gray); font-size: 14px; margin-top: 8px;">Total Orang Tersisa</div>
                </div>
            </div>

            <div>
                <div class="section-title">Ringkasan Jadwal Kegiatan</div>
                <div class="detail-card" id="upcomingEventContainer">
                    <div style="text-align:center; padding:20px; color:var(--text-gray);">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    <div class="side-column">
        <div class="calendar-card">
            <div class="calendar-header">
                <span id="calendarMonthYear">Bulan Tahun</span>
            </div>
            
            <div class="calendar-grid" id="calendarGrid">
                </div>
        </div>

        <div class="section-title">Booking Terbaru</div>
        <div class="recent-bookings">
            <table class="recent-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Paket</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="recentBookingsBody">
                    </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Set tanggal hari ini di Banner
    const bannerDateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('currentDateBanner').innerText = new Date().toLocaleDateString('en-US', bannerDateOptions);

    // Fungsi Utama Dashboard
    function loadDashboard() {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        const schedules = JSON.parse(localStorage.getItem('schedules') || '[]');
        
        // 1. Hitung Statistik (Disesuaikan untuk Pending, Diterima, Ditolak)
        const pending = bookings.filter(b => b.status === 'Menunggu Pembayaran' || b.payment_status === 'pending').length;
        const success = bookings.filter(b => b.status === 'Lunas' || b.payment_status === 'paid' || b.status === 'Diterima').length;
        const rejected = bookings.filter(b => b.status === 'Ditolak' || b.status === 'Batal').length;
        
        document.getElementById('valPending').innerText = pending;
        document.getElementById('valSuccess').innerText = success;
        document.getElementById('valRejected').innerText = rejected;
        
        // 2. Sisa Kuota & Jadwal Terdekat
        const today = new Date();
        today.setHours(0,0,0,0); // Normalisasi ke tengah malam
        
        const upcomingSchedules = schedules
            .filter(s => new Date(s.tanggal) >= today)
            .sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));
        
        const totalRemaining = upcomingSchedules.reduce((sum, s) => sum + (s.kuota - (s.terisi || 0)), 0);
        document.getElementById('valRemainingQuota').innerText = totalRemaining;
        
        // Render Card Jadwal Terdekat (Ambil 1 paling atas)
        const upcomingContainer = document.getElementById('upcomingEventContainer');
        if (upcomingSchedules.length === 0) {
            upcomingContainer.innerHTML = '<div style="text-align:center; padding: 20px; color: var(--text-gray);">Tidak ada jadwal terdekat</div>';
        } else {
            const s = upcomingSchedules[0];
            const sisa = s.kuota - (s.terisi || 0);
            upcomingContainer.innerHTML = `
                <div class="event-card">
                    <div class="event-card-header">
                        <div class="event-icon"><i class="far fa-calendar-alt"></i></div>
                        <div class="event-info">
                            <h4>${s.lokasi || 'Kegiatan'} - ${formatDate(s.tanggal)}</h4>
                            <p>Kuota Total: ${s.kuota} | Terisi: ${s.terisi || 0} | <strong>Sisa: ${sisa}</strong></p>
                        </div>
                    </div>
                </div>
            `;
        }
        
        // 3. Render Kalender & Tabel Booking
        renderNewCalendar(schedules);
        renderRecentBookings(bookings);
    }
    
    function formatDate(dateString) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
    
    // Fungsi Kalender (Disesuaikan dengan format Div/Grid CSS baru)
    function renderNewCalendar(schedules) {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        
        // Set Judul Kalender (Bulan Tahun)
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        document.getElementById('calendarMonthYear').innerText = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay(); // 0 = Minggu, 1 = Senin, dst
        const lastDate = new Date(year, month + 1, 0).getDate(); // Tanggal terakhir bulan ini
        const prevMonthLastDate = new Date(year, month, 0).getDate();

        const bookedDates = schedules.map(s => s.tanggal);
        let calendarHtml = `
            <div class="cal-day-name">S</div>
            <div class="cal-day-name">M</div>
            <div class="cal-day-name">T</div>
            <div class="cal-day-name">W</div>
            <div class="cal-day-name">T</div>
            <div class="cal-day-name">F</div>
            <div class="cal-day-name">S</div>
        `;

        // Tanggal dari bulan sebelumnya (untuk ngisi ruang kosong di awal)
        for (let i = firstDay; i > 0; i--) {
            calendarHtml += `<div class="cal-date" style="color: #cbd5e1;">${prevMonthLastDate - i + 1}</div>`;
        }

        // Tanggal bulan ini
        for (let d = 1; d <= lastDate; d++) {
            // Format YYYY-MM-DD
            const mStr = String(month + 1).padStart(2, '0');
            const dStr = String(d).padStart(2, '0');
            const dateStr = `${year}-${mStr}-${dStr}`;
            
            const isBooked = bookedDates.includes(dateStr);
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            
            // Kalau ada booking, kita kasih class 'cal-active' (hijau terang)
            // Kalau hari ini (tapi gak ada booking), kita tandai dengan border/warna lain opsional
            if (isBooked) {
                calendarHtml += `<div class="cal-date cal-active">${d}</div>`;
            } else if (isToday) {
                calendarHtml += `<div class="cal-date" style="color: var(--primary-green); font-weight: 800; border: 1px solid var(--primary-green);">${d}</div>`;
            } else {
                calendarHtml += `<div class="cal-date">${d}</div>`;
            }
        }

        document.getElementById('calendarGrid').innerHTML = calendarHtml;
    }

    // Fungsi Render Tabel Booking Terbaru (Ambil 4 data terakhir)
    function renderRecentBookings(bookings) {
        const tbody = document.getElementById('recentBookingsBody');
        
        if(bookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: var(--text-gray);">Belum ada booking</td></tr>';
            return;
        }

        // Ambil 4 booking terakhir
        const recent = bookings.slice(-4).reverse();
        
        tbody.innerHTML = recent.map(b => `
            <tr>
                <td class="td-name">${b.nama_client || b.nama || 'Client'}<br><span style="font-size:12px; color:var(--text-gray); font-weight:normal;">${b.tanggal || '-'}</span></td>
                <td class="td-paket">${b.paket || 'Paket Default'}</td>
                <td>
                    <span style="padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; 
                        background: ${b.status === 'Lunas' || b.status === 'Diterima' ? '#e8f5e9' : (b.status === 'Ditolak' ? '#ffebee' : '#f9fbe7')};
                        color: ${b.status === 'Lunas' || b.status === 'Diterima' ? '#4da674' : (b.status === 'Ditolak' ? '#e53935' : '#afb42b')}">
                        ${b.status || 'Pending'}
                    </span>
                </td>
            </tr>
        `).join('');
    }
    
    // Jalankan fungsi
    loadDashboard();
</script>
@endsection