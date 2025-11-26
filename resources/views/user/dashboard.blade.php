@extends('layouts.app')

@section('content')
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Welcome back, {{ Auth::user()->nama }}!</h2>
        </div>

        <div class="bg-blue-600 text-white p-5 rounded-lg text-center mb-8">
            <h3 class="text-xl font-semibold mb-2">Apa yang ingin Anda lakukan?</h3>
            <p class="text-sm">Pilih salah satu menu di bawah ini</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Laporkan Kasus -->
            <a href="{{ route('user.laporan.create') }}" class="block bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 text-center">
                <div class="text-3xl mb-3">📝</div>
                <h3 class="text-lg font-semibold">Laporkan Kasus</h3>
                <p class="text-sm text-gray-500">Buat laporan kasus baru</p>
            </a>
            <!-- Riwayat Laporan -->
            <a href="{{ route('user.laporan.history') }}" class="block bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 text-center">
                <div class="text-3xl mb-3">📜</div>
                <h3 class="text-lg font-semibold">Riwayat Laporan</h3>
                <p class="text-sm text-gray-500">Lihat laporan yang sudah Anda kirim</p>
            </a>
            <!-- Pendaftaran Anggota -->

            <a href="#" class="block bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 text-center">
                <div class="text-3xl mb-3">👥</div>
                <h3 class="text-lg font-semibold">Pendaftaran Anggota</h3>
                <p class="text-sm text-gray-500">Daftar menjadi anggota satgas</p>
            </a>
            <!-- Profil -->
            <a href="{{ route('profile.edit') }}" class="block bg-white rounded-xl shadow-md hover:shadow-lg transition p-6 text-center">
                <div class="text-3xl mb-3">👤</div>
                <h3 class="text-lg font-semibold">Profil</h3>
                <p class="text-sm text-gray-500">Lihat dan ubah biodata Anda</p>
            </a>
        </div>
    </div>
</div>

{{-- Notifikasi WA --}}
@if(session('wa_notice') && session('wa_link'))
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-init="setTimeout(() => {
                if(show) {
                    window.location.href = '{{ session('wa_link') }}';
                }
            }, 10000)" 
    class="fixed top-5 right-5 bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-start space-x-4 z-50 animate-fade-in-right"
>
    <div class="flex-shrink-0">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z"/>
        </svg>
    </div>
    <div class="flex-1">
        <p class="font-bold">Laporan Terkirim!</p>
        <p class="text-sm">{{ session('wa_notice') }}</p>
        <a href="{{ session('wa_link') }}" target="_blank" @click="show = false" class="mt-2 inline-block bg-white text-yellow-600 font-semibold px-3 py-1 rounded hover:bg-gray-100 transition">
            Kirim ke WhatsApp Sekarang
        </a>
    </div>
    <button @click="show = false" class="ml-3 text-white hover:text-gray-200">✖</button>
</div>

<style>
@keyframes fade-in-right {
  0% { opacity: 0; transform: translateX(50px); }
  100% { opacity: 1; transform: translateX(0); }
}
.animate-fade-in-right {
  animation: fade-in-right 0.5s ease-out;
}
</style>
@endif

@endsection
