@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Kelola Media / Berita</h1>

    <a href="{{ route('admin.media.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Media</a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg p-4">
        <table class="min-w-full text-left text-sm">
            <thead>
                <tr class="border-b">
                    <th class="p-3">Judul</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Gambar</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $item->judul }}</td>
                    <td class="p-3">{{ $item->kategori }}</td>
                    <td class="p-3">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="w-16 h-16 object-cover rounded">
                        @endif
                    </td>
                    <td class="p-3 text-right">
                        <a href="{{ route('admin.media.edit', $item->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus media ini?')" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $media->links() }}
        </div>
    </div>
</div>
@endsection
