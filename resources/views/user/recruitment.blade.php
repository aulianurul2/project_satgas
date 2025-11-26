@extends('layouts.app') {{-- layout utama --}}

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">
 
            <a href="{{ route('formpendaftaran.create') }}" class="menu-card">
                <div class="icon-placeholder"></div>
                <h3 class="card-title">Form Pendaftaran</h3>
                <p class="card-subtitle">Mengisi Form Pendaftaran</p>
            </a>
            
            {{-- 3. Page Content --}}
            <a href="{{ route('user.riwayatpendaftaran.index') }}" class="menu-card">
                <div class="icon-placeholder"></div>
                <h3 class="card-title">Riwayat Pendaftaran</h3>
                <p class="card-subtitle">Kelola Riwayat Pendaftaran</p>
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
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e5e7eb;
}

.menu-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.icon-placeholder {
    width: 80px;
    height: 80px;
    background: #f3f4f6; /* Warna placeholder abu-abu terang */
    border-radius: 8px;
    margin-bottom: 15px;
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 5px;
}

.card-subtitle {
    font-size: 13px;
    color: #6b7280;
}
</style>

@endsection
