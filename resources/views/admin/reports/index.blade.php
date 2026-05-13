@extends('layouts.admin')
@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Laporan Pendapatan</h1>
    <p class="text-gray-500 text-sm mt-0.5">Ringkasan pendapatan bulanan.</p>
</div>

<div class="bg-white rounded-2xl border border-gray-100 p-6">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="text-left text-xs font-semibold text-gray-400 uppercase pb-3">Bulan</th>
                <th class="text-right text-xs font-semibold text-gray-400 uppercase pb-3">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @php
                $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            @endphp
            @forelse($revenue as $r)
            <tr>
                <td class="py-3 text-sm text-gray-700">{{ $months[$r->month - 1] ?? $r->month }}</td>
                <td class="py-3 text-right font-bold text-green-600">
                    Rp {{ number_format($r->total, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="py-12 text-center text-gray-400 text-sm">Belum ada data pendapatan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
