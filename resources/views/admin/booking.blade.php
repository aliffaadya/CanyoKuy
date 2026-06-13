@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
<style>
    /* ========== KELOLA BOOKING UI STYLES ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --primary-green: #10b981;
        --banner-green: #059669;
        --bg-color: #f8fafc;
        --text-dark: #0f172a;
        --text-gray: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    body,
    .content-wrapper,
    .main-content {
        background-color: var(--bg-color) !important;
        font-family: 'Inter', sans-serif;
    }

    .green-banner-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 16px;
        padding: 28px 32px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        margin-top: 20px;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        position: relative;
        overflow: hidden;
    }

    .green-banner-header::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        bottom: -70px;
        right: -40px;
        pointer-events: none;
    }

    .banner-left {
        display: flex;
        align-items: center;
        gap: 20px;
        z-index: 2;
    }

    .banner-icon {
        background: rgba(255, 255, 255, 0.2);
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: #ffffff;
        backdrop-filter: blur(4px);
    }

    .banner-text {
        display: flex;
        flex-direction: column;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
        margin: 4px 0 0 0;
        font-weight: 400;
    }

    .filter-select {
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
    }

    .filter-select:hover {
        border-color: #10b981;
    }

    .table-container {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .data-table th {
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px;
        border-bottom: 2px solid #f1f5f9;
    }

    .data-table td {
        padding: 16px;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .data-table tr:hover td {
        background-color: #f8fafc;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-align: center;
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

    .btn-action {
        padding: 8px 16px;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
    }

    .btn-proof {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-proof:hover {
        background: #0284c7;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 13px;
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

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.4);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(4px);
    }

    .modal-box {
        background: var(--card-bg);
        border-radius: 20px;
        width: 100%;
        max-width: 500px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        transform: translateY(-20px);
        animation: modalFadeIn 0.3s forwards ease-out;
    }

    @keyframes modalFadeIn {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-top: 0;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        justify-content: flex-end;
    }

    .btn-cancel {
        background: white;
        color: var(--text-gray);
        border: 1px solid var(--border-color);
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        color: var(--text-dark);
    }
</style>

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

<div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-bottom: 16px;">
    <button onclick="exportToCSV()" class="btn-action" style="background: #ffffff; color: #10b981; border: 1px solid #10b981; padding: 10px 16px;">
        <i class="fas fa-file-excel"></i> Export Excel
    </button>

    <button onclick="exportToPDF()" class="btn-action" style="background: #ffffff; color: #ef4444; border: 1px solid #ef4444; padding: 10px 16px;">
        <i class="fas fa-file-pdf"></i> Export PDF
    </button>

    <select id="filterStatus" onchange="filterBookings()" class="filter-select">
        <option value="all">Semua Status</option>
        <option value="waiting">Menunggu Verifikasi</option>
        <option value="paid">Sudah Diverifikasi</option>
    </select>
</div>

<div class="table-container">
    <table class="data-table">
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
        <tbody id="bookingsTable"></tbody>
    </table>
</div>

<div id="proofModal" class="modal-overlay">
    <div class="modal-box">
        <h3 class="modal-title"><i class="fas fa-file-invoice-dollar" style="color: #10b981;"></i> Bukti Transfer</h3>
        <div style="background: #f8fafc; padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center;">
            <img id="proofImage" style="max-width: 100%; max-height: 400px; border-radius: 8px; object-fit: contain;">
        </div>
        <div class="modal-actions">
            <button onclick="closeModal()" class="btn-cancel">Tutup</button>
            <button onclick="verifyPayment()" class="btn-action" style="background-color: #10b981; color: white; padding: 10px 20px;">
                <i class="fas fa-check-circle"></i> Verifikasi Pendaftaran
            </button>
        </div>
    </div>
</div>

<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    let allBookings = [];
    let currentBookingId = null;

    // Fungsi untuk mendapatkan teks status
    function getStatusText(booking) {
        if (booking.payment_status === 'paid') return 'Sudah Diverifikasi';
        if (booking.payment_status === 'waiting_confirmation') return 'Menunggu Verifikasi';
        return '🕐 Menunggu Pembayaran';
    }

    // Fungsi untuk mendapatkan class status
    function getStatusClass(booking) {
        if (booking.payment_status === 'paid') return 'badge-success';
        if (booking.payment_status === 'waiting_confirmation') return 'badge-warning';
        return 'badge-pending';
    }

    // Load data dari DATABASE via API
    async function loadBookings() {
        try {
            const response = await fetch('/api/bookings');
            const result = await response.json();

            if (result.success) {
                allBookings = result.data;
                filterBookings();
            } else {
                console.error('Gagal load data:', result.message);
                allBookings = [];
                filterBookings();
            }
        } catch (error) {
            console.error('Error:', error);
            allBookings = [];
            filterBookings();
        }
    }

    function filterBookings() {
        const filter = document.getElementById('filterStatus').value;
        let filtered = [...allBookings];

        if (filter === 'pending') {
            filtered = filtered.filter(b => b.payment_status === 'pending');
        } else if (filter === 'waiting') {
            filtered = filtered.filter(b => b.payment_status === 'waiting_confirmation');
        } else if (filter === 'paid') {
            filtered = filtered.filter(b => b.payment_status === 'paid');
        }

        const tbody = document.getElementById('bookingsTable');
        if (filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; color: var(--text-gray); padding: 30px;">Tidak ada data booking yang sesuai dengan filter.</td><tr>';
            return;
        }

        tbody.innerHTML = filtered.map((booking) => {
            const statusText = getStatusText(booking);
            const statusClass = getStatusClass(booking);

            return `
                <tr>
                    <td><strong>${booking.booking_code || '-'}</strong></td>
                    <td>${booking.customer_name || '-'}</td>
                    <td>${booking.package_name || '-'}</td>
                    <td>${booking.phone || '-'}</td>
                    <td>${booking.booking_date || '-'}</td>
                    <td><strong>Rp ${(booking.total_price || 0).toLocaleString('id-ID')}</strong></td>
                    <td><span class="badge ${statusClass}">${statusText}</span></td>
                    <td>
                        ${booking.payment_proof 
                            ? `<button class="btn-action btn-proof" onclick="viewProof('${booking.payment_proof}', ${booking.id})"><i class="fas fa-image"></i> Cek</button>` 
                            : '<span style="color:var(--text-gray); font-size: 13px;">Belum upload</span>'}
                    </td>
                    <td>
                        <div class="action-buttons">
                            ${booking.payment_status !== 'paid' 
                                ? `<button class="btn-icon btn-edit" onclick="updateStatus(${booking.id}, 'paid')" title="Verifikasi Pendaftaran"><i class="fas fa-check"></i></button>`
                                : ''}
                            <button class="btn-icon btn-delete" onclick="deleteBooking(${booking.id})" title="Hapus"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    function viewProof(proofUrl, id) {
        currentBookingId = id;
        document.getElementById('proofImage').src = proofUrl;
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
        if (confirm('Verifikasi pendaftaran ini?')) {
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
                    alert('✅ Status pendaftaran berhasil diverifikasi!');
                    loadBookings();
                } else {
                    alert('❌ Gagal update status: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Gagal update status');
            }
        }
    }

    async function deleteBooking(id) {
        if (confirm('Yakin ingin menghapus data booking ini secara permanen?')) {
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
                    alert('✅ Booking berhasil dihapus!');
                    loadBookings();
                } else {
                    alert('❌ Gagal menghapus: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Gagal menghapus booking');
            }
        }
    }

    function exportToCSV() {
        if (allBookings.length === 0) {
            alert("Tidak ada data untuk diexport!");
            return;
        }

        let csvContent = "Kode Booking,Nama,Paket,WhatsApp,Tanggal,Total,Status\n";

        allBookings.forEach(b => {
            let status = b.payment_status === 'paid' ? 'Sudah Diverifikasi' : (b.payment_status === 'waiting_confirmation' ? 'Menunggu Verifikasi' : 'Menunggu Pembayaran');
            let row = `"${b.booking_code}","${b.customer_name}","${b.package_name}","${b.phone}","${b.booking_date}","${b.total_price}","${status}"`;
            csvContent += row + "\n";
        });

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);

        link.setAttribute("href", url);
        link.setAttribute("download", "Data_Booking_CanyoKuy.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportToPDF() {
        alert("Fitur PDF akan segera hadir. Silakan gunakan print browser (Ctrl+P)");
    }

    // Load data saat halaman dibuka
    loadBookings();
</script>
@endsection