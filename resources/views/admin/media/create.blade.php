@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Notifikasi Error Validation (Opsional, untuk berjaga-jaga) --}}
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
        <h1 class="form-title">Tambah Media Baru</h1>
        <p class="form-subtitle">Silakan isi detail artikel atau berita yang ingin dipublikasikan.</p>

        <form action="{{ route('admin.media.store') }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf

            {{-- Grid Layout --}}
            <div class="grid">
                
                {{-- Judul --}}
                <div style="grid-column: 1 / -1;">
                    <label>Judul *</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="input" placeholder="Masukkan judul artikel" required>
                </div>

                {{-- Kategori --}}
                <div>
                    <label>Kategori *</label>
                    <select name="kategori" class="input" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Gambar --}}
                <div>
                    <label>Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="input" accept="image/*">
                </div>

                {{-- Isi (Textarea Full Width) --}}
                <div style="grid-column: 1 / -1;">
                    <label>Isi Konten *</label>
                    <textarea name="isi" rows="8" class="input" placeholder="Tuliskan isi artikel di sini..." required>{{ old('isi') }}</textarea>
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="button-group between" style="margin-top: 25px;">
                <a href="{{ route('admin.media.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Media</button>
            </div>
        </form>
    </div>
</div>

{{-- 🎨 Styling CSS (Sama persis dengan Form Recruitment) --}}
<style>
/* Base Layout */
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
    border-top: 6px solid #1d4ed8; /* Blue Top Border */
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

/* Grid System */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
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
    box-sizing: border-box; /* Mencegah padding merusak width */
}
.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}
.input::placeholder {
    color: #9ca3af;
}

/* Textarea specific */
textarea.input {
    resize: vertical;
    line-height: 1.5;
}

/* File Input Styling */
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
    .form-title { font-size: 24px; }
    .grid { grid-template-columns: 1fr; }
    .button-group {
        flex-direction: column-reverse;
        gap: 10px;
    }
    .btn-primary, .btn-secondary { width: 100%; }
}
</style>
@endsection