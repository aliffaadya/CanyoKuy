@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>📋 Semua Booking</h3>
        <div>
            <select id="filterStatus" onchange="filterBookings()" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #ddd;">
                <option value="all">Semua Status</option>
                <option value="pending">Menunggu Pembayaran</option>
                <option value="waiting">Menunggu Verifikasi</option>
                <option value="paid">Lunas</option>
            </select>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Kode</th><th>Nama</th><th>Paket</th><th>WhatsApp</th><th>Tanggal</th><th>Total</th><th>Status</th><th>Bukti TF</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody id="bookingsTable"></tbody>
    </table>
</div>

<div id="proofModal" class="modal">
    <div class="modal-content">
        <h3>Bukti Transfer</h3>
        <img id="proofImage" style="max-width: 100%; border-radius: 12px;">
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button onclick="closeModal()" class="btn-view">Tutup</button>
            <button onclick="verifyPayment()" class="btn-edit" id="verifyBtn">Verifikasi Pembayaran</button>
        </div>
    </div>
</div>

<script>
    let currentBookingIndex = null;
    let allBookings = [];
    
    function loadBookings() {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        allBookings = bookings;
        filterBookings();
    }
    
    function filterBookings() {
        const filter = document.getElementById('filterStatus').value;
        let filtered = [...allBookings];
        
        if (filter === 'pending') filtered = filtered.filter(b => b.status === 'Menunggu Pembayaran' || b.payment_status === 'pending');
        else if (filter === 'waiting') filtered = filtered.filter(b => b.status === 'Menunggu Verifikasi' || b.payment_status === 'waiting_confirmation');
        else if (filter === 'paid') filtered = filtered.filter(b => b.status === 'Lunas' || b.payment_status === 'paid');
        
        const tbody = document.getElementById('bookingsTable');
        if (filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center;">Tidak ada data booking</td></tr>';
            return;
        }
        
        tbody.innerHTML = filtered.map((booking, idx) => `
            <tr>
                <td>${booking.booking_code || '-'}</td>
                <td>${booking.nama || booking.customer_name || '-'}</td>
                <td>${booking.package || booking.package_name || '-'}</td>
                <td>${booking.whatsapp || booking.phone || '-'}</td>
                <td>${booking.tanggal || booking.booking_date || '-'}</td>
                <td>Rp ${(booking.total || 0).toLocaleString('id-ID')}</td>
                <td><span class="status status-${getStatusClass(booking)}">${getStatusText(booking)}</span></td>
                <td>${booking.payment_proof ? `<button class="btn-view" onclick="viewProof(${idx})">Lihat Bukti</button>` : '<span style="color:#999;">Belum upload</span>'}</td>
                <td>
                    <button class="btn-edit" onclick="updateStatus(${idx}, 'paid')">✓ Verifikasi</button>
                    <button class="btn-delete" onclick="deleteBooking(${idx})">🗑 Hapus</button>
                </td>
            </tr>
        `).join('');
    }
    
    function getStatusClass(booking) {
        if (booking.status === 'Lunas' || booking.payment_status === 'paid') return 'paid';
        if (booking.status === 'Menunggu Verifikasi' || booking.payment_status === 'waiting_confirmation') return 'waiting';
        return 'pending';
    }
    
    function getStatusText(booking) {
        if (booking.status === 'Lunas' || booking.payment_status === 'paid') return 'Lunas';
        if (booking.status === 'Menunggu Verifikasi' || booking.payment_status === 'waiting_confirmation') return 'Menunggu Verifikasi';
        return 'Menunggu Pembayaran';
    }
    
    function viewProof(index) {
        currentBookingIndex = index;
        const booking = allBookings[index];
        document.getElementById('proofImage').src = booking.payment_proof;
        document.getElementById('proofModal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('proofModal').style.display = 'none';
        currentBookingIndex = null;
    }
    
    function verifyPayment() {
        if (currentBookingIndex !== null) {
            updateStatus(currentBookingIndex, 'paid');
            closeModal();
        }
    }
    
    function updateStatus(index, newStatus) {
        if (newStatus === 'paid') {
            allBookings[index].status = 'Lunas';
            allBookings[index].payment_status = 'paid';
        }
        localStorage.setItem('allBookings', JSON.stringify(allBookings));
        loadBookings();
        alert('✅ Status booking berhasil diupdate!');
    }
    
    function deleteBooking(index) {
        if (confirm('Yakin ingin menghapus booking ini?')) {
            allBookings.splice(index, 1);
            localStorage.setItem('allBookings', JSON.stringify(allBookings));
            loadBookings();
            alert('🗑 Booking berhasil dihapus!');
        }
    }
    
    loadBookings();
</script>
@endsection