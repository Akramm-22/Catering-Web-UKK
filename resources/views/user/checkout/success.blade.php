@extends('layouts.app')
@section('title', 'Pesanan Berhasil')

@section('content')
<div class="max-w-lg mx-auto px-4 py-16 text-center">
    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil!</h1>
    <p class="text-gray-500 text-sm mb-6">
        Terima kasih! Pesanan Anda telah kami terima dan sedang diproses.
    </p>

    <div class="bg-gray-50 rounded-2xl p-5 text-left mb-8">
        <div class="flex justify-between items-center mb-3">
            <span class="text-sm text-gray-500">No. Resi</span>
            <span class="font-bold text-green-600">{{ $order->receipt_number }}</span>
        </div>
        <div class="flex justify-between items-center mb-3">
            <span class="text-sm text-gray-500">Pemesan</span>
            <span class="font-medium text-gray-900">{{ $order->customer_name }}</span>
        </div>
        <div class="flex justify-between items-center mb-3">
            <span class="text-sm text-gray-500">Total Bayar</span>
            <span class="font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between items-center">
            <span class="text-sm text-gray-500">Status</span>
            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full uppercase">
                {{ $order->status_label }}
            </span>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('tracking.show', $order->receipt_number) }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl transition">
            Lacak Pesanan
        </a>
        <a href="{{ route('orders.index') }}"
           class="border border-gray-200 text-gray-700 hover:border-green-400 hover:text-green-600 font-medium px-6 py-3 rounded-xl transition">
            Riwayat Pesanan
        </a>
        <a href="{{ route('home') }}"
           class="border border-gray-200 text-gray-700 hover:border-green-400 hover:text-green-600 font-medium px-6 py-3 rounded-xl transition">
            Kembali ke Menu
        </a>
    </div>
</div>
@endsection
