@extends('layouts.admin')

@section('title', 'Kelola Jadwal & Kuota')

@section('content')
<style>
    :root {
        --primary-green: #10b981;
        --banner-green: #059669;
        --bg-color: #f8fafc;
        --text-dark: #0f172a;
        --text-gray: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

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
    }

    .banner-left { display: flex; align-items: center; gap: 20px; }
    .banner-icon {
        background: rgba(255,255,255,0.2);
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .page-title { font-size: 24px; font-weight: 700; margin: 0; }
    .page-subtitle { font-size: 14px; opacity: 0.85; margin: 4px 0 0 0; }

    .btn-action {
        padding: 12px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-white { background-color: white; color: var(--banner-green); }

    .table-container {
        background: white;
        border-radius: 16px;
        padding: 24px;
        overflow-x: auto;
    }
    .data-table { width: 100%; border-collapse: collapse; min-width: 600px; }
    .data-table th { text-align: left; font-size: 13px; font-weight: 600; color: #64748b; padding: 16px; border-bottom: 2px solid #f1f5f9; }
    .data-table td { padding: 16px; font-size: 14px; border-bottom: 1px solid #f1f5f9; }

    .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
    .badge-success { background: #d1fae5; color: #065f46; }
    .badge-danger { background: #fee2e2; color: #991b1b; }

    .action-buttons { display: flex; gap: 8px; }
    .btn-icon { width: 34px; height: 34px; border-radius: 10px; border: none; cursor: pointer; }
    .btn-edit { background: #f0fdf4; color: #16a34a; }
    .btn-delete { background: #fef2f2; color: #dc2626; }

    .modal-overlay { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000; justify-content: center; align-items: center; }
    .modal-box { background: white; border-radius: 20px; width: 100%; max-width: 420px; padding: 30px; }
    .modal-title { font-size: 20px; font-weight: 700; margin-bottom: 20px; }
    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; }
    .modal-actions { display: flex; gap: 12px; margin-top: 24px; justify-content: flex-end; }
    .btn-cancel { background: white; border: 1px solid #e2e8f0; padding: 10px 20px; border-radius: 10px; cursor: pointer; }
</style>

<div class="green-banner-header">
    <div class="banner-left">
        <div class="banner-icon"><i class="fas fa-calendar-alt"></i></div>
        <div class="banner-text">
            <h1 class="page-title">Kelola Jadwal & Kuota</h1>
            <p class="page-subtitle">Atur tanggal kegiatan dan pantau sisa kuota secara real-time.</p>
        </div>
    </div>
    <button class="btn-action btn-white" onclick="showAddModal()">
        <i class="fas fa-plus"></i> Buat Jadwal Baru
    </button>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Kuota</th><th>Terisi</th><th>Sisa</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody id="scheduleTable"></tbody>
    </table>
</div>

<div id="scheduleModal" class="modal-overlay">
    <div class="modal-box">
        <h3 id="modalTitle" class="modal-title">Buat Jadwal Baru</h3>
        <form id="scheduleForm">
            <input type="hidden" id="editId">
            <div class="form-group">
                <label>Tanggal Kegiatan</label>
                <input type="date" id="schedule_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kuota Maksimal</label>
                <input type="number" id="quota" class="form-control" placeholder="Contoh: 20" required min="1">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-action" style="background-color: var(--primary-green); color: white;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
    
    // Data dari controller (Laravel) - LANGSUNG, bukan dari API
    const schedulesFromServer = @json($schedules ?? []);
    
    function displaySchedules(schedules) {
        const tbody = document.getElementById('scheduleTable');
        
        if (!schedules || schedules.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; padding: 30px;">Belum ada jadwal. Silakan buat jadwal baru.';
            return;
        }
        
        tbody.innerHTML = schedules.map((s, i) => {
            const tersisa = s.quota - (s.filled || 0);
            const status = tersisa > 0 ? '<span class="badge badge-success">Tersedia</span>' : '<span class="badge badge-danger">Penuh</span>';
            return `
                <tr>
                    <td>${i + 1}</td>
                    <td>${formatDate(s.schedule_date)}</td>
                    <td>${s.quota} Orang</td>
                    <td>${s.filled || 0} Orang</td>
                    <td><strong>${tersisa} Orang</strong></td>
                    <td>${status}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon btn-edit" onclick="editSchedule(${s.id})"><i class="fas fa-pen"></i></button>
                            <button class="btn-icon btn-delete" onclick="deleteSchedule(${s.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }
    
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Buat Jadwal Baru';
        document.getElementById('editId').value = '';
        document.getElementById('scheduleForm').reset();
        document.getElementById('scheduleModal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('scheduleModal').style.display = 'none';
    }
    
    async function editSchedule(id) {
        try {
            const response = await fetch('/api/schedules');
            const result = await response.json();
            const schedule = result.data.find(s => s.id === id);
            
            if (schedule) {
                document.getElementById('modalTitle').innerText = 'Edit Jadwal';
                document.getElementById('editId').value = id;
                document.getElementById('schedule_date').value = schedule.schedule_date;
                document.getElementById('quota').value = schedule.quota;
                document.getElementById('scheduleModal').style.display = 'flex';
            }
        } catch (error) {
            alert('Gagal mengambil data');
        }
    }
    
    async function deleteSchedule(id) {
        if (confirm('Yakin ingin menghapus jadwal ini?')) {
            try {
                const response = await fetch(`/api/schedules/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });
                const result = await response.json();
                
                if (result.success) {
                    alert('✅ Jadwal berhasil dihapus!');
                    location.reload();
                } else {
                    alert('❌ Gagal menghapus');
                }
            } catch (error) {
                alert('❌ Gagal menghapus jadwal');
            }
        }
    }
    
    document.getElementById('scheduleForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const id = document.getElementById('editId').value;
        const schedule_date = document.getElementById('schedule_date').value;
        const quota = document.getElementById('quota').value;
        
        const submitBtn = document.querySelector('#scheduleForm button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;
        
        const data = { schedule_date: schedule_date, quota: parseInt(quota) };
        const url = id ? `/api/schedules/${id}` : '/api/schedules';
        const method = id ? 'PUT' : 'POST';
        
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            
            if (result.success) {
                alert(id ? '✅ Jadwal berhasil diupdate!' : '✅ Jadwal berhasil ditambahkan!');
                closeModal();
                location.reload();
            } else {
                alert('❌ Gagal menyimpan: ' + (result.message || 'Terjadi kesalahan'));
            }
        } catch (error) {
            alert('❌ Gagal menyimpan jadwal');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
    
    // Tampilkan data dari server
    displaySchedules(schedulesFromServer);
</script>
@endsection