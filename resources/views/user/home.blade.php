@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Hero Banner --}}
    <div class="mt-6 rounded-3xl overflow-hidden bg-gray-900 relative" style="min-height:320px">
        <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=1200&q=80"
             alt="Hero" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between p-10 lg:p-14 h-full">
            <div class="text-white max-w-lg">
                <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-3 py-1 rounded-full mb-4">
                    CURATED EXPERIENCE
                </span>
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                    Cita Rasa<br>
                    <span class="text-green-400">Nusantara</span><br>
                    Modern
                </h1>
                <p class="text-white/80 text-sm leading-relaxed mb-8 max-w-sm">
                    Menghadirkan kurasi hidangan terbaik Indonesia dengan sentuhan modern untuk setiap momen istimewa Anda.
                </p>
                <div class="flex items-center gap-3">
                    <a href="{{ route('packages.index') }}"
                       class="bg-green-600 hover:bg-green-500 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Eksplor Menu
                    </a>
                    <a href="#"
                       class="border border-white/40 text-white font-medium px-6 py-3 rounded-xl hover:bg-white/10 transition">
                        Konsultasi Menu
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80"
                     alt="Featured Dish"
                     class="w-72 h-64 object-cover rounded-2xl shadow-2xl border-4 border-white/20">
            </div>
        </div>
    </div>

    {{-- Category Filter --}}
    <div class="flex items-center gap-3 mt-10 overflow-x-auto pb-2" x-data="{ active: 'semua-paket' }">
        @foreach($categories as $cat)
        <a href="{{ route('packages.index', ['category' => $cat->slug]) }}"
           class="{{ request('category') === $cat->slug || (!request('category') && $loop->first)
                    ? 'bg-green-600 text-white'
                    : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300 hover:text-green-600' }}
                  px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    {{-- Packages Grid --}}
    <div class="mt-8 mb-16">
        @if($packages->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <p class="text-lg">Belum ada paket tersedia.</p>
            </div>
        @else
            {{-- Featured Package (first bestseller) --}}
            @php $featured = $packages->firstWhere('is_bestseller', true) ?? $packages->first(); @endphp
            @php $others = $packages->where('id', '!=', $featured->id)->take(5); @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Featured Card --}}
                <div class="lg:col-span-1 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition group">
                    <div class="aspect-square overflow-hidden bg-gray-50">
                        <img src="{{ $featured->image_url }}" alt="{{ $featured->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs text-green-600 font-semibold uppercase tracking-wide">
                                Paket Premium
                            </span>
                            @if($featured->badge)
                                <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                                    {{ $featured->badge }}
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $featured->name }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $featured->short_description }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-green-600 font-bold text-lg">{{ $featured->formatted_price }}</span>
                                <span class="text-gray-400 text-xs">/pax</span>
                            </div>
                        </div>
                        <a href="{{ route('packages.show', $featured->slug) }}"
                           class="mt-4 block w-full text-center border border-gray-200 hover:border-green-400 hover:text-green-600 text-gray-600 text-sm font-medium py-2.5 rounded-xl transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                {{-- Other Packages --}}
                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($others as $package)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition group">
                        <div class="h-40 overflow-hidden bg-gray-50">
                            <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            @if($package->badge)
                                <span class="text-xs text-teal-600 font-semibold uppercase tracking-wide">
                                    {{ $package->badge }}
                                </span>
                            @endif
                            <h3 class="font-bold text-gray-900 mt-1 mb-1">{{ $package->name }}</h3>
                            <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ $package->short_description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-green-600 font-bold text-sm">{{ $package->formatted_price }}</span>
                                <a href="{{ route('packages.show', $package->slug) }}"
                                   class="text-green-600 text-xs font-medium hover:underline">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
