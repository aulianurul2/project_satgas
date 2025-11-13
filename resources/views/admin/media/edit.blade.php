@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Media Berita</h1>

        <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $media->judul) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Isi --}}
            <div class="mb-4">
                <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
                <textarea id="isi" name="isi" rows="6"
                          class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('isi', $media->isi) }}</textarea>
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $media->kategori) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Gambar (Opsional)</label>
                @if ($media->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $media->gambar) }}" alt="Gambar Saat Ini"
                             class="h-32 w-auto rounded-md border">
                    </div>
                @endif
                <input type="file" id="gambar" name="gambar"
                       class="w-full text-gray-700 border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('admin.media.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">⬅ Kembali</a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
