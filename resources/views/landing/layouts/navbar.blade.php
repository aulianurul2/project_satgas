<nav class="bg-white shadow fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        {{-- Logo --}}
        <div class="text-lg font-bold text-blue-800">
            <a href="{{ route('landing') }}">SATGAS PPKPT POLSUB</a>
        </div>

        {{-- Menu Navigasi --}}
        <div class="hidden md:flex space-x-6">
            <a href="#beranda" class="hover:text-blue-700">Beranda</a>
            <a href="#tentang" class="hover:text-blue-700">Tentang</a>
            <a href="#berita" class="hover:text-blue-700">Berita</a>
            <a href="#kontak" class="hover:text-blue-700">Kontak</a>
        </div>

        {{-- Tombol Autentikasi --}}
        <div class="space-x-3">
            @auth
                {{-- Jika sudah login --}}
                <a href="{{ route('dashboard') }}" class="text-blue-700 font-semibold hover:underline">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 font-semibold hover:underline">
                        Logout
                    </button>
                </form>
            @else
                {{-- Jika belum login --}}
                <a href="{{ route('login') }}" class="text-blue-700 font-semibold hover:underline">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>
