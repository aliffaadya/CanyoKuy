@extends('layouts.admin')

@section('title', 'Kelola Jadwal & Kuota')

@section('content')
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>📅 Jadwal Keberangkatan</h3>
        <button class="btn-view" onclick="showAddModal()" style="background: #27ae60;">
            <i class="fas fa-plus"></i> Buat Jadwal Baru
        </button>
    </div>
    
    <table>
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Lokasi</th><th>Kuota</th><th>Terisi</th><th>Sisa</th><th>Guide</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody id="scheduleTable"></tbody>
    </table>
</div>

<div id="scheduleModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Buat Jadwal Baru</h3>
        <form id="scheduleForm">
            <input type="hidden" id="editIndex">
            <div style="margin-bottom: 15px;">
                <label>Tanggal Keberangkatan</label>
                <input type="date" id="tanggal" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Lokasi</label>
                <select id="lokasi" class="form-input" required>
                    <option value="">Pilih Lokasi</option>
                    <option value="Air Terjun Mandin Damar">Air Terjun Mandin Damar</option>
                    <option value="Curug Cileat">Curug Cileat</option>
                    <option value="Green Canyon">Green Canyon</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Kuota Maksimal</label>
                <input type="number" id="kuota" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Tour Guide</label>
                <select id="guide" class="form-input" required>
                    <option value="">Pilih Guide</option>
                    <option value="Tim A - Budi">Tim A - Budi</option>
                    <option value="Tim B - Siti">Tim B - Siti</option>
                    <option value="Tim C - Andi">Tim C - Andi</option>
                    <option value="Tim D - Via">Tim D - Via</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-view" style="background: #27ae60;">Simpan</button>
                <button type="button" class="btn-delete" onclick="closeModal()">Batal</button>
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
            tbody.innerHTML = '<tr><td colspan="9" style="text-align: center;">Belum ada jadwal</td></tr>';
            return;
        }
        
        tbody.innerHTML = schedules.map((s, i) => {
            const tersisa = s.kuota - (s.terisi || 0);
            const status = tersisa > 0 ? '<span class="status status-paid">Tersedia</span>' : '<span class="status status-pending">Penuh</span>';
            return `
                <tr>
                    <td>${i+1}</td>
                    <td>${formatDate(s.tanggal)}</td>
                    <td>${s.lokasi}</td>
                    <td>${s.kuota}</td>
                    <td>${s.terisi || 0}</td>
                    <td>${tersisa}</td>
                    <td>${s.guide || '-'}</td>
                    <td>${status}</td>
                    <td>
                        <button class="btn-edit" onclick="editSchedule(${i})">✏ Edit</button>
                        <button class="btn-delete" onclick="deleteSchedule(${i})">🗑 Hapus</button>
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
        document.getElementById('lokasi').value = s.lokasi;
        document.getElementById('kuota').value = s.kuota;
        document.getElementById('guide').value = s.guide;
        document.getElementById('scheduleModal').style.display = 'flex';
    }
    
    function deleteSchedule(index) {
        if (confirm('Yakin ingin menghapus jadwal ini?')) {
            schedules.splice(index, 1);
            localStorage.setItem('schedules', JSON.stringify(schedules));
            loadSchedules();
            alert('✅ Jadwal berhasil dihapus!');
        }
    }
    
    document.getElementById('scheduleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const editIndex = document.getElementById('editIndex').value;
        const newSchedule = {
            tanggal: document.getElementById('tanggal').value,
            lokasi: document.getElementById('lokasi').value,
            kuota: parseInt(document.getElementById('kuota').value),
            terisi: 0,
            guide: document.getElementById('guide').value
        };
        
        if (editIndex !== '') schedules[editIndex] = newSchedule;
        else schedules.push(newSchedule);
        
        localStorage.setItem('schedules', JSON.stringify(schedules));
        closeModal();
        loadSchedules();
        alert('✅ Jadwal berhasil disimpan!');
    });
    
    loadSchedules();
</script>
@endsection