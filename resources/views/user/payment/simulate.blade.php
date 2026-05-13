@extends('layouts.app')
@section('title', 'Simulasi Pembayaran')

@section('content')
<div class="max-w-lg mx-auto px-4 py-12">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="bg-green-600 p-6 text-white text-center">
            <svg class="w-12 h-12 mx-auto mb-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            <h1 class="text-xl font-bold">Simulasi Pembayaran</h1>
            <p class="text-green-100 text-sm mt-1">{{ $order->receipt_number }}</p>
        </div>

        <div class="p-6">
            {{-- Order Info --}}
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-500">Metode</span>
                    <span class="text-sm font-semibold text-gray-900 capitalize">
                        {{ str_replace('_', ' ', $order->payment_method) }}
                        @if($order->payment_detail) — {{ $order->payment_detail }} @endif
                    </span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm text-gray-500">Pemesan</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Total</span>
                    <span class="text-lg font-bold text-green-600">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- Dummy Payment Info by Method --}}
            @if($order->payment_method === 'transfer_bank' || $order->payment_method === 'virtual_account')
            <div class="border border-dashed border-green-300 rounded-xl p-4 mb-6 bg-green-50">
                <p class="text-xs font-semibold text-green-700 uppercase tracking-wide mb-2">Nomor Rekening Tujuan</p>
                <p class="text-xl font-bold text-gray-900 tracking-widest">1234-5678-9012</p>
                <p class="text-sm text-gray-600 mt-1">
                    {{ $order->payment_detail ?? 'BCA' }} a.n. <strong>PT Splitbill Indonesia</strong>
                </p>
                <p class="text-xs text-gray-400 mt-2">* Ini adalah simulasi. Tidak ada transfer nyata yang diperlukan.</p>
            </div>
            @elseif($order->payment_method === 'e_wallet')
            <div class="border border-dashed border-blue-300 rounded-xl p-4 mb-6 bg-blue-50 text-center">
                <p class="text-xs font-semibold text-blue-700 uppercase tracking-wide mb-3">QR Code Simulasi</p>
                <div class="w-32 h-32 bg-gray-200 rounded-xl mx-auto flex items-center justify-center">
                    <span class="text-xs text-gray-400">QR DUMMY</span>
                </div>
                <p class="text-xs text-gray-400 mt-2">Scan dengan {{ $order->payment_detail ?? 'GoPay' }}</p>
            </div>
            @elseif($order->payment_method === 'cod')
            <div class="border border-dashed border-amber-300 rounded-xl p-4 mb-6 bg-amber-50">
                <p class="text-xs font-semibold text-amber-700 uppercase tracking-wide mb-2">Cash on Delivery</p>
                <p class="text-sm text-gray-700">Siapkan uang tunai sebesar</p>
                <p class="text-xl font-bold text-gray-900 mt-1">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-400 mt-2">Bayar saat kurir tiba di lokasi Anda.</p>
            </div>
            @elseif($order->payment_method === 'credit_card')
            <div class="border border-dashed border-purple-300 rounded-xl p-4 mb-6 bg-purple-50">
                <p class="text-xs font-semibold text-purple-700 uppercase tracking-wide mb-3">Kartu Kredit Simulasi</p>
                <div class="space-y-2">
                    <input type="text" placeholder="1234 5678 9012 3456" readonly
                           class="w-full bg-white border border-purple-200 rounded-lg px-3 py-2 text-sm" value="4111 1111 1111 1111">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" placeholder="MM/YY" readonly value="12/26"
                               class="bg-white border border-purple-200 rounded-lg px-3 py-2 text-sm">
                        <input type="text" placeholder="CVV" readonly value="123"
                               class="bg-white border border-purple-200 rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-2">* Data kartu di atas hanya untuk simulasi.</p>
            </div>
            @endif

            {{-- Confirm Button --}}
            <form action="{{ route('payment.simulate.pay', $order->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition hover:shadow-lg text-lg">
                    ✓ Konfirmasi Pembayaran
                </button>
            </form>
            <p class="text-center text-xs text-gray-400 mt-3">
                Ini adalah simulasi pembayaran untuk keperluan demo.
            </p>
        </div>
    </div>
</div>
@endsection
