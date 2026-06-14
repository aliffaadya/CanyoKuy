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
        justify-content: flex-end;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
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

    .btn-action {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }

    /* CARD VIEW - TANPA SCROLL */
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

    .badge-pending {
        background: #f1f5f9;
        color: #475569;
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

    .btn-edit {
        background: #f0fdf4;
        color: #16a34a;
    }

    .btn-edit:hover {
        background: #16a34a;
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
    }

    .btn-proof:hover {
        background: #0284c7;
        color: white;
    }

    /* Modal Styles */
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        color: #64748b;
    }

    @media (max-width: 640px) {
        .card-body {
            grid-template-columns: 1fr;
        }
        
        .toolbar {
            justify-content: center;
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
        <button onclick="exportToCSV()" class="btn-action" style="background: #10b981; color: white;">
            <i class="fas fa-file-excel"></i> Export Excel
        </button>
        <button onclick="exportToPDF()" class="btn-action" style="background: #ef4444; color: white;">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
        <select id="filterStatus" onchange="filterBookings()" class="filter-select">
            <option value="all">Semua Status</option>
            <option value="waiting">Menunggu Verifikasi</option>
            <option value="paid">Sudah Diverifikasi</option>
        </select>
    </div>

    <div id="bookingsContainer" class="bookings-grid">
        <div class="empty-state">
            <i class="fas fa-spinner fa-spin"></i> Memuat data...
        </div>
    </div>
</div>

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
            <button onclick="verifyPayment()" class="btn-action" style="background: #10b981; color: white;">
                <i class="fas fa-check-circle"></i> Verifikasi
            </button>
        </div>
    </div>
</div>

<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    let allBookings = [];
    let currentBookingId = null;

    function getStatusText(booking) {
        if (booking.payment_status === 'paid') return 'Sudah Diverifikasi';
        if (booking.payment_status === 'waiting_confirmation') return 'Menunggu Verifikasi';
        return 'Menunggu Pembayaran';
    }

    function getStatusClass(booking) {
        if (booking.payment_status === 'paid') return 'badge-success';
        if (booking.payment_status === 'waiting_confirmation') return 'badge-warning';
        return 'badge-pending';
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
        let filtered = [...allBookings];

        if (filter === 'waiting') {
            filtered = filtered.filter(b => b.payment_status === 'waiting_confirmation');
        } else if (filter === 'paid') {
            filtered = filtered.filter(b => b.payment_status === 'paid');
        }

        const container = document.getElementById('bookingsContainer');
        if (filtered.length === 0) {
            container.innerHTML = '<div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada data yang sesuai</p></div>';
            return;
        }

        container.innerHTML = filtered.map(booking => `
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
                            <i class="fas fa-box"></i> Paket
                        </div>
                        <div class="info-value">${booking.package_name || '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </div>
                        <div class="info-value">${booking.phone || '-'}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar"></i> Tanggal
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
                
                <div class="card-footer">
                    ${booking.payment_status !== 'paid' && booking.payment_proof
                        ? `<button class="btn-icon btn-edit" onclick="updateStatus(${booking.id}, 'paid')" title="Verifikasi">
                            <i class="fas fa-check"></i>
                           </button>`
                        : ''}
                    <button class="btn-icon btn-delete" onclick="deleteBooking(${booking.id})" title="Hapus">
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

    async function updateStatus(id, newStatus) {
        if (!confirm('Verifikasi pendaftaran ini?')) return;
        
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
                alert('✅ Status berhasil diverifikasi!');
                loadBookings();
            } else {
                alert('❌ Gagal: ' + (result.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Gagal update status');
        }
    }

    async function deleteBooking(id) {
        if (!confirm('Yakin ingin menghapus booking ini?')) return;
        
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
                alert('✅ Booking dihapus!');
                loadBookings();
            } else {
                alert('❌ Gagal: ' + (result.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Gagal menghapus');
        }
    }

    function exportToCSV() {
        if (allBookings.length === 0) {
            alert("Tidak ada data untuk diexport!");
            return;
        }

        const headers = ['Kode Booking', 'Nama', 'Paket', 'WhatsApp', 'Tanggal', 'Total', 'Status'];
        const rows = allBookings.map(b => [
            b.booking_code,
            b.customer_name,
            b.package_name,
            b.phone,
            b.booking_date,
            b.total_price,
            getStatusText(b)
        ]);

        const csvContent = [headers, ...rows]
            .map(row => row.map(cell => `"${String(cell).replace(/"/g, '""')}"`).join(','))
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

    // Load data
    loadBookings();
</script>
@endsection