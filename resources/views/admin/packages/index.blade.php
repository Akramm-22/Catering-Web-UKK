@extends('layouts.admin')
@section('title', 'Manajemen Paket')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Paket</h1>
        <p class="text-gray-500 text-sm mt-0.5">Kelola paket katering yang tersedia.</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition-all shadow-lg shadow-green-200 hover:shadow-xl hover:shadow-green-200 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Paket
    </a>
</div>

{{-- Stats Row --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm text-center">
        <p class="text-2xl font-bold text-gray-900">{{ $packages->total() }}</p>
        <p class="text-xs text-gray-500 uppercase tracking-wide">Total Paket</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm text-center">
        <p class="text-2xl font-bold text-green-600">{{ $packages->where('is_active', true)->count() }}</p>
        <p class="text-xs text-gray-500 uppercase tracking-wide">Aktif</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm text-center">
        <p class="text-2xl font-bold text-amber-600">{{ $packages->where('is_bestseller', true)->count() }}</p>
        <p class="text-xs text-gray-500 uppercase tracking-wide">Bestseller</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm text-center">
        <p class="text-2xl font-bold text-blue-600">{{ $packages->sum('min_pax') }}</p>
        <p class="text-xs text-gray-500 uppercase tracking-wide">Min Pax Total</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Paket</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Kategori</th>
                    <th class="text-left text-xs font-semibold text-gray-500 uppercase px-6 py-4">Harga</th>
                    <th class="text-center text-xs font-semibold text-gray-500 uppercase px-6 py-4">Status</th>
                    <th class="text-center text-xs font-semibold text-gray-500 uppercase px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($packages as $package)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $package->name }}</p>
                                <p class="text-xs text-gray-500">{{ $package->short_description }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">Min. {{ $package->min_pax }} pax</p>
                                @if($package->badge)
                                <span class="inline-block mt-2 px-2 py-0.5 rounded text-[10px] font-bold text-white" style="background: linear-gradient(135deg, #f59e0b, #d97706);">★ {{ $package->badge }}</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-medium"
                              style="background: #f0f9ff; color: #0ea5e9;">
                            {{ $package->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-green-600 text-lg">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400">/pax</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="{{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} text-xs font-bold px-3 py-1.5 rounded-full transition-colors">
                            {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.packages.edit', $package->id) }}"
                               class="flex items-center justify-center w-9 h-9 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus paket ini? Semua pesanan terkait akan terpengaruh.');"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="flex items-center justify-center w-9 h-9 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                    title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Belum ada paket tersedia</p>
                        <p class="text-gray-400 text-xs mt-1">Klik "Tambah Paket" untuk membuat paket baru</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">
            Menampilkan <span class="font-bold text-gray-900">{{ $packages->firstItem() ?? 0 }}</span>–{{ $packages->lastItem() ?? 0 }} dari {{ $packages->total() ?? 0 }} paket
        </p>
        {{ $packages->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
