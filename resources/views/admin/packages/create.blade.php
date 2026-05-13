@extends('layouts.admin')
@section('title', 'Tambah Paket')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.packages.index') }}" class="text-sm text-gray-500 hover:text-green-600 mb-4 inline-block">
        ← Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Tambah Paket Baru</h1>
</div>

<div class="max-w-2xl">
    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Kategori</label>
                <select name="category_id" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Jenis Menu</label>
                <input type="text" name="menu_type" value="{{ old('menu_type') }}"
                    placeholder="Prasmanan / Kotak / Tumpeng"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Harga (per pax)</label>
                <input type="number" name="price" value="{{ old('price') }}" required min="0"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Min. Pax</label>
                <input type="number" name="min_pax" value="{{ old('min_pax', 1) }}" required min="1"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Deskripsi Singkat</label>
                <input type="text" name="short_description" value="{{ old('short_description') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 resize-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Badge (opsional)</label>
                <input type="text" name="badge" value="{{ old('badge') }}"
                    placeholder="TERLARIS, BOX CATERING, dll"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Foto Paket</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                    {{ old('is_active', 1) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                <label for="is_active" class="text-sm text-gray-700">Aktifkan paket ini</label>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_bestseller" value="1" id="is_bestseller"
                    {{ old('is_bestseller') ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                <label for="is_bestseller" class="text-sm text-gray-700">Tandai sebagai Bestseller</label>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2.5 rounded-xl transition text-sm">
                Simpan Paket
            </button>
            <a href="{{ route('admin.packages.index') }}"
               class="border border-gray-200 text-gray-600 font-medium px-6 py-2.5 rounded-xl hover:border-gray-300 transition text-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
