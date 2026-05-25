@extends('layouts.app')
@section('title', 'Splitbill — Katering Premium Nusantara')

@section('content')

<style>
.float-anim { animation: floatUp 6s ease-in-out infinite; }
.float-anim-2 { animation: floatUp 8s ease-in-out infinite 2s; }
.float-anim-3 { animation: floatUp 7s ease-in-out infinite 1s; }
.hero-text-in { animation: slideUp 0.8s ease forwards; }
.hero-img-in { animation: scaleUp 1s ease 0.3s both; }
.pkg-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.pkg-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.12); }
.clamp2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-clamp:2; }
.btn-hero { background: linear-gradient(135deg, #27ae60, #1e8449); transition: all 0.3s ease; }
.btn-hero:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(39,174,96,0.4); }
.cat-pill { transition: all 0.25s ease; }
.cat-pill:hover { transform: translateY(-2px); }

@keyframes floatUp {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-18px); }
}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes scaleUp {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
</style>

{{-- ===== HERO ===== --}}
<section class="relative overflow-hidden" style="background: linear-gradient(135deg, #0d1f0e 0%, #1a3d1e 40%, #2d5a32 100%); min-height: 92vh;">

    {{-- Glow decorations --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-10 w-96 h-96 rounded-full" style="background: radial-gradient(circle, rgba(232,184,75,0.12) 0%, transparent 70%);"></div>
        <div class="absolute bottom-20 left-20 w-64 h-64 rounded-full" style="background: radial-gradient(circle, rgba(192,57,43,0.1) 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 rounded-full" style="background: radial-gradient(circle, rgba(39,174,96,0.06) 0%, transparent 70%); transform: translate(-50%,-50%);"></div>
        <div class="float-anim absolute top-24 left-1/4 w-3 h-3 rounded-full" style="background:#e8b84b; opacity:0.6;"></div>
        <div class="float-anim-2 absolute top-40 right-1/3 w-2 h-2 rounded-full" style="background:#c0392b; opacity:0.4;"></div>
        <div class="float-anim-3 absolute bottom-32 right-1/4 w-4 h-4 rounded-full" style="background:#27ae60; opacity:0.3;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 py-20 lg:py-28">

            {{-- Left text --}}
            <div class="flex-1 hero-text-in">
                <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full" style="border: 1px solid rgba(232,184,75,0.4); background: rgba(232,184,75,0.1);">
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
                    <a href="{{ route('packages.index') }}" class="btn-hero text-white font-bold px-8 py-4 rounded-2xl text-sm">
                        Eksplor Menu →
                    </a>
                </div>
            </div>

            {{-- Right food showcase --}}
            <div class="flex-1 hero-img-in relative">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=700&q=85"
                             alt="Nasi Tumpeng" class="w-full object-cover" style="height:380px;">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-4 shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=100&q=80" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Nasi Kotak Premium</p>
                                <p class="text-xs font-bold" style="color:#16a34a;">Rp 85.000/pax</p>
                                <p style="color:#f59e0b; font-size:11px;">★★★★★</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 bg-white rounded-2xl p-3 shadow-xl text-center">
                        <p class="text-xs text-gray-500">Pesanan Hari Ini</p>
                        <p class="text-xl font-bold" style="color:#16a34a;">+124</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 80L1440 80L1440 20C1200 80 960 0 720 40C480 80 240 0 0 40L0 80Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

{{-- ===== CATEGORIES & PACKAGES ===== --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-3" style="color:#16a34a; background:#f0fdf4;">Pilihan Menu</span>
            <h2 class="text-3xl font-bold text-gray-900">Paket untuk Setiap Momen</h2>
            <p class="text-gray-500 mt-2">Dari sarapan harian hingga pesta pernikahan mewah</p>
        </div>

        {{-- Category pills --}}
        <div class="flex items-center gap-3 overflow-x-auto pb-2 mb-8" id="catFilter">
            <button class="cat-pill flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border-2 text-white" id="btn-all"
                    style="background:#1a3d1e; border-color:#1a3d1e;"
                    onclick="filterPkg('all', this)">
                Semua Paket
            </button>
            @foreach($categories->skip(1) as $cat)
            <button class="cat-pill flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-bold border-2 border-gray-200 bg-white text-gray-600 hover:border-green-400 hover:text-green-600"
                    id="btn-{{ $cat->slug }}"
                    onclick="filterPkg('{{ $cat->slug }}', this)">
                {{ $cat->name }}
            </button>
            @endforeach
        </div>

        {{-- Packages Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="packagesGrid">
            @forelse($packages as $package)
            <div class="pkg-card bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm"
                 data-cat="{{ $package->category->slug ?? '' }}">

                <div class="relative overflow-hidden" style="height:192px;">
                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div class="absolute top-3 left-3 flex gap-2">
                        @if($package->is_bestseller)
                        <span class="text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm" style="background: linear-gradient(135deg, #e8b84b, #d4930a);">
                            🔥 Terlaris
                        </span>
                        @elseif($package->badge)
                        <span class="bg-white text-gray-800 text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">
                            {{ $package->badge }}
                        </span>
                        @endif
                    </div>
                    <div class="absolute top-3 right-3 bg-white rounded-full px-2.5 py-1 flex items-center gap-1 shadow-sm">
                        <span style="color:#f59e0b; font-size:12px;">★</span>
                        <span class="text-xs font-bold text-gray-900">{{ number_format($package->rating, 1) }}</span>
                    </div>
                    <div class="absolute bottom-3 left-3">
                        <span class="text-white text-xs font-medium px-3 py-1 rounded-full" style="background:rgba(0,0,0,0.6);">
                            {{ $package->menu_type }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="font-bold text-gray-900 text-base leading-tight mb-1 clamp2">{{ $package->name }}</h3>
                    <p class="text-gray-400 text-xs mb-3 clamp2">{{ $package->short_description }}</p>

                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-xs text-gray-500">
                            Min. {{ $package->min_pax }} pax
                            @if($package->max_pax) – {{ $package->max_pax }} pax @endif
                        </span>
                    </div>

                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-xs text-gray-400">Mulai dari</p>
                            <p class="text-lg font-bold" style="color:#16a34a;">{{ $package->formatted_price }}</p>
                            <p class="text-xs text-gray-400">/pax</p>
                        </div>
                        <a href="{{ route('packages.show', $package->slug) }}"
                           class="text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all hover:shadow-md"
                           style="background:#16a34a;"
                           onmouseover="this.style.background='#15803d'"
                           onmouseout="this.style.background='#16a34a'">
                            Pesan →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-20">
                <div class="text-6xl mb-4">🍽️</div>
                <p class="text-lg font-medium text-gray-500">Belum ada paket tersedia</p>
                <p class="text-sm text-gray-400 mt-1">Jalankan <code class="bg-gray-100 px-2 py-0.5 rounded">php artisan db:seed</code></p>
            </div>
            @endforelse
        </div>

        @if($packages->count() >= 8)
        <div class="text-center mt-10">
            <a href="{{ route('packages.index') }}"
               class="inline-flex items-center gap-2 font-bold px-8 py-3 rounded-xl transition-all border-2 hover:text-white"
               style="border-color:#16a34a; color:#16a34a;"
               onmouseover="this.style.background='#16a34a'; this.style.color='white';"
               onmouseout="this.style.background='transparent'; this.style.color='#16a34a';">
                Lihat Semua Menu
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ===== WHY US ===== --}}
<section class="py-20" style="background: linear-gradient(135deg, #f0fdf4, #fefce8);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full" style="color:#d97706; background:#fef3c7;">Mengapa Splitbill?</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-6 leading-tight">
                    Pengalaman Kuliner<br>
                    <span style="color:#16a34a;">yang Tak Terlupakan</span>
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Kami memadukan tradisi memasak Nusantara dengan standar higienitas modern, memastikan setiap gigitan membawa cita rasa autentik.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">🌿</div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">Bahan Organik Lokal</p>
                            <p class="text-gray-500 text-xs mt-0.5">Langsung dari petani terpercaya, segar setiap hari</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">⏱️</div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">Pengiriman Tepat Waktu</p>
                            <p class="text-gray-500 text-xs mt-0.5">Komitmen 100% on-time, atau kami refund</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">👨‍🍳</div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">Chef Berpengalaman</p>
                            <p class="text-gray-500 text-xs mt-0.5">Tim chef dengan 10+ tahun keahlian masakan Nusantara</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-green-200 hover:shadow-sm transition-all">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">🏆</div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">Bersertifikat Halal & BPOM</p>
                            <p class="text-gray-500 text-xs mt-0.5">Terjamin aman untuk seluruh keluarga</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="rounded-2xl overflow-hidden shadow-md" style="height:192px;">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md" style="height:128px;">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="rounded-2xl overflow-hidden shadow-md" style="height:128px;">
                        <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-md" style="height:192px;">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== PROMO BANNER ===== --}}
<section class="py-16" style="background:linear-gradient(135deg, #1a3d1e 0%, #2d5a32 50%, #1a3d1e 100%);">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full" style="background:rgba(232,184,75,0.2);">
            <span style="color:#e8b84b;" class="text-sm font-bold">🎉 Promo Spesial</span>
        </div>
        <h2 class="text-4xl font-bold text-white mb-4">Gratis Ongkir Seluruh DKI Jakarta</h2>
        <p class="text-lg mb-8" style="color:rgba(255,255,255,0.7);">Untuk setiap pesanan minimal 20 pax. Berlaku setiap hari!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('packages.index') }}" class="btn-hero text-white font-bold px-8 py-4 rounded-2xl">
                Pesan Sekarang →
            </a>
            <a href="{{ route('about') }}"
               class="border-2 text-white font-bold px-8 py-4 rounded-2xl transition-all hover:bg-white hover:text-green-800"
               style="border-color:rgba(255,255,255,0.4);">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full" style="color:#16a34a; background:#f0fdf4;">Ulasan Pelanggan</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Kata Mereka tentang Kami</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div style="color:#f59e0b;" class="mb-4 text-lg">★★★★★</div>
                <p class="text-gray-700 text-sm leading-relaxed mb-5 italic">"Sangat puas dengan layanan prasmanannya untuk gathering kantor. Makanannya premium, plating-nya rapi, dan timnya sangat profesional."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-100 text-green-700 rounded-full flex items-center justify-center font-bold text-sm">AS</div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Agus Saputra</p>
                        <p class="text-gray-400 text-xs">Pengusaha</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div style="color:#f59e0b;" class="mb-4 text-lg">★★★★★</div>
                <p class="text-gray-700 text-sm leading-relaxed mb-5 italic">"Sudah jadi langganan tetap untuk acara rutin di rumah sakit. Rasanya konsisten enak, bersih, dan pengirimannya selalu on-time."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-100 text-amber-700 rounded-full flex items-center justify-center font-bold text-sm">BS</div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Budi Santoso</p>
                        <p class="text-gray-400 text-xs">Dokter</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div style="color:#f59e0b;" class="mb-4 text-lg">★★★★★</div>
                <p class="text-gray-700 text-sm leading-relaxed mb-5 italic">"Katering terbaik untuk acara kedinasan. Menu nusantaranya sangat otentik dan disukai oleh semua rekan kerja di kantor."</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-100 text-purple-700 rounded-full flex items-center justify-center font-bold text-sm">SL</div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Sari Lestari</p>
                        <p class="text-gray-400 text-xs">Pegawai Negeri Sipil</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full" style="color:#16a34a; background:#f0fdf4;">Cara Pesan</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-4">Mudah dalam 4 Langkah</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center group">
                <div class="relative inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mx-auto bg-green-50 group-hover:bg-green-600 transition-all duration-300">🔍</div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center">01</div>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1">Pilih Menu</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Jelajahi ratusan pilihan paket katering kami</p>
            </div>
            <div class="text-center group">
                <div class="relative inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mx-auto bg-green-50 group-hover:bg-green-600 transition-all duration-300">🛒</div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center">02</div>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1">Tambah Keranjang</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Pilih jumlah pax sesuai kebutuhan acara</p>
            </div>
            <div class="text-center group">
                <div class="relative inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mx-auto bg-green-50 group-hover:bg-green-600 transition-all duration-300">💳</div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center">03</div>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1">Bayar Mudah</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Berbagai metode pembayaran tersedia</p>
            </div>
            <div class="text-center group">
                <div class="relative inline-block mb-4">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mx-auto bg-green-50 group-hover:bg-green-600 transition-all duration-300">🚚</div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center">04</div>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-1">Terima Pesanan</h3>
                <p class="text-gray-400 text-xs leading-relaxed">Diantar tepat waktu ke lokasi Anda</p>
            </div>
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('packages.index') }}"
               class="btn-hero inline-flex items-center gap-2 text-white font-bold px-8 py-4 rounded-2xl text-sm">
                Mulai Pesan Sekarang
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<script>
function filterPkg(cat, btn) {
    document.querySelectorAll('#catFilter button').forEach(function(b) {
        b.style.background = 'white';
        b.style.color = '#4b5563';
        b.style.borderColor = '#e5e7eb';
    });
    btn.style.background = '#1a3d1e';
    btn.style.color = 'white';
    btn.style.borderColor = '#1a3d1e';

    document.querySelectorAll('#packagesGrid [data-cat]').forEach(function(card) {
        if (cat === 'all' || card.dataset.cat === cat) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection
