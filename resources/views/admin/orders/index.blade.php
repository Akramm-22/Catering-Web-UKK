@extends('layouts.admin')
@section('title', 'Daftar Pesanan')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Daftar Pesanan</h1>
        <p class="text-gray-500 text-sm mt-0.5">Kelola dan pantau semua pesanan pelanggan.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.orders.index') }}" class="{{ !request('status') ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm">
            Semua
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}" class="{{ request('status') === 'waiting_confirmation' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm">
            Konfirmasi
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="{{ request('status') === 'processing' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm">
            Diproses
        </a>
    </div>
</div>

{{-- Filters Section --}}
<div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 shadow-sm">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0">
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ !request('status') ? 'bg-green-50 text-green-700 border border-green-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                Semua
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ request('status') === 'waiting_confirmation' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Konfirmasi
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ request('status') === 'processing' ? 'bg-blue-50 text-blue-700 border border-blue-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                Diproses
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ request('status') === 'shipped' ? 'bg-purple-50 text-purple-700 border border-purple-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                Dikirim
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ request('status') === 'completed' ? 'bg-green-50 text-green-700 border border-green-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                Selesai
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition {{ request('status') === 'cancelled' ? 'bg-red-50 text-red-700 border border-red-100' : '' }}">
                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                Batal
            </a>
        </div>
        <div class="relative">
            <input type="text" id="searchOrders" placeholder="Cari resi, pelanggan..." class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 pl-9 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>
</div>

{{-- Order List --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Metode Bayar</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">No. Resi</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Tgl. Pesan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Status</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase px-6 py-4">Total</th>
                    <th class="text-center text-xs font-semibold text-gray-500 uppercase px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0 overflow-hidden shadow-sm"
                                 style="background: linear-gradient(135deg, hsl({{ crc32($order->customer_name) % 360 }}, 60%, 50%), hsl({{ (crc32($order->customer_name) + 40) % 360 }}, 60%, 40%));">
                                {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}</p>
                                <p class="text-xs text-gray-400">{{ $order->customer_phone ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600 capitalize font-medium">
                            {{ str_replace('_', ' ', $order->payment_method) }}
                        </div>
                        @if($order->payment_detail)
                        <div class="text-xs text-gray-400">{{ $order->payment_detail }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-sm font-bold text-green-600 hover:text-green-700 hover:underline">
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
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-green-600 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-all shadow-sm hover:shadow">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Tidak ada pesanan ditemukan</p>
                        <p class="text-gray-400 text-xs mt-1">Coba ubah filter atau tambah pesanan baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">
            Menampilkan <span class="font-bold text-gray-900">{{ $orders->firstItem() ?? 0 }}</span>–{{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() ?? 0 }} pesanan
        </p>
        {{ $orders->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
