@extends('layouts.admin')

@section('title', 'Kelola Tour Guide')

@section('content')
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>👨‍🏫 Daftar Tour Guide</h3>
        <button class="btn-view" onclick="showAddModal()" style="background: #27ae60;">
            <i class="fas fa-plus"></i> Tambah Guide
        </button>
    </div>
    
    <div id="guidesGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;"></div>
</div>

<div id="guideModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Tambah Guide</h3>
        <form id="guideForm">
            <input type="hidden" id="editIndex">
            <div style="margin-bottom: 15px;">
                <label>Nama Guide</label>
                <input type="text" id="name" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Keahlian</label>
                <input type="text" id="skill" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Foto (URL)</label>
                <input type="text" id="image" class="form-input" placeholder="/images/guide_name.jpg">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-view" style="background: #27ae60;">Simpan</button>
                <button type="button" class="btn-delete" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    let guides = [];
    
    function loadGuides() {
        const stored = localStorage.getItem('guides');
        if (stored) guides = JSON.parse(stored);
        else {
            guides = [
                { name: 'Via', skill: 'Canyoneering Expert', image: '/images/via.jpg' },
                { name: 'Faren', skill: 'Hiking Guide', image: '/images/Faren.jpg' },
                { name: 'Dori', skill: 'Safety & Rescue', image: '/images/Dori.jpeg' },
                { name: 'Lembut', skill: 'Nature Guide', image: '/images/lembut.jpeg' },
                { name: 'Nurmala', skill: 'Camping Specialist', image: '/images/nurmala.jpeg' },
                { name: 'Yaya', skill: 'Eco Tourism', image: '/images/yaya.jpeg' },
                { name: 'Badog', skill: 'Climbing Guide', image: '/images/badhog.jpeg' },
                { name: 'Kucrit', skill: 'Photography Guide', image: '/images/kucrit.jpg' }
            ];
            localStorage.setItem('guides', JSON.stringify(guides));
        }
        displayGuides();
    }
    
    function displayGuides() {
        const grid = document.getElementById('guidesGrid');
        grid.innerHTML = guides.map((g, i) => `
            <div class="guide-card">
                <img src="${g.image}" onerror="this.src='/images/default-avatar.jpg'">
                <h4>${g.name}</h4>
                <p style="color: #666; font-size: 14px;">${g.skill}</p>
                <div style="margin-top: 12px;">
                    <button class="btn-edit" onclick="editGuide(${i})">✏ Edit</button>
                    <button class="btn-delete" onclick="deleteGuide(${i})">🗑 Hapus</button>
                </div>
            </div>
        `).join('');
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Guide';
        document.getElementById('editIndex').value = '';
        document.getElementById('guideForm').reset();
        document.getElementById('guideModal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('guideModal').style.display = 'none';
    }
    
    function editGuide(index) {
        const g = guides[index];
        document.getElementById('modalTitle').innerText = 'Edit Guide';
        document.getElementById('editIndex').value = index;
        document.getElementById('name').value = g.name;
        document.getElementById('skill').value = g.skill;
        document.getElementById('image').value = g.image;
        document.getElementById('guideModal').style.display = 'flex';
    }
    
    function deleteGuide(index) {
        if (confirm('Yakin ingin menghapus guide ini?')) {
            guides.splice(index, 1);
            localStorage.setItem('guides', JSON.stringify(guides));
            loadGuides();
            alert('✅ Guide berhasil dihapus!');
        }
    }
    
    document.getElementById('guideForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const editIndex = document.getElementById('editIndex').value;
        const newGuide = {
            name: document.getElementById('name').value,
            skill: document.getElementById('skill').value,
            image: document.getElementById('image').value || '/images/default-avatar.jpg'
        };
        
        if (editIndex !== '') guides[editIndex] = newGuide;
        else guides.push(newGuide);
        
        localStorage.setItem('guides', JSON.stringify(guides));
        closeModal();
        loadGuides();
        alert('✅ Guide berhasil disimpan!');
    });
    
    loadGuides();
</script>
@endsection