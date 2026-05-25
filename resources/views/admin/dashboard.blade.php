@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Ringkasan Admin</h1>
    <p class="text-gray-500 text-sm mt-1">Memantau aliran kurasi kuliner hari ini.</p>
</div>

{{-- Stats Cards Grid - Modern Design --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Orders Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-green-100 rounded-xl group-hover:bg-green-600 transition-colors">
                <svg class="w-6 h-6 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="px-2 py-1 bg-green-50 rounded-full">
                <span class="text-xs font-bold text-green-700">+{{ number_format($stats['total_orders'] * 0.12) }}%</span>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Total Pesanan</p>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_orders']) }}</p>
        <div class="mt-4 pt-4 border-t border-gray-50">
            <p class="text-xs text-gray-400">Semua pesanan tercatat</p>
        </div>
    </div>

    {{-- Pending Orders Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-amber-100 rounded-xl group-hover:bg-amber-500 transition-colors">
                <svg class="w-6 h-6 text-amber-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="px-2 py-1 bg-amber-50 rounded-full">
                <span class="text-xs font-bold text-amber-700">Perlu Aksi</span>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Menunggu Konfirmasi</p>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['pending_orders']) }}</p>
        <div class="mt-4 pt-4 border-t border-gray-50">
            <p class="text-xs text-gray-400">Pesanan baru perlu diproses</p>
        </div>
    </div>

    {{-- Revenue Card --}}
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 shadow-lg text-white group hover:shadow-xl transition-all duration-300">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-white/20 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="px-2 py-1 bg-white/20 rounded-full">
                <span class="text-xs font-bold text-white">Bulan Ini</span>
            </div>
        </div>
        <p class="text-sm text-blue-100 font-medium mb-1">Total Pendapatan</p>
        <p class="text-3xl font-bold text-white">Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}M</p>
        <div class="mt-4 pt-4 border-t border-white/10">
            <p class="text-xs text-blue-200">Rp {{ number_format($stats['total_revenue']) }} total</p>
        </div>
    </div>

    {{-- Active Customers Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
        <div class="flex items-start justify-between mb-4">
            <div class="p-3 bg-purple-100 rounded-xl group-hover:bg-purple-600 transition-colors">
                <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="px-2 py-1 bg-purple-50 rounded-full">
                <span class="text-xs font-bold text-purple-700">Aktif</span>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Pelanggan Aktif</p>
        <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['active_customers']) }}</p>
        <div class="mt-4 pt-4 border-t border-gray-50">
            <p class="text-xs text-gray-400">Seluruh pelanggan terdaftar</p>
        </div>
    </div>
</div>

{{-- Quick Stats & Recent Activity Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Order Status Distribution --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <h2 class="font-bold text-gray-900 mb-5">Status Pesanan</h2>
        <div class="space-y-4">
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Menunggu Konfirmasi</span>
                    <span class="text-sm font-bold text-gray-900">{{ $stats['pending_orders'] }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $stats['pending_orders'] > 0 ? min(100, $stats['pending_orders'] / max(1, $stats['total_orders']) * 100) : 0 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Sedang Diproses</span>
                    <span class="text-sm font-bold text-gray-900">{{ $stats['pending_orders'] }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['pending_orders'] > 0 ? min(50, $stats['pending_orders'] / max(1, $stats['total_orders']) * 50) : 0 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700">Selesai</span>
                    <span class="text-sm font-bold text-gray-900">{{ max(0, $stats['total_orders'] - $stats['pending_orders']) }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stats['total_orders'] > 0 ? min(100, (1 - $stats['pending_orders'] / max(1, $stats['total_orders'])) * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <h2 class="font-bold text-gray-900 mb-5">Aksi Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}" class="flex flex-col items-center justify-center p-4 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-xl transition-all border border-amber-100 hover:border-amber-200">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold">Konfirmasi</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition-all border border-blue-100 hover:border-blue-200">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="text-sm font-bold">Proses</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 text-green-700 rounded-xl transition-all border border-green-100 hover:border-green-200">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold">Selesai</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 text-purple-700 rounded-xl transition-all border border-purple-100 hover:border-purple-200">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="text-sm font-bold">Laporan</span>
            </a>
        </div>
    </div>
</div>

{{-- Recent Orders Table - Enhanced Design --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-bold text-gray-900">Pesanan Terbaru</h2>
            <p class="text-sm text-gray-500 mt-0.5">Menampilkan 10 pesanan terakhir</p>
        </div>
        <div class="flex items-center gap-2 overflow-x-auto">
            <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}"
               class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-amber-100 transition border border-amber-100">
                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                Konfirmasi
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
               class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-blue-100 transition border border-blue-100">
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                Diproses
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}"
               class="inline-flex items-center gap-2 bg-purple-50 text-purple-700 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-purple-100 transition border border-purple-100">
                <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                Dikirim
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="inline-flex items-center gap-2 bg-gray-50 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-gray-100 transition border border-gray-100">
                Lihat Semua
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Metode Bayar</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">No. Resi</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Tgl. Pesan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Status</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-4">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 overflow-hidden shadow-sm"
                                 style="background: linear-gradient(135deg, hsl({{ crc32($order->customer_name) % 360 }}, 60%, 50%), hsl({{ (crc32($order->customer_name) + 40) % 360 }}, 60%, 40%));">
                                {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}</p>
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
                           class="text-sm font-bold text-green-600 hover:text-green-700 hover:underline">
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
                        <span class="{{ $color }} text-xs font-bold px-3 py-1.5 rounded-full uppercase">
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
    <div class="px-6 py-4 border-t border-gray-100 text-center">
        <a href="{{ route('admin.orders.index') }}"
           class="inline-flex items-center gap-2 text-sm font-bold text-green-600 hover:text-green-700 hover:bg-green-50 px-4 py-2 rounded-lg transition">
            Lihat Semua Pesanan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
@endsection
