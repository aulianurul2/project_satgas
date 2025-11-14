@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Tambah Media Baru</h1>

    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Judul</label>
            <input type="text" name="judul" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Isi</label>
            <textarea name="isi" rows="5" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select id="kategori" name="kategori" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-4">
            <label class="block text-sm font-semibold mb-2">Gambar (opsional)</label>
            <input type="file" name="gambar" class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.media.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
