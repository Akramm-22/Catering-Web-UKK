@extends('layouts.admin')
@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Laporan Pendapatan</h1>
    <p class="text-gray-500 text-sm mt-0.5">Ringkasan pendapatan dan performa bisnis.</p>
</div>

{{-- Revenue Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-gradient-to-br from-green-600 to-emerald-700 rounded-2xl p-6 shadow-lg text-white">
        <p class="text-green-100 text-sm font-medium mb-2">Total Pendapatan</p>
        <p class="text-3xl font-bold mb-4">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <div class="flex items-center gap-2">
            <span class="bg-green-500/30 text-green-100 text-xs font-bold px-2 py-1 rounded-full">All Time</span>
        </div>
    </div>
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 shadow-lg text-white">
        <p class="text-blue-100 text-sm font-medium mb-2">Pesanan Selesai</p>
        <p class="text-3xl font-bold mb-4">{{ $completedOrders }}</p>
        <div class="flex items-center gap-2">
            <span class="bg-blue-500/30 text-blue-100 text-xs font-bold px-2 py-1 rounded-full">Valid</span>
        </div>
    </div>
    <div class="bg-gradient-to-br from-amber-600 to-orange-700 rounded-2xl p-6 shadow-lg text-white">
        <p class="text-amber-100 text-sm font-medium mb-2">Rata-rata Order</p>
        <p class="text-3xl font-bold mb-4">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</p>
        <div class="flex items-center gap-2">
            <span class="bg-amber-500/30 text-amber-100 text-xs font-bold px-2 py-1 rounded-full">Per Pesanan</span>
        </div>
    </div>
</div>

{{-- Monthly Revenue Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="font-bold text-gray-900">Pendapatan Per Bulan</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Bulan</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase px-6 py-4">Total Pendapatan</th>
                    <th class="text-center text-xs font-semibold text-gray-500 uppercase px-6 py-4">Jumlah Pesanan</th>
                    <th class="text-right text-xs font-semibold text-gray-500 uppercase px-6 py-4">Persentase</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @php
                    $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                    $maxRevenue = $revenue->max('total') ?? 1;
                @endphp
                @foreach($revenue as $r)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            <span class="text-sm font-medium text-gray-900">{{ $months[$r->month - 1] ?? 'Bulan ' . $r->month }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right font-bold text-green-600 text-sm">
                        Rp {{ number_format($r->total, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium">
                            {{ $r->order_count }} pesanan
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center gap-3">
                            <div class="flex-1 bg-gray-100 rounded-full h-2 max-w-[80px]">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ ($r->total / $maxRevenue) * 100 }}%"></div>
                            </div>
                            <span class="text-xs text-gray-500 font-medium">{{ number_format(($r->total / $maxRevenue) * 100, 0) }}%</span>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($revenue->isEmpty())
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">
                        Belum ada data pendapatan.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100 text-center">
        <p class="text-xs text-gray-500">Data diperbarui setiap hari</p>
    </div>
</div>

{{-- Quick Export Actions --}}
<div class="mt-6 flex flex-wrap gap-3">
    <button class="flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:border-green-300 hover:text-green-600 px-4 py-2 rounded-lg text-sm font-medium transition-all">
        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export Excel
    </button>
    <button class="flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:border-green-300 hover:text-green-600 px-4 py-2 rounded-lg text-sm font-medium transition-all">
        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
        </svg>
        Export PDF
    </button>
</div>
@endsection
