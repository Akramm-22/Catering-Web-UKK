@extends('layouts.admin')
@section('title', 'Data Pelanggan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Data Pelanggan</h1>
    <p class="text-gray-500 text-sm mt-0.5">Kelola dan monitor pelanggan terdaftar.</p>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">No. HP</th>
                    <th class="text-center text-xs font-semibold text-gray-500 uppercase px-6 py-4">Total Pesanan</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($customers as $customer)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden shadow-sm flex-shrink-0">
                                @if($customer->avatar_url)
                                    <img src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-white font-bold text-sm"
                                         style="background: linear-gradient(135deg, hsl({{ crc32($customer->name) % 360 }}, 60%, 50%), hsl({{ (crc32($customer->name) + 40) % 360 }}, 60%, 40%));">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $customer->name }}</p>
                                <p class="text-xs text-gray-500">Pelanggan aktif</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $customer->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
                            {{ $customer->phone ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.orders.index', ['customer' => $customer->id]) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-white font-bold text-xs transition hover:shadow-sm"
                           style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                            {{ $customer->orders_count ?? 0 }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $customer->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Belum ada pelanggan terdaftar</p>
                        <p class="text-gray-400 text-xs mt-1">Pelanggan akan muncul setelah melakukan pesanan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">
            Menampilkan <span class="font-bold text-gray-900">{{ $customers->firstItem() ?? 0 }}</span>–{{ $customers->lastItem() ?? 0 }} dari {{ $customers->total() ?? 0 }} pelanggan
        </p>
        {{ $customers->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
