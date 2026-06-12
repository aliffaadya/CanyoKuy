@extends('layouts.admin')

@section('title', 'Kelola Jadwal & Kuota')

@section('content')
<style>
    /* ========== KELOLA JADWAL UI STYLES - PERBAIKAN WARNA KONSISTEN ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        /* REVISI WARNA: Menggunakan Hijau Emerald/Mint Khas Admin Panel CanyoKuy */
        --primary-green: #10b981; /* Hijau utama yang segar */
        --banner-green: #059669;  /* Hijau gelap untuk gradasi/hover */
        --bg-color: #f8fafc;
        --text-dark: #0f172a;
        --text-gray: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    body, .content-wrapper, .main-content {
        background-color: var(--bg-color) !important;
        font-family: 'Inter', sans-serif;
    }

    /* ========== GREEN BANNER HEADER ========== */
    .green-banner-header {
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--banner-green) 100%);
        border-radius: 16px;
        padding: 28px 32px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        margin-top: 20px;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        position: relative;
        overflow: hidden;
    }

    /* Efek lingkaran estetik transparan */
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

    /* Tombol Putih Kontras */
    .btn-action {
        padding: 12px 20px;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .btn-white {
        background-color: #ffffff;
        color: var(--banner-green);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .btn-white:hover {
        background-color: #f8fafc;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    /* Tabel Styling */
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
        min-width: 800px;
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

    .data-table tr:hover td { background-color: #f8fafc; }
    .data-table tr:last-child td { border-bottom: none; }

    /* Badges & Buttons */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-align: center;
    }

    .badge-success { background: #d1fae5; color: #065f46; }
    .badge-danger { background: #fee2e2; color: #991b1b; }

    .action-buttons { display: flex; gap: 8px; }

    .btn-icon {
        width: 34px; height: 34px;
        border-radius: 10px; border: none;
        display: flex; justify-content: center; align-items: center;
        cursor: pointer; transition: all 0.2s ease; font-size: 13px;
    }

    .btn-edit { background: #f0fdf4; color: #16a34a; }
    .btn-edit:hover { background: #16a34a; color: white; }
    
    .btn-delete { background: #fef2f2; color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: white; }

    /* Modal Styling */
    .modal-overlay {
        display: none;
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.4);
        z-index: 1000;
        justify-content: center; align-items: center;
        backdrop-filter: blur(4px);
    }

    .modal-box {
        background: var(--card-bg);
        border-radius: 20px;
        width: 100%; max-width: 420px;
        padding: 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        transform: translateY(-20px);
        animation: modalFadeIn 0.3s forwards ease-out;
    }

    @keyframes modalFadeIn {
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-title {
        font-size: 20px; font-weight: 700; color: var(--text-dark);
        margin-top: 0; margin-bottom: 20px;
    }

    .form-group { margin-bottom: 18px; }
    
    .form-group label {
        display: block; font-size: 13px; font-weight: 600;
        color: var(--text-gray); margin-bottom: 8px;
    }

    .form-control {
        width: 100%; padding: 12px 16px;
        border: 1px solid var(--border-color); border-radius: 10px;
        font-family: 'Inter', sans-serif; font-size: 14px;
        outline: none; transition: all 0.3s ease; box-sizing: border-box;
    }

    .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .modal-actions {
        display: flex; gap: 12px; margin-top: 24px; justify-content: flex-end;
    }

    .btn-cancel {
        background: white; color: var(--text-gray); border: 1px solid var(--border-color);
        padding: 10px 20px; border-radius: 10px; font-weight: 600; cursor: pointer;
    }
    
    .btn-cancel:hover { background: #f8fafc; color: var(--text-dark); }
</style>

<div class="green-banner-header">
    <div class="banner-left">
        <div class="banner-icon">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="banner-text">
            <h1 class="page-title">Kelola Jadwal & Kuota</h1>
            <p class="page-subtitle">Atur tanggal kegiatan dan pantau sisa kuota secara real-time dengan mudah.</p>
        </div>
    </div>
    <button class="btn-action btn-white" onclick="showAddModal()">
        <i class="fas fa-plus"></i> Buat Jadwal Baru
    </button>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kuota Awal</th>
                <th>Terisi</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="scheduleTable">
            </tbody>
    </table>
</div>

<div id="scheduleModal" class="modal-overlay">
    <div class="modal-box">
        <h3 id="modalTitle" class="modal-title">Buat Jadwal Baru</h3>
        <form id="scheduleForm">
            <input type="hidden" id="editIndex">
            
            <div class="form-group">
                <label>Tanggal Kegiatan</label>
                <input type="date" id="tanggal" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Kuota Maksimal</label>
                <input type="number" id="kuota" class="form-control" placeholder="Contoh: 20" required min="1">
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-action" style="background-color: var(--primary-green); color: white;">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>

<script>
    let schedules = [];
    
    function loadSchedules() {
        const stored = localStorage.getItem('schedules');
        schedules = stored ? JSON.parse(stored) : [];
        displaySchedules();
    }
    
    function displaySchedules() {
        const tbody = document.getElementById('scheduleTable');
        if (schedules.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; color: var(--text-gray); padding: 30px;">Belum ada jadwal keberangkatan. Silakan buat jadwal baru.</td></tr>';
            return;
        }
        
        tbody.innerHTML = schedules.map((s, i) => {
            const terisi = s.terisi || 0;
            const tersisa = s.kuota - terisi;
            const status = tersisa > 0 ? '<span class="badge badge-success">Tersedia</span>' : '<span class="badge badge-danger">Penuh</span>';
            
            return `
                <tr>
                    <td><strong>${i + 1}</strong></td>
                    <td>${formatDate(s.tanggal)}</td>
                    <td>${s.kuota} Orang</td>
                    <td>${terisi} Orang</td>
                    <td><strong>${tersisa} Orang</strong></td>
                    <td>${status}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon btn-edit" onclick="editSchedule(${i})" title="Edit"><i class="fas fa-pen"></i></button>
                            <button class="btn-icon btn-delete" onclick="deleteSchedule(${i})" title="Hapus"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }
    
    function formatDate(dateStr) {
        return new Date(dateStr).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Buat Jadwal Baru';
        document.getElementById('editIndex').value = '';
        document.getElementById('scheduleForm').reset();
        document.getElementById('scheduleModal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('scheduleModal').style.display = 'none';
    }
    
    function editSchedule(index) {
        const s = schedules[index];
        document.getElementById('modalTitle').innerText = 'Edit Jadwal';
        document.getElementById('editIndex').value = index;
        document.getElementById('tanggal').value = s.tanggal;
        document.getElementById('kuota').value = s.kuota;
        document.getElementById('scheduleModal').style.display = 'flex';
    }
    
    function deleteSchedule(index) {
        if (confirm('Yakin ingin menghapus jadwal ini?')) {
            schedules.splice(index, 1);
            localStorage.setItem('schedules', JSON.stringify(schedules));
            loadSchedules();
            alert('Jadwal berhasil dihapus!');
        }
    }
    
    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const editIndex = document.getElementById('editIndex').value;
        
        const oldTerisi = editIndex !== '' ? (schedules[editIndex].terisi || 0) : 0;

        const newSchedule = {
            tanggal: document.getElementById('tanggal').value,
            kuota: parseInt(document.getElementById('kuota').value),
            terisi: oldTerisi
        };
        
        if (editIndex !== '') {
            schedules[editIndex] = newSchedule;
        } else {
            schedules.push(newSchedule);
        }
        
        localStorage.setItem('schedules', JSON.stringify(schedules));
        closeModal();
        loadSchedules();
    });
    
    loadSchedules();
</script>
@endsection