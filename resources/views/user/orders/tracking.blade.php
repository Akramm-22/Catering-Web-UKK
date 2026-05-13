@extends('layouts.app')
@section('title', 'Lacak Pesanan')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Lacak Perjalanan Rasa</h1>
        <p class="text-gray-500 text-sm mt-1">
            Pantau status pesanan kurasi kuliner Anda dari dapur kami hingga tiba di meja saji Anda.
        </p>
    </div>

    {{-- Search Form --}}
    @if(!isset($order))
    <form action="{{ route('tracking.index') }}" method="GET" class="mb-8">
        <div class="flex gap-3 max-w-lg">
            <input type="text" name="resi" placeholder="Masukkan nomor resi (contoh: AG-XXXXXXXX)"
                   value="{{ request('resi') }}"
                   class="flex-1 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-xl transition">
                Cari
            </button>
        </div>
    </form>
    @endif

    @if(isset($order))
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left: Timeline --}}
        <div class="lg:col-span-2">
            {{-- Order Header --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold mb-1">Nomor Resi</p>
                        <p class="text-2xl font-bold text-gray-900">#{{ $order->receipt_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 mb-1">Tanggal Pesan</p>
                        <p class="text-sm font-semibold text-gray-700">
                            {{ $order->order_date ? $order->order_date->format('d M Y') : $order->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 mb-1">Status Pesan</p>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Progress Bar --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-6">
                <p class="font-bold text-gray-900 mb-6">Progress Pengiriman</p>
                @php
                    $steps = [
                        ['key' => 'pending', 'label' => 'Pesanan Diterima', 'icon' => '📋'],
                        ['key' => 'processing', 'label' => 'Diproses', 'icon' => '🍳'],
                        ['key' => 'shipped', 'label' => 'Dalam Perjalanan', 'icon' => '🚚'],
                        ['key' => 'delivered', 'label' => 'Tiba di Tujuan', 'icon' => '✅'],
                    ];
                    $statusOrder = ['pending','waiting_confirmation','processing','cooking','shipped','delivered','completed'];
                    $currentIndex = array_search($order->status, $statusOrder) ?: 0;
                @endphp
                <div class="flex items-center justify-between">
                    @foreach($steps as $i => $step)
                    @php
                        $stepIndex = array_search($step['key'], $statusOrder) ?: 0;
                        $isDone = $currentIndex >= $stepIndex;
                    @endphp
                    <div class="flex flex-col items-center flex-1">
                        <div class="{{ $isDone ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-400' }}
                                    w-10 h-10 rounded-full flex items-center justify-center text-lg transition">
                            {{ $step['icon'] }}
                        </div>
                        <p class="text-xs text-center mt-2 {{ $isDone ? 'text-gray-900 font-medium' : 'text-gray-400' }}">
                            {{ $step['label'] }}
                        </p>
                    </div>
                    @if(!$loop->last)
                    <div class="{{ $currentIndex > $stepIndex ? 'bg-green-400' : 'bg-gray-200' }} flex-1 h-0.5 mx-1 -mt-5 transition"></div>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- Timeline Detail --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="space-y-6">
                    @forelse($order->trackings as $track)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="{{ $track->is_latest ? 'bg-green-600' : 'bg-gray-300' }} w-3 h-3 rounded-full mt-1 flex-shrink-0"></div>
                            @if(!$loop->last)
                            <div class="w-px flex-1 bg-gray-200 mt-1"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-4">
                            <div class="flex items-center gap-2 mb-1">
                                <p class="font-bold text-gray-900 text-sm">{{ $track->title }}</p>
                                @if($track->is_latest)
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">TERBARU</span>
                                @endif
                            </div>
                            <p class="text-gray-500 text-sm">{{ $track->description }}</p>
                            <p class="text-gray-400 text-xs mt-1">
                                {{ \Carbon\Carbon::parse($track->happened_at)->format('d M Y, H:i') }} WIB
                            </p>
                            @if($track->photo)
                            <img src="{{ asset('storage/'.$track->photo) }}"
                                 class="mt-3 w-32 h-24 object-cover rounded-xl" alt="Bukti foto">
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada update tracking.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right: Status Card --}}
        <div class="space-y-4">
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Status Kirim</p>
                        <p class="text-xs text-green-600 font-semibold uppercase">
                            {{ $order->status_label }}
                        </p>
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal Kirim</span>
                        <span class="font-medium text-gray-900">
                            {{ $order->updated_at->format('d M Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Estimasi Tiba</span>
                        <span class="font-medium text-gray-900">
                            {{ $order->updated_at->addDay()->format('d M Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium text-green-600">On Process</span>
                    </div>
                </div>
            </div>

            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                <p class="font-bold text-gray-900 mb-1">Butuh Bantuan?</p>
                <p class="text-sm text-gray-500 mb-3">
                    Hubungi tim kurator kami jika Anda memiliki permintaan khusus.
                </p>
                <a href="#"
                   class="inline-block bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-4 py-2 rounded-xl transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    @else
    {{-- No order found --}}
    <div class="text-center py-16">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <p class="text-gray-500">Masukkan nomor resi untuk melacak pesanan Anda.</p>
        @auth
        <a href="{{ route('orders.index') }}" class="text-green-600 text-sm mt-2 inline-block hover:underline">
            Lihat semua pesanan saya
        </a>
        @endauth
    </div>
    @endif
</div>
@endsection
