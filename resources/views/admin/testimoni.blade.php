@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
<style>
    /* ========== KELOLA TESTIMONI UI STYLES - EMERALD CONSISTENT ========== */
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

    /* Tombol Utama Banner */
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

    /* ========== DESIGN GRID & CARD TESTIMONI ========== */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .testimonial-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(226, 232, 240, 0.6);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        border-color: rgba(16, 185, 129, 0.2);
    }

    /* Dekorasi Tanda Kutip Estetik */
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 15px;
        right: 24px;
        font-size: 80px;
        color: rgba(16, 185, 129, 0.05);
        font-family: 'Georgia', serif;
        line-height: 1;
        pointer-events: none;
    }

    .card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .user-name {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .rating-stars {
        color: #ffb703;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .user-city {
        color: var(--text-gray);
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
        margin: 0 0 14px 0;
        font-weight: 500;
    }

    .testimonial-text {
        font-size: 14px;
        color: #334155;
        line-height: 1.6;
        margin: 0 0 20px 0;
        font-style: italic;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
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
        width: 100%; max-width: 440px;
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

    textarea.form-control {
        resize: none;
        line-height: 1.5;
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
            <i class="fas fa-star"></i>
        </div>
        <div class="banner-text">
            <h1 class="page-title">Kelola Testimoni</h1>
            <p class="page-subtitle">Ulas umpan balik jujur dan penilaian tingkat kepuasan dari petualang CanyoKuy.</p>
        </div>
    </div>
    <button class="btn-action btn-white" onclick="showAddModal()">
        <i class="fas fa-plus"></i> Tambah Testimoni
    </button>
</div>

<div class="content-container">
    <div id="testimonialsGrid" class="testimonials-grid"></div>
</div>

<div id="testimonialModal" class="modal-overlay">
    <div class="modal-box">
        <h3 id="modalTitle" class="modal-title">Tambah Testimoni</h3>
        <form id="testimonialForm">
            <input type="hidden" id="editIndex">
            
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" id="name" class="form-control" placeholder="Masukkan nama pelanggan" required>
            </div>
            
            <div class="form-group">
                <label>Asal Kota</label>
                <input type="text" id="city" class="form-control" placeholder="Contoh: Banjarmasin" required>
            </div>
            
            <div class="form-group">
                <label>Isi Testimoni</label>
                <textarea id="message" rows="3" class="form-control" placeholder="Tulis komentar ulasan petualangan di sini..." required></textarea>
            </div>
            
            <div class="form-group">
                <label>Skor Rating Kepuasan</label>
                <select id="rating" class="form-control" style="cursor: pointer;">
                    <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                    <option value="4">⭐⭐⭐⭐ (4 - Puas)</option>
                    <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                    <option value="2">⭐⭐ (2 - Kurang)</option>
                    <option value="1">⭐ (1 - Buruk)</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-action" style="background-color: var(--primary-green); color: white; padding: 10px 20px; border-radius: 10px;">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    // LOGIKA ASLI TEMAN KAMU DIJAMIN TETAP UTUH & BEKERJA NORMAL
    let testimonials = [];
    
    function loadTestimonials() {
        const stored = localStorage.getItem('testimonials');
        if (stored) testimonials = JSON.parse(stored);
        else {
            testimonials = [
                { name: 'Putri', city: 'Marabahan', message: 'Pengalaman canyoneering yang luar biasa! Guide profesional dan ramah.', rating: 5 },
                { name: 'Siti', city: 'Batu Licin', message: 'Pelayanan sangat memuaskan. Tim cepat merespon.', rating: 5 },
                { name: 'Ryan', city: 'Banjarbaru', message: 'Salah satu pengalaman outdoor terbaik yang pernah saya coba.', rating: 5 },
                { name: 'Rahman', city: 'Banjarmasin', message: 'Recommended untuk pecinta alam dan tantangan!', rating: 5 }
            ];
            localStorage.setItem('testimonials', JSON.stringify(testimonials));
        }
        displayTestimonials();
    }
    
    // MODIFIKASI: Hanya meremajakan struktur HTML agar menghasilkan review card modern
    function displayTestimonials() {
        const grid = document.getElementById('testimonialsGrid');
        if (testimonials.length === 0) {
            grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--text-gray); padding: 40px 0;">Belum ada data testimoni pelanggan.</div>';
            return;
        }
        
        grid.innerHTML = testimonials.map((t, i) => `
            <div class="testimonial-card">
                <div>
                    <div class="card-top">
                        <h4 class="user-name">${t.name}</h4>
                        <div class="rating-stars">${'★'.repeat(t.rating)}${'☆'.repeat(5 - t.rating)}</div>
                    </div>
                    <p class="user-city"><i class="fas fa-map-marker-alt" style="color: #ef4444; font-size: 12px;"></i> ${t.city}</p>
                    <p class="testimonial-text">"${t.message}"</p>
                </div>
                <div class="card-actions">
                    <button class="btn-card btn-card-edit" onclick="editTestimonial(${i})"><i class="fas fa-pen"></i> Edit</button>
                    <button class="btn-card btn-card-delete" onclick="deleteTestimonial(${i})"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
        `).join('');
    }
    
    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Testimoni';
        document.getElementById('editIndex').value = '';
        document.getElementById('testimonialForm').reset();
        document.getElementById('testimonialModal').style.display = 'flex';
    }
    
    function closeModal() {
        document.getElementById('testimonialModal').style.display = 'none';
    }
    
    function editTestimonial(index) {
        const t = testimonials[index];
        document.getElementById('modalTitle').innerText = 'Edit Testimoni';
        document.getElementById('editIndex').value = index;
        document.getElementById('name').value = t.name;
        document.getElementById('city').value = t.city;
        document.getElementById('message').value = t.message;
        document.getElementById('rating').value = t.rating;
        document.getElementById('testimonialModal').style.display = 'flex';
    }
    
    function deleteTestimonial(index) {
        if (confirm('Yakin ingin menghapus testimoni ini?')) {
            testimonials.splice(index, 1);
            localStorage.setItem('testimonials', JSON.stringify(testimonials));
            loadTestimonials();
            alert('✅ Testimoni berhasil dihapus!');
        }
    }
    
    document.getElementById('testimonialForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const editIndex = document.getElementById('editIndex').value;
        const newTestimonial = {
            name: document.getElementById('name').value,
            city: document.getElementById('city').value,
            message: document.getElementById('message').value,
            rating: parseInt(document.getElementById('rating').value)
        };
        
        if (editIndex !== '') testimonials[editIndex] = newTestimonial;
        else testimonials.push(newTestimonial);
        
        localStorage.setItem('testimonials', JSON.stringify(testimonials));
        closeModal();
        loadTestimonials();
        alert('✅ Testimoni berhasil disimpan!');
    });
    
    loadTestimonials();
</script>
@endsection