@extends('layouts.app')
@section('title', 'Semua Menu')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Menu</h1>
    <p class="text-gray-500 text-sm mb-8">Pilih paket katering terbaik untuk momen Anda.</p>

    {{-- Category Filter --}}
    <div class="flex items-center gap-3 mb-8 overflow-x-auto pb-2">
        @foreach($categories as $cat)
        <a href="{{ route('packages.index', ['category' => $cat->slug]) }}"
           class="{{ request('category') === $cat->slug || (!request('category') && $loop->first)
                    ? 'bg-green-600 text-white'
                    : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }}
                  px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    {{-- Grid --}}
    @if($packages->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>Tidak ada paket untuk kategori ini.</p>
            <a href="{{ route('packages.index') }}" class="text-green-600 text-sm mt-2 inline-block hover:underline">
                Lihat semua paket
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($packages as $package)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="relative h-48 overflow-hidden bg-gray-50">
                    <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @if($package->badge)
                        <span class="absolute top-3 right-3 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{ $package->badge }}
                        </span>
                    @endif
                </div>
                <div class="p-5">
                    <span class="text-xs text-green-600 font-semibold uppercase tracking-wide">
                        {{ $package->menu_type }}
                    </span>
                    <h3 class="font-bold text-gray-900 text-lg mt-1 mb-2">{{ $package->name }}</h3>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $package->short_description }}</p>

                    <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                        <div>
                            <span class="text-green-600 font-bold">{{ $package->formatted_price }}</span>
                            <span class="text-gray-400 text-xs">/pax</span>
                        </div>
                        <div class="flex items-center gap-1 text-amber-500 text-xs">
                            ★ {{ number_format($package->rating, 1) }}
                            <span class="text-gray-400">({{ $package->review_count }})</span>
                        </div>
                    </div>
                    <a href="{{ route('packages.show', $package->slug) }}"
                       class="mt-3 block w-full text-center bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2.5 rounded-xl transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
