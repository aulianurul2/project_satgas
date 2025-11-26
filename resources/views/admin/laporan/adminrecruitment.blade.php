@extends('layouts.app')

@section('content')

<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Pelamar</h1>

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
                <th class="p-2 border">NIM</th>
                <th class="p-2 border">Jurusan</th>
                <th class="p-2 border">Prodi</th>
                <th class="p-2 border">IPK Terakhir</th>
                <th class="p-2 border">No WA</th>
                <th class="p-2 border">CV</th>
                <th class="p-2 border">Essay</th>
                <th class="p-2 border">Pas Foto</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr class="text-center">
                <td class="p-2 border">{{ $loop->iteration }}</td>
                <td class="p-2 border">{{ $member->nama }}</td>
                <td class="p-2 border">{{ $member->nim }}</td>
                <td class="p-2 border">{{ $member->jurusan }}</td>
                <td class="p-2 border">{{ $member->ipk_terakhir }}</td>
                <td class="p-2 border">{{ $member->no_wa }}</td>
                <td class="p-2 border">{{ $member->cv }}</td>
                <td class="p-2 border">{{ $member->essay }}</td>
                <td class="p-2 border">{{ $member->pas_foto }}</td>
                <td class="p-2 border">{{ $member->status }}</td>
                <td class="p-2 border">
                    
                    @if($member->status == 'seleksi')
                        <span class="text-green-600 font-semibold">Seleksi</span>
                    @elseif($member->status == 'lolos_wawancara')
                        <span class="text-blue-600 font-semibold">Lolos Wawancara</span>
                    @elseif($member->status == 'diterima')
                        <span class="text-green-600 font-bold">Di Terima</span>
                    @else
                        <span class="text-gray-600">{{ $member->status }}</span>
                    @endif
                </td>
                {{-- <td class="p-2 border">
                    <a href="{{ route('admin.members.edit', $member) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus member ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 ml-2">Hapus</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection
