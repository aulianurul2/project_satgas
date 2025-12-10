@extends('layouts.app')

@section('content')

{{-- Pastikan variabel $pendaftaranAktif dan $pelamars tersedia di controller yang memanggil view ini --}}

<div class="container mx-auto py-8 px-4">

    {{-- Header & Title (MODIFIED: Blue Background Wraps Everything) --}}
    <div class="bg-blue-800 rounded-lg shadow-md border border-blue-700 p-8 mb-8 text-white">
        <div class="flex flex-col md:flex-row justify-between items-center">
            
            {{-- Bagian Kiri: Judul & Deskripsi --}}
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold mb-2">
                    Daftar Pelamar
                </h1>
                <p class="text-blue-100 text-lg">
                    Manajemen data pelamar, berkas, dan proses seleksi anggota baru.
                </p>
            </div>

            {{-- Bagian Kanan: Bisa diisi info tambahan jika perlu, saat ini dikosongkan agar rapi --}}
            <div></div>

        </div>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- A. KOTAK STATUS & TOMBOL TOGGLE --}}
    <div class="p-6 rounded-xl shadow-lg mb-8 transition-colors duration-300 
        {{ $pendaftaranAktif ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500' }}">

        <div class="flex items-center justify-between flex-wrap">
            <div class="flex items-center">
                {{-- Ikon Status --}}
                @if($pendaftaranAktif)
                    <svg class="w-8 h-8 text-green-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @else
                    <svg class="w-8 h-8 text-red-600 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
                
                <div>
                    <p class="text-sm font-medium text-gray-600">Status Pendaftaran:</p>
                    <h3 class="text-xl font-bold {{ $pendaftaranAktif ? 'text-green-800' : 'text-red-800' }}">
                        {{ $pendaftaranAktif ? 'AKTIF (Tersedia untuk Pendaftar)' : 'TIDAK AKTIF (Ditutup)' }}
                    </h3>
                </div>
            </div>

            <form action="{{ route('admin.recruitment.toggle') }}" method="POST" class="mt-4 md:mt-0">
                @csrf
                <button type="submit" name="action" value="{{ $pendaftaranAktif ? 'close' : 'open' }}"
                    class="px-5 py-2 rounded-full font-semibold shadow-md transition-all duration-300 ease-in-out flex items-center
                    {{ $pendaftaranAktif 
                        ? 'bg-red-600 hover:bg-red-700 text-white transform hover:scale-105' 
                        : 'bg-green-600 hover:bg-green-700 text-white transform hover:scale-105' }}">
                    
                    @if($pendaftaranAktif)
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        Tutup Pendaftaran
                    @else
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Buka Pendaftaran
                    @endif
                </button>
            </form>
        </div>
    </div>

    {{-- B. FILTER TANGGAL --}}
    <div class="bg-white p-6 rounded-xl shadow-md mb-8 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Filter Data Berdasarkan Tanggal
        </h3>
        <form method="GET" action="{{ url()->current() }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            
            <div class="col-span-1">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" 
                    value="{{ request('start_date') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="col-span-1">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" 
                    value="{{ request('end_date') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div class="col-span-1 flex space-x-2">
                <button type="submit" 
                    class="flex-shrink-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-md transition duration-150 ease-in-out">
                    Filter
                </button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ url()->current() }}" 
                        class="flex-shrink-0 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md shadow-md transition duration-150 ease-in-out text-center">
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>
    
    {{-- C. TABEL DATA PELAMAR --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIM</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jurusan/Prodi</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IPK</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No WA</th>
                    <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Berkas</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Pendaftaran
                    </th>
                    <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="p-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Ubah Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pelamars as $index => $pelamar)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $pelamars->firstItem() + $index }}</td>
                    <td class="p-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pelamar->nama }}</td>
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $pelamar->nim }}</td>
                    <td class="p-3 whitespace-normal text-sm text-gray-500">{{ $pelamar->jurusan }} / {{ $pelamar->prodi }}</td>
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $pelamar->ipk_terakhir }}</td>
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">{{ $pelamar->no_wa }}</td>
                    
                    {{-- Berkas --}}
                    <td class="p-3 whitespace-nowrap text-center text-sm">
                        <div class="flex flex-col gap-1 items-center">
                            <a href="{{ asset('storage/' . $pelamar->cv) }}" target="_blank" class="text-blue-500 hover:text-blue-700 font-medium text-xs hover:underline">CV</a>
                            <a href="{{ asset('storage/' . $pelamar->essay) }}" target="_blank" class="text-blue-500 hover:text-blue-700 font-medium text-xs hover:underline">Essay</a>
                            <a href="{{ asset('storage/' . $pelamar->pas_foto) }}" target="_blank" class="text-blue-500 hover:text-blue-700 font-medium text-xs hover:underline">Foto</a>
                        </div>
                    </td>
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">
                        {{ $pelamar->created_at ? $pelamar->created_at->format('d M Y') : '-' }}
                    </td>

                    <td class="p-3 whitespace-nowrap text-center">
                        @php
                            $badge_class = 'bg-gray-200 text-gray-700';
                            if ($pelamar->status == 'Seleksi') {
                                $badge_class = 'bg-yellow-100 text-yellow-800';
                            } elseif ($pelamar->status == 'Lolos Wawancara') {
                                $badge_class = 'bg-blue-100 text-blue-800';
                            } elseif ($pelamar->status == 'Diterima') {
                                $badge_class = 'bg-green-100 text-green-800 font-bold';
                            } elseif ($pelamar->status == 'Ditolak') {
                                $badge_class = 'bg-red-100 text-red-800';
                            }
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge_class }}">
                            {{ $pelamar->status }}
                        </span>
                    </td>
                    
                    <td class="p-3 whitespace-nowrap text-sm text-gray-500">
                        <form action="{{ route('adminrecruitment.updateStatus', $pelamar->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg shadow-sm px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Seleksi" {{ $pelamar->status == 'Seleksi' ? 'selected' : '' }}>Seleksi</option>
                                <option value="Lolos Wawancara" {{ $pelamar->status == 'Lolos Wawancara' ? 'selected' : '' }}>Lolos Wawancara</option>
                                <option value="Diterima" {{ $pelamar->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ $pelamar->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Pagination --}}
        @if($pelamars->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $pelamars->firstItem() }} sampai {{ $pelamars->lastItem() }} dari total {{ $pelamars->total() }} pelamar
            </p>
            <div>
                {{ $pelamars->links() }}
            </div>
        </div>
        @endif
    </div>

</div>

@endsection