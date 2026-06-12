@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>⭐ Kelola Testimoni</h3>
        <button class="btn-view" onclick="showAddModal()" style="background: #27ae60;">
            <i class="fas fa-plus"></i> Tambah Testimoni
        </button>
    </div>
    
    <div id="testimonialsGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px;"></div>
</div>

<div id="testimonialModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Tambah Testimoni</h3>
        <form id="testimonialForm">
            <input type="hidden" id="editIndex">
            <div style="margin-bottom: 15px;">
                <label>Nama</label>
                <input type="text" id="name" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Asal Kota</label>
                <input type="text" id="city" class="form-input" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Testimoni</label>
                <textarea id="message" rows="3" class="form-input" required></textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label>Rating (1-5)</label>
                <select id="rating" class="form-input">
                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4">⭐⭐⭐⭐ (4)</option>
                    <option value="3">⭐⭐⭐ (3)</option>
                    <option value="2">⭐⭐ (2)</option>
                    <option value="1">⭐ (1)</option>
                </select>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-view" style="background: #27ae60;">Simpan</button>
                <button type="button" class="btn-delete" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
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
    
    function displayTestimonials() {
        const grid = document.getElementById('testimonialsGrid');
        if (testimonials.length === 0) {
            grid.innerHTML = '<p style="text-align: center; grid-column: 1/-1;">Belum ada testimoni</p>';
            return;
        }
        
        grid.innerHTML = testimonials.map((t, i) => `
            <div style="background: #f8f9fa; border-radius: 16px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <strong>${t.name}</strong>
                    <span style="color: #FFCC00;">${'⭐'.repeat(t.rating)}</span>
                </div>
                <p style="color: #666; font-size: 14px; margin-bottom: 8px;">📍 ${t.city}</p>
                <p style="font-size: 14px; line-height: 1.5;">"${t.message}"</p>
                <div style="margin-top: 12px;">
                    <button class="btn-edit" onclick="editTestimonial(${i})">✏ Edit</button>
                    <button class="btn-delete" onclick="deleteTestimonial(${i})">🗑 Hapus</button>
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