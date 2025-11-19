@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Daftar Laporan Kasus</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reports as $report)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->nama_pelapor }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Form ubah status --}}
                       <form action="{{ route('admin.laporan.update_status', $report->idForm) }}" method="POST" onsubmit="return handleCancelSubmit(event, '{{ $report->idForm }}')">
                            @csrf
                            @method('PATCH')
                            <select name="status"
                                onchange="handleStatusChange(event, '{{ $report->idForm }}')"
                                class="border rounded-lg px-3 py-1 text-sm
                                @if($report->status === 'Menunggu Verifikasi Admin') bg-gray-100 text-orange-800
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
        <script>
            function handleStatusChange(event, reportId) {
                const selected = event.target.value;

                // Jika admin pilih "Dibatalkan" → tampilkan form alasan
                if (selected === 'Dibatalkan') {
                    const reason = prompt('Masukkan alasan pembatalan laporan:');
                    if (!reason) {
                        alert('Alasan pembatalan wajib diisi!');
                        event.target.value = ''; // reset pilihan
                        return;
                    }
                    document.getElementById('alasan_dibatalkan_' + reportId).value = reason;
                    event.target.form.submit();
                } else {
                    event.target.form.submit();
                }
            }

            function handleCancelSubmit(event, reportId) {
                // biarkan JS yang handle pengiriman
                return true;
            }
            </script>

    </div>
</div>
@endsection
