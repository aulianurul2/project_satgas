@extends('layouts.app')

@section('content')
<div class="container">
    
    {{-- Notifikasi Error Validation --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:10px; border-radius:5px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-card">
        <h1 class="form-title">{{ isset($member) ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}</h1>
        <p class="form-subtitle">
            Silakan lengkapi data anggota di bawah ini.
        </p>

        <form action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}" method="POST">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif

            {{-- Grid Baris 1: Nama & NIM --}}
            <div class="grid">
                <div>
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $member->nama ?? '') }}" class="input" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div>
                    <label>NIM / NIP *</label>
                    <input type="text" name="nim_nip" value="{{ old('nim_nip', $member->nim_nip ?? '') }}" class="input" placeholder="Masukkan NIM atau NIP" required>
                </div>
            </div>

            {{-- Grid Baris 2: Jabatan & Divisi --}}
            <div class="grid" style="margin-top: 20px;">
                <div>
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" class="input" placeholder="Contoh: Staff, Kepala Divisi">
                </div>
                <div>
                    <label>Divisi</label>
                    <input type="text" name="divisi" value="{{ old('divisi', $member->divisi ?? '') }}" class="input" placeholder="Contoh: IT, Humas">
                </div>
            </div>

            {{-- Grid Baris 3: Kontak & Status --}}
            <div class="grid" style="margin-top: 20px;">
                <div>
                    <label>Kontak (No. HP/WA)</label>
                    <input type="text" name="kontak" value="{{ old('kontak', $member->kontak ?? '') }}" class="input" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label>Status Keanggotaan</label>
                    <select name="aktif" class="input">
                        <option value="1" {{ old('aktif', $member->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('aktif', $member->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            {{-- Baris 4: Alamat (Full Width) --}}
            <div style="margin-top: 20px;">
                <label style="display:block; margin-bottom:6px; font-weight:500; color:#374151; font-size:14px;">Alamat</label>
                <textarea name="alamat" class="input" rows="3" placeholder="Masukkan alamat lengkap domisili">{{ old('alamat', $member->alamat ?? '') }}</textarea>
            </div>

            {{-- Tombol Aksi --}}
            <div class="button-group between" style="margin-top: 30px;">
                {{-- Tombol Kembali --}}
                <a href="{{ route('admin.members.index') }}" class="btn-secondary">Kembali</a>
                
                {{-- Tombol Simpan --}}
                <button type="submit" class="btn-primary">
                    {{ isset($member) ? 'Simpan Perubahan' : 'Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Styling CSS (Konsisten dengan Form Media & Recruitment) --}}
<style>
/* Base Layout */
body {
    background: #f5f6fa;
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 800px; /* Sedikit lebih kecil dari form media agar pas */
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
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 10px;
}
.form-subtitle {
    text-align: center;
    color: #555;
    margin-bottom: 30px;
    font-size: 14px;
}

/* Grid System */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}
.grid > div {
    display: flex;
    flex-direction: column;
}

/* Labels & Inputs */
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
    box-sizing: border-box;
}
.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}
textarea.input {
    resize: vertical;
    line-height: 1.5;
}

/* Buttons */
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
    text-align: center;
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

/* Error Alerts */
.bg-red-100 { background-color: #fee2e2; border: 1px solid #fecaca; }
.text-red-700 { color: #b91c1c; }
.list-disc { list-style-type: disc; }
.pl-5 { padding-left: 1.25rem; }
.p-3 { padding: 0.75rem; }
.rounded { border-radius: 0.5rem; }
.mb-4 { margin-bottom: 1rem; }

/* Responsive */
@media (max-width: 768px) {
    .form-card { padding: 30px 20px; }
    .grid { grid-template-columns: 1fr; }
    .button-group {
        flex-direction: column-reverse;
        gap: 10px;
    }
    .btn-primary, .btn-secondary { width: 100%; }
}
</style>
@endsection