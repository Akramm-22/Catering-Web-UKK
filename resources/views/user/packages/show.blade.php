@extends('layouts.app')
@section('title', $package->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-green-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('packages.index') }}" class="hover:text-green-600">Daftar Menu</a>
        <span>/</span>
        <span class="text-gray-900 font-medium">{{ $package->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        {{-- Left: Images --}}
        <div>
            <div class="rounded-2xl overflow-hidden aspect-video bg-gray-100">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                     class="w-full h-full object-cover">
            </div>
            @if($package->gallery)
            <div class="grid grid-cols-3 gap-3 mt-3">
                @foreach(array_slice($package->gallery, 0, 3) as $img)
                <div class="rounded-xl overflow-hidden aspect-square bg-gray-100">
                    <img src="{{ $img }}" class="w-full h-full object-cover hover:scale-105 transition cursor-pointer">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Right: Info --}}
        <div>
            {{-- Badges --}}
            <div class="flex items-center gap-2 mb-3">
                @if($package->is_bestseller)
                <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">TERPOPULER</span>
                @endif
                @if($package->badge)
                <span class="bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1 rounded-full">{{ $package->badge }}</span>
                @endif
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $package->name }}</h1>

            <p class="text-gray-500 text-sm italic mb-6 border-l-4 border-green-200 pl-4">
                "{{ $package->short_description }}"
            </p>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 text-gray-400 text-xs mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        KAPASITAS
                    </div>
                    <p class="font-bold text-gray-900 text-sm">
                        Min. {{ $package->min_pax }} Pax
                        @if($package->max_pax) – {{ $package->max_pax }} Pax @endif
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center gap-2 text-gray-400 text-xs mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        JENIS MENU
                    </div>
                    <p class="font-bold text-gray-900 text-sm">{{ $package->menu_type }}</p>
                </div>
            </div>

            {{-- Price & Order --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-5 mb-6">
                <p class="text-gray-500 text-xs mb-1">Mulai dari</p>
                <div class="flex items-baseline gap-2 mb-1">
                    <span class="text-3xl font-bold text-green-600">{{ $package->formatted_price }}</span>
                    <span class="text-gray-400 text-sm">/pax</span>
                </div>
                <div class="flex items-center gap-1 text-amber-500 text-sm mb-4">
                    ★ {{ number_format($package->rating, 1) }}
                    <span class="text-gray-400 text-xs">({{ $package->review_count }}+ ulasan)</span>
                </div>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <div class="flex items-center gap-3 mb-4">
                        <label class="text-sm text-gray-600 font-medium">Jumlah Pax:</label>
                        <input type="number" name="qty" value="{{ $package->min_pax }}"
                               min="{{ $package->min_pax }}"
                               class="w-24 border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 text-center">
                    </div>
                    @auth
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3.5 rounded-xl flex items-center justify-center gap-2 transition hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Pesan Sekarang
                    </button>
                    @else
                    <a href="{{ route('login') }}"
                       class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3.5 rounded-xl transition">
                        Login untuk Memesan
                    </a>
                    @endauth
                </form>

                <p class="text-center text-xs text-gray-400 mt-3">
                    Gratis ongkir untuk wilayah DKI Jakarta & sekitarnya.
                </p>
            </div>

            {{-- Description --}}
            <div>
                <h2 class="text-lg font-bold text-gray-900 mb-3">Deskripsi Paket</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $package->description }}</p>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs">✓</span>
                        Bahan baku segar pilihan langsung dari petani lokal.
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs">✓</span>
                        Kemasan ramah lingkungan dengan desain elegan.
                    </li>
                    <li class="flex items-center gap-2 text-sm text-gray-700">
                        <span class="w-5 h-5 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xs">✓</span>
                        Opsi kustomisasi menu sesuai preferensi diet.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Package Items --}}
    @if($package->items->isNotEmpty())
    <div class="mt-14">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Isi Dalam Paket</h2>
        <p class="text-gray-500 text-sm mb-8">Komposisi seimbang untuk kepuasan lidah yang sempurna.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($package->items as $item)
            <div class="bg-white border border-gray-100 rounded-2xl p-5 hover:border-green-200 hover:shadow-sm transition">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $item->category }}</span>
                <h3 class="font-bold text-gray-900 mt-1 mb-2">{{ $item->name }}</h3>
                <p class="text-gray-500 text-sm">{{ $item->description }}</p>
                @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}"
                     class="w-full h-32 object-cover rounded-xl mt-3">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
