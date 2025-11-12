<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Satgas PPKS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 min-h-screen flex items-center justify-center p-4">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-64 h-64 bg-white/5 rounded-full blur-3xl top-20 -left-20 float-animation"></div>
        <div class="absolute w-64 h-64 bg-white/5 rounded-full blur-3xl bottom-20 -right-20 float-animation" style="animation-delay: 3s;"></div>
    </div>

    @yield('content')

</body>
</html>