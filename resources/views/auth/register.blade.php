<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Satgas PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.5s ease-out; }

        .block.mt-1.w-full {
            padding: 0.875rem 1rem 0.875rem 3rem !important;
            background-color: #f9fafb !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 0.75rem !important;
            transition: all 0.2s !important;
        }

        .block.mt-1.w-full:focus {
            outline: none !important;
            border-color: #3b82f6 !important;
            background-color: white !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1) !important;
        }

        label.block.font-medium.text-sm.text-gray-700 {
            font-weight: 600 !important;
            margin-bottom: 0.5rem !important;
        }

        .inline-flex.items-center.px-4.py-2 {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%) !important;
            padding: 0.75rem 2rem !important;
            border-radius: 0.75rem !important;
            font-weight: 600 !important;
            transition: all 0.3s !important;
            box-shadow: 0 4px 6px -1px rgba(59,130,246,0.3) !important;
        }

        .inline-flex.items-center.px-4.py-2:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 15px -3px rgba(59,130,246,0.4) !important;
        }

        .underline.text-sm.text-gray-600 {
            color: #4b5563 !important;
            font-weight: 500 !important;
        }
        .underline.text-sm.text-gray-600:hover {
            color: #3b82f6 !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl fade-in">
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-10 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-4">
                    <img src="{{ asset('landing/assets/img/logo.png') }}" class="w-14 h-14 object-contain">
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">SIPRAK</h1>
                <p class="text-blue-100 text-base">Buat Akun Baru</p>
            </div>

            <!-- FORM START -->
            <div class="px-8 py-10">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <x-input-label for="nama" :value="__('Nama Lengkap')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                                      :value="old('nama')" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                      :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Kontak -->
                    <div class="mt-4 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <x-input-label for="kontak" :value="__('Nomor Kontak')" />
                        <x-text-input id="kontak" class="block mt-1 w-full" type="text" name="kontak"
                                      :value="old('kontak')" required />
                        <x-input-error :messages="$errors->get('kontak')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mt-4 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat"
                                      :value="old('alamat')" required />
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                      name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mt-4 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none" style="top: 28px;">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                      name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-center justify-end mt-6">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            Sudah punya akun?
                        </a>

                        <button class="ml-4 inline-flex items-center px-4 py-2 text-white">
                            Daftar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>
</html>
