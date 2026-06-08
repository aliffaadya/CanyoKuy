@extends('layouts.admin')

@section('title', 'Jadwal Kegiatan')

@section('content')
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>📅 Jadwal Kegiatan</h3>
        <button class="btn-view" onclick="showAddModal()" style="background: #27ae60;">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tersisa</th>
                <th>Guide</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="scheduleTable">
            <tr>
                <td colspan="8" style="text-align: center;">Loading...</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Tambah/Edit Jadwal -->
<div id="scheduleModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Tambah Jadwal</h3>
        <form id="scheduleForm">
            <input type="hidden" id="editIndex">
            <div style="margin-bottom: 15px;">
                <label>Tanggal</label>
                <input type="date" id="tanggal" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Lokasi</label>
                <select id="lokasi" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                    <option value="">Pilih Lokasi</option>
                    <option value="Air Terjun Mandin Damar">Air Terjun Mandin Damar</option>
                    <option value="Curug Cileat">Curug Cileat</option>
                    <option value="Green Canyon">Green Canyon</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Kuota</label>
                <input type="number" id="kuota" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Guide</label>
                <select id="guide" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;" required>
                    <option value="">Pilih Guide</option>
                    <option value="Tim A - Budi">Tim A - Budi</option>
                    <option value="Tim B - Siti">Tim B - Siti</option>
                    <option value="Tim C - Andi">Tim C - Andi</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-view" style="background: #27ae60;">Simpan</button>
                <button type="button" class="btn-delete" onclick="closeScheduleModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    let schedules = [];
    
    function loadSchedules() {
        const stored = localStorage.getItem('schedules');
        if (stored) {
            schedules = JSON.parse(stored);
        } else {
            schedules = [
                { tanggal: '2026-06-15', lokasi: 'Air Terjun Mandin Damar', kuota: 20, terisi: 5, guide: 'Tim A - Budi' },
                { tanggal: '2026-06-20', lokasi: 'Curug Cileat', kuota: 15, terisi: 3, guide: 'Tim B - Siti' },
                { tanggal: '2026-06-25', lokasi: 'Green Canyon', kuota: 25, terisi: 8, guide: 'Tim C - Andi' }
            ];
            localStorage.setItem('schedules', JSON.stringify(schedules));
        }
        displaySchedules();
    }
    
    function displaySchedules() {
        const tbody = document.getElementById('scheduleTable');
        
        if (schedules.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align: center;">Belum ada jadwal</td></tr>';
            return;
        }
        
        tbody.innerHTML = schedules.map((schedule, index) => {
            const tersisa = schedule.kuota - (schedule.terisi || 0);
            const status = tersisa > 0 ? '<span class="status status-paid">Tersedia</span>' : '<span class="status status-pending">Penuh</span>';
            
            return `
                <tr>
                    <td>${index + 1}</td>
                    <td>${formatDate(schedule.tanggal)}</td>
                    <td>${schedule.lokasi}</td>
                    <td>${schedule.kuota} orang</td>
                    <td>${tersisa} orang</td>
                    <td>${schedule.guide}</td>
                    <td>${status}</td>
                    <td>
                        <button class="btn-edit" onclick="editSchedule(${index})">✏ Edit</button>
                        <button class="btn-delete" onclick="deleteSchedule(${index})">🗑 Hapus</button>
                    </td>
                </tr>
            `;
        }).join('');
    }
    
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Jadwal';
        document.getElementById('editIndex').value = '';
        document.getElementById('scheduleForm').reset();
        document.getElementById('scheduleModal').style.display = 'flex';
    }
    
    function closeScheduleModal() {
        document.getElementById('scheduleModal').style.display = 'none';
    }
    
    function editSchedule(index) {
        const schedule = schedules[index];
        document.getElementById('modalTitle').innerText = 'Edit Jadwal';
        document.getElementById('editIndex').value = index;
        document.getElementById('tanggal').value = schedule.tanggal;
        document.getElementById('lokasi').value = schedule.lokasi;
        document.getElementById('kuota').value = schedule.kuota;
        document.getElementById('guide').value = schedule.guide;
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
        
        if (editIndex !== '') {
            schedules[editIndex] = newSchedule;
        } else {
            schedules.push(newSchedule);
        }
        
        localStorage.setItem('schedules', JSON.stringify(schedules));
        closeScheduleModal();
        loadSchedules();
        alert('✅ Jadwal berhasil disimpan!');
    });
    
    loadSchedules();
</script>
@endsection