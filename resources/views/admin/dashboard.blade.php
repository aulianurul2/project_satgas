@extends('layouts.app') 

@section('content')

<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-1">
                Selamat Datang, Admin!
            </h1>
            <p class="text-gray-600">
                Bersama Peduli, Tanggap menangani, POLSUB Tanpa kekerasan!
            </p>
        </div>

        {{-- Search/Quick Action Area (Seperti di Mockup) --}}
        <div class="bg-blue-800 rounded-lg p-10 mb-8 shadow-xl">
            <h2 class="text-2xl text-white font-semibold mb-6 text-center">
                What are you looking for?
            </h2>
            <div class="max-w-xl mx-auto">
                <div class="relative">
                    <input type="text" placeholder="Search report text" class="w-full py-3 pl-12 pr-4 rounded-full text-gray-800 focus:ring-4 focus:ring-blue-300 focus:outline-none" />
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

         {{-- Menu Grid (Sesuai Mockup) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">
            
            {{-- 1. Hotliner --}}
            {{-- <a href="#" class="menu-card">
                <div class="icon-placeholder">
                    <!-- Phone icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.97.757l.6 2.7a1 1 0 01-.27.95L7.4 9.8a11 11 0 005.8 5.8l1.2-1.6a1 1 0 01.95-.27l2.7.6A1 1 0 0119 18.4V21a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                </div>
                 <h3 class="card-title">Hotliner</h3>
                 <p class="card-subtitle">Daftar kontak hotliner</p>
             </a> --}}

        {{-- 2. Data Laporan (Riwayat Laporan di Mockup) --}}
   <a href="{{ route('admin.laporan.index') }}" class="menu-card">
            <div class="icon-placeholder">
                <i class="bi bi-clipboard-data text-blue-600" aria-hidden="true"></i>
            </div>
             <h3 class="card-title">Data Laporan</h3>
             <p class="card-subtitle">Kelola seluruh laporan</p>
         </a>
        
         {{-- 3. Page Content --}}
         <a href="{{ route('admin.media.index') }}" class="menu-card">
           <div class="icon-placeholder">
                <i class="bi bi-file-earmark-text text-indigo-600" aria-hidden="true"></i>
            </div>
              <h3 class="card-title">Kelola Berita</h3>
              <p class="card-subtitle">Kelola informasi publik</p>
          </a>

         
         {{-- 4. Anggota --}}
         <a href="{{ route('admin.members.index') }}" class="menu-card">
            <div class="icon-placeholder">
                <i class="bi bi-people-fill text-green-600" aria-hidden="true"></i>
            </div>
              <h3 class="card-title">Anggota</h3>
              <p class="card-subtitle">Kelola data anggota</p>
          </a>


         {{-- 5. Recruitment --}}
         <a href="#" class="menu-card">
            <div class="icon-placeholder">
               <i class="bi bi-person-plus text-pink-600" aria-hidden="true"></i>
            </div>
              <h3 class="card-title">Recruitment</h3>
              <p class="card-subtitle">Data pendaftar anggota</p>
          </a>
          <a href="{{ route('admin.users.index') }}" class="menu-card">
                <div class="icon-placeholder">
                    <i class="bi bi-people text-purple-600" aria-hidden="true"></i>
                </div>
                <h3 class="card-title">Kelola User</h3>
                <p class="card-subtitle">Manajemen pengguna sistem</p>

            {{-- 5. Recruitment --}}
            <a href="{{ route('laporan.adminrecruitment') }}" class="menu-card">
            <div class="icon-placeholder">
                <i class="bi bi-person-badge text-green-600" aria-hidden="true"></i>
            </div>
                <h3 class="card-title">Recruitment</h3>
                <p class="card-subtitle">Data pendaftar anggota</p>
            </a>


            {{-- 6. Settings --}}
            {{-- <a href="#" class="menu-card">
                <div class="icon-placeholder"></div>
                <h3 class="card-title">Settings</h3>
                <p class="card-subtitle">Pengaturan sistem</p>
            </a> --}}

            {{-- Anda bisa tambahkan kartu lain di sini jika ada --}}

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