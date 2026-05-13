@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-green-600 flex items-center gap-1 mb-4">
        ← Kembali ke Daftar Pesanan
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan #{{ $order->receipt_number }}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- Customer Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Informasi Pelanggan</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-400 text-xs mb-1">Nama</p>
                    <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs mb-1">Telepon</p>
                    <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-gray-400 text-xs mb-1">Alamat</p>
                    <p class="font-medium text-gray-900">
                        {{ $order->address_1 }}
                        @if($order->address_2), {{ $order->address_2 }}@endif
                        @if($order->address_3), {{ $order->address_3 }}@endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Item Pesanan</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <p class="font-medium text-gray-900 text-sm">{{ $item->name }}</p>
                        <p class="text-xs text-gray-400">{{ $item->qty }} pax × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
                <div class="pt-3 space-y-2 text-sm">
                    <div class="flex justify-between text-gray-500">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Pengiriman</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Layanan</span>
                        <span>Rp {{ number_format($order->service_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-gray-900 text-base pt-2 border-t border-gray-100">
                        <span>Total</span>
                        <span class="text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Update Status Pesanan</h2>
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Status Baru</label>
                        <select name="status"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                            @foreach(['pending','waiting_confirmation','processing','cooking','shipped','delivered','completed','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $s)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Keterangan</label>
                        <input type="text" name="description" placeholder="Deskripsi update status..."
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                    </div>
                </div>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-xl transition text-sm">
                    Perbarui Status
                </button>
            </form>
        </div>
    </div>

    {{-- Right --}}
    <div class="space-y-6">
        {{-- Payment Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Pembayaran</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Metode</span>
                    <span class="font-medium capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                </div>
                @if($order->payment_detail)
                <div class="flex justify-between">
                    <span class="text-gray-500">Channel</span>
                    <span class="font-medium">{{ $order->payment_detail }}</span>
                </div>
                @endif
                @if($order->payment)
                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">
                        {{ strtoupper($order->payment->status) }}
                    </span>
                </div>
                @if($order->payment->paid_at)
                <div class="flex justify-between">
                    <span class="text-gray-500">Dibayar</span>
                    <span class="font-medium">{{ $order->payment->paid_at->format('d M Y H:i') }}</span>
                </div>
                @endif
                @endif
            </div>
        </div>

        {{-- Tracking History --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-4">Riwayat Tracking</h2>
            <div class="space-y-4">
                @forelse($order->trackings as $track)
                <div class="flex gap-3">
                    <div class="{{ $track->is_latest ? 'bg-green-600' : 'bg-gray-300' }} w-2.5 h-2.5 rounded-full mt-1.5 flex-shrink-0"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $track->title }}</p>
                        <p class="text-xs text-gray-500">{{ $track->description }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ \Carbon\Carbon::parse($track->happened_at)->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-400">Belum ada tracking.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
