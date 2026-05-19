@extends('layouts.app')
@section('title', 'Lacak Pesanan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Lacak Perjalanan Rasa</h1>
        <p class="text-gray-500 text-sm mt-1">
            Pantau status pesanan kurasi kuliner Anda dari dapur kami hingga tiba di meja saji Anda.
        </p>
    </div>

    @auth
    @if($orders->isEmpty())
    {{-- Empty State --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Riwayat Pesanan</h2>
        <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto">
            Anda belum pernah memesan. Yuk mulai jelajahi menu katering premium kami!
        </p>
        <a href="{{ route('packages.index') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-xl transition hover:shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
            Jelajahi Menu
        </a>
    </div>

    @else

    @if(!$selectedOrder)
    {{-- Order List --}}
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-gray-900 text-lg">Riwayat Pesanan Anda</h2>
            <span class="text-sm text-gray-500">{{ $orders->count() }} pesanan</span>
        </div>

        <div class="space-y-3">
            @foreach($orders as $order)
            @php
                $statusColors = [
                    'pending'              => ['bg'=>'bg-amber-100','text'=>'text-amber-700','dot'=>'bg-amber-500'],
                    'waiting_confirmation' => ['bg'=>'bg-amber-100','text'=>'text-amber-700','dot'=>'bg-amber-500'],
                    'processing'           => ['bg'=>'bg-blue-100','text'=>'text-blue-700','dot'=>'bg-blue-500'],
                    'cooking'              => ['bg'=>'bg-blue-100','text'=>'text-blue-700','dot'=>'bg-blue-500'],
                    'shipped'              => ['bg'=>'bg-purple-100','text'=>'text-purple-700','dot'=>'bg-purple-500'],
                    'delivered'            => ['bg'=>'bg-green-100','text'=>'text-green-700','dot'=>'bg-green-500'],
                    'completed'            => ['bg'=>'bg-green-100','text'=>'text-green-700','dot'=>'bg-green-500'],
                    'cancelled'            => ['bg'=>'bg-red-100','text'=>'text-red-700','dot'=>'bg-red-500'],
                ];
                $sc = $statusColors[$order->status] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700','dot'=>'bg-gray-400'];
            @endphp
            <a href="{{ route('tracking.show', $order->receipt_number) }}"
               class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-green-300 hover:shadow-md transition-all group">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        {{-- Icon --}}
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-green-100 transition">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-green-600 text-sm">#{{ $order->receipt_number }}</p>
                            <p class="text-gray-900 font-semibold text-sm mt-0.5">
                                {{ $order->customer_name }}
                            </p>
                            <p class="text-gray-400 text-xs mt-0.5">
                                {{ $order->items->count() }} paket ·
                                {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="font-bold text-gray-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-400">Total Bayar</p>
                        </div>

                        <div>
                            <span class="inline-flex items-center gap-1.5 {{ $sc['bg'] }} {{ $sc['text'] }} text-xs font-bold px-3 py-1.5 rounded-full">
                                <span class="w-1.5 h-1.5 {{ $sc['dot'] }} rounded-full"></span>
                                {{ $order->status_label }}
                            </span>
                        </div>

                        <div class="text-gray-400 group-hover:text-green-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Progress mini bar --}}
                @php
                    $steps = ['pending','processing','shipped','delivered'];
                    $curIdx = array_search($order->status, ['pending','waiting_confirmation','processing','cooking','shipped','delivered','completed']) ?? 0;
                    $pct = min(100, round($curIdx / 6 * 100));
                @endphp
                <div class="mt-4 pt-4 border-t border-gray-50">
                    <div class="flex items-center justify-between text-xs text-gray-400 mb-1.5">
                        <span>Pesanan Diterima</span>
                        <span>Diproses</span>
                        <span>Dalam Perjalanan</span>
                        <span>Tiba</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="bg-green-500 h-1.5 rounded-full transition-all"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    @else
    {{-- Detail Tracking --}}
    <div class="mb-6">
        <a href="{{ route('tracking.index') }}"
           class="inline-flex items-center gap-2 text-gray-500 hover:text-green-600 text-sm mb-4 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left: Detail --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Order header card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nomor Resi</p>
                        <p class="text-2xl font-bold text-gray-900">#{{ $selectedOrder->receipt_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 mb-1">Tanggal Pesan</p>
                        <p class="font-semibold text-gray-700 text-sm">
                            {{ $selectedOrder->order_date
                                ? \Carbon\Carbon::parse($selectedOrder->order_date)->format('d M Y')
                                : $selectedOrder->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        @php
                            $sc2 = $statusColors[$selectedOrder->status] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700','dot'=>'bg-gray-400'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 {{ $sc2['bg'] }} {{ $sc2['text'] }} text-xs font-bold px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 {{ $sc2['dot'] }} rounded-full"></span>
                            {{ $selectedOrder->status_label }}
                        </span>
                    </div>
                </div>

                {{-- Items ringkasan --}}
                <div class="mt-5 pt-5 border-t border-gray-50">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Item Pesanan</p>
                    <div class="space-y-2">
                        @foreach($selectedOrder->items as $item)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <p class="text-sm font-medium text-gray-900">{{ $item->name }}</p>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $item->qty }} pax</p>
                                <p class="text-sm font-bold text-green-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center pt-3 mt-2 border-t border-dashed border-gray-200">
                        <span class="text-sm font-bold text-gray-900">Total Bayar</span>
                        <span class="text-lg font-bold text-green-600">Rp {{ number_format($selectedOrder->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Progress Steps --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <p class="font-bold text-gray-900 mb-6">Progress Pengiriman</p>
                @php
                    $progressSteps = [
                        ['key'=>'pending','label'=>'Pesanan\nDiterima','icon'=>'📋'],
                        ['key'=>'processing','label'=>'Diproses','icon'=>'👨‍🍳'],
                        ['key'=>'shipped','label'=>'Dalam\nPerjalanan','icon'=>'🚚'],
                        ['key'=>'delivered','label'=>'Tiba di\nTujuan','icon'=>'✅'],
                    ];
                    $statusOrder2 = ['pending','waiting_confirmation','processing','cooking','shipped','delivered','completed','cancelled'];
                    $curStep = array_search($selectedOrder->status, $statusOrder2) ?? 0;
                @endphp
                <div class="flex items-start">
                    @foreach($progressSteps as $si => $step)
                    @php
                        $stepIdx = array_search($step['key'], $statusOrder2) ?? 0;
                        $done = $curStep >= $stepIdx;
                    @endphp
                    <div class="flex flex-col items-center flex-1">
                        <div class="relative">
                            <div class="{{ $done ? 'bg-green-600 text-white shadow-md shadow-green-200' : 'bg-gray-100 text-gray-400' }} w-12 h-12 rounded-xl flex items-center justify-center text-xl transition-all">
                                {{ $step['icon'] }}
                            </div>
                            @if($done && $si < 3)
                            <div class="absolute -right-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-green-600 rounded-full" style="right:-4px;"></div>
                            @endif
                        </div>
                        <p class="text-xs text-center mt-2 {{ $done ? 'text-gray-900 font-semibold' : 'text-gray-400' }} leading-tight whitespace-pre-line">
                            {{ $step['label'] }}
                        </p>
                    </div>
                    @if(!$loop->last)
                    <div class="{{ $curStep > $stepIdx ? 'bg-green-400' : 'bg-gray-200' }} h-0.5 flex-1 mt-6 transition-all mx-1"></div>
                    @endif
                    @endforeach
                </div>
            </div>

            {{-- Timeline --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <p class="font-bold text-gray-900 mb-6">Riwayat Status</p>
                <div class="space-y-0">
                    @forelse($selectedOrder->trackings as $ti => $track)
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full flex-shrink-0 mt-1 {{ $track->is_latest ? 'bg-green-600 ring-4 ring-green-100' : 'bg-gray-300' }}"></div>
                            @if(!$loop->last)
                            <div class="w-0.5 flex-1 bg-gray-100 my-1"></div>
                            @endif
                        </div>
                        <div class="flex-1 pb-6">
                            <div class="flex items-center gap-2 flex-wrap mb-1">
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
                                 class="mt-3 w-40 h-28 object-cover rounded-xl shadow-sm" alt="Bukti foto">
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-400 text-sm">Belum ada update tracking.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right --}}
        <div class="space-y-4">
            {{-- Status Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Status Kirim</p>
                        <p class="text-xs font-semibold text-green-600 uppercase tracking-wide">
                            {{ $selectedOrder->status_label }}
                        </p>
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Tanggal Pesan</span>
                        <span class="font-semibold text-gray-900">{{ $selectedOrder->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Estimasi Tiba</span>
                        <span class="font-semibold text-gray-900">{{ $selectedOrder->created_at->addDays(1)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Metode Bayar</span>
                        <span class="font-semibold text-gray-900 capitalize">{{ str_replace('_',' ',$selectedOrder->payment_method) }}</span>
                    </div>
                    @if($selectedOrder->payment_detail)
                    <div class="flex justify-between py-2">
                        <span class="text-gray-500">Channel</span>
                        <span class="font-semibold text-gray-900">{{ $selectedOrder->payment_detail }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Alamat --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <p class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Alamat Pengiriman
                </p>
                <p class="text-sm text-gray-700">{{ $selectedOrder->address_1 }}</p>
                @if($selectedOrder->address_2)
                <p class="text-sm text-gray-500 mt-0.5">{{ $selectedOrder->address_2 }}</p>
                @endif
                @if($selectedOrder->address_3)
                <p class="text-sm text-gray-500 mt-0.5">{{ $selectedOrder->address_3 }}</p>
                @endif
                <p class="text-sm font-semibold text-gray-900 mt-2">{{ $selectedOrder->customer_phone }}</p>
            </div>

            {{-- Bantuan --}}
            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                <p class="font-bold text-gray-900 mb-1">Butuh Bantuan?</p>
                <p class="text-sm text-gray-500 mb-3">
                    Hubungi tim kurator kami untuk permintaan khusus.
                </p>
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
    @endif
    @endif

    @else
    {{-- Guest --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-16 text-center">
        <div class="w-20 h-20 bg-green-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Masuk untuk Melihat Pesanan</h2>
        <p class="text-gray-500 text-sm mb-8 max-w-sm mx-auto">
            Silakan masuk ke akun Anda untuk melacak status pesanan Anda.
        </p>
        <a href="{{ route('login') }}"
           class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-xl transition">
            Masuk Sekarang
        </a>
    </div>
    @endauth

</div>
@endsection
