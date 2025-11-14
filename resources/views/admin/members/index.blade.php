@extends('layouts.app')

@section('content')

<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Kelola Anggota</h1>

    <a href="{{ route('admin.members.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Anggota</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Jabatan</th>
                <th class="p-2 border">Kontak</th>
                <th class="p-2 border">Divisi</th>
                <th class="p-2 border">NIM/NIP</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr class="text-center">
                <td class="p-2 border">{{ $loop->iteration }}</td>
                <td class="p-2 border">{{ $member->nama }}</td>
                <td class="p-2 border">{{ $member->divisi }}</td>
                <td class="p-2 border">{{ $member->nim_nip }}</td>
                <td class="p-2 border">{{ $member->jabatan }}</td>
                <td class="p-2 border">{{ $member->kontak }}</td>
                <td class="p-2 border">
                    @if($member->aktif)
                        <span class="text-green-600 font-semibold">Aktif</span>
                    @else
                        <span class="text-red-600 font-semibold">Nonaktif</span>
                    @endif
                </td>
                <td class="p-2 border">
                    <a href="{{ route('admin.members.edit', $member) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus member ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection
