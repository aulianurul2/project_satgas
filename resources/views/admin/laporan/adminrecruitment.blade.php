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

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Berhasil</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- SECTION: Table Pelamar --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identitas Pelamar</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akademik</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berkas</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Saat Ini</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Update Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- PERBAIKAN: Menggunakan $members sesuai Controller --}}
                @forelse($members as $member)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $loop->iteration + $members->firstItem() - 1 }}
                    </td>
                    
                    {{-- Kolom Identitas --}}
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $member->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $member->nim }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="inline-flex items-center gap-1">
                                📞 {{ $member->no_wa }}
                            </span>
                        </div>
                    </td>

                    {{-- Kolom Akademik --}}
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $member->jurusan }}</div>
                        <div class="text-xs text-gray-500">{{ $member->prodi }}</div>
                        <div class="text-xs font-semibold text-blue-600 mt-1">IPK: {{ $member->ipk_terakhir }}</div>
                    </td>

                    {{-- Kolom Berkas (Digabung agar rapi) --}}
                    <td class="px-6 py-4 text-sm">
                        <div class="flex flex-col space-y-1">
                            @if($member->cv)
                                <a href="{{ asset('storage/' . $member->cv) }}" target="_blank" class="text-blue-600 hover:underline text-xs flex items-center gap-1">
                                    📄 Lihat CV
                                </a>
                            @else
                                <span class="text-xs text-gray-400">📄 CV Tidak ada</span>
                            @endif

                            @if($member->essay)
                                <a href="{{ asset('storage/' . $member->essay) }}" target="_blank" class="text-blue-600 hover:underline text-xs flex items-center gap-1">
                                    📝 Lihat Essay
                                </a>
                            @else
                                <span class="text-xs text-gray-400">📝 Essay Tidak ada</span>
                            @endif

                            @if($member->pas_foto)
                                <a href="{{ asset('storage/' . $member->pas_foto) }}" target="_blank" class="text-blue-600 hover:underline text-xs flex items-center gap-1">
                                    📷 Lihat Foto
                                </a>
                            @else
                                <span class="text-xs text-gray-400">📷 Foto Tidak ada</span>
                            @endif
                        </div>
                    </td>

                    {{-- Kolom Status Badge --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $status = $member->status;
                            $badgeClass = 'bg-gray-100 text-gray-800'; // Default

                            if($status == 'Seleksi') {
                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                            } elseif($status == 'Lolos Wawancara') {
                                $badgeClass = 'bg-blue-100 text-blue-800';
                            } elseif($status == 'Diterima') {
                                $badgeClass = 'bg-green-100 text-green-800';
                            }
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                            {{ $status ?? 'Menunggu' }}
                        </span>
                    </td>

                    {{-- Kolom Form Update Status --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Pastikan route 'adminrecruitment.updateStatus' sudah didefinisikan di web.php --}}
                        <form action="{{ route('adminrecruitment.updateStatus', $member->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" 
                                class="text-xs block w-full pl-2 pr-8 py-1 border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-xs rounded-md shadow-sm">
                                <option value="Seleksi" {{ $member->status == 'Seleksi' ? 'selected' : '' }}>Seleksi</option>
                                <option value="Lolos Wawancara" {{ $member->status == 'Lolos Wawancara' ? 'selected' : '' }}>Lolos Wawancara</option>
                                <option value="Diterima" {{ $member->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-lg font-medium text-gray-900">Belum ada data pelamar</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 px-4">
        {{-- PERBAIKAN: Menggunakan $members --}}
        {{ $members->links() }}
    </div>
</div>
@endsection