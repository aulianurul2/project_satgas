@extends('layouts.app') 

@section('content')
<div class="container">
    
    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:10px; border-radius:5px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <h1 class="form-title">Formulir Pendaftaran Recruitment</h1>
        <p class="form-subtitle">Silakan lengkapi seluruh data berikut. Data bertanda * wajib diisi.</p>

        <form action="{{ route('formpendaftaran.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf

            <div class="grid">
                <div>
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="input" placeholder="Nama Lengkap" required>
                </div>

                <div>
                    <label>NIM *</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" class="input" placeholder="NIM" required>
                </div>

                {{-- 🧑‍🎓 Kolom Jurusan: SATU KOLOM (Dynamic Select/Input) --}}
                <div id="jurusan-group">
                    <label>Jurusan *</label>
                    <select id="jurusan-select" name="jurusan" class="input jurusan-input" required>
                        <option value="">Pilih</option>
                        <option value="Jurusan Teknologi Informasi dan Komputer">Jurusan Teknologi Informasi dan Komputer</option>
                        <option value="Jurusan Kesehatan">Jurusan Kesehatan</option>
                        <option value="Jurusan Teknik Mesin">Jurusan Teknik Mesin</option>
                        <option value="Jurusan Pertanian">Jurusan Pertanian</option>
                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                    </select>
                </div>

                {{-- Hapus kolom 'Jurusan Lainnya' --}}
                {{-- Ganti dengan kolom IPK agar layout 2 kolom tetap terisi rapi --}}
                <div>
                    <label>IPK Terakhir *</label>
                    <input type="number" step="0.01" min="0" max="4" name="ipk_terakhir" value="{{ old('ipk_terakhir') }}" class="input" placeholder="Contoh: 3.50" required>
                </div>

                {{-- 📚 Kolom Prodi: SATU KOLOM (Dynamic Select/Input) --}}
                <div id="prodi-group">
                    <label>Prodi *</label>
                    <select id="prodi-select" name="prodi" class="input prodi-input" required>
                        <option value="">Pilih</option>
                        <option value="D3-Sistem Informasi">D3-Sistem Informasi</option>
                        <option value="D3-Keperawatan">D3-Keperawatan</option>
                        <option value="D3-Agroindustri">D3-Agroindustri</option>
                        <option value="D3-Pemeliharaan Mesin">D3-Pemeliharaan Mesin</option>
                        <option value="D4-TRPL">D4-TRPL</option>
                        <option value="D4-TPTP">D4-TPTP</option>
                        <option value="D4-TRM">D4-TRM</option>
                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                    </select>
                </div>

                {{-- Hapus kolom 'Prodi Lainnya' --}}
                {{-- Ganti dengan kolom Nomor WA agar layout 2 kolom tetap terisi rapi --}}
                <div>
                    <label>Nomor WhatsApp Aktif *</label>
                    <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="input" placeholder="08xxxxxxxxxx" required>
                </div>

                {{-- Baris File Input --}}
                <div>
                    <label>Pas Foto * (jpg/png, maks 10MB)</label>
                    <input type="file" name="pas_foto" class="input" accept="image/jpeg,image/jpg,image/png" required>
                </div>

                <div>
                    <label>CV * (PDF, maks 10MB)</label>
                    <input type="file" name="cv" class="input" accept="application/pdf" required>
                </div>

                <div>
                    <label>Essay * (PDF, maks 10MB)</label>
                    <input type="file" name="essay" class="input" accept="application/pdf" required>
                </div>
            </div>

            <div class="button-group between" style="margin-top: 25px;">
                <a href="{{ route('user.dashboard') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

---
## 🎨 Styling (CSS) - *Tidak ada perubahan*

<style>
body {
    background: #f5f6fa;
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 900px;
    margin: 50px auto;
    padding: 0 20px;
}
.form-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border-top: 6px solid #1d4ed8;
}
.form-title {
    text-align: center;
    color: #1d4ed8;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 10px;
}
.form-subtitle {
    text-align: center;
    color: #555;
    margin-bottom: 30px;
    font-size: 14px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

.grid > div {
    display: flex;
    flex-direction: column;
}

.grid label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 6px;
    font-size: 14px;
}

.input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 14px;
    transition: all 0.2s ease;
    background: white;
}

.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}

.input::placeholder {
    color: #9ca3af;
}

.input[type="file"] {
    padding: 10px;
    cursor: pointer;
}

.input[type="file"]::file-selector-button {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 16px;
    margin-right: 12px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    transition: all 0.2s ease;
}

.input[type="file"]::file-selector-button:hover {
    background: #e5e7eb;
}

.btn-primary, .btn-secondary {
    border: none;
    border-radius: 8px;
    padding: 12px 28px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 15px;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: #1d4ed8;
    color: white;
}
.btn-primary:hover {
    background: #1e40af;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
}

.btn-secondary {
    background: #9ca3af;
    color: white;
}
.btn-secondary:hover {
    background: #6b7280;
    transform: translateY(-1px);
}

.button-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Responsive */
@media (max-width: 768px) {
    .form-card {
        padding: 30px 20px;
    }
    
    .form-title {
        font-size: 24px;
    }
    
    .grid {
        grid-template-columns: 1fr;
    }
    
    .button-group {
        flex-direction: column-reverse;
        gap: 10px;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        text-align: center;
    }
}

/* Alert Styles */
.bg-red-100 {
    background-color: #fee2e2;
    border: 1px solid #fecaca;
}

.text-red-700 {
    color: #b91c1c;
}

.list-disc {
    list-style-type: disc;
}

.pl-5 {
    padding-left: 1.25rem;
}

.p-3 {
    padding: 0.75rem;
}

.rounded {
    border-radius: 0.5rem;
}

.mb-4 {
    margin-bottom: 1rem;
}
</style>

---
## ⚙️ JavaScript untuk Logika "Lainnya"

<div class="modal fade" id="syaratModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 14px;">

            <div class="modal-header" style="border-bottom: 1px solid #e5e7eb;">
                <h5 class="modal-title" style="color: #1d4ed8; font-weight: 600;">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Syarat Pendaftaran Satgas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="padding: 24px;">
                <ul style="list-style-type: disc; padding-left: 24px; color: #374151; line-height: 1.8;">
                    <li>Mahasiswa aktif Politeknik Negeri Subang</li>
                    <li>IPK minimal <strong>3.50</strong></li>
                    <li>Melampirkan pas foto terbaru (format JPG/PNG)</li>
                    <li>Melampirkan CV (Curriculum Vitae) dalam format PDF</li>
                    <li>Melampirkan essay dalam format PDF</li>
                    <li>Mengisi data dengan jujur dan benar</li>
                    <li>Bersedia mengikuti seluruh tahapan seleksi</li>
                </ul>
            </div>

            <div class="modal-footer" style="border-top: 1px solid #e5e7eb;">
                <button class="btn btn-primary" data-bs-dismiss="modal" style="padding: 10px 24px;">
                    <i class="bi bi-check-circle me-2"></i>
                    Paham
                </button>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tampilkan Modal Syarat
        var modalElement = document.getElementById('syaratModal');
        if (modalElement) {
            var modal = new bootstrap.Modal(modalElement);
            modal.show();
        }

        // --- Fungsi Utama (Handling Jurusan & Prodi) ---
        function initializeDynamicInput(selectId, containerId, inputName, placeholderText) {
            const selectElement = document.getElementById(selectId);
            const container = document.getElementById(containerId);

            if (!selectElement || !container) return;

            // Variabel untuk menyimpan input teks yang dibuat secara dinamis (dibuat hanya sekali)
            let dynamicInput = null;

            function replaceWithTextInput(initialValue = '') {
                // 1. Buat input teks baru jika belum ada
                if (!dynamicInput) {
                    dynamicInput = document.createElement('input');
                    dynamicInput.setAttribute('type', 'text');
                    dynamicInput.setAttribute('id', selectId); // ID sama
                    dynamicInput.setAttribute('required', 'required');
                    dynamicInput.setAttribute('placeholder', placeholderText);
                    dynamicInput.setAttribute('class', selectElement.className);
                }

                // 2. Set nilai jika ada nilai awal (dari old() atau isian user)
                dynamicInput.value = initialValue;

                // 3. Ganti elemen select dengan input teks
                // Pastikan input teks memiliki name yang sama dengan select agar terkirim ke backend
                if (container.querySelector('select#' + selectId)) {
                    container.replaceChild(dynamicInput, selectElement);
                }
                dynamicInput.setAttribute('name', inputName); 
                dynamicInput.focus();
            }
            
            // --- Penanganan Old Value Saat Load ---
            const initialOldValue = selectElement.getAttribute('data-old-value'); // Akan kita ambil dari Blade

            // Cek apakah ada nilai lama yang diisi (setelah error validasi)
            if (initialOldValue) {
                // Cari apakah nilai lama ada di opsi standar
                let found = Array.from(selectElement.options).some(opt => opt.value === initialOldValue);

                if (!found) {
                    // Jika nilai ada tapi tidak di opsi standar, berarti itu isian manual.
                    // Langsung ganti ke input teks saat load.
                    replaceWithTextInput(initialOldValue);
                } else {
                    // Jika nilai ditemukan di opsi standar, set nilai select
                    selectElement.value = initialOldValue;
                }
            }


            // --- Event Listener ---
            selectElement.addEventListener('change', function() {
                if (this.value === 'Lainnya') {
                    // Jika memilih "Lainnya", ganti ke input teks
                    replaceWithTextInput(''); // Nilai awal kosong
                }
            });
        }

        // Karena kita tidak bisa mendapatkan old() di JS dengan pasti di luar PHP,
        // kita tambahkan data-old-value di Blade agar JS bisa membacanya.

        // Jurusan Setup
        const jurusanSelect = document.getElementById('jurusan-select');
        jurusanSelect.setAttribute('data-old-value', '{{ old("jurusan") }}');
        initializeDynamicInput('jurusan-select', 'jurusan-group', 'jurusan', 'Masukkan Jurusan Anda');

        // Prodi Setup
        const prodiSelect = document.getElementById('prodi-select');
        prodiSelect.setAttribute('data-old-value', '{{ old("prodi") }}');
        initializeDynamicInput('prodi-select', 'prodi-group', 'prodi', 'Masukkan Program Studi Anda');
    });
</script>

@endsection