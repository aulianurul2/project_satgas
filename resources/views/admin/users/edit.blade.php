@extends('layouts.app')

@section('content')

{{-- Tambahkan styling kustom agar seragam dengan form User --}}
<style>
    /* Styling dasar input dan textarea */
    .form-input-custom {
        width: 100%;
        padding: 12px;
        margin-top: 4px;
        border: 1px solid #d1d5db; /* gray-300 */
        border-radius: 8px; /* Lebih rounded */
        box-sizing: border-box;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-input-custom:focus {
        border-color: #3b82f6; /* blue-500 */
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2); /* Ring focus biru muda */
    }

    /* Styling Tombol Primary */
    .btn-primary-custom {
        display: inline-block;
        padding: 10px 24px;
        background-color: #1d4ed8; /* blue-700 (Sesuaikan dengan warna tema Member/Recruitment sebelumnya jika mau, atau emerald seperti user) */
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.1s;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }

    .btn-primary-custom:hover {
        background-color: #1e40af; /* blue-800 */
        transform: translateY(-1px);
    }

    /* Styling Tombol Secondary */
    .btn-secondary-custom {
        display: inline-block;
        padding: 10px 24px;
        background-color: #f3f4f6; /* gray-100 */
        color: #374151; /* gray-700 */
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s;
        text-decoration: none;
        margin-right: 10px;
        border: 1px solid #d1d5db;
    }

    .btn-secondary-custom:hover {
        background-color: #e5e7eb; /* gray-200 */
        color: #111827;
    }
</style>

<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8 max-w-3xl">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="p-4 mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Notifikasi Error Global --}}
    @if ($errors->any())
        <div class="p-4 mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-sm">
            <p class="font-bold mb-1">Terjadi Kesalahan</p>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-2xl rounded-xl p-8 border-t-4 border-blue-700">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-4">
            <span class="text-blue-700">👤</span> {{ isset($member) ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}
        </h2>

        <form action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}" method="POST">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif

            {{-- Grid Baris 1: Nama & NIM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $member->nama ?? '') }}" 
                        class="form-input-custom @error('nama') border-red-500 @enderror" 
                        placeholder="Nama Lengkap" required>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nim_nip" class="block text-sm font-medium text-gray-700 mb-1">NIM / NIP *</label>
                    <input type="text" id="nim_nip" name="nim_nip" value="{{ old('nim_nip', $member->nim_nip ?? '') }}" 
                        class="form-input-custom @error('nim_nip') border-red-500 @enderror" 
                        placeholder="NIM atau NIP" required>
                    @error('nim_nip') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Grid Baris 2: Jabatan & Divisi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" 
                        class="form-input-custom @error('jabatan') border-red-500 @enderror" 
                        placeholder="Contoh: Staff">
                </div>
                <div>
                    <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                    <input type="text" id="divisi" name="divisi" value="{{ old('divisi', $member->divisi ?? '') }}" 
                        class="form-input-custom @error('divisi') border-red-500 @enderror" 
                        placeholder="Contoh: Humas">
                </div>
            </div>

            {{-- Grid Baris 3: Kontak & Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">Kontak (No. HP/WA)</label>
                    <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $member->kontak ?? '') }}" 
                        class="form-input-custom @error('kontak') border-red-500 @enderror" 
                        placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label for="aktif" class="block text-sm font-medium text-gray-700 mb-1">Status Keanggotaan</label>
                    <select id="aktif" name="aktif" class="form-input-custom">
                        <option value="1" {{ old('aktif', $member->aktif ?? 1) == 1 ? 'selected' : '' }}>🟢 Aktif</option>
                        <option value="0" {{ old('aktif', $member->aktif ?? 1) == 0 ? 'selected' : '' }}>🔴 Nonaktif</option>
                    </select>
                </div>
            </div>

            {{-- Baris 4: Alamat (Full Width) --}}
            <div class="mb-8">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" 
                    class="form-input-custom @error('alamat') border-red-500 @enderror" 
                    placeholder="Masukkan alamat lengkap domisili">{{ old('alamat', $member->alamat ?? '') }}</textarea>
                @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end pt-6 border-t border-gray-100">
                <a href="{{ route('admin.members.index') }}" class="btn-secondary-custom">
                    Kembali
                </a>
                <button type="submit" class="btn-primary-custom">
                    {{ isset($member) ? '💾 Simpan Perubahan' : '💾 Simpan Data' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection