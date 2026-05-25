@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header Section --}}
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-500 mt-1">Kelola pesanan Anda dan pantau status katering.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Orders Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-gray-900">{{ $orders->count() }}</p>
                    <p class="text-sm text-gray-500">Total Pesanan</p>
                </div>
            </div>
            <a href="{{ route('orders.index') }}" class="block text-sm font-medium text-green-600 hover:text-green-700 hover:underline">
                Lihat semua pesanan &rarr;
            </a>
        </div>

        {{-- Pending Orders Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-100 rounded-xl">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-gray-900">{{ $orders->where('status', 'pending')->where('status', 'waiting_confirmation')->count() }}</p>
                    <p class="text-sm text-gray-500">Menunggu</p>
                </div>
            </div>
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="block text-sm font-medium text-amber-600 hover:text-amber-700 hover:underline">
                Konfirmasi pesanan &rarr;
            </a>
        </div>

        {{-- Active Subscription Card --}}
        <div class="bg-gradient-to-br from-green-600 to-emerald-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-white/20 rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold">Premium</p>
                    <p class="text-sm text-green-100">Aktif</p>
                </div>
            </div>
            <p class="text-green-50 text-sm mb-4">Langganan aktif hingga {{ auth()->user()->subscription_ends ?? 'Tidak ada' }}</p>
            <a href="{{ route('profile') }}" class="inline-block px-4 py-2 bg-white text-green-700 rounded-lg text-sm font-bold hover:bg-green-50 transition">
                Kelola Langganan
            </a>
        </div>
    </div>

    {{-- Recent Orders Section --}}
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-bold text-gray-900">Pesanan Terbaru</h2>
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">No. Resi</th>
                        <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Tgl. Pesan</th>
                        <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Total</th>
                        <th class="text-left text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Status</th>
                        <th class="text-right text-xs font-semibold text-gray-400 uppercase tracking-wide px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders->take(5) as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-green-600">#{{ $order->receipt_number }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
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
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('orders.show', $order->id) }}" class="text-sm font-medium text-green-600 hover:text-green-700">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-sm">
                            Belum ada pesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->count() > 5)
        <div class="px-6 py-4 border-t border-gray-100 text-center">
            <a href="{{ route('orders.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium">
                Lihat Semua Pesanan &rarr;
            </a>
        </div>
        @endif
    </div>

    {{-- Quick Actions Section --}}
    <div class="mt-8">
        <h2 class="font-bold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('packages.index') }}" class="group bg-white rounded-xl border border-gray-100 p-4 hover:border-green-200 hover:shadow-sm transition-all text-center">
                <div class="w-12 h-12 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-green-100 transition-colors">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900 text-sm">Pesan Paket</p>
            </a>

            <a href="{{ route('tracking.index') }}" class="group bg-white rounded-xl border border-gray-100 p-4 hover:border-green-200 hover:shadow-sm transition-all text-center">
                <div class="w-12 h-12 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900 text-sm">Lacak Pesanan</p>
            </a>

            <a href="{{ route('profile') }}" class="group bg-white rounded-xl border border-gray-100 p-4 hover:border-green-200 hover:shadow-sm transition-all text-center">
                <div class="w-12 h-12 mx-auto bg-purple-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-100 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900 text-sm">Profil Saya</p>
            </a>

            <a href="{{ route('tracking.index') }}" class="group bg-white rounded-xl border border-gray-100 p-4 hover:border-green-200 hover:shadow-sm transition-all text-center">
                <div class="w-12 h-12 mx-auto bg-amber-50 rounded-full flex items-center justify-center mb-3 group-hover:bg-amber-100 transition-colors">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900 text-sm">Bantuan</p>
            </a>
        </div>
    </div>
</div>
@endsection
