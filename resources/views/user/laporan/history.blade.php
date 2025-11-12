@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📜 Riwayat Laporan Anda</h1>

        @if($reports->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-600">
                Anda belum pernah membuat laporan.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($reports as $report)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $report->nama_terlapor ?? '-' }}</h3>
                            <p class="text-sm text-gray-500 mb-1">
                                <span class="font-medium">Tanggal:</span> {{ $report->tanggal_kejadian ?? '-' }}
                            </p>
                            <p class="text-sm text-gray-500 mb-2">
                                <span class="font-medium">Tempat:</span> {{ $report->tempat_kejadian ?? '-' }}
                            </p>
                            @php
                                $statusColors = [
                                    'Menunggu Verifikasi Admin' => 'bg-gray-100 text-gray-800',
                                    'Diproses' => 'bg-yellow-100 text-yellow-800',
                                    'Selesai' => 'bg-green-100 text-green-800',
                                    'Dibatalkan' => 'bg-red-100 text-red-800',
                                    'Terverifikasi' => 'bg-blue-100 text-blue-800',
                                ];
                                $badgeClass = $statusColors[$report->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                {{ $report->status ?? 'Belum Diproses' }}
                            </span>
                        </div>
                        <a href="{{ route('user.laporan.show', $report->idForm) }}" 
                           class="mt-auto inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                            Detail
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('user.dashboard') }}" class="text-blue-600 hover:underline flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
