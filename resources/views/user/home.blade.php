@extends('layouts.app')
@section('title', 'Splitbill — Katering Premium Nusantara')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0d1f0e 0%, #1a3d1e 40%, #2d5a32 100%); min-height: 92vh;">

    {{-- Decorative rempah elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-10 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #e8b84b 0%, transparent 70%);"></div>
        <div class="absolute bottom-20 left-20 w-64 h-64 rounded-full opacity-10" style="background: radial-gradient(circle, #c0392b 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 rounded-full opacity-5" style="background: radial-gradient(circle, #27ae60 0%, transparent 70%); transform: translate(-50%,-50%);"></div>

        {{-- Floating spice dots --}}
        <div class="absolute top-24 left-1/4 w-3 h-3 rounded-full opacity-60" style="background:#e8b84b; animation: float 6s ease-in-out infinite;"></div>
        <div class="absolute top-40 right-1/3 w-2 h-2 rounded-full opacity-40" style="background:#c0392b; animation: float 8s ease-in-out infinite 2s;"></div>
        <div class="absolute bottom-32 right-1/4 w-4 h-4 rounded-full opacity-30" style="background:#27ae60; animation: float 7s ease-in-out infinite 1s;"></div>
        <div class="absolute top-1/3 right-16 w-2 h-2 rounded-full opacity-50" style="background:#e8b84b; animation: float 5s ease-in-out infinite 3s;"></div>
    </div>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-20px)
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        .hero-text {
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-img {
            animation: scaleIn 1s ease 0.3s both;
        }

        .pkg-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pkg-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .badge-spice {
            background: linear-gradient(135deg, #e8b84b, #d4930a);
        }

        .btn-primary {
            background: linear-gradient(135deg, #27ae60, #1e8449);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.4);
        }

        .category-pill {
            transition: all 0.25s ease;
        }

        .category-pill:hover {
            transform: translateY(-2px);
        }

        .category-pill.active {
            background: #1a3d1e;
            color: white;
        }

        .star-filled {
            color: #f59e0b;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 py-20 lg:py-28">

            {{-- Left: Text --}}
            <div class="flex-1 hero-text">
                <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full border" style="border-color:rgba(232,184,75,0.4); background:rgba(232,184,75,0.1);">
                    <div class="w-2 h-2 rounded-full" style="background:#e8b84b;"></div>
                    <span class="text-xs font-bold uppercase tracking-widest" style="color:#e8b84b;">Curated Experience</span>
                </div>

                <h1 class="text-white font-bold leading-none mb-6" style="font-size:clamp(2.5rem,5vw,4.5rem); line-height:1.1;">
                    Cita Rasa<br>
                    <span style="color:#e8b84b;">Nusantara</span><br>
                    <span style="color:#7ed87f;">Modern</span>
                </h1>

                <p class="text-lg mb-8 leading-relaxed max-w-lg" style="color:rgba(255,255,255,0.75);">
                    Menghadirkan kurasi hidangan terbaik Indonesia dengan sentuhan modern. Dari rempah pilihan petani lokal hingga presentasi estetika tinggi.
                </p>

                {{-- Stats mini --}}
                <div class="flex items-center gap-8 mb-10">
                    <div>
                        <p class="text-2xl font-bold text-white">500+</p>
                        <p class="text-xs" style="color:rgba(255,255,255,0.5);">Menu Pilihan</p>
                    </div>
                    <div class="w-px h-10" style="background:rgba(255,255,255,0.2);"></div>
                    <div>
                        <p class="text-2xl font-bold text-white">10K+</p>
                        <p class="text-xs" style="color:rgba(255,255,255,0.5);">Pelanggan Puas</p>
                    </div>
                    <div class="w-px h-10" style="background:rgba(255,255,255,0.2);"></div>
                    <div>
                        <p class="text-2xl font-bold" style="color:#e8b84b;">4.9★</p>
                        <p class="text-xs" style="color:rgba(255,255,255,0.5);">Rating</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('packages.index') }}" class="btn-primary text-white font-bold px-8 py-4 rounded-2xl text-sm">
                        Eksplor Menu →
                    </a>
                    <a href="{{ route('about') }}" class="font-semibold px-8 py-4 rounded-2xl text-sm border-2 transition-all hover:bg-white"
                        style="border-color:rgba(255,255,255,0.4); color:white;">
                        Konsultasi Menu
                    </a>
                </div>
            </div>

            {{-- Right: Food showcase --}}
            <div class="flex-1 hero-img relative">
                <div class="relative">
                    {{-- Main food image --}}
                    <div class="rounded-3xl overflow-hidden shadow-2xl" style="background:#1a3d1e;">
                        <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=700&q=85"
                            alt="Nasi Tumpeng"
                            class="w-full h-80 lg:h-96 object-cover opacity-90">
                    </div>

                    {{-- Floating mini cards --}}
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-4 shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=100&q=80" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Nasi Kotak Premium</p>
                                <p class="text-xs text-green-600 font-bold">Rp 85.000/pax</p>
                                <div class="flex text-yellow-400 text-xs mt-0.5">★★★★★</div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -top-4 -right-4 bg-white rounded-2xl p-3 shadow-xl">
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Pesanan Hari Ini</p>
                            <p class="text-xl font-bold text-green-600">+124</p>
                        </div>
                    </div>

                    <div class="absolute top-1/2 -right-8 transform -translate-y-1/2 bg-white rounded-2xl p-3 shadow-xl">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=80&q=80" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Gratis Ongkir</p>
                                <p class="text-xs text-green-600">DKI Jakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80L1440 80L1440 20C1200 80 960 0 720 40C480 80 240 0 0 40L0 80Z" fill="#f9fafb" />
        </svg>
    </div>
</section>

{{-- ===== FEATURED CATEGORIES ===== --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-bold uppercase tracking-widest text-green-600 mb-3 px-4 py-1.5 bg-green-50 rounded-full">Kategori Menu</span>
            <h2 class="text-3xl font-bold text-gray-900">Pilihan untuk Setiap Momen</h2>
            <p class="text-gray-500 mt-2">Dari sarapan harian hingga pesta pernikahan, kami siap melayani</p>
        </div>

        {{-- Category Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
            @php
            $categoryIcons = [
            'semua-paket' => ['icon' => '🍽️', 'color' => 'from-green-400 to-emerald-600', 'count' => $packages->count()],
            'prasmanan' => ['icon' => '🍛', 'color' => 'from-amber-400 to-orange-500', 'count' => $packages->where('menu_type','Prasmanan')->count()],
            'nasi-kotak' => ['icon' => '📦', 'color' => 'from-red-400 to-rose-500', 'count' => $packages->where('menu_type','Kotak')->count()],
            'tumpeng' => ['icon' => '🏔️', 'color' => 'from-yellow-400 to-amber-500', 'count' => $packages->where('menu_type','Tumpeng')->count()],
            'harian' => ['icon' => '🥗', 'color' => 'from-teal-400 to-cyan-500', 'count' => $packages->where('menu_type','Snack Box')->count()],
            'snack' => ['icon' => '🧆', 'color' => 'from-purple-400 to-violet-500', 'count' => 0],
            ];
            @endphp

            @foreach($categories as $cat)
            @php $catData = $categoryIcons[$cat->slug] ?? ['icon'=>'🍴','color'=>'from-gray-400 to-gray-600','count'=>0]; @endphp
            <a href="{{ route('packages.index', ['category' => $cat->slug]) }}"
                class="group category-pill">
                <div class="bg-white rounded-2xl p-4 text-center border border-gray-100 hover:border-green-200 hover:shadow-md transition-all">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl transition-transform group-hover:scale-110"
                        style="background: linear-gradient(135deg, {{ str_replace('from-','',explode(' ',$catData['color'])[0]) === 'green-400' ? '#4ade80,#059669' : (str_replace('from-','',explode(' ',$catData['color'])[0]) === 'amber-400' ? '#fbbf24,#f97316' : (str_replace('from-','',explode(' ',$catData['color'])[0]) === 'red-400' ? '#f87171,#f43f5e' : '#a3e635,#eab308')) }});">
                        {{ $catData['icon'] }}
                    </div>
                    <p class="text-xs font-bold text-gray-900">{{ $cat->name }}</p>
                    @if($catData['count'] > 0)
                    <p class="text-xs text-green-600 font-semibold mt-0.5">{{ $catData['count'] }} paket</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        {{-- Category Filter Pills --}}
        <div class="flex items-center gap-3 overflow-x-auto pb-2 mb-8" id="catFilter">
            <button onclick="filterCat('all')" data-cat="all"
                class="category-pill active flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border-2 transition-all"
                style="background:#1a3d1e; color:white; border-color:#1a3d1e;">
                Semua Paket
            </button>
            @foreach($categories->skip(1) as $cat)
            <button onclick="filterCat('{{ $cat->slug }}')" data-cat="{{ $cat->slug }}"
                class="category-pill flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border-2 border-gray-200 text-gray-600 bg-white transition-all hover:border-green-400 hover:text-green-600">
                {{ $cat->name }}
            </button>
            @endforeach
        </div>

        {{-- Packages Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="packagesGrid">
            @forelse($packages as $package)
            <div class="pkg-card bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm"
                data-category="{{ $package->category->slug ?? '' }}"
                data-menu="{{ strtolower($package->menu_type) }}">

                {{-- Image --}}
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">

                    {{-- Badges --}}
                    <div class="absolute top-3 left-3 flex gap-2">
                        @if($package->is_bestseller)
                        <span class="badge-spice text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                            🔥 Terlaris
                        </span>
                        @elseif($package->badge)
                        <span class="bg-white text-gray-800 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                            {{ $package->badge }}
                        </span>
                        @endif
                    </div>

                    {{-- Rating --}}
                    <div class="absolute top-3 right-3 bg-white rounded-full px-2.5 py-1 flex items-center gap-1 shadow-sm">
                        <span class="text-amber-400 text-xs">★</span>
                        <span class="text-xs font-bold text-gray-900">{{ number_format($package->rating, 1) }}</span>
                    </div>

                    {{-- Category chip --}}
                    <div class="absolute bottom-3 left-3">
                        <span class="bg-black/60 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full">
                            {{ $package->menu_type }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 line-clamp-2">{{ $package->name }}</h3>
                    <p class="text-gray-400 text-xs mb-3 line-clamp-2">{{ $package->short_description }}</p>

                    {{-- Pax info --}}
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xs text-gray-500">Min. {{ $package->min_pax }} pax
                            @if($package->max_pax) – {{ $package->max_pax }} pax @endif
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400">Mulai dari</p>
                            <p class="text-lg font-bold text-green-600">{{ $package->formatted_price }}</p>
                            <p class="text-xs text-gray-400">/pax</p>
                        </div>
                        <a href="{{ route('packages.show', $package->slug) }}"
                            class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all hover:shadow-md hover:shadow-green-200">
                            Pesan →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-16 text-gray-400">
                <div class="text-6xl mb-4">🍽️</div>
                <p class="text-lg font-medium">Belum ada paket tersedia</p>
                <p class="text-sm mt-1">Silakan jalankan seeder terlebih dahulu</p>
            </div>
            @endforelse
        </div>

        @if($packages->count() > 8)
        <div class="text-center mt-10">
            <a href="{{ route('packages.index') }}"
                class="inline-flex items-center gap-2 border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white font-bold px-8 py-3 rounded-xl transition-all">
                Lihat Semua Menu
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ===== WHY US SECTION ===== --}}
<section class="py-20" style="background: linear-gradient(135deg, #f0fdf4, #fefce8);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 px-3 py-1.5 bg-amber-50 rounded-full">Mengapa Splitbill?</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6 leading-tight">
                    Pengalaman Kuliner<br>
                    <span class="text-green-600">yang Tak Terlupakan</span>
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Kami memadukan tradisi memasak Nusantara dengan standar higienitas modern, memastikan setiap gigitan membawa cita rasa autentik yang terasa seperti masakan ibu.
                </p>

                <div class="space-y-4">
                    @foreach([
                    ['icon'=>'🌿','title'=>'Bahan Organik Lokal','desc'=>'Langsung dari petani terpercaya, segar setiap hari','color'=>'bg-green-100'],
                    ['icon'=>'⏱️','title'=>'Pengiriman Tepat Waktu','desc'=>'Komitmen 100% on-time, atau kami refund','color'=>'bg-blue-100'],
                    ['icon'=>'👨‍🍳','title'=>'Chef Berpengalaman','desc'=>'Tim chef dengan 10+ tahun keahlian masakan Nusantara','color'=>'bg-amber-100'],
                    ['icon'=>'🏆','title'=>'Bersertifikat Halal & BPOM','desc'=>'Terjamin aman untuk seluruh keluarga','color'=>'bg-purple-100'],
                    ] as $item)
                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 {{ $item['color'] }} rounded-xl flex items-center justify-center text-xl flex-shrink-0">
                            {{ $item['icon'] }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $item['title'] }}</p>
                            <p class="text-gray-500 text-xs mt-0.5">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Image grid --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="rounded-2xl overflow-hidden h-48 shadow-md">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden h-32 shadow-md">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="rounded-2xl overflow-hidden h-32 shadow-md">
                        <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden h-48 shadow-md">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== BESTSELLER BANNER ===== --}}
@php $bestsellers = $packages->where('is_bestseller', true)->take(3); @endphp
@if($bestsellers->isNotEmpty())
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-red-500 px-3 py-1.5 bg-red-50 rounded-full">🔥 Paling Diminati</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-3">Paket Bestseller</h2>
            </div>
            <a href="{{ route('packages.index') }}" class="text-green-600 font-bold text-sm hover:underline hidden sm:block">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($bestsellers as $i => $pkg)
            <div class="pkg-card rounded-3xl overflow-hidden shadow-sm border border-gray-100 relative {{ $i === 0 ? 'md:col-span-1 row-span-2' : '' }}">
                <div class="{{ $i === 0 ? 'h-80' : 'h-52' }} overflow-hidden relative">
                    <img src="{{ $pkg->image_url }}" alt="{{ $pkg->name }}"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <p class="text-white font-bold text-lg leading-tight">{{ $pkg->name }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-green-300 font-bold">{{ $pkg->formatted_price }}/pax</p>
                            <a href="{{ route('packages.show', $pkg->slug) }}"
                                class="bg-white text-gray-900 text-xs font-bold px-4 py-1.5 rounded-full hover:bg-green-600 hover:text-white transition-all">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== PROMO BANNER ===== --}}
<section class="py-16" style="background:linear-gradient(135deg, #1a3d1e 0%, #2d5a32 50%, #1a3d1e 100%);">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full" style="background:rgba(232,184,75,0.2);">
            <span style="color:#e8b84b;" class="text-sm font-bold">🎉 Promo Spesial</span>
        </div>
        <h2 class="text-4xl font-bold text-white mb-4">Gratis Ongkir Seluruh DKI Jakarta</h2>
        <p class="text-lg mb-8" style="color:rgba(255,255,255,0.7);">
            Untuk setiap pesanan minimal 20 pax. Berlaku setiap hari!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('packages.index') }}" class="btn-primary text-white font-bold px-8 py-4 rounded-2xl">
                Pesan Sekarang →
            </a>
            <a href="{{ route('about') }}"
                class="border-2 border-white/40 text-white font-bold px-8 py-4 rounded-2xl hover:bg-white hover:text-green-800 transition-all">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-green-600 px-3 py-1.5 bg-green-50 rounded-full">Ulasan Pelanggan</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Kata Mereka tentang Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
            ['name'=>'Ahmad Fauzi','role'=>'Wali Asrama','review'=>'Luar biasa! Prasmanan untuk acara pernikahan 500 orang berjalan sempurna. Tepat waktu dan makanannya enak sekali.','rating'=>5,'avatar'=>'BP','color'=>'bg-green-100 text-green-700'],
            ['name'=>'Ahmad Rifai','role'=>'Penyelia Asrama','review'=>'Sudah 3 bulan langganan nasi kotak untuk makan siang kantor. Konsisten enak dan harga sangat terjangkau!','rating'=>5,'avatar'=>'SR','color'=>'bg-amber-100 text-amber-700'],
            ['name'=>'Ahmad Dahlan','role'=>'Kepala Sekolah','review'=>'Tumpeng ultah anak saya cantik banget! Tim sangat profesional dan responsif. Highly recommended and good!','rating'=>5,'avatar'=>'DS','color'=>'bg-purple-100 text-purple-700'],
            ] as $t)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div class="flex text-amber-400 mb-4">
                    @for($i=0;$i<$t['rating'];$i++) ★ @endfor
                        </div>
                        <p class="text-gray-700 text-sm leading-relaxed mb-5 italic">"{{ $t['review'] }}"</p>
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ $t['name'] }}</p>
                                <p class="text-gray-400 text-xs">{{ $t['role'] }}</p>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-green-600 px-3 py-1.5 bg-green-50 rounded-full">Cara Pesan</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Mudah dalam 4 Langkah</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
            ['step'=>'01','icon'=>'🔍','title'=>'Pilih Menu','desc'=>'Jelajahi ratusan pilihan paket katering kami'],
            ['step'=>'02','icon'=>'🛒','title'=>'Tambah Keranjang','desc'=>'Pilih jumlah pax sesuai kebutuhan acara'],
            ['step'=>'03','icon'=>'💳','title'=>'Bayar Mudah','desc'=>'Berbagai metode pembayaran tersedia'],
            ['step'=>'04','icon'=>'🚚','title'=>'Terima Pesanan','desc'=>'Diantar tepat waktu ke lokasi Anda'],
            ] as $step)
            <div class="text-center group">
                <div class="relative inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mx-auto bg-green-50 group-hover:bg-green-600 transition-all duration-300">
                        {{ $step['icon'] }}
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                        {{ $step['step'] }}
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1">{{ $step['title'] }}</h3>
                <p class="text-gray-400 text-xs leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('packages.index') }}"
                class="btn-primary inline-flex items-center gap-2 text-white font-bold px-8 py-4 rounded-2xl text-sm">
                Mulai Pesan Sekarang
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>

<script>
    function filterCat(cat) {
        const cards = document.querySelectorAll('#packagesGrid [data-category]');
        const btns = document.querySelectorAll('#catFilter button');

        btns.forEach(b => {
            if (b.dataset.cat === cat) {
                b.style.background = '#1a3d1e';
                b.style.color = 'white';
                b.style.borderColor = '#1a3d1e';
            } else {
                b.style.background = 'white';
                b.style.color = '#4b5563';
                b.style.borderColor = '#e5e7eb';
            }
        });

        cards.forEach(card => {
            if (cat === 'all' || card.dataset.category === cat) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.4s ease forwards';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

@endsection