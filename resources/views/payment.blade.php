<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - CanyoKuy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .payment-wrapper {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 30px;
        }

        /* Left Panel - Order Summary */
        .order-summary {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-header {
            background: #2F6B5E;
            color: white;
            padding: 20px;
        }

        .summary-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .summary-body {
            padding: 20px;
        }

        .order-item {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item .item-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .order-item .item-detail {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .total-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #2F6B5E;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            color: #2F6B5E;
        }

        /* Right Panel - Payment Methods */
        .payment-methods {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .payment-header {
            background: #2F6B5E;
            color: white;
            padding: 20px;
        }

        .payment-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .payment-body {
            padding: 20px;
        }

        /* Bank Info */
        .bank-info {
            text-align: center;
            padding: 10px;
        }

        .bank-logo {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .bank-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .bank-number {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin: 15px 0;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
            width: 100%;
        }

        .copy-btn {
            background: #2F6B5E;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .copy-btn:hover {
            background: #1e4a40;
        }

        .instruction {
            text-align: left;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .instruction ol {
            margin-left: 20px;
            margin-top: 10px;
        }

        .instruction li {
            margin: 8px 0;
            font-size: 14px;
        }

        /* Upload File */
        .upload-section {
            margin: 20px 0;
            padding: 20px;
            border: 2px dashed #ddd;
            border-radius: 16px;
            text-align: center;
        }

        .upload-label {
            display: inline-block;
            padding: 12px 24px;
            background: #f0f0f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-label:hover {
            background: #e0e0e0;
        }

        .upload-label i {
            margin-right: 8px;
        }

        #fileInput {
            display: none;
        }

        .file-name {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
        }

        .preview-image {
            margin-top: 15px;
            max-width: 200px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .btn-confirm {
            width: 100%;
            padding: 16px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-confirm:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        .btn-confirm:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid white;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
            vertical-align: middle;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .payment-wrapper {
                grid-template-columns: 1fr;
            }
            .order-summary {
                position: static;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-wrapper">
            <!-- LEFT: Order Summary -->
            <div class="order-summary">
                <div class="summary-header">
                    <h2><i class="fas fa-receipt"></i> Ringkasan Pesanan</h2>
                    <p>Detail pemesanan Anda</p>
                </div>
                <div class="summary-body">
                    <div class="order-item">
                        <div class="item-title">🏞️ Paket Wisata</div>
                        <div class="item-detail">
                            <span id="summaryPackage">Memuat...</span>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="item-title">👤 Data Pemesan</div>
                        <div class="item-detail">
                            <span>Nama:</span>
                            <span id="summaryNama">-</span>
                        </div>
                        <div class="item-detail">
                            <span>Email:</span>
                            <span id="summaryEmail">-</span>
                        </div>
                        <div class="item-detail">
                            <span>WhatsApp:</span>
                            <span id="summaryWA">-</span>
                        </div>
                    </div>
                    <div class="order-item">
                        <div class="item-title">📅 Detail Booking</div>
                        <div class="item-detail">
                            <span>Jumlah Peserta:</span>
                            <span id="summaryJumlah">-</span>
                        </div>
                        <div class="item-detail">
                            <span>Tanggal:</span>
                            <span id="summaryTanggal">-</span>
                        </div>
                        <div class="item-detail">
                            <span>Kode Booking:</span>
                            <span id="summaryKode" style="font-weight: bold; color: #2F6B5E;">-</span>
                        </div>
                    </div>
                    <div class="total-section">
                        <div class="total-row">
                            <span>Total Pembayaran</span>
                            <span id="summaryTotal" style="font-size: 24px; color: #e74c3c;">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Payment Methods -->
            <div class="payment-methods">
                <div class="payment-header">
                    <h2><i class="fas fa-credit-card"></i> Metode Pembayaran</h2>
                    <p>Silakan transfer ke rekening berikut</p>
                </div>
                <div class="payment-body">
                    <!-- Bank Transfer -->
                    <div class="bank-info">
                        <div class="bank-logo">
                            <i class="fas fa-university" style="font-size: 48px; color: #2F6B5E;"></i>
                        </div>
                        <div class="bank-name">Bank Mandiri</div>
                        <div class="bank-number" id="bankNumber">
                            123 00 12345678 9
                        </div>
                        <button class="copy-btn" onclick="copyToClipboard('12300123456789')">
                            <i class="fas fa-copy"></i> Salin Nomor Rekening
                        </button>

                        <div class="instruction">
                            <strong>📝 Instruksi Transfer:</strong>
                            <ol>
                                <li>Buka aplikasi mobile banking Mandiri / ATM / Livin' Mandiri</li>
                                <li>Pilih menu transfer ke rekening Mandiri</li>
                                <li>Masukkan nomor rekening: <strong>123 00 12345678 9</strong></li>
                                <li>Masukkan nominal sesuai <strong id="instructionTotal">total pembayaran</strong></li>
                                <li>Pada keterangan/bukti transfer, tuliskan <strong>Kode Booking</strong> Anda</li>
                                <li>Setelah transfer, upload bukti transfer di bawah ini</li>
                                <li>Klik tombol Konfirmasi Pembayaran</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Upload Bukti Transfer -->
                    <div class="upload-section">
                        <label class="upload-label" for="fileInput">
                            <i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer
                        </label>
                        <input type="file" id="fileInput" accept="image/*">
                        <div class="file-name" id="fileName"></div>
                        <img id="previewImage" class="preview-image" style="display: none;">
                    </div>

                    <button class="btn-confirm" id="confirmBtn" onclick="confirmPayment()">
                        <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let bookingData = null;
        let selectedFile = null;

        // Load data dari localStorage
        window.onload = function() {
            const storedData = localStorage.getItem('bookingData');
            
            if (storedData) {
                bookingData = JSON.parse(storedData);
                displayOrderSummary();
                updateInstructionTotal();
            } else {
                alert('Data pemesanan tidak ditemukan. Silakan isi form pemesanan terlebih dahulu.');
                window.location.href = "{{ route('booking') }}";
            }
        };

        function displayOrderSummary() {
            document.getElementById('summaryPackage').textContent = bookingData.package;
            document.getElementById('summaryNama').textContent = bookingData.nama;
            document.getElementById('summaryEmail').textContent = bookingData.email;
            document.getElementById('summaryWA').textContent = bookingData.whatsapp;
            document.getElementById('summaryJumlah').textContent = bookingData.jumlah + ' orang';
            document.getElementById('summaryTanggal').textContent = bookingData.tanggal;
            document.getElementById('summaryKode').textContent = bookingData.booking_code;
            document.getElementById('summaryTotal').textContent = 'Rp ' + bookingData.total.toLocaleString('id-ID');
        }

        function updateInstructionTotal() {
            if (bookingData) {
                document.getElementById('instructionTotal').textContent = 'Rp ' + bookingData.total.toLocaleString('id-ID');
            }
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('✅ Nomor rekening berhasil disalin!');
            }).catch(() => {
                alert('❌ Gagal menyalin, silakan salin manual');
            });
        }

        // File upload handler
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    alert('❌ Format file harus JPG, JPEG, atau PNG!');
                    this.value = '';
                    return;
                }
                
                // Validasi ukuran (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ Ukuran file maksimal 2MB!');
                    this.value = '';
                    return;
                }
                
                selectedFile = file;
                document.getElementById('fileName').textContent = file.name;
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('previewImage');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function confirmPayment() {
            if (!bookingData) {
                alert('Data tidak ditemukan!');
                return;
            }
            
            // Validasi upload bukti
            if (!selectedFile) {
                alert('⚠️ Silakan upload bukti transfer terlebih dahulu!');
                return;
            }
            
            // Simpan status pembayaran
            bookingData.payment_status = 'Menunggu Verifikasi';
            bookingData.payment_time = new Date().toISOString();
            bookingData.bank_account = 'Bank Mandiri - 12300123456789';
            
            localStorage.setItem('bookingData', JSON.stringify(bookingData));
            
            // Loading effect
            const confirmBtn = document.getElementById('confirmBtn');
            const originalText = confirmBtn.innerHTML;
            confirmBtn.innerHTML = '<span class="loading-spinner"></span> Mengirim konfirmasi...';
            confirmBtn.disabled = true;
            
            // Kirim ke WhatsApp admin
            const message = `Halo%20Admin%20CanyoKuy%2C%0A%0A*KONFIRMASI PEMBAYARAN*%0A%0ASaya%20telah%20melakukan%20pembayaran%20untuk%20pemesanan%20berikut%3A%0A%0A📦%20Paket%3A%20${bookingData.package}%0A👤%20Nama%3A%20${bookingData.nama}%0A📧%20Email%3A%20${bookingData.email}%0A📞%20WhatsApp%3A%20${bookingData.whatsapp}%0A👥%20Peserta%3A%20${bookingData.jumlah}%20orang%0A📅%20Tanggal%3A%20${bookingData.tanggal}%0A🎫%20Kode%20Booking%3A%20${bookingData.booking_code}%0A💰%20Total%3A%20Rp%20${bookingData.total.toLocaleString('id-ID')}%0A🏦%20Bank%3A%20Bank%20Mandiri%0A%0A📎%20Bukti%20Transfer%3A%20${selectedFile.name}%0A%0A_Mohon%20diverifikasi.%20Terima%20kasih._`;
            
            setTimeout(() => {
                window.location.href = `https://wa.me/628123456789?text=${message}`;
            }, 500);
        }
    </script>
</body>
</html>