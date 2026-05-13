@extends('layouts.admin')
@section('title', 'Daftar Pesanan')

@section('content')
<div class="mb-6 flex items-center justify-between flex-wrap gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Daftar Pesanan</h1>
        <p class="text-gray-500 text-sm mt-0.5">Memantau aliran kurasi kuliner hari ini.</p>
    </div>
</div>

{{-- Filters --}}
<div class="flex items-center gap-3 mb-6 flex-wrap">
    <a href="{{ route('admin.orders.index') }}"
       class="{{ !request('status') ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-full text-sm font-medium transition">
        Semua
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'waiting_confirmation']) }}"
       class="{{ request('status') === 'waiting_confirmation' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-full text-sm font-medium transition">
        Menunggu Konfirmasi
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
       class="{{ request('status') === 'processing' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-full text-sm font-medium transition">
        Sedang Diproses
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}"
       class="{{ request('status') === 'shipped' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-full text-sm font-medium transition">
        Dikirim
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}"
       class="{{ request('status') === 'completed' ? 'bg-green-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }} px-4 py-2 rounded-full text-sm font-medium transition">
        Selesai
    </a>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">ID Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Metode Bayar</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">No. Resi</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Tgl. Pesan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Status</th>
                    <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Total Bayar</th>
                    <th class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                 style="background-color: hsl({{ crc32($order->customer_name) % 360 }}, 55%, 50%)">
                                {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</span>
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
                           class="text-sm font-semibold text-green-600 hover:underline">
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
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                        Tidak ada pesanan ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-sm text-gray-500">
            Menampilkan {{ $orders->firstItem() }}–{{ $orders->lastItem() }} dari {{ $orders->total() }} pesanan
        </p>
        {{ $orders->links() }}
    </div>
</div>
@endsection
