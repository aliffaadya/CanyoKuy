@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="totalBooking">0</h3>
            <p>Total Booking</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-book"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="pendingBooking">0</h3>
            <p>Pending</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="confirmedBooking">0</h3>
            <p>Confirmed</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3 id="totalRevenue">0</h3>
            <p>Total Revenue</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-money-bill"></i>
        </div>
    </div>
</div>

<div class="table-container">
    <h3 style="margin-bottom: 20px;">📋 Booking Terbaru</h3>
    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Nama</th>
                <th>Paket</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="recentBookings">
            <tr>
                <td colspan="6" style="text-align: center;">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    function loadDashboard() {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        
        document.getElementById('totalBooking').innerText = bookings.length;
        document.getElementById('pendingBooking').innerText = bookings.filter(b => b.status === 'Menunggu Pembayaran' || b.payment_status === 'pending').length;
        document.getElementById('confirmedBooking').innerText = bookings.filter(b => b.status === 'Lunas' || b.payment_status === 'paid').length;
        
        const totalRevenue = bookings.reduce((sum, b) => sum + (b.total || 0), 0);
        document.getElementById('totalRevenue').innerText = 'Rp ' + totalRevenue.toLocaleString('id-ID');
        
        const recentBookings = bookings.slice(-5).reverse();
        const tbody = document.getElementById('recentBookings');
        
        if (recentBookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">Belum ada booking</td></tr>';
            return;
        }
        
        tbody.innerHTML = recentBookings.map(booking => `
            <tr>
                <td>${booking.booking_code || '-'}</td>
                <td>${booking.nama || booking.customer_name || '-'}</td>
                <td>${booking.package || booking.package_name || '-'}</td>
                <td>${booking.tanggal || booking.booking_date || '-'}</td>
                <td>Rp ${(booking.total || 0).toLocaleString('id-ID')}</td>
                <td><span class="status status-${booking.status === 'Lunas' ? 'paid' : 'pending'}">${booking.status || 'Pending'}</span></td>
            </tr>
        `).join('');
    }
    
    loadDashboard();
</script>
@endsection