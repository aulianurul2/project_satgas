@extends('layouts.app') {{-- layout utama --}}

{{-- Import Heroicons (Pastikan Anda telah menginstal/mengaktifkan Heroicons atau gunakan SVG inline) --}}
{{-- Di sini, saya akan menempelkan SVG inline. --}}

@section('content')

<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto"> {{-- Mengurangi lebar max untuk fokus pada menu --}}
        
        <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-10">
            KLIK UNTUK PILIH 
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> {{-- Mengubah layout grid menjadi 1 atau 2 kolom --}}
 
            {{-- 1. Form Pendaftaran --}}
            <a href="{{ route('formpendaftaran.create') }}" class="menu-card group">
                <div class="icon-container bg-blue-500 group-hover:bg-blue-600">
                    {{-- Ikon Plus/Tambah --}}
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="card-title">Form Pendaftaran Baru</h3>
                <p class="card-subtitle">Mulai dan isi formulir pendaftaran Anda.</p>
            </a>
            
            {{-- 2. Riwayat Pendaftaran --}}
            <a href="{{ route('user.riwayatpendaftaran.index') }}" class="menu-card group">
                <div class="icon-container bg-green-500 group-hover:bg-green-600">
                    {{-- Ikon Riwayat/Clock --}}
                    <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="card-title">Riwayat Pendaftaran</h3>
                <p class="card-subtitle">Lihat status dan kelola semua pendaftaran Anda.</p>
            </a>

        </div>
    </div>
</div>

<style>
/* Custom CSS untuk styling card menu */
.menu-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background: white;
    padding: 30px 20px; /* Padding lebih besar */
    border-radius: 16px; /* Sudut lebih melengkung */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.04); /* Bayangan lebih halus */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    border: 1px solid #e5e7eb;
    text-decoration: none; /* Hilangkan garis bawah default */
}

.menu-card:hover {
    transform: translateY(-5px); /* Efek angkat lebih tinggi */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1); /* Bayangan lebih jelas saat hover */
}

/* Container Ikon yang diperbarui */
.icon-container {
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%; /* Membuat ikon berbentuk lingkaran */
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

.card-title {
    font-size: 20px; /* Ukuran judul lebih besar */
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 8px;
}

.card-subtitle {
    font-size: 15px;
    color: #6b7280;
    line-height: 1.4;
}
</style>

@endsection