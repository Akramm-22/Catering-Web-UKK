@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-green-600">Penyelesaian Pesanan</h1>
        <p class="text-gray-500 text-sm mt-1">Lengkapi detail pengiriman dan pembayaran untuk menikmati cita rasa kami.</p>
    </div>

    {{-- Progress Steps --}}
    <div class="flex items-center mb-10">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-md">1</div>
            <span class="text-sm font-semibold text-green-600 hidden sm:inline">Informasi</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center text-sm font-bold">2</div>
            <span class="text-sm text-gray-400 hidden sm:inline">Pembayaran</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200 mx-3"></div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center text-sm font-bold">3</div>
            <span class="text-sm text-gray-400 hidden sm:inline">Selesai</span>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT: Form --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Data Pelanggan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        Data Pelanggan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Pelanggan *</label>
                            <input type="text" name="customer_name"
                                   value="{{ old('customer_name', auth()->user()->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Telepon *</label>
                            <input type="tel" name="customer_phone"
                                   value="{{ old('customer_phone', auth()->user()->phone) }}"
                                   placeholder="Contoh: 08123456789"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Alamat Lengkap *</label>
                        <input type="text" name="address_1" value="{{ old('address_1') }}"
                               placeholder="Nama jalan, nomor rumah, gedung, lantai"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition">
                        @error('address_1') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kecamatan</label>
                            <input type="text" name="address_2" value="{{ old('address_2') }}"
                                   placeholder="Masukkan kecamatan"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kota / Kabupaten</label>
                            <input type="text" name="address_3" value="{{ old('address_3') }}"
                                   placeholder="Masukkan kota"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Catatan Tambahan</label>
                        <textarea name="notes" rows="2" placeholder="Contoh: Tolong tidak terlalu pedas, alergi kacang, dll."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 hover:bg-white transition resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Tanggal & Waktu Pengiriman --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        Jadwal Pengiriman
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Pengiriman</label>
                            <input type="date" name="delivery_date"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   value="{{ old('delivery_date', date('Y-m-d', strtotime('+1 day'))) }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Waktu Pengiriman</label>
                            <select name="delivery_time"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50">
                                <option value="08:00-10:00">08:00 – 10:00 WIB</option>
                                <option value="10:00-12:00">10:00 – 12:00 WIB</option>
                                <option value="12:00-14:00">12:00 – 14:00 WIB</option>
                                <option value="14:00-16:00">14:00 – 16:00 WIB</option>
                                <option value="16:00-18:00">16:00 – 18:00 WIB</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6"
                     x-data="{ selected: 'transfer_bank', channel: 'BCA' }">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                        <span class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </span>
                        Metode Pembayaran
                    </h2>

                    <input type="hidden" name="payment_method" :value="selected">
                    <input type="hidden" name="payment_detail" :value="channel">

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">

                        {{-- Transfer Bank --}}
                        <label @click="selected='transfer_bank'; channel='BCA'" class="cursor-pointer">
                            <div :class="selected==='transfer_bank' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='transfer_bank' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='transfer_bank'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">Transfer Bank</p>
                                <p class="text-xs text-gray-400 mt-0.5">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </label>

                        {{-- E-Wallet --}}
                        <label @click="selected='e_wallet'; channel='GoPay'" class="cursor-pointer">
                            <div :class="selected==='e_wallet' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='e_wallet' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='e_wallet'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">E-Wallet</p>
                                <p class="text-xs text-gray-400 mt-0.5">GoPay, OVO, ShopeePay</p>
                            </div>
                        </label>

                        {{-- Kartu Kredit --}}
                        <label @click="selected='credit_card'; channel='Visa'" class="cursor-pointer">
                            <div :class="selected==='credit_card' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='credit_card' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='credit_card'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">Kartu Kredit</p>
                                <p class="text-xs text-gray-400 mt-0.5">Visa, Mastercard</p>
                            </div>
                        </label>

                        {{-- Virtual Account --}}
                        <label @click="selected='virtual_account'; channel='Mandiri VA'" class="cursor-pointer">
                            <div :class="selected==='virtual_account' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='virtual_account' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='virtual_account'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">Virtual Account</p>
                                <p class="text-xs text-gray-400 mt-0.5">Mandiri, BNI, BRI</p>
                            </div>
                        </label>

                        {{-- COD --}}
                        <label @click="selected='cod'; channel='COD'" class="cursor-pointer">
                            <div :class="selected==='cod' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='cod' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='cod'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">Cash on Delivery</p>
                                <p class="text-xs text-gray-400 mt-0.5">Bayar saat tiba</p>
                            </div>
                        </label>

                        {{-- QRIS --}}
                        <label @click="selected='qris'; channel='QRIS'" class="cursor-pointer">
                            <div :class="selected==='qris' ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 hover:border-gray-300 bg-white'"
                                 class="border-2 rounded-2xl p-4 transition-all">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                    </div>
                                    <div :class="selected==='qris' ? 'bg-green-500' : 'bg-gray-200'"
                                         class="w-5 h-5 rounded-full flex items-center justify-center transition-colors">
                                        <div x-show="selected==='qris'" class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <p class="font-bold text-gray-900 text-sm">QRIS</p>
                                <p class="text-xs text-gray-400 mt-0.5">Semua bank & e-wallet</p>
                            </div>
                        </label>
                    </div>

                    {{-- Sub-channel Transfer Bank --}}
                    <div x-show="selected === 'transfer_bank'" class="bg-blue-50 rounded-xl p-4">
                        <p class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-3">Pilih Bank Tujuan</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['BCA','Mandiri','BNI','BRI','CIMB Niaga'] as $bank)
                            <span class="border px-4 py-2 rounded-xl text-sm font-medium cursor-pointer transition-all"
                                  :class="channel === '{{ $bank }}' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-300'"
                                  @click="channel='{{ $bank }}'">
                                {{ $bank }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sub-channel E-Wallet --}}
                    <div x-show="selected === 'e_wallet'" class="bg-green-50 rounded-xl p-4">
                        <p class="text-xs font-bold text-green-700 uppercase tracking-wider mb-3">Pilih E-Wallet</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['GoPay','OVO','ShopeePay','Dana','LinkAja'] as $ew)
                            <span class="border px-4 py-2 rounded-xl text-sm font-medium cursor-pointer transition-all"
                                  :class="channel === '{{ $ew }}' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-600 border-gray-200 hover:border-green-300'"
                                  @click="channel='{{ $ew }}'">
                                {{ $ew }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sub-channel Virtual Account --}}
                    <div x-show="selected === 'virtual_account'" class="bg-amber-50 rounded-xl p-4">
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-3">Pilih Bank Virtual Account</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Mandiri VA','BNI VA','BRI VA','Permata VA'] as $va)
                            <span class="border px-4 py-2 rounded-xl text-sm font-medium cursor-pointer transition-all"
                                  :class="channel === '{{ $va }}' ? 'bg-amber-600 text-white border-amber-600' : 'bg-white text-gray-600 border-gray-200 hover:border-amber-300'"
                                  @click="channel='{{ $va }}'">
                                {{ $va }}
                            </span>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-900 flex items-center gap-2 mb-5 pb-4 border-b border-gray-100">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Ringkasan Pesanan
                    </h2>

                    {{-- Items --}}
                    <div class="space-y-4 mb-5">
                        @foreach($cart as $item)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100' }}"
                                 class="w-14 h-14 rounded-xl object-cover flex-shrink-0 shadow-sm">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-green-600 truncate">PKT-{{ $item['id'] }}</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-400">{{ $item['qty'] }} pax × Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-900 flex-shrink-0">
                                Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Price Breakdown --}}
                    <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Layanan (2%)</span>
                            <span>Rp {{ number_format($service, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between font-bold text-gray-900">
                            <span class="text-base">Total Bayar</span>
                            <span class="text-xl text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Info Gratis Ongkir --}}
                    <div class="mt-4 bg-green-50 border border-green-100 rounded-xl p-3 flex items-start gap-2">
                        <svg class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs text-green-700">Gratis ongkir untuk wilayah DKI Jakarta & sekitarnya.</p>
                    </div>

                    <button type="submit"
                        class="mt-5 w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition-all hover:shadow-lg hover:shadow-green-200 active:scale-95 text-base">
                        Konfirmasi & Bayar Sekarang
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-3 leading-relaxed">
                        Dengan menekan tombol di atas, Anda menyetujui
                        <a href="{{ route('about') }}" class="text-green-600 hover:underline">Syarat & Ketentuan</a>
                        Splitbill.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
