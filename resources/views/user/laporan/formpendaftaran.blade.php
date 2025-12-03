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

            <form action="{{ route('formpendaftaran.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama Lengkap*" required>
                <div>
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="input" required>
                </div>

                <div>
                    <label>NIM *</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" class="input" required>
                </div>

                <div>
                    <label>Jurusan *</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="input" required>
                </div>

                <div>
                    <label>Prodi *</label>
                    <input type="text" name="prodi" value="{{ old('prodi') }}" class="input" required>
                </div>

                <div>
                    <label>IPK Terakhir *</label>
                    <input type="text" name="ipk_terakhir" value="{{ old('ipk_terakhir') }}" class="input" required>
                </div>

                <div>
                    <label>Nomor WhatsApp Aktif *</label>
                    <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="input" required>
                </div>

                <div>
                    <label>Pas Foto * (jpg/png, maks 2MB)</label>
                    <input type="file" name="pas_foto" class="input" required>
                </div>

                <div>
                    <label>CV * (PDF, maks 2MB)</label>
                    <input type="file" name="cv" class="input" required>
                </div>

                <div>
                    <label>Essay * (PDF, maks 2MB)</label>
                    <input type="file" name="essay" class="input" required>
                </div>

            </div>

            <div class="button-group between" style="margin-top: 25px;">
                <a href="{{ route('user.dashboard') }}" class="btn-secondary">Kembali</a>
                <button type="submit" class="btn-primary">Kirim Pendaftaran</button>
            </div>
        </form>
    </div>
</div>

<style>
body {
    background: #f5f6fa;
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 900px;
    margin: 50px auto;
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
}
.form-subtitle {
    text-align: center;
    color: #555;
    margin-bottom: 30px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

.input {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 10px;
    font-size: 14px;
    margin-top: 5px;
}
.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
}

.btn-primary, .btn-secondary {
    border: none;
    border-radius: 6px;
    padding: 10px 24px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.btn-primary {
    background: #1d4ed8;
    color: white;
}
.btn-primary:hover {
    background: #1e40af;
}

.btn-secondary {
    background: #9ca3af;
    color: white;
}
.btn-secondary:hover {
    background: #6b7280;
}

.button-group {
    display: flex;
    justify-content: space-between;
}
</style>

<!-- Modal Syarat -->
<div class="modal fade" id="syaratModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 14px;">

            <div class="modal-header">
                <h5 class="modal-title">Syarat Pendaftaran Satgas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <ul class="list-disc pl-4">
                    <li>Mahasiswa aktif.</li>
                    <li>IPK minimal 2.75.</li>
                    <li>Melampirkan pas foto, CV, dan essay.</li>
                    <li>Mengisi data dengan jujur dan benar.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">
                    Saya Mengerti
                </button>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = new bootstrap.Modal(document.getElementById('syaratModal'));
        modal.show();
    });
</script>

@endsection
