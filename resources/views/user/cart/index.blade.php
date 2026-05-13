@extends('layouts.app')
@section('title', 'Keranjang Pesanan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Keranjang Pesanan</h1>
            <p class="text-gray-500 text-sm mt-1">
                @if(!empty($cart))
                    {{ count($cart) }} paket dipilih · Total Rp {{ number_format($total + 45000 + ($total * 0.02), 0, ',', '.') }}
                @else
                    Belum ada paket yang dipilih
                @endif
            </p>
        </div>
        <a href="{{ route('packages.index') }}"
           class="hidden sm:flex items-center gap-2 border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-600 text-sm font-medium px-4 py-2 rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Paket
        </a>
    </div>

    @if(empty($cart))
    {{-- Empty State --}}
    <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 shadow-sm">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Keranjang Anda Masih Kosong</h2>
        <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto">
            Belum ada paket yang dipilih. Yuk jelajahi menu katering premium kami!
        </p>
        <a href="{{ route('packages.index') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl transition hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
            Jelajahi Menu
        </a>
    </div>

    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left: Cart Items --}}
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $key => $item)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-green-200 hover:shadow-md transition-all group">
                <div class="flex items-start gap-4">
                    {{-- Image --}}
                    <div class="relative flex-shrink-0">
                        <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=200' }}"
                             alt="{{ $item['name'] }}"
                             class="w-24 h-24 rounded-xl object-cover shadow-sm group-hover:shadow-md transition">
                        @if(isset($item['badge']) && $item['badge'])
                        <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ $item['badge'] }}
                        </span>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-green-600 uppercase tracking-wide">{{ $item['menu_type'] ?? 'Paket Katering' }}</p>
                                <h3 class="font-bold text-gray-900 text-base mt-0.5 leading-tight">{{ $item['name'] }}</h3>
                                <p class="text-xs text-gray-400 mt-1">Min. {{ $item['min_pax'] }} pax</p>
                            </div>
                            <form action="{{ route('cart.remove', $key) }}" method="POST" class="flex-shrink-0">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-600 flex items-center justify-center transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            {{-- Price --}}
                            <div>
                                <p class="text-green-600 font-bold text-lg">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </p>
                                <p class="text-gray-400 text-xs">Rp {{ number_format($item['price'], 0, ',', '.') }}/pax</p>
                            </div>

                            {{-- Qty Control --}}
                            <form action="{{ route('cart.update', $key) }}" method="POST"
                                  class="flex items-center gap-2" x-data="{ qty: {{ $item['qty'] }} }">
                                @csrf @method('PATCH')
                                <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                                    <button type="button"
                                        @click="qty = Math.max({{ $item['min_pax'] }}, qty - 10)"
                                        class="w-9 h-9 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold flex items-center justify-center transition text-lg">
                                        −
                                    </button>
                                    <input type="number" name="qty" x-model="qty"
                                           min="{{ $item['min_pax'] }}" step="1"
                                           class="w-16 h-9 text-center text-sm font-bold border-x border-gray-200 focus:outline-none bg-white">
                                    <button type="button"
                                        @click="qty = qty + 10"
                                        class="w-9 h-9 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold flex items-center justify-center transition text-lg">
                                        +
                                    </button>
                                </div>
                                <button type="submit"
                                    class="h-9 px-3 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-bold rounded-xl transition">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Rekomendasi Paket Lain --}}
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100 p-6 mt-6">
                <h3 class="font-bold text-gray-900 mb-1">Tambahkan Paket Lain?</h3>
                <p class="text-gray-500 text-sm mb-4">Lengkapi pesanan Anda dengan paket katering lainnya.</p>
                <a href="{{ route('packages.index') }}"
                   class="inline-flex items-center gap-2 bg-white border border-green-200 text-green-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-green-600 hover:text-white hover:border-green-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Lihat Semua Menu
                </a>
            </div>

            {{-- Keunggulan --}}
            <div class="grid grid-cols-3 gap-3 mt-4">
                <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-900">Bahan Segar</p>
                    <p class="text-xs text-gray-400 mt-0.5">Langsung dari petani</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-900">Tepat Waktu</p>
                    <p class="text-xs text-gray-400 mt-0.5">Pengiriman terjadwal</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center shadow-sm">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-gray-900">Rating 4.9★</p>
                    <p class="text-xs text-gray-400 mt-0.5">10K+ pelanggan puas</p>
                </div>
            </div>
        </div>

        {{-- Right: Summary --}}
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                <h2 class="font-bold text-gray-900 mb-5 pb-4 border-b border-gray-100">Ringkasan Belanja</h2>

                <div class="space-y-3 text-sm mb-5">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal ({{ count($cart) }} paket)</span>
                        <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Biaya Pengiriman</span>
                        <span class="font-medium">Rp 45.000</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Biaya Layanan (2%)</span>
                        <span class="font-medium">Rp {{ number_format($total * 0.02, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between font-bold text-gray-900">
                        <span>Total Pembayaran</span>
                        <span class="text-xl text-green-600">
                            Rp {{ number_format($total + 45000 + ($total * 0.02), 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                {{-- Promo Code --}}
                <div class="mb-5">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode Promo</p>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Masukkan kode promo"
                            class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        <button class="bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition">
                            Pakai
                        </button>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}"
                   class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition hover:shadow-lg hover:shadow-green-200 text-base">
                    Lanjut ke Checkout
                    <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

                <a href="{{ route('packages.index') }}"
                   class="block w-full text-center text-gray-500 text-sm hover:text-green-600 transition py-3">
                    ← Lanjut Belanja
                </a>

                {{-- Keamanan --}}
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-xs text-gray-400 justify-center">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Pembayaran aman & terenkripsi
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
