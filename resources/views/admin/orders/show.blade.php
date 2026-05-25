@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-green-600 hover:underline mb-4 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Daftar Pesanan
    </a>
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
            <div class="flex items-center gap-2 mt-1">
                <span class="text-xs text-gray-500">No. Resi:</span>
                <span class="text-sm font-bold text-green-600">#{{ $order->receipt_number }}</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            @php
                $statusColors = [
                    'pending' => 'bg-amber-100 text-amber-700',
                    'waiting_confirmation' => 'bg-amber-100 text-amber-700',
                    'processing' => 'bg-blue-100 text-blue-700',
                    'cooking' => 'bg-blue-100 text-blue-700',
                    'shipped' => 'bg-purple-100 text-purple-700',
                    'delivered' => 'bg-green-100 text-green-700',
                    'completed' => 'bg-green-100 text-green-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                ];
                $statusColor = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <span class="{{ $statusColor }} text-xs font-bold px-4 py-2 rounded-full uppercase">
                {{ $order->status_label }}
            </span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Column - Order Info & Items --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Customer Info Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Informasi Pelanggan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div class="p-4 bg-gray-50 rounded-xl">
                    <p class="text-gray-400 text-xs mb-1">Nama Pemesan</p>
                    <p class="font-bold text-gray-900">{{ $order->customer_name }}</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-xl">
                    <p class="text-gray-400 text-xs mb-1">Telepon</p>
                    <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                </div>
                <div class="col-span-2 p-4 bg-gray-50 rounded-xl">
                    <p class="text-gray-400 text-xs mb-1">Alamat Pengiriman</p>
                    <p class="font-medium text-gray-900 text-sm">{{ $order->address_1 }}</p>
                    @if($order->address_2)
                    <p class="text-sm text-gray-600">{{ $order->address_2 }}</p>
                    @endif
                    @if($order->address_3)
                    <p class="text-sm text-gray-600">{{ $order->address_3 }}</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Order Items Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Item Pesanan
            </h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0 group hover:bg-gray-50 px-2 rounded-lg transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 text-gray-600 text-xs">
                            {{ $item->qty }}pax
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">{{ $item->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->qty }} pax x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="mt-6 pt-4 border-t border-gray-100 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Biaya Pengiriman</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Biaya Layanan</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($order->service_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                    <span class="font-bold text-gray-900 text-base">Total Bayar</span>
                    <span class="text-xl font-bold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Column - Actions & Details --}}
    <div class="space-y-6">
        {{-- Payment Info Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pembayaran
            </h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Metode Pembayaran</span>
                    <span class="font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                </div>
                @if($order->payment_detail)
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Detail Channel</span>
                    <span class="font-medium text-gray-900">{{ $order->payment_detail }}</span>
                </div>
                @endif
                @if($order->payment)
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-500">Status Pembayaran</span>
                    <span class="{{ $order->payment->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }} text-xs font-bold px-2.5 py-1 rounded-full uppercase">
                        {{ $order->payment->status === 'paid' ? 'Lunas' : 'Belum Lunas' }}
                    </span>
                </div>
                @endif
                <div class="pt-2">
                    <p class="text-gray-500 text-xs mb-2">Tanggal Pesan</p>
                    <p class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Update Status Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Update Status
            </h2>
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Status Baru</label>
                    <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 transition-all">
                        @foreach(['pending' => 'Pending', 'waiting_confirmation' => 'Menunggu Konfirmasi', 'processing' => 'Sedang Diproses', 'cooking' => 'Sedang Memasak', 'shipped' => 'Sedang Dikirim', 'delivered' => 'Telah Diterima', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $statusKey => $statusLabel)
                        <option value="{{ $statusKey }}" {{ $order->status === $statusKey ? 'selected' : '' }}>
                            {{ $statusLabel }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Catatan (opsional)</label>
                    <input type="text" name="description" placeholder="Tambahkan catatan untuk update ini..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 transition-all">
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold px-4 py-3 rounded-xl transition-all shadow-md hover:shadow-lg">
                    Simpan Update
                </button>
            </form>
        </div>

        {{-- Order Timeline --}}

        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h2 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Riwayat Status
            </h2>
            <div class="space-y-4">
                @forelse($order->trackings as $track)
                <div class="relative pl-6 border-l-2 border-gray-100 last:border-0">
                    <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-2 {{ $track->is_latest ? 'border-green-500' : 'border-gray-300' }}"></div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $track->title }}</p>
                        <p class="text-xs text-gray-500">{{ $track->description }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $track->happened_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400 italic">Pesanan baru, belum ada riwayat tracking.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
