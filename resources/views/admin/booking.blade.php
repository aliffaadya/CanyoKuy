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
                <th>Kode</th>
                <th>Nama</th>
                <th>Paket</th>
                <th>WhatsApp</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti TF</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="bookingsTable">
            <tr>
                <td colspan="9" style="text-align: center;">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Preview Bukti Transfer -->
<div id="proofModal" class="modal">
    <div class="modal-content">
        <h3>Bukti Transfer</h3>
        <img id="proofImage" class="proof-image" src="">
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button onclick="closeModal()" class="btn-view">Tutup</button>
            <button onclick="verifyPayment()" class="btn-edit" id="verifyBtn">Verifikasi Pembayaran</button>
        </div>
    </div>
</div>

<script>
    let currentBookingId = null;
    let allBookings = [];
    
    function loadBookings() {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        allBookings = bookings;
        filterBookings();
    }
    
    function filterBookings() {
        const filter = document.getElementById('filterStatus').value;
        let filteredBookings = [...allBookings];
        
        if (filter === 'pending') {
            filteredBookings = filteredBookings.filter(b => b.status === 'Menunggu Pembayaran' || b.payment_status === 'pending');
        } else if (filter === 'waiting') {
            filteredBookings = filteredBookings.filter(b => b.status === 'Menunggu Verifikasi' || b.payment_status === 'waiting_confirmation');
        } else if (filter === 'paid') {
            filteredBookings = filteredBookings.filter(b => b.status === 'Lunas' || b.payment_status === 'paid');
        }
        
        const tbody = document.getElementById('bookingsTable');
        
        if (filteredBookings.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center;">Tidak ada data booking</td></tr>';
            return;
        }
        
        tbody.innerHTML = filteredBookings.map((booking, index) => `
            <tr>
                <td>${booking.booking_code || '-'}</td>
                <td>${booking.nama || booking.customer_name || '-'}</td>
                <td>${booking.package || booking.package_name || '-'}</td>
                <td>${booking.whatsapp || booking.phone || '-'}</td>
                <td>${booking.tanggal || booking.booking_date || '-'}</td>
                <td>Rp ${(booking.total || 0).toLocaleString('id-ID')}</td>
                <td><span class="status status-${getStatusClass(booking)}">${getStatusText(booking)}</span></td>
                <td>
                    ${booking.payment_proof ? 
                        `<button class="btn-view" onclick="viewProof('${booking.payment_proof}', ${index})">Lihat Bukti</button>` : 
                        '<span style="color: #999;">Belum upload</span>'}
                </td>
                <td>
                    <button class="btn-edit" onclick="updateStatus(${index}, 'paid')">✓ Verifikasi</button>
                    <button class="btn-delete" onclick="deleteBooking(${index})">🗑 Hapus</button>
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
    
    function viewProof(proofData, index) {
        currentBookingId = index;
        const modal = document.getElementById('proofModal');
        const img = document.getElementById('proofImage');
        
        if (proofData.startsWith('data:image')) {
            img.src = proofData;
        } else {
            img.src = proofData;
        }
        
        modal.style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('proofModal').style.display = 'none';
        currentBookingId = null;
    }
    
    function verifyPayment() {
        if (currentBookingId !== null) {
            updateStatus(currentBookingId, 'paid');
            closeModal();
        }
    }
    
    function updateStatus(index, newStatus) {
        const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
        
        if (newStatus === 'paid') {
            bookings[index].status = 'Lunas';
            bookings[index].payment_status = 'paid';
        }
        
        localStorage.setItem('allBookings', JSON.stringify(bookings));
        loadBookings();
        alert('✅ Status booking berhasil diupdate!');
    }
    
    function deleteBooking(index) {
        if (confirm('Yakin ingin menghapus booking ini?')) {
            const bookings = JSON.parse(localStorage.getItem('allBookings') || '[]');
            bookings.splice(index, 1);
            localStorage.setItem('allBookings', JSON.stringify(bookings));
            loadBookings();
            alert('🗑 Booking berhasil dihapus!');
        }
    }
    
    loadBookings();
</script>
@endsection