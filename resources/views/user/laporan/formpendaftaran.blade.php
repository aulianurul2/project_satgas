@extends('layouts.app') {{-- layout utama --}}

@section('content')

<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow" style="width: 480px;">
        <div class="card-body">
            <h4 class="text-center mb-3">Form Pendaftaran Recruitment</h4>

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="text-danger text-center small mb-4">
                *(Wajib diisi!)* — indicated required field!
            </p>

            <form action="{{ route('formpendaftaran.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" placeholder="Nama Lengkap*" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="nim" value="{{ old('nim') }}" class="form-control" placeholder="NIM*" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="form-control" placeholder="Jurusan*" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="prodi" value="{{ old('prodi') }}" class="form-control" placeholder="Prodi*" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="ipk_terakhir" value="{{ old('ipk_terakhir') }}" class="form-control" placeholder="IPK Terakhir (misal: 3.75)*" required>
                </div>

                <div class="mb-3">
                    <input type="text" name="no_wa" value="{{ old('no_wa') }}" class="form-control" placeholder="Nomor WhatsApp Aktif*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pas Foto* (jpg/png, maks 2MB)</label>
                    <input type="file" name="pas_foto" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">CV* (PDF, maks 2MB)</label>
                    <input type="file" name="cv" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Essay* (PDF, maks 2MB)</label>
                    <input type="file" name="essay" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection