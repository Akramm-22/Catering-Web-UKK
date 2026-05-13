@extends('layouts.admin')
@section('title', 'Manajemen Paket')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Paket</h1>
        <p class="text-gray-500 text-sm mt-0.5">Kelola paket katering yang tersedia.</p>
    </div>
    <a href="{{ route('admin.packages.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-xl text-sm transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Paket
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50">
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Paket</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Kategori</th>
                    <th class="text-left text-xs font-semibold text-gray-400 uppercase px-6 py-3">Harga</th>
                    <th class="text-center text-xs font-semibold text-gray-400 uppercase px-6 py-3">Status</th>
                    <th class="text-center text-xs font-semibold text-gray-400 uppercase px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($packages as $package)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $package->image_url }}" alt="{{ $package->name }}"
                                 class="w-12 h-12 rounded-xl object-cover">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $package->name }}</p>
                                <p class="text-xs text-gray-400">Min. {{ $package->min_pax }} pax</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $package->category->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-green-600">{{ $package->formatted_price }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="{{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} text-xs font-bold px-3 py-1 rounded-full">
                            {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.packages.edit', $package->id) }}"
                               class="border border-gray-200 text-gray-600 hover:border-green-400 hover:text-green-600 text-xs px-3 py-1.5 rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus paket ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="border border-red-200 text-red-500 hover:bg-red-50 text-xs px-3 py-1.5 rounded-lg transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">Belum ada paket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $packages->links() }}
    </div>
</div>
@endsection
