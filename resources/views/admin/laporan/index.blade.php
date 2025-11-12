@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Daftar Laporan</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelapor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($reports as $report)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->idForm }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $report->nama_pelapor }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Form ubah status --}}
                        <form action="{{ route('admin.laporan.update_status', $report->idForm) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border rounded-lg px-3 py-1 text-sm
                                @if($report->status === 'Menunggu Verifikasi Admin') bg-gray-100 text-gray-800
                                @elseif($report->status === 'Diproses') bg-yellow-100 text-yellow-800
                                @elseif($report->status === 'Selesai') bg-green-100 text-green-800
                                @elseif($report->status === 'Dibatalkan') bg-red-100 text-red-800
                                @elseif($report->status === 'Terverifikasi') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif
                                focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-blue-500
                            ">
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
    </div>
</div>
@endsection
