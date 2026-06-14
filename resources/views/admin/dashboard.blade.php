@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    /* ========== DASHBOARD UI STYLES ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-green: #29604c;
        --banner-green: #4da674;
        --bg-color: #f7f9fa;
        --text-dark: #1e293b;
        --text-gray: #64748b;
        --card-bg: #ffffff;
    }

    body,
    .content-wrapper,
    .main-content {
        background-color: var(--bg-color) !important;
        font-family: 'Inter', sans-serif;
    }

    .dashboard-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        align-items: start;
        padding-top: 20px;
    }

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

    .welcome-banner::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        bottom: -50%;
        left: 20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
    }

    .banner-date {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .welcome-banner h1 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 8px 0;
        color: white;
    }

    .welcome-banner p {
        font-size: 15px;
        opacity: 0.9;
        margin: 0;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

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
        cursor: pointer;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .card-waiting {
        border-bottom: 4px solid #ff9800;
    }

    .card-success {
        border-bottom: 4px solid #4da674;
    }

    .card-rejected {
        border-bottom: 4px solid #e53935;
    }

    .stat-number {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 12px;
        line-height: 1;
    }

    .card-waiting .stat-number {
        color: #ff9800;
    }

    .card-success .stat-number {
        color: #4da674;
    }

    .card-rejected .stat-number {
        color: #e53935;
    }

    .stat-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1.8fr;
        gap: 20px;
    }

    .detail-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .sisa-kuota-number {
        font-size: 72px;
        font-weight: 800;
        color: var(--primary-green);
        text-align: center;
        line-height: 1;
        margin-top: 10px;
    }

    .event-card {
        background: #f0fdf4;
        border-radius: 16px;
        padding: 20px;
    }

    .event-card-header {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .event-icon {
        font-size: 24px;
        color: var(--primary-green);
        margin-top: 2px;
    }

    .event-info h4 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 8px 0;
        line-height: 1.4;
    }

    .event-info p {
        font-size: 14px;
        color: var(--text-gray);
        margin: 0;
        line-height: 1.5;
    }

    .calendar-card {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 30px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        font-size: 16px;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
    }

    .cal-day-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
    }

    .cal-date {
        font-size: 14px;
        color: var(--text-gray);
        padding: 8px 0;
        margin-bottom: 5px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .cal-date:hover {
        background: #e8f5e9;
        transform: scale(1.05);
    }

    .cal-active {
        background: linear-gradient(135deg, #4da674 0%, #29604c 100%);
        color: white !important;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(77, 166, 116, 0.3);
    }

    .cal-today {
        border: 2px solid #4da674;
        color: #4da674 !important;
        font-weight: 800;
        background: transparent;
    }

    .recent-bookings {
        background: var(--card-bg);
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
    }

    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }

    .recent-table th {
        text-align: left;
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }

    .recent-table td {
        padding: 15px 0;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid #f8fafc;
    }

    .recent-table tr:last-child td {
        border-bottom: none;
    }

    .loading-spinner {
        text-align: center;
        padding: 20px;
    }

    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #4da674;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <div class="main-column">
        <div class="welcome-banner">
            <div class="banner-date" id="currentDateBanner"></div>
            <h1>Welcome back, Admin!</h1>
            <p>Pantau pembaruan data dan aktivitas booking terbaru di sini.</p>
        </div>

        <div class="section-title">Status</div>

        <div class="stats-grid">
            <div class="stat-card card-waiting" onclick="window.location.href='/admin/booking?status=waiting'">
                <div class="stat-number" id="valWaiting">0</div>
                <div class="stat-title">Menunggu Verifikasi</div>
            </div>

            <div class="stat-card card-success" onclick="window.location.href='/admin/booking?status=paid'">
                <div class="stat-number" id="valSuccess">0</div>
                <div class="stat-title">Pesanan Sukses</div>
            </div>

            <div class="stat-card card-rejected" onclick="window.location.href='/admin/booking?status=rejected'">
                <div class="stat-number" id="valRejected">0</div>
                <div class="stat-title">Pesanan Ditolak</div>
            </div>
        </div>

        <div class="details-grid">
            <div>
                <div class="section-title">Sisa Kuota</div>
                <div class="detail-card" style="height: 180px;">
                    <div class="sisa-kuota-number" id="valRemainingQuota">0</div>
                    <div style="text-align: center; color: var(--text-gray); font-size: 14px; margin-top: 8px;">Total Tersisa</div>
                </div>
            </div>

            <div>
                <div class="section-title">Jadwal Terdekat</div>
                <div class="detail-card" id="upcomingEventContainer">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Loading...</p>
                    </div>
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
                <div class="loading-spinner">
                    <div class="spinner"></div>
                </div>
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
                    <tr>
                        <td colspan="3" class="loading-spinner">
                            <div class="spinner"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    // Set tanggal hari ini di Banner
    const bannerDateOptions = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById('currentDateBanner').innerText = new Date().toLocaleDateString('id-ID', bannerDateOptions);

    // Fungsi mengambil data dari API
    async function fetchData() {
        try {
            console.log('Fetching data...');
            
            // Ambil stats dari API
            const statsResponse = await fetch('/api/bookings/stats');
            
            if (!statsResponse.ok) {
                throw new Error(`HTTP error! status: ${statsResponse.status}`);
            }
            
            const statsResult = await statsResponse.json();
            console.log('Stats result:', statsResult);

            if (statsResult.success) {
                document.getElementById('valWaiting').innerText = statsResult.data.waiting_confirmation || 0;
                document.getElementById('valSuccess').innerText = statsResult.data.paid || 0;
                document.getElementById('valRejected').innerText = statsResult.data.rejected || 0;
            }

            // Ambil data booking
            const bookingResponse = await fetch('/api/bookings');
            const bookingResult = await bookingResponse.json();

            // Ambil data schedule dari endpoint yang benar
            let schedules = [];
            try {
                // Coba beberapa endpoint yang mungkin tersedia
                let scheduleResponse = await fetch('/api/schedules');
                if (scheduleResponse.ok) {
                    const scheduleResult = await scheduleResponse.json();
                    schedules = scheduleResult.success ? scheduleResult.data : (scheduleResult.data || []);
                } else {
                    // Fallback ke endpoint lain
                    scheduleResponse = await fetch('/admin/jadwal/api');
                    if (scheduleResponse.ok) {
                        const scheduleResult = await scheduleResponse.json();
                        schedules = scheduleResult.data || [];
                    }
                }
            } catch (e) {
                console.warn('Schedule API not available, using mock data');
                // Mock data untuk testing
                schedules = [];
            }

            const bookings = bookingResult.success ? bookingResult.data : [];
            
            console.log('Bookings loaded:', bookings.length);
            console.log('Schedules loaded:', schedules.length);

            updateDashboard(bookings, schedules);
        } catch (error) {
            console.error('Error fetching data:', error);
            showError();
        }
    }

    function showError() {
        document.getElementById('upcomingEventContainer').innerHTML = '<div style="text-align:center; padding:20px; color:#e53935;"><i class="fas fa-exclamation-triangle"></i> Gagal memuat data. Silahkan refresh halaman.</div>';
        document.getElementById('calendarGrid').innerHTML = '<div style="text-align:center; padding:20px; color:#e53935;">Gagal memuat kalender</div>';
        document.getElementById('recentBookingsBody').innerHTML = '<tr><td colspan="3" style="text-align:center; color:#e53935;">Gagal memuat data booking</td></tr>';
    }

    function updateDashboard(bookings, schedules) {
        // 1. Sisa Kuota & Jadwal Terdekat
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const upcomingSchedules = schedules
            .filter(s => s.schedule_date && new Date(s.schedule_date) >= today)
            .sort((a, b) => new Date(a.schedule_date) - new Date(b.schedule_date));

        const totalRemaining = upcomingSchedules.reduce((sum, s) => sum + ((s.quota || 0) - (s.filled || 0)), 0);
        document.getElementById('valRemainingQuota').innerText = totalRemaining || 0;

        // Render Card Jadwal Terdekat
        const upcomingContainer = document.getElementById('upcomingEventContainer');
        if (upcomingSchedules.length === 0) {
            upcomingContainer.innerHTML = '<div style="text-align:center; padding: 20px; color: var(--text-gray);"><i class="fas fa-calendar-alt"></i><br>Tidak ada jadwal terdekat</div>';
        } else {
            const s = upcomingSchedules[0];
            const sisa = (s.quota || 0) - (s.filled || 0);
            const statusColor = sisa > 0 ? '#4da674' : '#e53935';
            upcomingContainer.innerHTML = `
                <div class="event-card">
                    <div class="event-card-header">
                        <div class="event-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="event-info">
                            <h4>🎯 Kegiatan Canyoneering</h4>
                            <p>📅 ${formatDate(s.schedule_date)}</p>
                            <p>👥 Kuota: <strong>${s.quota || 0}</strong> | Terisi: <strong>${s.filled || 0}</strong></p>
                            <p style="color: ${statusColor}; font-weight: bold;">✅ Sisa Kuota: ${sisa} peserta</p>
                        </div>
                    </div>
                </div>
            `;
        }

        // 2. Render Kalender
        renderCalendar(schedules);

        // 3. Render Tabel Booking Terbaru
        renderRecentBookings(bookings);
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        try {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        } catch (e) {
            return dateString;
        }
    }

    function formatShortDate(dateString) {
        if (!dateString) return '-';
        try {
            const options = {
                day: 'numeric',
                month: 'short'
            };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        } catch (e) {
            return dateString;
        }
    }

    function renderCalendar(schedules) {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        document.getElementById('calendarMonthYear').innerHTML = `<i class="fas fa-calendar"></i> ${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
        const prevMonthLastDate = new Date(year, month, 0).getDate();

        // Adjust firstDay (Minggu = 0, Senin = 1, ...)
        let startDay = firstDay === 0 ? 6 : firstDay - 1;

        // BUAT SET TANGGAL YANG ADA JADWAL (format YYYY-MM-DD)
        const scheduleDates = new Set();
        if (schedules && schedules.length > 0) {
            schedules.forEach(s => {
                if (s.schedule_date) {
                    try {
                        const date = new Date(s.schedule_date);
                        const formattedDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
                        scheduleDates.add(formattedDate);
                    } catch (e) {
                        console.error('Error parsing date:', s.schedule_date);
                    }
                }
            });
        }

        let calendarHtml = `
            <div class="cal-day-name">Sen</div>
            <div class="cal-day-name">Sel</div>
            <div class="cal-day-name">Rab</div>
            <div class="cal-day-name">Kam</div>
            <div class="cal-day-name">Jum</div>
            <div class="cal-day-name">Sab</div>
            <div class="cal-day-name">Min</div>
        `;

        // Tanggal dari bulan sebelumnya
        for (let i = startDay; i > 0; i--) {
            calendarHtml += `<div class="cal-date" style="color: #cbd5e1;">${prevMonthLastDate - i + 1}</div>`;
        }

        // Tanggal bulan ini
        for (let d = 1; d <= lastDate; d++) {
            const mStr = String(month + 1).padStart(2, '0');
            const dStr = String(d).padStart(2, '0');
            const dateStr = `${year}-${mStr}-${dStr}`;

            const hasSchedule = scheduleDates.has(dateStr);
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();

            let additionalClass = '';
            let title = '';

            if (hasSchedule) {
                additionalClass = 'cal-active';
                title = 'Ada jadwal kegiatan';
            }

            if (isToday && !hasSchedule) {
                additionalClass = 'cal-today';
                title = 'Hari ini';
            }

            calendarHtml += `<div class="cal-date ${additionalClass}" title="${title}">${d}</div>`;
        }

        document.getElementById('calendarGrid').innerHTML = calendarHtml;
    }

    function renderRecentBookings(bookings) {
        const tbody = document.getElementById('recentBookingsBody');

        if (!bookings || bookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: var(--text-gray);"><i class="fas fa-inbox"></i><br>Belum ada booking</td></tr>';
            return;
        }

        const recent = [...bookings].reverse().slice(0, 5);

        tbody.innerHTML = recent.map(b => {
            let statusText = 'Pending';
            let statusClass = '#f1f5f9';
            let statusColor = '#64748b';
            let statusIcon = '⏳';

            if (b.payment_status === 'paid') {
                statusText = 'Lunas';
                statusClass = '#e8f5e9';
                statusColor = '#4da674';
                statusIcon = '✅';
            } else if (b.payment_status === 'waiting_confirmation') {
                statusText = 'Menunggu Verifikasi';
                statusClass = '#fff3e0';
                statusColor = '#ff9800';
                statusIcon = '⏰';
            } else if (b.payment_status === 'rejected') {
                statusText = 'Ditolak';
                statusClass = '#fee2e2';
                statusColor = '#dc2626';
                statusIcon = '❌';
            }

            const bookingDate = b.booking_date ? formatShortDate(b.booking_date) : '-';
            const customerName = b.customer_name || 'Unknown';
            const packageName = b.package_name || '-';
            
            return `
                <tr>
                    <td>
                        <strong>${customerName}</strong><br>
                        <small style="color: var(--text-gray);">${bookingDate}</small>
                    </td>
                    <td>${packageName}</td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: ${statusClass}; color: ${statusColor};">
                            ${statusIcon} ${statusText}
                        </span>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Load data saat halaman siap
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard loaded, fetching data...');
        fetchData();
        
        // Refresh data every 30 seconds
        setInterval(fetchData, 30000);
    });
</script>
@endsection