<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan - CanyoKuy</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .booking-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .booking-header {
            background: #2F6B5E;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .booking-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .booking-header p {
            opacity: 0.9;
        }

        .booking-body {
            padding: 30px;
        }

        /* Package Selection */
        .package-selection {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .package-card {
            flex: 1;
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
        }

        .package-card:hover {
            border-color: #2F6B5E;
            transform: translateY(-5px);
        }

        .package-card.selected {
            border-color: #2F6B5E;
            background: #f0f7f5;
            box-shadow: 0 4px 12px rgba(47, 107, 94, 0.2);
        }

        .package-card i {
            font-size: 40px;
            color: #2F6B5E;
            margin-bottom: 10px;
        }

        .package-card h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .package-card .price {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
        }

        .package-card .dp {
            font-size: 12px;
            color: #666;
        }

        .check-icon {
            display: none;
            color: #27ae60;
            font-size: 20px;
            margin-top: 10px;
        }

        .package-card.selected .check-icon {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group label .required {
            color: #e74c3c;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2F6B5E;
            box-shadow: 0 0 0 3px rgba(47, 107, 94, 0.1);
        }

        .fixed-participant {
            background: #f0f0f0;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
        }

        .price-detail {
            background: #f0f7f5;
            border-radius: 16px;
            padding: 20px;
            margin: 20px 0;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #d0e0dc;
        }

        .price-item:last-child {
            border-bottom: none;
        }

        .price-item.total {
            font-weight: bold;
            font-size: 18px;
            color: #2F6B5E;
            padding-top: 15px;
            margin-top: 5px;
            border-top: 2px solid #2F6B5E;
        }

        .info-payment {
            background: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 12px;
            margin-top: 10px;
            border-radius: 8px;
        }

        .info-payment p {
            font-size: 13px;
            margin: 5px 0;
            color: #856404;
        }

        .bank-info {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .bank-info h4 {
            color: #2F6B5E;
            margin-bottom: 10px;
        }

        .bank-number {
            background: white;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ddd;
        }

        .copy-btn {
            background: #2F6B5E;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .copy-btn:hover {
            background: #1e4a40;
        }

        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #2F6B5E;
            background: #f8f9fa;
        }

        .upload-area i {
            font-size: 40px;
            color: #999;
            margin-bottom: 10px;
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
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
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            color: #2F6B5E;
            text-decoration: none;
            text-align: center;
            width: 100%;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="booking-card">
            <div class="booking-header">
                <h1>📝 Form Pemesanan & Pembayaran</h1>
                <p>Pilih paket wisata, isi data diri dan upload bukti transfer DP</p>
            </div>
            <div class="booking-body">
                <div id="alertMessage"></div>

                <!-- Pilihan Paket -->
                <div class="package-selection">
                    <div class="package-card" onclick="selectPackage('camp')" id="packageCamp">
                        <i class="fas fa-campground"></i>
                        <h3>Paket Camp</h3>
                        <div class="price">Rp 330.000</div>
                        <div class="dp">DP 45%: Rp 150.000</div>
                        <div class="check-icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                    <div class="package-card" onclick="selectPackage('roundtrip')" id="packageRoundtrip">
                        <i class="fas fa-car"></i>
                        <h3>Paket Round Trip</h3>
                        <div class="price">Rp 300.000</div>
                        <div class="dp">DP 50%: Rp 150.000</div>
                        <div class="check-icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>

                <form id="bookingForm">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="nama" required placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" id="email" required placeholder="contoh@email.com">
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp <span class="required">*</span></label>
                        <input type="tel" id="whatsapp" required placeholder="081234567890">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Peserta</label>
                        <div class="fixed-participant">
                            <i class="fas fa-user"></i> 1 Orang (Booking Individu)
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Keberangkatan <span class="required">*</span></label>
                        <input type="date" id="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label>Catatan Tambahan</label>
                        <textarea id="catatan" rows="3" placeholder="Tulis kebutuhan khusus atau catatan lainnya..."></textarea>
                    </div>

                    <!-- DETAIL PEMBAYARAN DP & PELUNASAN (Dinamis) -->
                    <div id="priceDetail" class="price-detail">
                        <!-- Akan diisi oleh JS -->
                    </div>

                    <!-- Bank Info -->
                    <div class="bank-info">
                        <h4><i class="fas fa-university"></i> Transfer DP ke Rekening Berikut</h4>
                        <div class="bank-number">
                            BANK MANDIRI<br>
                            123 00 12345678 9
                        </div>
                        <button type="button" class="copy-btn" onclick="copyToClipboard('12300123456789')">
                            <i class="fas fa-copy"></i> Salin Nomor Rekening
                        </button>
                        <p class="dp-nominal" style="font-size: 12px; margin-top: 10px; color: #666;">
                            *Transfer sesuai nominal DP
                        </p>
                    </div>

                    <!-- Upload Bukti Transfer DP -->
                    <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Upload Bukti Transfer DP</p>
                        <small>Format JPG, JPEG, PNG (Max 2MB)</small>
                        <input type="file" id="fileInput" accept="image/jpeg,image/jpg,image/png">
                        <div class="file-name" id="fileName"></div>
                        <img id="previewImage" class="preview-image" style="display: none;">
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fab fa-whatsapp"></i> Konfirmasi via WhatsApp
                    </button>
                    <a href="javascript:history.back()" class="btn-back">← Kembali ke detail paket</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        let selectedFile = null;
        let selectedPackage = 'camp'; // Default: camp
        let packageData = {
            camp: {
                name: 'Paket Camp',
                price: 330000,
                dp: 148500,
                sisa: 181500,
                dp_percent: '45%',
                price_formatted: 'Rp 330.000',
                dp_formatted: 'Rp 150.000',
                sisa_formatted: 'Rp 180.000'
            },
            roundtrip: {
                name: 'Paket Round Trip',
                price: 300000,
                dp: 150000,
                sisa: 150000,
                dp_percent: '50%',
                price_formatted: 'Rp 300.000',
                dp_formatted: 'Rp 150.000',
                sisa_formatted: 'Rp 150.000'
            }
        };

        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').min = today;
            
            // Cek apakah ada data paket dari sessionStorage (dari halaman detail)
            const storedPackage = sessionStorage.getItem('selected_package');
            if (storedPackage) {
                const package = JSON.parse(storedPackage);
                if (package.name === 'Paket Camp') {
                    selectPackage('camp');
                } else if (package.name === 'Paket Round Trip') {
                    selectPackage('roundtrip');
                }
            } else {
                selectPackage('camp'); // Set default
            }
        };

        function selectPackage(packageType) {
            selectedPackage = packageType;
            
            // Update UI paket yang dipilih
            document.getElementById('packageCamp').classList.remove('selected');
            document.getElementById('packageRoundtrip').classList.remove('selected');
            document.getElementById(`package${packageType.charAt(0).toUpperCase() + packageType.slice(1)}`).classList.add('selected');
            
            // Update detail harga
            updatePriceDetail();
        }

        function updatePriceDetail() {
            const data = packageData[selectedPackage];
            const priceDetailDiv = document.getElementById('priceDetail');
            
            priceDetailDiv.innerHTML = `
                <div class="price-item">
                    <span>Paket</span>
                    <span>${data.name}</span>
                </div>
                <div class="price-item">
                    <span>Harga Paket</span>
                    <span>${data.price_formatted}</span>
                </div>
                <div class="price-item">
                    <span>Jumlah Peserta</span>
                    <span>1 orang</span>
                </div>
                <div class="price-item total">
                    <span>💰 DP (${data.dp_percent}) yang harus dibayar sekarang</span>
                    <span style="color: #e74c3c;">${data.dp_formatted}</span>
                </div>
                <div class="info-payment">
                    <p><i class="fas fa-info-circle"></i> <strong>Informasi Pelunasan:</strong></p>
                    <p>✅ Sisa pembayaran <strong>${data.sisa_formatted}</strong> dilunasi pada hari H (saat kegiatan berlangsung)</p>
                    <p>✅ Pelunasan dapat dilakukan secara <strong>tunai</strong> atau <strong>transfer</strong> ke rekening yang sama</p>
                    <p>✅ Konfirmasi pelunasan bisa melalui WhatsApp ke admin</p>
                    <p>⚠️ <strong>Perhatian:</strong> Jika pemesanan dibatalkan, DP akan <strong>hangus</strong> dan tidak dapat dikembalikan</p>
                </div>
            `;
            
            // Update nominal DP di bank info
            const dpNominalElement = document.querySelector('.dp-nominal');
            if (dpNominalElement) {
                dpNominalElement.innerHTML = `*Transfer sesuai nominal DP: ${data.dp_formatted}`;
            }
        }

        function showAlert(message, type) {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            setTimeout(() => {
                alertDiv.innerHTML = '';
            }, 4000);
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
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    alert('❌ Format file harus JPG, JPEG, atau PNG!');
                    this.value = '';
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('❌ Ukuran file maksimal 2MB!');
                    this.value = '';
                    return;
                }

                selectedFile = file;
                document.getElementById('fileName').textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('previewImage');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Submit form langsung ke WA
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const whatsapp = document.getElementById('whatsapp').value;
            const tanggal = document.getElementById('tanggal').value;
            const catatan = document.getElementById('catatan').value;
            
            const data = packageData[selectedPackage];
            const total = data.price;
            const dp = data.dp;
            const sisa = data.sisa;
            const dpPercent = data.dp_percent;

            // Validasi
            if (!nama || !email || !whatsapp || !tanggal) {
                showAlert('⚠️ Mohon lengkapi semua data!', 'error');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showAlert('⚠️ Format email tidak valid!', 'error');
                return;
            }

            const phoneClean = whatsapp.replace(/[^0-9]/g, '');
            if (phoneClean.length < 10 || phoneClean.length > 13) {
                showAlert('⚠️ Nomor WhatsApp harus 10-13 digit!', 'error');
                return;
            }

            if (!selectedFile) {
                showAlert('⚠️ Silakan upload bukti transfer DP!', 'error');
                return;
            }

            // Generate kode booking
            const bookingCode = 'CYK' + Date.now();

            // Loading effect
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<span class="loading-spinner"></span> Mengalihkan ke WhatsApp...';
            submitBtn.disabled = true;

            const fileName = selectedFile.name;

            // Buat pesan WhatsApp dengan persentase yang benar
            const message = `Halo%20Admin%20CanyoKuy%2C%0A%0A*PEMESANAN ${data.name.toUpperCase()}*%0A%0ASaya%20ingin%20memesan%20${data.name}%20dengan%20detail%20berikut%3A%0A%0A📦%20Paket%3A%20${data.name}%0A👤%20Nama%3A%20${nama}%0A📧%20Email%3A%20${email}%0A📞%20WhatsApp%3A%20${whatsapp}%0A👥%20Peserta%3A%201%20orang%0A📅%20Tanggal%3A%20${tanggal}%0A🎫%20Kode%20Booking%3A%20${bookingCode}%0A📝%20Catatan%3A%20${catatan || '-'}%0A%0A*PEMBAYARAN DP:*%0A💰%20Total%20Harga%3A%20Rp%20${total.toLocaleString('id-ID')}%0A💵%20DP%20(${dpPercent})%3A%20Rp%20${dp.toLocaleString('id-ID')}%0A📎%20Bukti%20Transfer%20DP%3A%20${fileName}%0A🏦%20Bank%20Tujuan%3A%20Bank%20Mandiri%2012300123456789%0A%0A*INFORMASI PELUNASAN:*%0A✅%20Sisa%20pembayaran%3A%20Rp%20${sisa.toLocaleString('id-ID')}%0A✅%20Pelunasan%20dilakukan%20pada%20hari%20H%20(saat%20kegiatan)%0A✅%20Dapat%20dibayar%20tunai%20atau%20transfer%0A%0A_Mohon%20dikonfirmasi%20setelah%20DP%20diterima.%20Terima%20kasih._`;

            // Redirect ke WhatsApp
            setTimeout(() => {
                window.location.href = `https://wa.me/628123456789?text=${message}`;
            }, 500);
        });
    </script>
</body>

</html>