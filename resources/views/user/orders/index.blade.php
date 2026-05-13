@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-gray-500 mb-4">Belum ada pesanan.</p>
            <a href="{{ route('packages.index') }}"
               class="bg-green-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium hover:bg-green-700 transition">
                Pesan Sekarang
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-white rounded-2xl border border-gray-100 p-5 hover:border-green-200 hover:shadow-sm transition">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">No. Resi</p>
                        <p class="font-bold text-green-600">#{{ $order->receipt_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Tanggal</p>
                        <p class="text-sm font-medium text-gray-700">
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Total</p>
                        <p class="text-sm font-bold text-gray-900">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
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
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('tracking.show', $order->receipt_number) }}"
                           class="border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-600 text-xs font-medium px-4 py-2 rounded-xl transition">
                            Lacak
                        </a>
                        <a href="{{ route('orders.show', $order->id) }}"
                           class="bg-green-600 hover:bg-green-700 text-white text-xs font-medium px-4 py-2 rounded-xl transition">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
