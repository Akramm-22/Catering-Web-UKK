@extends('layouts.admin')
@section('title', 'Data Pelanggan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Data Pelanggan</h1>
    <p class="text-gray-500 text-sm mt-0.5">Kelola data pelanggan terdaftar.</p>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Pelanggan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Email</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">No. HP</th>
                    <th class="text-center text-xs font-semibold text-gray-400 uppercase px-6 py-3">Total Pesanan</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($customers as $customer)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}"
                                 class="w-9 h-9 rounded-full object-cover">
                            <span class="text-sm font-medium text-gray-900">{{ $customer->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $customer->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $customer->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $customer->orders_count }} pesanan
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $customer->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                        Belum ada pelanggan terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $customers->links() }}
    </div>
</div>
@endsection
