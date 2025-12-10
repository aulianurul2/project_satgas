@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">

    {{-- Header & Title (Disamakan dengan style Admin) --}}
    <div class="bg-blue-800 rounded-lg shadow-md border border-blue-700 p-8 mb-8 text-white">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:text-left">
                <h1 class="text-3xl font-bold mb-2">
                    Riwayat Pendaftaran
                </h1>
                <p class="text-blue-100 text-lg">
                    Pantau status seleksi dan detail pendaftaran yang telah Anda kirimkan.
                </p>
            </div>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center gap-3" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="font-bold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Konten Utama --}}
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        
        {{-- Header Panel --}}
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Lamaran Anda</h3>
        </div>

        {{-- Jika tidak ada data --}}
        @if ($pelamars->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 px-4 text-center">
                <div class="bg-gray-100 p-4 rounded-full mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Belum ada riwayat pendaftaran</h3>
                <p class="text-gray-500 mt-1 max-w-sm">Anda belum mengirimkan pendaftaran recruitment. Silakan cek halaman recruitment untuk lowongan yang tersedia.</p>
                <a href="{{ url('/') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali ke Beranda
                </a>
            </div>
        @else
            {{-- Tabel Data --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-12">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal & Info</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Akademik</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Berkas Lampiran</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status Terkini</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pelamars as $index => $p)
                            <tr class="hover:bg-blue-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $index + 1 }}
                                </td>
                                
                                {{-- Kolom Info Dasar --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900">{{ $p->nama }}</span>
                                        <span class="text-xs text-gray-500 mb-1">NIM: {{ $p->nim }}</span>
                                        <div class="flex items-center text-xs text-gray-400 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $p->created_at ? $p->created_at->format('d M Y, H:i') : '-' }} WIB
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Akademik --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $p->jurusan }}</div>
                                    <div class="text-xs text-gray-500">{{ $p->prodi }}</div>
                                    <div class="mt-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        IPK: {{ $p->ipk_terakhir }}
                                    </div>
                                </td>

                                {{-- Kolom Berkas (Dibuat tombol/icon agar rapi) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ asset('storage/' . $p->cv) }}" target="_blank" class="group flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-600 hover:text-white transition" title="Lihat CV">
                                            <span class="text-xs font-bold">CV</span>
                                        </a>
                                        <a href="{{ asset('storage/' . $p->essay) }}" target="_blank" class="group flex items-center justify-center w-8 h-8 bg-purple-50 text-purple-600 rounded-lg border border-purple-200 hover:bg-purple-600 hover:text-white transition" title="Lihat Essay">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        <a href="{{ asset('storage/' . $p->pas_foto) }}" target="_blank" class="group flex items-center justify-center w-8 h-8 bg-green-50 text-green-600 rounded-lg border border-green-200 hover:bg-green-600 hover:text-white transition" title="Lihat Foto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>

                                {{-- Kolom Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClass = match($p->status) {
                                            'Seleksi' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'Lolos Wawancara' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'Diterima' => 'bg-green-100 text-green-800 border-green-200',
                                            'Ditolak' => 'bg-red-100 text-red-800 border-red-200',
                                            default => 'bg-gray-100 text-gray-800 border-gray-200',
                                        };
                                        
                                        $statusIcon = match($p->status) {
                                            'Seleksi' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                            'Lolos Wawancara' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                                            'Diterima' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
                                            'Ditolak' => '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
                                            default => '',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                        {!! $statusIcon !!}
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
</div>
@endsection