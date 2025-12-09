@extends('layouts.app')

@section('content')

{{-- Tambahkan styling kustom untuk mempercantik form --}}
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

    /* Styling khusus untuk input yang disabled/read-only */
    .form-input-disabled {
        background-color: #f3f4f6; /* gray-100 */
        color: #6b7280; /* gray-500 */
        cursor: not-allowed;
    }

    /* Styling Tombol Primary */
    .btn-primary-custom {
        display: inline-block;
        padding: 10px 20px;
        background-color: #10b981; /* emerald-500 */
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }

    .btn-primary-custom:hover {
        background-color: #059669; /* emerald-600 */
    }

    /* Styling Tombol Secondary */
    .btn-secondary-custom {
        display: inline-block;
        padding: 10px 20px;
        background-color: #6b7280; /* gray-500 */
        color: white;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s;
        text-decoration: none;
        margin-left: 10px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary-custom:hover {
        background-color: #4b5563; /* gray-600 */
    }

</style>


<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 max-w-2xl">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="p-4 mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <div class="p-4 mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif


    <div class="bg-white shadow-2xl rounded-xl p-8">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3">
            <span class="text-indigo-600">📝</span> Edit Data User
        </h2>

        <form action="{{ route('admin.users.update', $user->idUser) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-5">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" 
                    class="form-input-custom @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                    class="form-input-custom @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kontak --}}
            <div class="mb-5">
                <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">Kontak (No. Telp)</label>
                <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $user->kontak) }}" 
                    class="form-input-custom @error('kontak') border-red-500 @enderror">
                @error('kontak')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-5">
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" 
                    class="form-input-custom @error('alamat') border-red-500 @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Jenis User --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis User</label>

                @if (isset(auth()->user()->idUser) && $user->idUser == auth()->user()->idUser)
                    {{-- Admin tidak bisa mengedit jenis user dirinya sendiri --}}
                    <input type="text" 
                        class="form-input-custom form-input-disabled" 
                        value="{{ ucfirst($user->jenisUser) }} (Anda)" disabled>
                    
                    {{-- Hidden field untuk memastikan jenisUser tetap terkirim saat disubmit --}}
                    <input type="hidden" name="jenisUser" value="{{ $user->jenisUser }}">
                    
                    <small class="text-yellow-600 mt-2 block">
                        💡 Anda tidak dapat mengubah jenis user Anda sendiri saat ini.
                    </small>
                @else
                  <select name="jenisUser" class="form-input-custom">
                    <option value="admin" {{ $user->jenisUser == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="minor_admin" {{ $user->jenisUser == 'minor_admin' ? 'selected' : '' }}>Minor Admin</option>
                    <option value="user" {{ $user->jenisUser == 'user' ? 'selected' : '' }}>User Biasa</option>
                </select>

                @endif
            </div>

            <hr class="my-6 border-gray-200">
            
            {{-- Password Baru (Opsional) --}}
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Ubah Password (Opsional)</h3>
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" id="password" name="password"
                    class="form-input-custom @error('password') border-red-500 @enderror"
                    placeholder="Kosongkan jika tidak ingin mengubah password">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-input-custom @error('password_confirmation') border-red-500 @enderror"
                    placeholder="Ulangi password baru">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tombol Aksi --}}
            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary-custom">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary-custom">
                    Kembali ke Daftar
                </a>
            </div>

        </form>

    </div>

</div>

@endsection