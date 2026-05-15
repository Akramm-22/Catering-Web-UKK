<!DOCTYPE html>
<html lang="id" x-data="darkMode()" :class="{ 'dark': isDark }" x-init="init()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Splitbill') — Katering Premium Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dark body { background-color: #0f172a; color: #e2e8f0; }
        .dark .bg-white { background-color: #1e293b !important; }
        .dark .bg-gray-50 { background-color: #0f172a !important; }
        .dark .border-gray-100 { border-color: #334155 !important; }
        .dark .border-gray-200 { border-color: #475569 !important; }
        .dark .text-gray-900 { color: #f1f5f9 !important; }
        .dark .text-gray-700 { color: #cbd5e1 !important; }
        .dark .text-gray-600 { color: #94a3b8 !important; }
        .dark .text-gray-500 { color: #64748b !important; }
        .dark .text-gray-400 { color: #475569 !important; }
        .dark .bg-gray-100 { background-color: #1e293b !important; }
        .dark .shadow-sm { box-shadow: 0 1px 3px rgba(0,0,0,0.4) !important; }
        .dark input, .dark select, .dark textarea {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }
        .dark .hover\:bg-gray-50:hover { background-color: #1e293b !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased transition-colors duration-300">

@include('layouts.navigation')

{{-- Flash Messages --}}
@if(session('success'))
<div class="max-w-7xl mx-auto px-4 pt-4" x-data="{ show: true }" x-show="show" x-transition>
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm shadow-sm">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        <button @click="show = false" class="text-green-600 hover:text-green-800 ml-4 font-bold">✕</button>
    </div>
</div>
@endif

@if(session('error'))
<div class="max-w-7xl mx-auto px-4 pt-4" x-data="{ show: true }" x-show="show" x-transition>
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between text-sm shadow-sm">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
        <button @click="show = false" class="text-red-600 hover:text-red-800 ml-4 font-bold">✕</button>
    </div>
</div>
@endif

<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-white border-t border-gray-100 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="md:col-span-2">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-green-700">Splitbill</a>
                <p class="text-gray-500 text-sm mt-3 leading-relaxed max-w-sm">
                    Kurator kuliner Nusantara modern. Menghadirkan cita rasa Indonesia terbaik untuk setiap momen istimewa Anda sejak 2016.
                </p>
                <div class="flex gap-3 mt-4">
                    <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-green-100 hover:text-green-600 rounded-xl flex items-center justify-center text-gray-500 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 bg-gray-100 hover:bg-green-100 hover:text-green-600 rounded-xl flex items-center justify-center text-gray-500 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="w-9 h-9 bg-gray-100 hover:bg-green-100 hover:text-green-600 rounded-xl flex items-center justify-center text-gray-500 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Menu</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="{{ route('packages.index', ['category' => 'prasmanan']) }}" class="hover:text-green-600 transition">Prasmanan</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'nasi-kotak']) }}" class="hover:text-green-600 transition">Nasi Kotak</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'tumpeng']) }}" class="hover:text-green-600 transition">Tumpeng</a></li>
                    <li><a href="{{ route('packages.index', ['category' => 'harian']) }}" class="hover:text-green-600 transition">Harian</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Informasi</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="{{ route('about') }}" class="hover:text-green-600 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('tracking.index') }}" class="hover:text-green-600 transition">Lacak Pesanan</a></li>
                    @auth
                    <li><a href="{{ route('orders.index') }}" class="hover:text-green-600 transition">Pesanan Saya</a></li>
                    @endauth
                    <li><a href="#" class="hover:text-green-600 transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-green-600 transition">Syarat Layanan</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-100 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-400">© 2024 Splitbill. Kurator Kuliner Nusantara Modern.</p>
            <div class="flex items-center gap-4 text-xs text-gray-400">
                <a href="#" class="hover:text-green-600 transition">Kebijakan Privasi</a>
                <span>·</span>
                <a href="#" class="hover:text-green-600 transition">Syarat Layanan</a>
                <span>·</span>
                <a href="{{ route('about') }}" class="hover:text-green-600 transition">Tentang Kami</a>
            </div>
        </div>
    </div>
</footer>

<script>
function darkMode() {
    return {
        isDark: localStorage.getItem('darkMode') === 'true',
        init() {
            this.$watch('isDark', val => localStorage.setItem('darkMode', val));
        },
        toggle() {
            this.isDark = !this.isDark;
        }
    }
}
</script>

</body>
</html>