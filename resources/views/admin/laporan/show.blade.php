@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4">
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white rounded-lg shadow-md p-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Detail Laporan #{{ $report->idForm ?? 'xxxxxx' }}</h1>
                <p class="text-sm opacity-90 mt-1">Informasi lengkap laporan</p>
            </div>
            
            {{-- Status Badge --}}
            @php
                $statusClasses = [
                    'Menunggu Verifikasi Admin' => 'bg-gray-200 text-gray-800',
                    'Dibatalkan' => 'bg-red-200 text-red-800',
                    'Diproses' => 'bg-yellow-200 text-yellow-900',
                    'Selesai' => 'bg-green-200 text-green-900',
                    'Terverifikasi' => 'bg-blue-200 text-blue-900'
                ];
                $badgeClass = $statusClasses[$report->status] ?? 'bg-gray-200 text-gray-800';
            @endphp
            <span class="px-4 py-2 rounded-full font-semibold {{ $badgeClass }}">
                {{ $report->status }}
            </span>
        </div>

        {{-- Timeline Status --}}
        @php
            $timeline = [
                'Menunggu Verifikasi Admin',
                'Terverifikasi',
                'Diproses',
                'Selesai'
            ];
            $currentIndex = array_search($report->status, $timeline);
        @endphp
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6 border-b pb-2">Status Timeline</h2>
            <div class="relative flex justify-between items-center">
                {{-- Horizontal line --}}
                <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200"></div>

                @foreach($timeline as $index => $status)
                    @php
                        $isPassed = $index < $currentIndex;
                        $isCurrent = $index === $currentIndex;
                        $dotClass = $isPassed || $isCurrent ? 'bg-blue-600' : 'bg-white border-2 border-gray-300';
                        $labelClass = $isPassed || $isCurrent ? 'text-gray-900 font-semibold' : 'text-gray-400';
                    @endphp
                    <div class="flex flex-col items-center z-10 w-1/4 relative">
                        <div class="w-6 h-6 rounded-full {{ $dotClass }} flex items-center justify-center">
                            @if($isPassed)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif($isCurrent)
                                <div class="w-3 h-3 bg-white rounded-full"></div>
                            @endif
                        </div>
                        <p class="text-xs mt-2 text-center {{ $labelClass }}">{{ $status }}</p>
                        @if($isCurrent)
                            <span class="mt-1 px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded-full">Saat Ini</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Detail Laporan Card --}}
        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            {{-- Informasi Pelapor --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Identitas Pelapor</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <p><strong>Nama:</strong> {{ $report->nama_pelapor }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $report->tempat_lahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $report->tanggal_lahir }}</p>
                    <p><strong>Agama:</strong> {{ $report->agama }}</p>
                    <p><strong>JK:</strong> {{ $report->jk }}</p>
                    <p class="col-span-2"><strong>Alamat:</strong> {{ $report->alamat }}</p>
                    <p><strong>Kedudukan:</strong> {{ $report->kedudukan }}</p>
                    <p><strong>Jurusan:</strong> {{ $report->jurusan ?? '-' }}</p>
                    <p><strong>Prodi:</strong> {{ $report->prodi ?? '-' }}</p>
                    <p><strong>No HP/WA:</strong> {{ $report->no_hp }}</p>
                    <p><strong>Email:</strong> {{ $report->email }}</p>
                    
                </div>
            </div>

            {{-- Informasi Terlapor --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Identitas Terlapor</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <p><strong>Pihak Dilaporkan:</strong> {{ $report->pihak_dilaporkan ?? '-' }}</p>
                    <p><strong>Nama Terlapor:</strong> {{ $report->nama_terlapor ?? '-' }}</p>
                    <p><strong>JK Terlapor:</strong> {{ $report->jk_terlapor ?? '-' }}</p>
                    <p class="col-span-2"><strong>Unit Kerja:</strong> {{ $report->unit_kerja_terlapor ?? '-' }}</p>
                </div>
            </div>

            {{-- Kronologi & Bantuan --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Kronologi Peristiwa</h2>
                <div class="bg-gray-50 p-4 rounded-md border border-gray-100 mb-4">
                    <p class="whitespace-pre-wrap">{{ $report->kronologi ?? 'Tidak ada kronologi' }}</p>
                </div>

                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Bantuan yang Diperlukan</h2>
                <div class="bg-gray-50 p-4 rounded-md border border-gray-100">
                    <p class="whitespace-pre-wrap">{{ $report->bantuan_yang_diperlukan ?? 'Tidak ada informasi' }}</p>
                </div>
                <br>
                
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Tanggal Submit</h2>
                <div class="bg-gray-50 p-4 rounded-md border border-gray-100">
                    <p> {{ $report->created_at->translatedFormat('d F Y H:i') }}</p>

                </div>

            </div>

            {{-- Bukti --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Unggahan Bukti</h2>
                @if($report->bukti)
                    <div class="flex flex-col md:flex-row items-center md:justify-start space-y-2 md:space-y-0 md:space-x-4">
                        <a href="{{ Storage::url($report->bukti) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                            Lihat Bukti
                        </a>
                        <a href="{{ Storage::url($report->bukti) }}" download class="px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                            Download Bukti
                        </a>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Tidak ada bukti yang diunggah untuk laporan ini.</p>
                @endif
            </div>

            {{-- Alasan Pembatalan --}}
            @if ($report->status === 'Dibatalkan')
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-sm">
                    <h2 class="text-lg font-semibold text-red-800 mb-2">Alasan Pembatalan</h2>
                    <p class="text-red-700 whitespace-pre-wrap">
                        {{ $report->alasan_dibatalkan ?? 'Tidak ada alasan yang diberikan.' }}
                    </p>
                </div>
            @endif
        </div>
        {{-- Tombol Download PDF --}}
        <div class="flex justify-start mb-4">
            <a href="{{ route('admin.laporan.download', $report->idForm) }}"
            class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                📄 Download Laporan (PDF)
            </a>
        </div>


        {{-- Tombol Kembali --}}
        <div class="flex justify-start">
            <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition">
                ← Kembali ke Laporan
            </a>
        </div>

    </div>
</div>
@endsection
