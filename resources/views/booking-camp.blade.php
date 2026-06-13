<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan & Pembayaran - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-green: #29604c;
            --banner-green: #4da674;
            --bg-color: #f7f9fa;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --card-bg: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #ffffff;
            padding: 50px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .booking-card {
            background: var(--card-bg);
            max-width: 580px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(30, 41, 59, 0.05);
        }

        .card-header {
            background: var(--card-bg);
            color: var(--text-dark);
            padding: 30px 30px 20px 30px;
            text-align: left;
            position: relative;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 30px;
            bottom: 20px;
            width: 4px;
            background: var(--primary-green);
            border-radius: 0 4px 4px 0;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .card-header p {
            font-size: 13px;
            color: var(--text-gray);
            line-height: 1.5;
        }

        .card-body {
            padding: 30px;
        }

        .package-badge {
            background: var(--bg-color);
            border: 1px solid #e2e8f0;
            padding: 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .package-icon {
            background: var(--primary-green);
            color: #ffffff;
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .package-info h3 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .package-info p {
            font-size: 13.5px;
            color: var(--primary-green);
            font-weight: 700;
            margin-top: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group label span {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            background: var(--bg-color);
            border-radius: 8px;
            font-size: 13.5px;
            color: var(--text-dark);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(41, 96, 76, 0.1);
        }

        .payment-box {
            background: var(--bg-color);
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 18px;
            margin: 24px 0 16px 0;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            padding: 6px 0;
            color: var(--text-dark);
        }

        .payment-row span {
            color: var(--text-gray);
        }

        .payment-row.total-dp {
            border-top: 1px dashed #cbd5e1;
            margin-top: 10px;
            padding-top: 12px;
            font-weight: 700;
        }

        .payment-row.total-dp .price {
            color: var(--primary-green);
            font-size: 16px;
            font-weight: 800;
        }

        .bank-section {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
            text-align: center;
            margin-top: 12px;
        }

        .bank-name {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-gray);
            letter-spacing: 0.5px;
        }

        .bank-account {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 4px 0 10px 0;
        }

        .btn-copy {
            background: var(--bg-color);
            border: 1px solid #e2e8f0;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s ease;
        }

        .btn-copy:hover {
            background: #e2e8f0;
        }

        .payment-flow-container {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            margin: 24px 0 16px 0;
            background: #ffffff;
        }

        .flow-title {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .flow-steps {
            position: relative;
            padding-left: 24px;
        }

        .flow-steps::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: #e2e8f0;
        }

        .flow-item {
            position: relative;
            margin-bottom: 20px;
        }

        .flow-dot {
            position: absolute;
            left: -24px;
            top: 3px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #cbd5e1;
            z-index: 1;
        }

        .flow-item.current .flow-dot {
            border-color: var(--primary-green);
            background: var(--primary-green);
        }

        .warning-box {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 12.5px;
            color: #991b1b;
            line-height: 1.5;
        }

        .upload-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            background: var(--bg-color);
            transition: all 0.2s ease;
        }

        .upload-zone:hover {
            border-color: var(--primary-green);
            background: #f0fdf9;
        }

        .upload-zone i {
            font-size: 26px;
            color: var(--text-gray);
            margin-bottom: 8px;
        }

        .btn-submit {
            width: 100%;
            background: var(--primary-green);
            color: #ffffff;
            border: none;
            padding: 13px;
            border-radius: 8px;
            font-size: 14.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
        }

        .btn-submit:hover {
            background: #1e4537;
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-back {
            display: block;
            text-align: center;
            text-decoration: none;
            color: var(--text-gray);
            font-size: 13px;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            color: var(--primary-green);
        }

        .btn-home {
            display: block;
            width: 100%;
            background: #f1f5f9;
            color: #1e293b;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-top: 15px;
            transition: all 0.2s ease;
        }

        .btn-home:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid white;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #successView {
            display: none;
            text-align: center;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-icon {
            width: 60px;
            height: 60px;
            background: #e6f4ea;
            color: var(--banner-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin: 10px auto 18px;
        }

        .success-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .success-desc {
            font-size: 13.5px;
            color: var(--text-gray);
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .invoice-box {
            background: var(--bg-color);
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            text-align: left;
            margin-bottom: 24px;
        }

        .invoice-row {
            display: flex;
            justify-content: space-between;
            font-size: 13.5px;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .invoice-row:last-of-type {
            border-bottom: none;
        }

        .invoice-row .label {
            color: var(--text-gray);
        }

        .invoice-row .value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .booking-code-wrapper {
            background: #eaf2ee;
            border: 1px solid #cfe2d8;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            margin-top: 14px;
        }

        .booking-code-label {
            font-size: 11px;
            color: var(--primary-green);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .booking-code-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary-green);
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .btn-whatsapp {
            width: 100%;
            background: #25D366;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
            transition: background 0.2s;
        }

        .btn-whatsapp:hover {
            background: #20ba5a;
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-spinner-large {
            width: 50px;
            height: 50px;
            border: 4px solid white;
            border-top: 4px solid #4da674;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            color: white;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner-large"></div>
        <div class="loading-text">Memproses data...</div>
    </div>

    <div class="booking-card">
        <div class="card-header">
            <h2>Form Pemesanan & Pembayaran</h2>
            <p>Isi data diri dan upload bukti transfer DP untuk menyelesaikan booking</p>
        </div>

        <div class="card-body">
            <!-- FORM INPUT -->
            <form id="bookingForm" onsubmit="handleFormSubmit(event)">
                <div class="package-badge">
                    <div class="package-icon">
                        <i class="fas fa-campground"></i>
                    </div>
                    <div class="package-info">
                        <h3>Paket Camp</h3>
                        <p>Rp 330.000 <span style="font-size:12px; color: var(--text-gray); font-weight:400;">/orang (Booking Individu)</span></p>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap <span>*</span></label>
                    <input type="text" id="inputNama" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <div class="form-group">
                    <label>Nomor WhatsApp <span>*</span></label>
                    <input type="tel" id="inputWA" class="form-control" placeholder="081234567890" required>
                </div>

                <div class="form-group">
                    <label>Catatan Tambahan</label>
                    <textarea id="inputCatatan" class="form-control" rows="2" placeholder="Tulis kebutuhan khusus atau catatan lainnya..."></textarea>
                </div>

                <div class="payment-box">
                    <div class="payment-row">
                        <span>Paket</span>
                        <strong>Paket Camp</strong>
                    </div>
                    <div class="payment-row">
                        <span>Harga Paket</span>
                        <span id="labelHargaPaket">Rp 330.000</span>
                    </div>
                    <div class="payment-row total-dp">
                        <span>DP (50%) yang Harus Ditransfer</span>
                        <span class="price" id="labelTotalDP">Rp 165.000</span>
                    </div>

                    <div class="bank-section">
                        <div class="bank-name">BANK MANDIRI</div>
                        <div class="bank-account">123 00 12345678 9</div>
                        <button type="button" class="btn-copy" onclick="copyReconciliation()">
                            <i class="fas fa-copy"></i> Salin No. Rekening
                        </button>
                    </div>
                </div>

                <div class="payment-flow-container">
                    <div class="flow-title">Alur Proses & Pelunasan Pembayaran</div>
                    <div class="flow-steps">
                        <div class="flow-item current">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 1: Down Payment (DP)</h4>
                                <p>Transfer komitmen awal sebesar 50% dari total biaya paket.</p>
                            </div>
                        </div>
                        <div class="flow-item next">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 2: Verifikasi Admin</h4>
                                <p>Admin akan mengecek data dan validasi bukti transfer Anda.</p>
                            </div>
                        </div>
                        <div class="flow-item next">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 3: Pelunasan di Hari H</h4>
                                <p>Sisa pembayaran dilunasi di lokasi saat kegiatan berlangsung.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="warning-box">
                    <strong>Peringatan Pembatalan:</strong> Apabila pemesanan dibatalkan secara sepihak, maka DP dinyatakan hangus dan tidak dapat dikembalikan.
                </div>

                <div class="form-group">
                    <label class="upload-label">Upload Bukti Transfer DP <span>*</span></label>
                    <div class="upload-zone" onclick="document.getElementById('fileUpload').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p id="uploadText">Klik untuk upload Bukti Transfer</p>
                        <span>Format JPG, JPEG, PNG (Max 2MB)</span>
                        <input type="file" id="fileUpload" style="display:none;" accept="image/*" required onchange="fileSelected(this)">
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="spinner" id="btnSpinner"></span>
                    <span id="btnText">Kirim</span>
                </button>

                <a href="{{ url('/detailCamp') }}" class="btn-back">Kembali</a>
            </form>

            <!-- HALAMAN SUKSES -->
            <div id="successView">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="success-title">Pemesanan Terkirim!</h3>
                <p class="success-desc">Data Anda telah disimpan di sistem. Silakan konfirmasi ke WhatsApp admin untuk verifikasi.</p>

                <div class="invoice-box">
                    <div class="invoice-row">
                        <span class="label">Nama</span>
                        <span class="value" id="resNama">-</span>
                    </div>
                    <div class="invoice-row">
                        <span class="label">Paket</span>
                        <span class="value">Paket Camp</span>
                    </div>
                    <div class="invoice-row">
                        <span class="label">Tanggal</span>
                        <span class="value" id="resTanggal">-</span>
                    </div>
                    <div class="invoice-row">
                        <span class="label">Total DP</span>
                        <span class="value" id="resDP" style="color: var(--primary-green); font-weight:700;">-</span>
                    </div>

                    <div class="booking-code-wrapper">
                        <div class="booking-code-label">Kode Booking Anda</div>
                        <div class="booking-code-value" id="resKode">CKY-XXXXX</div>
                    </div>
                </div>

                <a href="#" target="_blank" class="btn-whatsapp" id="waLink" onclick="openWhatsApp()">
                    <i class="fab fa-whatsapp"></i> Konfirmasi ke WA Admin
                </a>

                <a href="{{ url('/') }}" class="btn-home">
                    <i class="fas fa-home"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <script>
        let isSubmitting = false;

        function copyReconciliation() {
            navigator.clipboard.writeText("12300123456789").then(() => {
                alert("Nomor rekening Mandiri berhasil disalin!");
            });
        }

        function fileSelected(input) {
            if (input.files.length > 0) {
                const file = input.files[0];
                if (file.size > 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 1MB. Silakan kompres gambar Anda.');
                    input.value = '';
                    return;
                }
                document.getElementById('uploadText').innerHTML = "<b>File Terpilih:</b> " + file.name;
                document.getElementById('uploadText').style.color = "var(--primary-green)";
            }
        }

        function compressImage(file, callback) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(event) {
                const img = new Image();
                img.src = event.target.result;
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;

                    const maxWidth = 1024;
                    if (width > maxWidth) {
                        height = (height * maxWidth) / width;
                        width = maxWidth;
                    }

                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob(function(blob) {
                        const compressedFile = new File([blob], file.name.replace(/\.[^/.]+$/, '.jpg'), { type: 'image/jpeg' });
                        callback(compressedFile);
                    }, 'image/jpeg', 0.7);
                };
            };
        }

        function formatTanggal(tanggal) {
            const date = new Date(tanggal);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric', month: 'long', day: 'numeric'
            });
        }

        async function handleFormSubmit(event) {
            event.preventDefault();

            if (isSubmitting) return;
            isSubmitting = true;

            const fileInput = document.getElementById('fileUpload');
            if (!fileInput.files.length) {
                alert('Silakan upload bukti transfer terlebih dahulu!');
                isSubmitting = false;
                return;
            }

            const tanggal = document.getElementById('inputTanggal').value;
            if (!tanggal) {
                alert('Tanggal tidak tersedia. Silakan hubungi admin.');
                isSubmitting = false;
                return;
            }

            // CEK KUOTA SEBELUM SUBMIT
            try {
                const scheduleResponse = await fetch('/api/schedules');
                const scheduleResult = await scheduleResponse.json();

                if (scheduleResult.success && scheduleResult.data.length > 0) {
                    const schedule = scheduleResult.data[0];
                    const remainingQuota = schedule.quota - (schedule.filled || 0);

                    if (remainingQuota <= 0) {
                        alert('❌ Maaf, kuota sudah penuh! Tidak dapat melakukan pemesanan.');
                        isSubmitting = false;
                        return;
                    }
                }
            } catch (error) {
                console.error('Error checking quota:', error);
                alert('Gagal mengecek kuota. Silakan coba lagi.');
                isSubmitting = false;
                return;
            }

            const originalFile = fileInput.files[0];
            if (originalFile.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                isSubmitting = false;
                return;
            }

            document.getElementById('loadingOverlay').style.display = 'flex';
            document.getElementById('btnSpinner').style.display = 'block';
            document.getElementById('btnText').textContent = 'Mengompres...';
            document.getElementById('submitBtn').disabled = true;

            compressImage(originalFile, function(compressedFile) {
                document.getElementById('btnText').textContent = 'Mengirim...';

                const formData = new FormData();
                formData.append('nama', document.getElementById('inputNama').value);
                formData.append('email', document.getElementById('inputEmail').value);
                formData.append('whatsapp', document.getElementById('inputWA').value);
                formData.append('paket', 'Paket Camp');
                formData.append('tanggal', tanggal);
                formData.append('total', '330000');
                formData.append('catatan', document.getElementById('inputCatatan').value || '-');
                formData.append('bukti_transfer', compressedFile);

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/api/bookings', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    document.getElementById('loadingOverlay').style.display = 'none';

                    if (result.success) {
                        document.getElementById('resNama').textContent = document.getElementById('inputNama').value;
                        document.getElementById('resTanggal').textContent = formatTanggal(tanggal);
                        document.getElementById('resDP').textContent = 'Rp 165.000';
                        document.getElementById('resKode').textContent = result.booking_code;

                        const waMessage = `Halo Admin CanyoKuy!%0A%0A*KONFIRMASI PEMBAYARAN DP*%0A%0ANama: ${document.getElementById('inputNama').value}%0AEmail: ${document.getElementById('inputEmail').value}%0AKode Booking: ${result.booking_code}%0ATotal DP: Rp 165.000%0A%0AMohon segera diverifikasi. Terima kasih.`;
                        document.getElementById('waLink').href = `https://wa.me/6283150774897?text=${waMessage}`;

                        document.getElementById('bookingForm').style.display = 'none';
                        document.getElementById('successView').style.display = 'block';
                    } else {
                        alert('Gagal: ' + (result.message || 'Terjadi kesalahan'));
                        resetButton();
                    }
                    isSubmitting = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingOverlay').style.display = 'none';
                    alert('Terjadi kesalahan. Periksa koneksi internet Anda.');
                    resetButton();
                    isSubmitting = false;
                });
            });

            function resetButton() {
                document.getElementById('btnSpinner').style.display = 'none';
                document.getElementById('btnText').textContent = 'Kirim';
                document.getElementById('submitBtn').disabled = false;
            }
        }

        function openWhatsApp() {
            const waLink = document.getElementById('waLink').href;
            window.open(waLink, '_blank');
        }
    </script>
</body>
</html>