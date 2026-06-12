@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="pendingOrders">0</h3>
            <p>Pesanan Pending</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="successOrders">0</h3>
            <p>Pesanan Sukses</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="remainingQuota">0</h3>
            <p>Sisa Kuota Terdekat</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="totalRevenue">0</h3>
            <p>Total Pendapatan</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-money-bill"></i>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
    <div class="table-container">
        <h3 style="margin-bottom: 20px;">📅 Kalender Kegiatan</h3>
        <div id="calendar"></div>
    </div>
    <div class="table-container">
        <h3 style="margin-bottom: 20px;">⏰ Jadwal Terdekat</h3>
        <div id="upcomingSchedules">
            <table style="width: 100%;">
                <thead>
                    <tr><th>Tanggal</th><th>Lokasi</th><th>Kuota</th><th>Terisi</th><th>Sisa</th></tr>
                </thead>
                <tbody id="upcomingTable">
                    <tr><td colspan="5" style="text-align: center;">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="table-container">
    <h3 style="margin-bottom: 20px;">📊 Statistik Booking per Bulan</h3>
    <canvas id="bookingChart" style="max-height: 300px;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function loadDashboard() {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        const schedules = JSON.parse(localStorage.getItem('schedules') || '[]');
        
        const pending = bookings.filter(b => b.status === 'Menunggu Pembayaran' || b.payment_status === 'pending').length;
        const success = bookings.filter(b => b.status === 'Lunas' || b.payment_status === 'paid').length;
        const totalRevenue = bookings.reduce((sum, b) => sum + (b.total || 0), 0);
        
        document.getElementById('pendingOrders').innerText = pending;
        document.getElementById('successOrders').innerText = success;
        document.getElementById('totalRevenue').innerText = 'Rp ' + totalRevenue.toLocaleString('id-ID');
        
        const today = new Date();
        const upcomingSchedules = schedules
            .filter(s => new Date(s.tanggal) >= today)
            .sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));
        
        const totalRemaining = upcomingSchedules.reduce((sum, s) => sum + (s.kuota - (s.terisi || 0)), 0);
        document.getElementById('remainingQuota').innerText = totalRemaining;
        
        const upcomingTable = document.getElementById('upcomingTable');
        if (upcomingSchedules.length === 0) {
            upcomingTable.innerHTML = '<tr><td colspan="5" style="text-align: center;">Tidak ada jadwal terdekat</td></tr>';
        } else {
            upcomingTable.innerHTML = upcomingSchedules.slice(0, 5).map(s => `
                <tr>
                    <td>${formatDate(s.tanggal)}</td>
                    <td>${s.lokasi}</td>
                    <td>${s.kuota}</td>
                    <td>${s.terisi || 0}</td>
                    <td>${s.kuota - (s.terisi || 0)}</td>
                </tr>
            `).join('');
        }
        
        drawChart(bookings);
        renderCalendar(schedules);
    }
    
    function formatDate(dateString) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
    
    function drawChart(bookings) {
        const monthlyData = {};
        bookings.forEach(b => {
            const date = new Date(b.tanggal || b.booking_date);
            const monthYear = `${date.getMonth() + 1}/${date.getFullYear()}`;
            monthlyData[monthYear] = (monthlyData[monthYear] || 0) + 1;
        });
        
        const months = Object.keys(monthlyData).sort();
        const counts = months.map(m => monthlyData[m]);
        
        const ctx = document.getElementById('bookingChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jumlah Booking',
                    data: counts,
                    backgroundColor: '#2F6B5E',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'top' } }
            }
        });
    }
    
    function renderCalendar(schedules) {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const bookedDates = schedules.map(s => s.tanggal);
        
        let calendarHtml = '<table style="width: 100%; text-align: center;"><thead><tr><th>Sen</th><th>Sel</th><th>Rab</th><th>Kam</th><th>Jum</th><th>Sab</th><th>Min</th></tr></thead><tbody><tr>';
        
        for (let i = 0; i < (firstDay.getDay() + 6) % 7; i++) {
            calendarHtml += '<td style="padding: 8px; color: #ccc;"></td>';
        }
        
        for (let d = 1; d <= lastDay.getDate(); d++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            const isBooked = bookedDates.includes(dateStr);
            const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
            
            calendarHtml += `<td style="padding: 8px; ${isBooked ? 'background: #d4edda; border-radius: 8px;' : ''} ${isToday ? 'background: #2F6B5E; color: white; border-radius: 8px;' : ''}">
                ${d}
            </td>`;
            
            if ((d + (firstDay.getDay() + 6) % 7) % 7 === 0 && d !== lastDay.getDate()) {
                calendarHtml += '</tr><tr>';
            }
        }
        
        calendarHtml += '</tr></tbody></table>';
        document.getElementById('calendar').innerHTML = calendarHtml;
    }
    
    loadDashboard();
</script>
@endsection