@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Daftar Pemesanan</h1>
    <p class="text-gray-500 text-sm mt-1">Memantau aliran kurasi kuliner hari ini.</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Total Pesanan</p>
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_orders']) }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Konfirmasi</p>
            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['pending_orders']) }}</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Pendapatan</p>
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">
            Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}M
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5">
        <div class="flex items-center justify-between mb-3">
            <p class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Pelanggan Aktif</p>
            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['active_customers']) }}</p>
    </div>
</div>

{{-- Recent Orders Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-bold text-gray-900">Pesanan Terbaru</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}"
               class="bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-amber-200 transition">
                Menunggu Konfirmasi
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
               class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-blue-200 transition">
                Sedang Diproses
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Metode Bayar</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">No. Resi</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Tgl. Pesan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Status</th>
                    <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                 style="background-color: hsl({{ crc32($order->customer_name) % 360 }}, 60%, 50%)">
                                {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-400">{{ $order->user->email ?? '' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 capitalize">
                        {{ str_replace('_', ' ', $order->payment_method) }}
                        @if($order->payment_detail)
                        <br><span class="text-xs text-gray-400">{{ $order->payment_detail }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="text-sm font-semibold text-green-600 hover:text-green-700">
                            #{{ $order->receipt_number }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $colors = [
                                'pending' => 'bg-amber-100 text-amber-700',
                                'waiting_confirmation' => 'bg-amber-100 text-amber-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'cooking' => 'bg-blue-100 text-blue-700',
                                'shipped' => 'bg-purple-100 text-purple-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ];
                            $color = $colors[$order->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="{{ $color }} text-xs font-bold px-3 py-1 rounded-full uppercase">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                        Belum ada pesanan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-gray-100 text-center">
        <a href="{{ route('admin.orders.index') }}"
           class="text-sm text-green-600 hover:text-green-700 font-medium">
            Lihat Semua Pesanan →
        </a>
    </div>
</div>
@endsection
