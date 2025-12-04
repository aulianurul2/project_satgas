@extends('layouts.app')

@section('content')
<!-- Import Font Poppins (Jika belum ada di layout utama) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<div class="container">
    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <h1 class="form-title">{{ isset($member) ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}</h1>
        <p class="form-subtitle">
            Silakan lengkapi formulir di bawah ini untuk {{ isset($member) ? 'memperbarui data' : 'menambahkan' }} anggota.
        </p>

        <form action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}" method="POST">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif

            {{-- Grid Layout untuk baris pertama --}}
            <div class="grid">
                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $member->nama ?? '') }}" class="input" placeholder="Masukkan nama lengkap" required>
                </div>
                <div>
                    <label class="form-label">NIM / NIP</label>
                    <input type="text" name="nim_nip" value="{{ old('nim_nip', $member->nim_nip ?? '') }}" class="input" placeholder="Nomor Induk" required>
                </div>
            </div>

            {{-- Grid Layout untuk baris kedua --}}
            <div class="grid" style="margin-top: 20px;">
                <div>
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" class="input" placeholder="Contoh: Ketua, Staff, dll">
                </div>
                <div>
                    <label class="form-label">Divisi</label>
                    <input type="text" name="divisi" value="{{ old('divisi', $member->divisi ?? '') }}" class="input" placeholder="Nama Divisi">
                </div>
            </div>

            {{-- Grid Layout untuk baris ketiga --}}
            <div class="grid" style="margin-top: 20px;">
                <div>
                    <label class="form-label">Kontak (HP/WA)</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $member->kontak ?? '') }}" class="input" placeholder="08...">
                </div>
                <div>
                    <label class="form-label">Status Keaktifan</label>
                    <select name="aktif" class="input">
                        <option value="1" {{ old('aktif', $member->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('aktif', $member->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="input" rows="3" placeholder="Alamat domisili anggota">{{ old('alamat', $member->alamat ?? '') }}</textarea>
            </div>

            <div class="button-group right">
                {{-- Tombol Kembali (Opsional, menggunakan JS back) --}}
                <button type="button" onclick="history.back()" class="btn-secondary">Batal</button>
                
                <button type="submit" class="btn-primary">
                    {{ isset($member) ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Base Styles */
body {
    background: #f5f6fa;
    font-family: 'Poppins', sans-serif;
}

.container {
    max-width: 800px; /* Sedikit lebih kecil dari form laporan agar pas */
    margin: 50px auto;
    padding: 0 15px;
}

/* Card Style */
.form-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.05);
    border-top: 6px solid #1d4ed8; /* Warna Biru Utama */
}

/* Typography */
.form-title {
    text-align: center;
    color: #1d4ed8;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 10px;
}

.form-subtitle {
    text-align: center;
    color: #6b7280;
    margin-bottom: 35px;
    font-size: 14px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #374151;
    font-size: 14px;
}

/* Alert Error */
.alert-error {
    background-color: #fee2e2;
    color: #b91c1c;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #fca5a5;
}

/* Layouting */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.field {
    margin-top: 20px;
}

/* Inputs */
.input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #f9fafb;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.input:focus {
    outline: none;
    border-color: #2563eb;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

textarea.input {
    resize: vertical;
}

/* Buttons */
.button-group {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.button-group.right {
    justify-content: flex-end;
}

.btn-primary, .btn-secondary {
    border: none;
    border-radius: 8px;
    padding: 12px 28px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    font-family: 'Poppins', sans-serif;
}

.btn-primary {
    background: #1d4ed8;
    color: white;
    box-shadow: 0 4px 6px -1px rgba(29, 78, 216, 0.3);
}

.btn-primary:hover {
    background: #1e40af;
    transform: translateY(-1px);
    box-shadow: 0 6px 8px -1px rgba(29, 78, 216, 0.4);
}

.btn-secondary {
    background: #e5e7eb;
    color: #374151;
}

.btn-secondary:hover {
    background: #d1d5db;
    color: #111827;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .form-card {
        padding: 25px;
    }
    .grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    .button-group {
        flex-direction: column-reverse;
    }
    .btn-primary, .btn-secondary {
        width: 100%;
    }
}
</style>
@endsection