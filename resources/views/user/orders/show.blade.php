@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">
        Detail Pesanan
    </h1>

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <p><strong>Nomor Resi:</strong> {{ $order->receipt_number }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total_amount,0,',','.') }}</p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h2 class="font-bold text-xl mb-4">Item Pesanan</h2>

        @foreach($order->items as $item)
            <div class="border-b py-3">
                <p class="font-semibold">{{ $item->name }}</p>
                <p>{{ $item->qty }} x Rp {{ number_format($item->price,0,',','.') }}</p>
            </div>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="font-bold text-xl mb-4">Tracking</h2>

        @foreach($order->trackings as $track)
            <div class="border-l-4 border-emerald-500 pl-4 mb-4">
                <p class="font-semibold">{{ $track->title }}</p>
                <p class="text-gray-500 text-sm">{{ $track->description }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection