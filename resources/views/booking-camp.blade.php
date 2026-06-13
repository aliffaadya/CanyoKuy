<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan & Pembayaran - CanyoKuy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* INTERFACE VARIABLES ADMIN PANEL */
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

        /* FORM FIELD STYLES */
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

        /* PAYMENT DETAILS BOX */
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

        .payment-row.total-dp span {
            color: var(--text-dark);
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

        /* ALUR PROSES PEMBAYARAN & PELUNASAN */
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

        .flow-item:last-child {
            margin-bottom: 0;
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

        .flow-item.next .flow-dot {
            border-color: var(--banner-green);
            background: #ffffff;
        }

        .flow-content h4 {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 3px;
        }

        .flow-content p {
            font-size: 12.5px;
            color: var(--text-gray);
            line-height: 1.5;
        }

        /* REVISI: KOTAK PERINGATAN KHUSUS (CLEAN, JELAS, BEBAS EMOJI) */
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

        .warning-box strong {
            color: #991b1b;
            font-weight: 700;
        }

        /* UPLOAD ZONE */
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

        .upload-zone p {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .upload-zone span {
            font-size: 11px;
            color: var(--text-gray);
            display: block;
            margin-top: 4px;
        }

        /* BUTTONS */
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

        /* SPINNER LOADING */
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* SUCCESS VIEW */
        #successView {
            display: none;
            text-align: center;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    </style>
</head>

<body>

    <div class="booking-card">
        <!-- HEADER -->
        <div class="card-header">
            <h2>Form Pemesanan & Pembayaran</h2>
            <p>Isi data diri dan upload bukti transfer DP untuk menyelesaikan booking</p>
        </div>

        <div class="card-body">
            <!-- ================= VIEW 1: FORM INPUT ================= -->
            <form id="bookingForm" onsubmit="handleFormSubmit(event)">
                <!-- Detail Singkat Paket -->
                <div class="package-badge">
                    <div class="package-icon">
                        <i class="fas fa-campground"></i>
                    </div>
                    <div class="package-info">
                        <h3>Paket Camp</h3>
                        <p>Rp 330.000 <span style="font-size:12px; color: var(--text-gray); font-weight:400;">/orang
                                (Booking Individu)</span></p>
                    </div>
                </div>

                <!-- Input Data Diri -->
                <div class="form-group">
                    <label>Nama Lengkap <span>*</span></label>
                    <input type="text" id="inputNama" class="form-control" placeholder="Masukkan nama lengkap Anda"
                        required>
                </div>

                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="contoh@email.com" required>
                </div>

                <div class="form-group">
                    <label>Nomor WhatsApp <span>*</span></label>
                    <input type="tel" id="inputWA" class="form-control" placeholder="081234567890" required>
                </div>

                <div class="form-group">
                    <label>Catatan Tambahan</label>
                    <textarea id="inputCatatan" class="form-control" rows="2"
                        placeholder="Tulis kebutuhan khusus atau catatan lainnya..."></textarea>
                </div>

                <!-- Box Rincian Pembayaran & Rekening -->
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

                    <!-- Rekening Bank -->
                    <div class="bank-section">
                        <div class="bank-name">BANK MANDIRI</div>
                        <div class="bank-account" id="rekNumber">123 00 12345678 9</div>
                        <button type="button" class="btn-copy" onclick="copyReconciliation()">
                            <i class="fas fa-copy"></i> Salin No. Rekening
                        </button>
                    </div>
                </div>

                <!-- ALUR PROSES PEMBAYARAN -->
                <div class="payment-flow-container">
                    <div class="flow-title">Alur Proses & Pelunasan Pembayaran</div>
                    <div class="flow-steps">
                        <!-- Tahap 1 -->
                        <div class="flow-item current">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 1: Down Payment (DP)</h4>
                                <p>Melakukan transfer komitmen awal sebesar 50% dari total biaya paket dan mengunggah
                                    bukti pembayaran pada form di bawah.</p>
                            </div>
                        </div>
                        <!-- Tahap 2 -->
                        <div class="flow-item next">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 2: Verifikasi & Konfirmasi Admin</h4>
                                <p>Sistem admin akan melakukan pengecekan data serta validasi bukti transfer yang Anda
                                    unggah untuk meresmikan status booking.</p>
                            </div>
                        </div>
                        <!-- Tahap 3 -->
                        <div class="flow-item next">
                            <div class="flow-dot"></div>
                            <div class="flow-content">
                                <h4>Tahap 3: Pelunasan di Hari H</h4>
                                <p>Sisa pembayaran sebesar Rp 150.000 dilunasi langsung di lokasi saat kegiatan
                                    berlangsung secara tunai maupun transfer bank.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOTAK PERINGATAN KHUSUS (MUNCUL KEMBALI & DIJAMIN TERLIHAT JELAS) -->
                <div class="warning-box">
                    <strong>Peringatan Pembatalan:</strong> Apabila pemesanan dibatalkan secara sepihak oleh pihak
                    pemesan, maka dana komitmen awal (DP) dinyatakan hangus dan tidak dapat dikembalikan.
                </div>

                <!-- File Bukti Transfer -->
                <div class="form-group">
                    <label class="upload-label">Upload Bukti Transfer DP <span>*</span></label>
                    <div class="upload-zone" onclick="document.getElementById('fileUpload').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p id="uploadText">Klik untuk upload Bukti Transfer</p>
                        <span>Format JPG, JPEG, PNG (Max 2MB)</span>
                        <input type="file" id="fileUpload" style="display:none;" accept="image/*" required
                            onchange="fileSelected(this)">
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="spinner" id="btnSpinner"></span>
                    <span id="btnText">Kirim</span>
                </button>

                <!-- TOMBOL KEMBALI SEBELUMNYA -->
                <a href="{{ url('/detailCamp') }}" class="btn-back">Kembali</a>
            </form>

            <!-- ================= VIEW 2: HALAMAN SUKSES (INVOICE) ================= -->
            <div id="successView">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="success-title">Pemesanan Terkirim!</h3>
                <p class="success-desc">Data Anda telah disimpan di sistem. Silakan klik tombol di bawah untuk mengirim
                    konfirmasi ke WhatsApp admin agar segera diverifikasi.</p>

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

                <a href="#" target="_blank" class="btn-whatsapp" id="waLink" onclick="pindahKeBeranda()">
                    <i class="fab fa-whatsapp"></i> Konfirmasi ke WA Admin
                </a>
            </div>
        </div>
    </div>

    <script>
        const HARGA_PER_ORANG = 330000;

        function updatePaymentDetails() {
            const inputPesertaEl = document.getElementById('inputPeserta');
            const jumlah = inputPesertaEl ? parseInt(inputPesertaEl.value) : 1;
            const totalHarga = HARGA_PER_ORANG * jumlah;
            const totalDP = totalHarga * 0.5;

            const labelJumlahPesertaEl = document.getElementById('labelJumlahPeserta');
            if (labelJumlahPesertaEl) {
                labelJumlahPesertaEl.textContent = jumlah + " orang";
            }

            document.getElementById('labelHargaPaket').textContent = "Rp " + (totalHarga).toLocaleString('id-ID');
            document.getElementById('labelTotalDP').textContent = "Rp " + (totalDP).toLocaleString('id-ID');
        }

        function copyReconciliation() {
            const textToCopy = "12300123456789";
            navigator.clipboard.writeText(textToCopy).then(() => {
                alert("Nomor rekening Mandiri berhasil disalin!");
            });
        }

        function fileSelected(input) {
            if (input.files.length > 0) {
                document.getElementById('uploadText').innerHTML = "<b>File Terpilih:</b> " + input.files[0].name;
                document.getElementById('uploadText').style.color = "var(--primary-green)";
            }
        }

        function generateRandomBookingCode() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 5; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return "CKY-" + result;
        }

        function handleFormSubmit(event) {
            event.preventDefault();

            document.getElementById('btnSpinner').style.display = 'block';
            document.getElementById('btnText').textContent = 'Memproses Data...';
            document.getElementById('submitBtn').disabled = true;

            setTimeout(() => {
                const nama = document.getElementById('inputNama').value;
                const email = document.getElementById('inputEmail').value;
                const wa = document.getElementById('inputWA').value;

                const inputPesertaEl = document.getElementById('inputPeserta');
                const peserta = inputPesertaEl ? inputPesertaEl.value : '1';

                const inputTanggalEl = document.getElementById('inputTanggal');
                const tanggal = inputTanggalEl ? inputTanggalEl.value : new Date().toLocaleDateString('id-ID');

                const catatan = document.getElementById('inputCatatan').value || "-";

                const formatDP = document.getElementById('labelTotalDP').textContent;
                const kodeBooking = generateRandomBookingCode();

                document.getElementById('resNama').textContent = nama;
                document.getElementById('resTanggal').textContent = tanggal;
                document.getElementById('resDP').textContent = formatDP;
                document.getElementById('resKode').textContent = kodeBooking;

                const nomorAdmin = "6283150774897";
                const textMessage = `Halo Admin CanyoKuy!%0A` +
                    `Saya ingin konfirmasi pembayaran DP untuk paket wisata.%0A%0A` +
                    `*Berikut Rincian Data Pemesanan:*%0A` +
                    `• Kode Booking: *${kodeBooking}*%0A` +
                    `• Nama Lengkap: ${nama}%0A` +
                    `• Email: ${email}%0A` +
                    `• No. WhatsApp: ${wa}%0A` +
                    `• Total Nominal DP: *${formatDP}*%0A` +
                    `• Catatan: ${catatan}%0A%0A` +
                    `Saya sudah melampirkan bukti transfer di website. Mohon segera dicek dan diverifikasi ya, terima kasih!`;

                document.getElementById('waLink').href = `https://wa.me/${nomorAdmin}?text=${textMessage}`;

                document.getElementById('bookingForm').style.display = 'none';
                document.getElementById('successView').style.display = 'block';

                document.querySelector('.booking-card').scrollIntoView({ behavior: 'smooth' });

            }, 1500);
        }
        function pindahKeBeranda() {
            // Beri jeda 1 detik agar tab WhatsApp terbuka dengan aman
            // Setelah itu, pindahkan halaman form ini ke Beranda
            setTimeout(() => {
                window.location.href = "/"; // Jika kamu pakai Laravel blade, bisa juga pakai "{{ url('/') }}"
            }, 1000);
        }
    </script>
</body>

</html>