@extends('layouts.app')

@section('content')

{{-- Tambahkan styling untuk textarea agar seragam dengan input --}}
<style>
    /* Menargetkan textarea yang tidak memiliki kelas tailwind yang memadai dari form-control */
    .form-control {
        width: 100%;
        border: 1px solid #d1d5db; /* gray-300 */
        border-radius: 0.5rem; /* rounded-lg */
        padding: 0.5rem 0.75rem; /* px-3 py-2 */
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus {
        border-color: #4f46e5; /* indigo-600 */
        outline: 0;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5); /* Ring focus indigo */
    }
</style>


<div class="container mx-auto py-10 px-4 sm:px-6 lg:px-8 max-w-2xl">
    
    {{-- Card Form Utama --}}
    <div class="bg-white shadow-2xl rounded-xl p-6 sm:p-10 border border-gray-100">
        
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-4">
            <span class="text-indigo-600">👤</span> {{ isset($member) ? 'Edit Data Anggota' : 'Tambah Anggota Baru' }}
        </h1>

        <form action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}" method="POST" class="space-y-6">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif
            
            {{-- Pesan Sukses/Error (Jika ada) --}}
            @if(session('success'))
                <div class="p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $member->nama ?? '') }}" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('jabatan') border-red-500 @enderror">
                @error('jabatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kontak --}}
            <div>
                <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">Kontak (No. Telp)</label>
                <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $member->kontak ?? '') }}" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('kontak') border-red-500 @enderror">
                @error('kontak')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Divisi --}}
            <div>
                <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                <input type="text" id="divisi" name="divisi" value="{{ old('divisi', $member->divisi ?? '') }}" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('divisi') border-red-500 @enderror">
                @error('divisi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIM / NIP --}}
            <div>
                <label for="nim_nip" class="block text-sm font-medium text-gray-700 mb-1">NIM / NIP</label>
                <input type="text" id="nim_nip" name="nim_nip" value="{{ old('nim_nip', $member->nim_nip ?? '') }}" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('nim_nip') border-red-500 @enderror">
                @error('nim_nip')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Status --}}
            <div>
                <label for="aktif" class="block text-sm font-medium text-gray-700 mb-1">Status Keanggotaan</label>
                <select id="aktif" name="aktif" 
                    class="w-full border rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('aktif') border-red-500 @enderror">
                    <option value="1" {{ old('aktif', $member->aktif ?? 1) == 1 ? 'selected' : '' }}>🟢 Aktif</option>
                    <option value="0" {{ old('aktif', $member->aktif ?? 1) == 0 ? 'selected' : '' }}>🔴 Nonaktif</option>
                </select>
                @error('aktif')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3"
                    placeholder="Alamat lengkap anggota saat ini">{{ old('alamat', $member->alamat ?? '') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <hr class="mt-8 border-gray-200">

            {{-- Tombol Aksi --}}
            <div class="flex justify-end space-x-3 pt-4">
                
                {{-- Tombol Kembali/Batal (Asumsi ada rute index) --}}
                <a href="{{ route('admin.members.index') }}" class="inline-flex items-center px-5 py-2.5 text-base font-medium rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150 ease-in-out shadow-md">
                    Batal
                </a>
                
                {{-- Tombol Submit --}}
                <button type="submit" class="inline-flex items-center px-6 py-2.5 text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 transition duration-150 ease-in-out shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ isset($member) ? 'Simpan Perubahan' : 'Tambah Anggota' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection