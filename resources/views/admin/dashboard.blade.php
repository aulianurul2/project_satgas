@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section (Diubah jadi Biru & Text Putih) --}}
        <div class="bg-blue-800 rounded-lg shadow-md border border-blue-700 p-8 mb-8 text-white">
            <h1 class="text-3xl font-bold mb-2">
                Selamat Datang, Admin!
            </h1>
            <p class="text-blue-100 text-lg">
                Bersama Peduli, Tanggap menangani, POLSUB Tanpa kekerasan!
            </p>
        </div>

        {{-- Search Section SUDAH DIHAPUS --}}

         {{-- Menu Grid (Sesuai Mockup) --}}
       <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">

    {{-- 2. Data Laporan — Hanya Admin --}}
    @if(auth()->user()->jenisUser === 'admin')
    <a href="{{ route('admin.laporan.index') }}" class="menu-card">
        <div class="icon-placeholder">
            <i class="bi bi-clipboard-data text-blue-600" aria-hidden="true"></i>
        </div>
        <h3 class="card-title">Data Laporan</h3>
        <p class="card-subtitle">Kelola seluruh laporan</p>
    </a>
    @endif

    {{-- 3. Kelola Berita — minor_admin boleh --}}
    <a href="{{ route('admin.media.index') }}" class="menu-card">
        <div class="icon-placeholder">
            <i class="bi bi-file-earmark-text text-indigo-600" aria-hidden="true"></i>
        </div>
        <h3 class="card-title">Kelola Berita</h3>
        <p class="card-subtitle">Kelola informasi publik</p>
    </a>

    {{-- 4. Anggota — minor_admin boleh --}}
    <a href="{{ route('admin.members.index') }}" class="menu-card">
        <div class="icon-placeholder">
            <i class="bi bi-people-fill text-green-600" aria-hidden="true"></i>
        </div>
        <h3 class="card-title">Anggota</h3>
        <p class="card-subtitle">Kelola data anggota</p>
    </a>

    {{-- 5. Kelola User — Hanya Admin --}}
    @if(auth()->user()->jenisUser === 'admin')
    <a href="{{ route('admin.users.index') }}" class="menu-card">
        <div class="icon-placeholder">
            <i class="bi bi-people text-purple-600" aria-hidden="true"></i>
        </div>
        <h3 class="card-title">Kelola User</h3>
        <p class="card-subtitle">Manajemen pengguna sistem</p>
    </a>
    @endif

    {{-- 6. Recruitment — Hanya Admin --}}
    @if(auth()->user()->jenisUser === 'admin')
    <a href="{{ route('laporan.adminrecruitment') }}" class="menu-card">
        <div class="icon-placeholder">
            <i class="bi bi-person-badge text-green-600" aria-hidden="true"></i>
        </div>
        <h3 class="card-title">Recruitment</h3>
        <p class="card-subtitle">Data pendaftar anggota</p>
    </a>
    @endif

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
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ukuran icon bootstrap inside placeholder */
.icon-placeholder .bi {
    font-size: 36px;
    line-height: 1;
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