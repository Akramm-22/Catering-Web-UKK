@extends('layouts.admin')
@section('title', 'Tambah Paket')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.packages.index') }}" class="text-sm text-gray-500 hover:text-green-600 hover:underline mb-4 inline-block transition-colors">
        ← Kembali ke Manajemen Paket
    </a>
    <h1 class="text-2xl font-bold text-gray-900">Tambah Paket Baru</h1>
    <p class="text-gray-500 text-sm mt-0.5">Buat paket katering baru untuk ditambahkan ke menu.</p>
</div>

<div class="max-w-3xl">
    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @csrf

        <div class="p-6 space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Nama Paket <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all @error('name') border-red-300 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Jenis Menu</label>
                    <input type="text" name="menu_type" value="{{ old('menu_type') }}"
                        placeholder="Contoh: Prasmanan / Kotak / Tumpeng"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    @error('menu_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Harga (per pax) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-gray-400 text-sm">Rp</span>
                        <input type="number" name="price" value="{{ old('price', 0) }}" required min="0"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Min. Pax <span class="text-red-500">*</span></label>
                    <input type="number" name="min_pax" value="{{ old('min_pax', 1) }}" required min="1"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    @error('min_pax') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Max. Pax (opsional)</label>
                    <input type="number" name="max_pax" value="{{ old('max_pax') }}" min="1"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    @error('max_pax') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Deskripsi Singkat</label>
                    <input type="text" name="short_description" value="{{ old('short_description') }}"
                        placeholder="Max 100 karakter"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all resize-none">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Badge (opsional)</label>
                    <input type="text" name="badge" value="{{ old('badge') }}"
                        placeholder="Contoh: TERLARIS, BOX CATERING, dll"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 transition-all">
                    @error('badge') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1.5">Foto Paket <span class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-green-300 transition-colors bg-gray-50">
                        <input type="file" name="image" accept="image/*" id="imageInput" required
                            class="hidden">
                        <label for="imageInput" class="cursor-pointer flex flex-col items-center">
                            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3 transition-colors group-hover:bg-green-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-400">JPG, PNG - Max 2MB</p>
                        </label>
                    </div>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2 flex items-center gap-4 mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" id="is_active" checked
                            class="w-5 h-5 rounded border-gray-300 text-green-600 focus:ring-green-500 transition-colors">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan paket ini</label>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_bestseller" value="1" id="is_bestseller" {{ old('is_bestseller') ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-green-600 focus:ring-green-500 transition-colors">
                        <label for="is_bestseller" class="text-sm font-medium text-gray-700">Tandai sebagai Bestseller</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.packages.index') }}"
               class="border border-gray-300 text-gray-700 font-semibold px-6 py-2.5 rounded-xl hover:bg-gray-100 transition-all">
                Batal
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-2.5 rounded-xl transition-all shadow-lg hover:shadow-xl">
                Simpan Paket
            </button>
        </div>
    </form>
</div>
@endsection
