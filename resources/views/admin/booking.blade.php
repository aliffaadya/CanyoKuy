@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .booking-content {
        font-family: 'Inter', sans-serif;
        padding: 0 20px;
    }

    .green-banner-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 16px;
        padding: 20px 28px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
    }

    .banner-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .banner-icon {
        background: rgba(255, 255, 255, 0.2);
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }

    .page-title {
        font-size: 22px;
        font-weight: 700;
        margin: 0;
        color: white;
    }

    .page-subtitle {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.85);
        margin: 4px 0 0;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .filter-group {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .filter-select {
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 13px;
        font-weight: 500;
        background: white;
        cursor: pointer;
    }

    .search-input {
        padding: 8px 14px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 13px;
        width: 250px;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    .btn-excel {
        background: #10b981;
        color: white;
    }

    .btn-excel:hover {
        background: #059669;
    }

    .btn-pdf {
        background: #ef4444;
        color: white;
    }

    .btn-pdf:hover {
        background: #dc2626;
    }

    .bookings-grid {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .booking-card {
        background: white;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .booking-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .booking-code {
        font-weight: 700;
        font-size: 14px;
        color: #10b981;
        background: #f0fdf4;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
    }

    .card-body {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
        word-break: break-word;
    }

    .info-value strong {
        font-size: 16px;
        color: #10b981;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
        width: fit-content;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-info {
        background: #e0f2fe;
        color: #0284c7;
    }

    .card-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding-top: 12px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }

    .btn-verify {
        background: #d1fae5;
        color: #059669;
    }

    .btn-verify:hover {
        background: #059669;
        color: white;
    }

    .btn-reject {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-reject:hover {
        background: #dc2626;
        color: white;
    }

    .btn-restore {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-restore:hover {
        background: #0284c7;
        color: white;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }

    .btn-proof {
        background: #e0f2fe;
        color: #0284c7;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }

    .btn-proof:hover {
        background: #0284c7;
        color: white;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .modal-box {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 500px;
        padding: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        justify-content: flex-end;
    }

    .btn-cancel {
        background: #f1f5f9;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-submit {
        background: #10b981;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
    }

    .btn-submit:hover {
        background: #059669;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        color: #64748b;
    }

    .rejection-reason {
        background: #fef2f2;
        padding: 8px;
        border-radius: 6px;
        margin-top: 8px;
        font-size: 12px;
        color: #dc2626;
    }

    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
    }

    @media (max-width: 640px) {
        .card-body {
            grid-template-columns: 1fr;
        }
        
        .toolbar {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
            flex-wrap: wrap;
        }
        
        .search-input {
            width: 100%;
        }
        
        .green-banner-header {
            text-align: center;
        }
        
        .banner-left {
            flex-direction: column;
            text-align: center;
            width: 100%;
        }
    }
</style>

<div class="booking-content">
    <div class="green-banner-header">
        <div class="banner-left">
            <div class="banner-icon">
                <i class="fas fa-receipt"></i>
            </div>
            <div class="banner-text">
                <h1 class="page-title">Semua Booking</h1>
                <p class="page-subtitle">Pantau dan verifikasi pesanan tiket dari pelanggan.</p>
            </div>
        </div>
    </div>

    <div class="toolbar">
        <div class="filter-group">
            <input type="text" id="searchInput" placeholder="Cari nama atau kode booking..." class="search-input">
            <select id="filterStatus" onchange="filterBookings()" class="filter-select">
                <option value="all">Semua Status</option>
                <option value="waiting_confirmation">Menunggu Verifikasi</option>
                <option value="paid">Sudah Diverifikasi</option>
                <option value="rejected">Ditolak</option>
            </select>
        </div>
        <div class="filter-group">
            <button onclick="exportToCSV()" class="btn-action btn-excel">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
            <button onclick="exportToPDF()" class="btn-action btn-pdf">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>
    </div>

    <div id="bookingsContainer" class="bookings-grid">
        <div class="empty-state">
            <i class="fas fa-spinner fa-spin"></i> Memuat data...
        </div>
    </div>
</div>

<!-- Modal Lihat Bukti -->
<div id="proofModal" class="modal-overlay" onclick="if(event.target === this) closeModal()">
    <div class="modal-box">
        <h3 class="modal-title">
            <i class="fas fa-file-invoice-dollar" style="color: #10b981;"></i> 
            Bukti Transfer
        </h3>
        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; text-align: center;">
            <img id="proofImage" style="max-width: 100%; max-height: 400px; border-radius: 8px;">
        </div>
        <div class="modal-actions">
            <button onclick="closeModal()" class="btn-cancel">Tutup</button>
            <button onclick="verifyPayment()" class="btn-submit">
                <i class="fas fa-check-circle"></i> Verifikasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Tolak Booking -->
<div id="rejectModal" class="modal-overlay" onclick="if(event.target === this) closeRejectModal()">
    <div class="modal-box">
        <h3 class="modal-title">
            <i class="fas fa-times-circle" style="color: #dc2626;"></i> 
            Tolak Booking
        </h3>
        <div style="margin-bottom: 16px;">
            <label style="font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Alasan Penolakan:</label>
            <textarea id="rejectionReason" rows="4" placeholder="Masukkan alasan penolakan booking..."></textarea>
        </div>
        <div class="modal-actions">
            <button onclick="closeRejectModal()" class="btn-cancel">Batal</button>
            <button onclick="submitRejection()" class="btn-submit" style="background: #dc2626;">
                <i class="fas fa-times"></i> Tolak
            </button>
        </div>
    </div>
</div>

<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    let allBookings = [];
    let currentBookingId = null;
    let currentBookingCode = null;

    function getStatusText(booking) {
        if (booking.payment_status === 'paid') return 'Sudah Diverifikasi';
        if (booking.payment_status === 'waiting_confirmation') return 'Menunggu Verifikasi';
        if (booking.payment_status === 'rejected') return 'Ditolak';
        return 'Menunggu Pembayaran';
    }

    function getStatusClass(booking) {
        if (booking.payment_status === 'paid') return 'badge-success';
        if (booking.payment_status === 'waiting_confirmation') return 'badge-warning';
        if (booking.payment_status === 'rejected') return 'badge-danger';
        return 'badge-info';
    }

    async function loadBookings() {
        try {
            const response = await fetch('/api/bookings');
            const result = await response.json();

            if (result.success) {
                allBookings = result.data;
                filterBookings();
            } else {
                console.error('Error:', result.message);
                showEmptyState();
            }
        } catch (error) {
            console.error('Error:', error);
            showEmptyState();
        }
    }

    function showEmptyState() {
        const container = document.getElementById('bookingsContainer');
        container.innerHTML = '<div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada data booking</p></div>';
    }

    function filterBookings() {
        const filter = document.getElementById('filterStatus').value;
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        
        let filtered = [...allBookings];

        if (filter !== 'all') {
            filtered = filtered.filter(b => b.payment_status === filter);
        }

        if (searchTerm) {
            filtered = filtered.filter(b => 
                b.booking_code?.toLowerCase().includes(searchTerm) ||
                b.customer_name?.toLowerCase().includes(searchTerm) ||
                b.phone?.includes(searchTerm)
            );
        }

        renderBookings(filtered);
    }

    function renderBookings(bookings) {
        const container = document.getElementById('bookingsContainer');
        
        if (bookings.length === 0) {
            container.innerHTML = '<div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada data yang sesuai</p></div>';
            return;
        }

        container.innerHTML = bookings.map(booking => `
            <div class="booking-card">
                <div class="card-header">
                    <span class="booking-code">
                        <i class="fas fa-ticket-alt"></i> ${booking.booking_code || '-'}
                    </span>
                    <span class="badge ${getStatusClass(booking)}">${getStatusText(booking)}</span>
                </div>
                
                <div class="card-body">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-user"></i> Nama
                        </div>
                        <div class="info-value">${booking.customer_name || '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </div>
                        <div class="info-value">${booking.phone || '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-box"></i> Paket
                        </div>
                        <div class="info-value">${booking.package_name || '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar"></i> Tanggal Booking
                        </div>
                        <div class="info-value">${booking.booking_date ? new Date(booking.booking_date).toLocaleDateString('id-ID') : '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-money-bill"></i> Total
                        </div>
                        <div class="info-value"><strong>Rp ${(booking.total_price || 0).toLocaleString('id-ID')}</strong></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-receipt"></i> Bukti Transfer
                        </div>
                        <div class="info-value">
                            ${booking.payment_proof 
                                ? `<button class="btn-proof" onclick="viewProof('${booking.payment_proof}', ${booking.id})">
                                    <i class="fas fa-image"></i> Lihat Bukti
                                   </button>` 
                                : '<span style="color:#94a3b8;">Belum upload</span>'}
                        </div>
                    </div>
                </div>
                
                ${booking.rejection_reason && booking.payment_status === 'rejected' ? `
                <div class="rejection-reason">
                    <strong><i class="fas fa-comment"></i> Alasan Ditolak:</strong><br>
                    ${booking.rejection_reason}
                </div>
                ` : ''}
                
                <div class="card-footer">
                    ${booking.payment_status === 'waiting_confirmation' && booking.payment_proof ? `
                        <button class="btn-icon btn-verify" onclick="verifyBooking(${booking.id})" title="Verifikasi">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn-icon btn-reject" onclick="showRejectModal(${booking.id}, '${booking.booking_code}')" title="Tolak">
                            <i class="fas fa-times"></i>
                        </button>
                    ` : ''}
                    
                    ${booking.payment_status === 'rejected' ? `
                        <button class="btn-icon btn-restore" onclick="restoreBooking(${booking.id})" title="Batalkan Penolakan">
                            <i class="fas fa-undo"></i>
                        </button>
                    ` : ''}
                    
                    <button class="btn-icon btn-delete" onclick="deleteBooking(${booking.id})" title="Hapus Permanen">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');
    }

    function viewProof(proofUrl, id) {
        currentBookingId = id;
        const img = document.getElementById('proofImage');
        img.src = proofUrl;
        img.onerror = () => { img.src = 'https://via.placeholder.com/400?text=Gambar+tidak+dapat+dimuat'; };
        document.getElementById('proofModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('proofModal').style.display = 'none';
        currentBookingId = null;
    }

    function verifyPayment() {
        if (currentBookingId) {
            updateStatus(currentBookingId, 'paid');
            closeModal();
        }
    }

    function verifyBooking(id) {
        if (confirm('Verifikasi pendaftaran ini?')) {
            updateStatus(id, 'paid');
        }
    }

    async function updateStatus(id, newStatus) {
        try {
            const response = await fetch(`/api/bookings/${id}/status`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            });
            const result = await response.json();

            if (result.success) {
                alert('✅ Status berhasil diupdate!');
                loadBookings();
            } else {
                alert('❌ Gagal: ' + (result.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Gagal update status');
        }
    }

    function showRejectModal(id, bookingCode) {
        currentBookingId = id;
        currentBookingCode = bookingCode;
        document.getElementById('rejectionReason').value = '';
        document.getElementById('rejectModal').style.display = 'flex';
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
        currentBookingId = null;
        currentBookingCode = null;
    }

    async function submitRejection() {
        const reason = document.getElementById('rejectionReason').value;
        
        if (!reason.trim()) {
            alert('Harap masukkan alasan penolakan!');
            return;
        }
        
        try {
            const response = await fetch(`/api/bookings/${currentBookingId}/reject`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ rejection_reason: reason })
            });
            const result = await response.json();

            if (result.success) {
                alert('✅ Booking berhasil ditolak!');
                closeRejectModal();
                loadBookings();
            } else {
                alert('❌ Gagal: ' + (result.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Gagal menolak booking');
        }
    }

    async function restoreBooking(id) {
        if (confirm('Batalkan penolakan dan kembalikan status ke menunggu verifikasi?')) {
            await updateStatus(id, 'waiting_confirmation');
        }
    }

    async function deleteBooking(id) {
        if (confirm('Yakin ingin menghapus booking ini secara permanen? Tindakan ini tidak dapat dibatalkan!')) {
            try {
                const response = await fetch(`/api/bookings/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });
                const result = await response.json();

                if (result.success) {
                    alert('✅ Booking dihapus permanen!');
                    loadBookings();
                } else {
                    alert('❌ Gagal: ' + (result.message || 'Terjadi kesalahan'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Gagal menghapus booking');
            }
        }
    }

    function exportToCSV() {
        const filter = document.getElementById('filterStatus').value;
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        
        let dataToExport = [...allBookings];
        
        if (filter !== 'all') {
            dataToExport = dataToExport.filter(b => b.payment_status === filter);
        }
        
        if (searchTerm) {
            dataToExport = dataToExport.filter(b => 
                b.booking_code?.toLowerCase().includes(searchTerm) ||
                b.customer_name?.toLowerCase().includes(searchTerm)
            );
        }
        
        if (dataToExport.length === 0) {
            alert("Tidak ada data untuk diexport!");
            return;
        }

        const headers = ['Kode Booking', 'Nama', 'WhatsApp', 'Paket', 'Tanggal', 'Total', 'Status', 'Alasan Ditolak'];
        const rows = dataToExport.map(b => [
            b.booking_code,
            b.customer_name,
            b.phone,
            b.package_name,
            b.booking_date ? new Date(b.booking_date).toLocaleDateString('id-ID') : '',
            b.total_price,
            getStatusText(b),
            b.rejection_reason || ''
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(cell => `"${String(cell || '').replace(/"/g, '""')}"`).join(','))
            .join('\n');

        const blob = new Blob(["\uFEFF" + csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = `Data_Booking_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }

    function exportToPDF() {
        window.print();
    }

    document.getElementById('searchInput')?.addEventListener('input', function() {
        filterBookings();
    });

    document.addEventListener('DOMContentLoaded', function() {
        loadBookings();
    });
</script>
@endsection