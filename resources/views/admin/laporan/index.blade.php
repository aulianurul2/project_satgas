@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">

    {{-- Header & Reset Filter --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Laporan Kasus</h1>
        @if(request('status') || request('start') || request('end'))
            <a href="{{ route('admin.laporan.index') }}" class="text-sm text-red-600 hover:underline mt-2 md:mt-0">
                &times; Reset Filter
            </a>
        @endif
    </div>

    {{-- SECTION: Filter Form --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            
            {{-- Filter Tanggal Mulai --}}
            <div>
                <label for="start" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="start" id="start" value="{{ request('start') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
            </div>

            {{-- Filter Tanggal Selesai --}}
            <div>
                <label for="end" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="end" id="end" value="{{ request('end') }}" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
            </div>

            {{-- Filter Status --}}
            <div>
                <label for="filter_status" class="block text-sm font-medium text-gray-700 mb-1">Status Laporan</label>
                <select name="status" id="filter_status" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 border">
                    <option value="">Semua Status</option>
                    <option value="Menunggu Verifikasi Admin" {{ request('status') == 'Menunggu Verifikasi Admin' ? 'selected' : '' }}>Menunggu Verifikasi Admin</option>
                    <option value="Terverifikasi" {{ request('status') == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            {{-- Tombol Cari --}}
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-150 ease-in-out flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Filter Data
                </button>
            </div>
        </form>
    </div>

    {{-- SECTION: Table Laporan --}}
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Submit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reports as $report)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->nama_pelapor }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Form ubah status (Inline) --}}
                        <form action="{{ route('admin.laporan.update_status', $report->idForm) }}" method="POST" onsubmit="return handleCancelSubmit(event, '{{ $report->idForm }}')">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                onchange="handleStatusChange(event, '{{ $report->idForm }}')"
                                class="border rounded-lg px-3 py-1 text-sm
                                @if($report->status === 'Menunggu Verifikasi Admin') bg-orange-100 text-orange-800
                                @elseif($report->status === 'Diproses') bg-yellow-100 text-yellow-800
                                @elseif($report->status === 'Selesai') bg-green-100 text-green-800
                                @elseif($report->status === 'Dibatalkan') bg-red-100 text-red-800
                                @elseif($report->status === 'Terverifikasi') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif
                                focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500"
                                {{ $report->status === 'Dibatalkan' ? 'disabled' : '' }}
                            >
                                @php
                                    $statuses = [
                                        'Menunggu Verifikasi Admin',
                                        'Diproses',
                                        'Selesai',
                                        'Dibatalkan',
                                        'Terverifikasi'
                                    ];
                                @endphp
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $report->status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- Input alasan pembatalan (hidden, muncul via JS) --}}
                            <input type="hidden" name="alasan_dibatalkan" id="alasan_dibatalkan_{{ $report->idForm }}">
                        </form>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.laporan.show', $report->idForm) }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Pagination (jika ada) --}}
        <div class="px-6 py-4 border-t border-gray-200">
            @if(method_exists($reports, 'links'))
                {{ $reports->links() }}
            @endif
        </div>

        <script>
            function handleStatusChange(event, reportId) {
                const selected = event.target.value;

                // Jika admin pilih "Dibatalkan" → tampilkan form alasan
                if (selected === 'Dibatalkan') {
                    const reason = prompt('Masukkan alasan pembatalan laporan:');
                    if (!reason) {
                        alert('Alasan pembatalan wajib diisi!');
                        event.target.value = ''; // reset pilihan (atau kembalikan ke nilai sebelumnya jika disimpan)
                        // Reload halaman agar value select kembali ke semula (cara cepat)
                        window.location.reload(); 
                        return;
                    }
                    document.getElementById('alasan_dibatalkan_' + reportId).value = reason;
                    event.target.form.submit();
                } else {
                    // Konfirmasi sederhana untuk perubahan selain batal
                    if(confirm('Apakah Anda yakin ingin mengubah status menjadi ' + selected + '?')) {
                        event.target.form.submit();
                    } else {
                         window.location.reload(); // reset jika cancel
                    }
                }
            }

            function handleCancelSubmit(event, reportId) {
                // biarkan JS yang handle pengiriman via onchange
                return true;
            }
        </script>

    </div>
</div>
@endsection