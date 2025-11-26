@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">📋 Riwayat Pendaftaran Anda</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Jika tidak ada data --}}
    @if ($pelamars->isEmpty())
        <div class="text-center text-gray-600 py-8">
            Anda belum mengirimkan pendaftaran recruitment.
        </div>
    @else
    {{-- Tabel Data --}}
    <div class="bg-white shadow-md rounded-lg p-4 overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">Nama</th>
                    <th class="border px-4 py-2 text-left">NIM</th>
                    <th class="border px-4 py-2 text-left">Jurusan</th>
                    <th class="border px-4 py-2 text-left">Prodi</th>
                    <th class="border px-4 py-2 text-left">IPK</th>
                    <th class="border px-4 py-2 text-left">No. WA</th>
                    <th class="border px-4 py-2 text-left">CV</th>
                    <th class="border px-4 py-2 text-left">Essay</th>
                    <th class="border px-4 py-2 text-left">Pas Foto</th>
                    <th class="border px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelamars as $index => $p)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $p->nama }}</td>
                        <td class="border px-4 py-2">{{ $p->nim }}</td>
                        <td class="border px-4 py-2">{{ $p->jurusan }}</td>
                        <td class="border px-4 py-2">{{ $p->prodi }}</td>
                        <td class="border px-4 py-2">{{ $p->ipk_terakhir }}</td>
                        <td class="border px-4 py-2">{{ $p->no_wa }}</td>
                        <td class="border px-4 py-2 text-blue-600 underline">
                            <a href="{{ asset('storage/' . $p->cv) }}" target="_blank">Lihat CV</a>
                        </td>
                        <td class="border px-4 py-2 text-blue-600 underline">
                            <a href="{{ asset('storage/' . $p->essay) }}" target="_blank">Lihat Essay</a>
                        </td>
                        <td class="border px-4 py-2 text-blue-600 underline">
                            <a href="{{ asset('storage/' . $p->pas_foto) }}" target="_blank">Lihat Foto</a>
                        </td>
                        <td class="border px-4 py-2">
                            <span class="px-2 py-1 rounded text-white text-sm
                                {{ $p->status === 'Seleksi' ? 'bg-yellow-500' :
                                   ($p->status === 'Lolos Wawancara' ? 'bg-blue-500' : 'bg-green-600') }}">
                                {{ $p->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
