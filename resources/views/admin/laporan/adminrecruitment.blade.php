@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">

    {{-- Header & Title --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Pelamar</h1>
            <p class="text-sm text-gray-500 mt-1">Manajemen data pelamar, berkas, dan proses seleksi.</p>
        </div>
    </div>

<!-- Tombol Toggle Status Pendaftaran --> 
<form action="{{ route('admin.recruitment.toggle') }}" method="POST" style="margin-bottom: 20px;"> 
    @csrf 
    <button type="submit" name="action" value="{{ $pendaftaranAktif ? 'close' : 'open' }}" 
    style="padding: 10px 20px; background-color: #3490dc; color: white; border: none; cursor: pointer;"> 
    {{ $pendaftaranAktif ? 'Tutup Pendaftaran (AKTIF)' : 'Buka Pendaftaran (TIDAK AKTIF)' }} 
    </button> 
</form>

@if(Auth::user()->role === 'admin')
<div class="mt-8 p-4 bg-gray-100 rounded-lg">
    <form action="{{ route('admin.recruitment.toggle') }}" method="POST">
        @csrf
        <button type="submit" name="action" value="{{ $pendaftaranAktif ? 'close' : 'open' }}"
            class="px-4 py-2 rounded {{ $pendaftaranAktif ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">
            {{ $pendaftaranAktif ? 'Undeploy Pendaftaran' : 'Deploy Pendaftaran' }}
        </button>
    </form>
    <p class="mt-2 text-sm text-gray-500">
        Status saat ini: <span class="font-semibold">{{ $pendaftaranAktif ? 'AKTIF' : 'TIDAK AKTIF' }}</span>
    </p>
</div>
@endif

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
            <th class="p-2 border">Ubah Status</th>
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
            <td class="p-2 border">
                @if($pelamar->status == 'Seleksi')
                    <span class="text-green-600 font-semibold">Seleksi</span>
                @elseif($pelamar->status == 'Lolos Wawancara')
                    <span class="text-blue-600 font-semibold">Lolos Wawancara</span>
                @elseif($pelamar->status == 'Diterima')
                    <span class="text-green-600 font-bold">Diterima</span>
                @else
                    <span class="text-gray-600">{{ $pelamar->status }}</span>
                @endif
            </td>
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
   