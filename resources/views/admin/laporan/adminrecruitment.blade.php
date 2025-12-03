@extends('layouts.app')

@section('content')

<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Pelamar</h1>

    {{-- Pesan sukses --}}
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
            @foreach($pelamars as $pelamar)
            <tr class="text-center">
                <td class="p-2 border">{{ $loop->iteration }}</td>
                <td class="p-2 border">{{ $pelamar->nama }}</td>
                <td class="p-2 border">{{ $pelamar->nim }}</td>
                <td class="p-2 border">{{ $pelamar->jurusan }}</td>
                <td class="p-2 border">{{ $pelamar->prodi }}</td>
                <td class="p-2 border">{{ $pelamar->ipk_terakhir }}</td>
                <td class="p-2 border">{{ $pelamar->no_wa }}</td>
                <td class="p-2 border text-blue-600 underline">
                    <a href="{{ asset('storage/' . $pelamar->cv) }}" target="_blank">Lihat CV</a>
                </td>
                <td class="p-2 border text-blue-600 underline">
                    <a href="{{ asset('storage/' . $pelamar->essay) }}" target="_blank">Lihat Essay</a>
                </td>
                <td class="p-2 border text-blue-600 underline">
                    <a href="{{ asset('storage/' . $pelamar->pas_foto) }}" target="_blank">Lihat Foto</a>
                </td>

                {{-- 🔽 Dropdown ubah status --}}
                <td class="p-2 border">
                    <form action="{{ route('adminrecruitment.updateStatus', $pelamar->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                            <option value="Seleksi" {{ $pelamar->status == 'Seleksi' ? 'selected' : '' }}>Seleksi</option>
                            <option value="Lolos Wawancara" {{ $pelamar->status == 'Lolos Wawancara' ? 'selected' : '' }}>Lolos Wawancara</option>
                            <option value="Diterima" {{ $pelamar->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $pelamars->links() }}
    </div>
</div>
@endsection
