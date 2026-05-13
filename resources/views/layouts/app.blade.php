<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Splitbill') — Katering Premium Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

@include('layouts.navigation')

{{-- Flash Messages --}}
@if(session('success'))
<div class="max-w-7xl mx-auto px-4 pt-4" x-data="{ show: true }" x-show="show">
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-green-600 hover:text-green-800 ml-4">✕</button>
    </div>
</div>
@endif

@if(session('error'))
<div class="max-w-7xl mx-auto px-4 pt-4" x-data="{ show: true }" x-show="show">
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm">
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="text-red-600 hover:text-red-800 ml-4">✕</button>
    </div>
</div>
@endif

{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-white border-t border-gray-100 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-green-700 mb-4">Splitbill</h3>
            <div class="flex items-center justify-center gap-6 text-sm text-gray-500 mb-6 flex-wrap">
                <h1>jangan lupa bayar!</h1>
            </div>
            <p class="text-xs text-gray-400">© 2026 Splitbill. Akram Mujjaman Raton.</p>
        </div>
    </div>
</footer>

</body>
</html>
