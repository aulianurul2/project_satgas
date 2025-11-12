<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satgas PPKPT - Selamat Datang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-6 py-4 bg-white shadow">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Satgas" class="h-10">
            <span class="text-xl font-semibold text-blue-700">Satgas PPKPT</span>
        </div>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 font-medium">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">Daftar</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-24 bg-gradient-to-b from-blue-50 to-white">
        <h1 class="text-4xl font-bold text-gray-900">Selamat Datang di Sistem Satgas PPKPT</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
            Platform untuk mendukung pelaporan, pengawasan, dan pengelolaan kegiatan Satgas PPKPT secara digital.
        </p>
        <div class="mt-8">
            <a href="{{ route('register') }}" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-800 transition">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-500 border-t mt-10">
        &copy; {{ date('Y') }} Satgas PPKPT. All rights reserved.
    </footer>

</body>
</html>
