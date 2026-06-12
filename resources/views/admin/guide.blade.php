@extends('layouts.admin')

@section('title', 'Kelola Tour Guide')

@section('content')
<style>
    /* ========== KELOLA GUIDE UI STYLES - KONSISTEN EMERALD ========== */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700;800&display=swap');

    :root {
        --primary-green: #10b981; /* Hijau Emerald Segar */
        --banner-green: #059669;  /* Hijau Dark Emerald */
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

    /* Tombol Aksi */
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

    /* ========== DESIGN CARD GUIDE MODERN ========== */
    .guides-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .guide-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(226, 232, 240, 0.6);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .guide-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        border-color: rgba(16, 185, 129, 0.2);
    }

    .guide-card img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 16px;
        border: 3px solid #f1f5f9;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: border-color 0.3s ease;
    }

    .guide-card:hover img {
        border-color: var(--primary-green);
    }

    .guide-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 6px 0;
    }

    .guide-skill-badge {
        font-size: 12px;
        font-weight: 500;
        color: var(--banner-green);
        background: #e6fbf3;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 18px;
        display: inline-block;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        width: 100%;
        margin-top: auto;
    }

    .btn-card {
        flex: 1;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-card-edit {
        background: #f0fdf4;
        color: #16a34a;
    }

    .btn-card-edit:hover {
        background: #16a34a;
        color: white;
    }

    .btn-card-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-card-delete:hover {
        background: #dc2626;
        color: white;
    }

    /* ========== MODAL FORM STYLING ========== */
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

    /* Style khusus input file biar rapi */
    input[type="file"].form-control {
        padding: 8px 12px;
        cursor: pointer;
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
            <i class="fas fa-map-signs"></i>
        </div>
        <div class="banner-text">
            <h1 class="page-title">Kelola Tour Guide</h1>
            <p class="page-subtitle">Manajemen tour guide profesional CanyoKuy.</p>
        </div>
    </div>
    <button class="btn-action btn-white" onclick="showAddModal()">
        <i class="fas fa-plus"></i> Tambah Guide
    </button>
</div>

<div class="content-container">
    <div id="guidesGrid" class="guides-grid"></div>
</div>

<div id="guideModal" class="modal-overlay">
    <div class="modal-box">
        <h3 id="modalTitle" class="modal-title">Tambah Guide</h3>
        <form id="guideForm">
            <input type="hidden" id="editIndex">
            
            <div class="form-group">
                <label>Nama Lengkap Guide</label>
                <input type="text" id="name" class="form-control" placeholder="Masukkan nama guide" required>
            </div>
            
            <div class="form-group">
                <label>Keahlian Spesifik</label>
                <input type="text" id="skill" class="form-control" placeholder="Contoh: Canyoneering Expert" required>
            </div>
            
            <div class="form-group">
                <label>Upload Foto Profile</label>
                <input type="file" id="imageFile" class="form-control" accept="image/*">
                <small style="color: var(--text-gray); font-size: 12px; display: block; margin-top: 6px;">
                    Format file harus gambar (.jpg, .jpeg, .png)
                </small>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-action" style="background-color: var(--primary-green); color: white; padding: 10px 20px; border-radius: 10px;">Simpan Data</button>
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
                <span class="guide-skill-badge"><i class="fas fa-award" style="margin-right: 4px;"></i>${g.skill}</span>
                <div class="card-actions">
                    <button class="btn-card btn-card-edit" onclick="editGuide(${i})"><i class="fas fa-pen"></i> Edit</button>
                    <button class="btn-card btn-card-delete" onclick="deleteGuide(${i})"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
        `).join('');
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Guide';
        document.getElementById('editIndex').value = '';
        document.getElementById('guideForm').reset();
        document.getElementById('imageFile').value = ''; // Reset pilihan file
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
        document.getElementById('imageFile').value = ''; // Reset pilihan file lama saat edit terbuka
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
    
    // Fungsi pembantu untuk mengubah objek file mentah dari input menjadi string Base64
    function convertFileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }
    
    // PENYESUAIAN LOGIKA: Handler submit diubah menjadi Async agar bisa menunggu konversi file gambar
    document.getElementById('guideForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const editIndex = document.getElementById('editIndex').value;
        const fileInput = document.getElementById('imageFile');
        
        // Atur gambar default awal
        let finalImageUrl = '/images/default-avatar.jpg';
        
        // Jika sedang mengedit data lama, ambil data gambar lamanya terlebih dahulu
        if (editIndex !== '') {
            finalImageUrl = guides[editIndex].image;
        }
        
        // Jika admin meng-upload file gambar baru, konversi ke Base64
        if (fileInput.files && fileInput.files[0]) {
            try {
                finalImageUrl = await convertFileToBase64(fileInput.files[0]);
            } catch (error) {
                alert('❌ Gagal memproses file gambar. Silakan coba lagi.');
                return;
            }
        }
        
        const newGuide = {
            name: document.getElementById('name').value,
            skill: document.getElementById('skill').value,
            image: finalImageUrl
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