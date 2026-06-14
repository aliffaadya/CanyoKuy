@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
<style>
    /* ========== KELOLA TESTIMONI UI STYLES ========== */
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
        max-width: 440px;
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
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-gray);
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
        box-sizing: border-box;
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
    }

    .btn-cancel:hover {
        background: #f8fafc;
        color: var(--text-dark);
    }
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
            <input type="hidden" id="editId">

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
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Load testimoni dari database
    async function loadTestimonials() {
        try {
            const response = await fetch('/api/testimonials');
            const result = await response.json();

            if (result.success) {
                // SORTIR DARI YANG PALING LAMA (ID terkecil/created_at paling lama)
                const sortedData = result.data.sort((a, b) => {
                    return (a.id || 0) - (b.id || 0);
                });
                displayTestimonials(sortedData);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function displayTestimonials(testimonials) {
        const grid = document.getElementById('testimonialsGrid');
        if (!testimonials || testimonials.length === 0) {
            grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--text-gray); padding: 40px 0;">Belum ada data testimoni pelanggan.</div>';
            return;
        }

        grid.innerHTML = testimonials.map((t, i) => `
            <div class="testimonial-card" data-id="${t.id}">
                <div>
                    <div class="card-top">
                        <h4 class="user-name">${escapeHtml(t.name)}</h4>
                        <div class="rating-stars">${'★'.repeat(t.rating)}${'☆'.repeat(5 - t.rating)}</div>
                    </div>
                    <p class="user-city"><i class="fas fa-map-marker-alt" style="color: #ef4444; font-size: 12px;"></i> ${escapeHtml(t.city)}</p>
                    <p class="testimonial-text">"${escapeHtml(t.message)}"</p>
                </div>
                <div class="card-actions">
                    <button class="btn-card btn-card-edit" onclick="editTestimonial(${t.id})"><i class="fas fa-pen"></i> Edit</button>
                    <button class="btn-card btn-card-delete" onclick="deleteTestimonial(${t.id})"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>
        `).join('');
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    function showAddModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Testimoni';
        document.getElementById('editId').value = '';
        document.getElementById('testimonialForm').reset();
        document.getElementById('testimonialModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('testimonialModal').style.display = 'none';
    }

    async function editTestimonial(id) {
        try {
            const response = await fetch('/api/testimonials');
            const result = await response.json();
            const testimonial = result.data.find(t => t.id === id);

            if (testimonial) {
                document.getElementById('modalTitle').innerText = 'Edit Testimoni';
                document.getElementById('editId').value = testimonial.id;
                document.getElementById('name').value = testimonial.name;
                document.getElementById('city').value = testimonial.city;
                document.getElementById('message').value = testimonial.message;
                document.getElementById('rating').value = testimonial.rating;
                document.getElementById('testimonialModal').style.display = 'flex';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal mengambil data testimoni');
        }
    }

    async function deleteTestimonial(id) {
        if (confirm('Yakin ingin menghapus testimoni ini?')) {
            try {
                const response = await fetch(`/api/testimonials/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();
                if (result.success) {
                    alert('✅ Testimoni berhasil dihapus!');
                    loadTestimonials();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menghapus testimoni');
            }
        }
    }

    document.getElementById('testimonialForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const editId = document.getElementById('editId').value;
        const data = {
            name: document.getElementById('name').value,
            city: document.getElementById('city').value,
            message: document.getElementById('message').value,
            rating: parseInt(document.getElementById('rating').value)
        };

        const url = editId ? `/api/testimonials/${editId}` : '/api/testimonials';
        const method = editId ? 'PUT' : 'POST';

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
                alert(editId ? '✅ Testimoni berhasil diupdate!' : '✅ Testimoni berhasil ditambahkan!');
                closeModal();
                loadTestimonials();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal menyimpan testimoni');
        }
    });

    // Load data saat halaman dibuka
    loadTestimonials();
</script>
@endsection