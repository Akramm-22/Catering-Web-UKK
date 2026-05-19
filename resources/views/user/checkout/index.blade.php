@extends('layouts.app')
@section('title', 'Checkout — Splitbill')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8">
        <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-green-600 text-sm mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Keranjang
        </a>
        <h1 class="text-3xl font-bold text-green-600">Penyelesaian Pesanan</h1>
        <p class="text-gray-500 text-sm mt-1">Lengkapi detail pengiriman dan pembayaran</p>
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

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
        <ul class="text-red-700 text-sm space-y-1">
            @foreach($errors->all() as $error)
            <li class="flex items-center gap-2">
                <span class="text-red-500 font-bold">✕</span> {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <input type="hidden" name="payment_method" id="paymentMethodInput" value="transfer_bank">
        <input type="hidden" name="payment_detail" id="paymentDetailInput" value="BCA">
        <input type="hidden" name="promo_code" id="promoCodeInput" value="">
        <input type="hidden" name="discount_amount" id="discountAmountInput" value="0">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Data Pelanggan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
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
                                   required placeholder="Masukkan nama lengkap"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Telepon *</label>
                            <input type="tel" name="customer_phone"
                                   value="{{ old('customer_phone', auth()->user()->phone) }}"
                                   required placeholder="08xxxxxxxxxx"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Alamat Lengkap *</label>
                        <input type="text" name="address_1" value="{{ old('address_1') }}" required
                               placeholder="Nama jalan, nomor rumah, gedung, lantai"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kecamatan</label>
                            <input type="text" name="address_2" value="{{ old('address_2') }}"
                                   placeholder="Masukkan kecamatan"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kota / Kabupaten</label>
                            <input type="text" name="address_3" value="{{ old('address_3') }}"
                                   placeholder="Masukkan kota"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Catatan Tambahan</label>
                        <textarea name="notes" rows="2"
                            placeholder="Alergi makanan, request khusus, dll."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Jadwal Pengiriman --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
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
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Waktu Pengiriman</label>
                            <select name="delivery_time"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
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
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                        <span class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </span>
                        Metode Pembayaran
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4">

                        <div class="pay-method border-2 border-green-500 bg-green-50 rounded-2xl p-4 cursor-pointer"
                             data-value="transfer_bank" data-channel="BCA" data-panel="panelBank"
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-green-500 bg-green-500 flex items-center justify-center radio-dot">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                </div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">Transfer Bank</p>
                            <p class="text-xs text-gray-400 mt-0.5">BCA, Mandiri, BNI, BRI</p>
                        </div>

                        <div class="pay-method border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer hover:border-gray-300"
                             data-value="e_wallet" data-channel="GoPay" data-panel="panelEwallet"
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-dot"></div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">E-Wallet</p>
                            <p class="text-xs text-gray-400 mt-0.5">GoPay, OVO, ShopeePay</p>
                        </div>

                        <div class="pay-method border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer hover:border-gray-300"
                             data-value="credit_card" data-channel="Visa" data-panel=""
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-dot"></div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">Kartu Kredit</p>
                            <p class="text-xs text-gray-400 mt-0.5">Visa, Mastercard</p>
                        </div>

                        <div class="pay-method border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer hover:border-gray-300"
                             data-value="virtual_account" data-channel="Mandiri VA" data-panel="panelVA"
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-dot"></div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">Virtual Account</p>
                            <p class="text-xs text-gray-400 mt-0.5">Mandiri, BNI, BRI</p>
                        </div>

                        <div class="pay-method border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer hover:border-gray-300"
                             data-value="cod" data-channel="COD" data-panel=""
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-dot"></div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">Cash on Delivery</p>
                            <p class="text-xs text-gray-400 mt-0.5">Bayar saat tiba</p>
                        </div>

                        <div class="pay-method border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer hover:border-gray-300"
                             data-value="qris" data-channel="QRIS" data-panel=""
                             onclick="selectPayment(this)">
                            <div class="flex justify-between items-start mb-3">
                                <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 radio-dot"></div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">QRIS</p>
                            <p class="text-xs text-gray-400 mt-0.5">Semua bank & e-wallet</p>
                        </div>

                    </div>

                    {{-- Channel Panels --}}
                    <div id="panelBank" class="bg-blue-50 rounded-xl p-4">
                        <p class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-3">Pilih Bank Tujuan Transfer</p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-green-500 bg-green-600 text-white" data-ch="BCA" onclick="pickChannel(this,'panelBank')">BCA</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="Mandiri" onclick="pickChannel(this,'panelBank')">Mandiri</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="BNI" onclick="pickChannel(this,'panelBank')">BNI</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="BRI" onclick="pickChannel(this,'panelBank')">BRI</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="CIMB" onclick="pickChannel(this,'panelBank')">CIMB</button>
                        </div>
                    </div>

                    <div id="panelEwallet" class="bg-green-50 rounded-xl p-4 hidden">
                        <p class="text-xs font-bold text-green-700 uppercase tracking-wider mb-3">Pilih E-Wallet</p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-green-500 bg-green-600 text-white" data-ch="GoPay" onclick="pickChannel(this,'panelEwallet')">GoPay</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="OVO" onclick="pickChannel(this,'panelEwallet')">OVO</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="ShopeePay" onclick="pickChannel(this,'panelEwallet')">ShopeePay</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="Dana" onclick="pickChannel(this,'panelEwallet')">Dana</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="LinkAja" onclick="pickChannel(this,'panelEwallet')">LinkAja</button>
                        </div>
                    </div>

                    <div id="panelVA" class="bg-amber-50 rounded-xl p-4 hidden">
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-3">Pilih Bank Virtual Account</p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-amber-500 bg-amber-500 text-white" data-ch="Mandiri VA" onclick="pickChannel(this,'panelVA')">Mandiri VA</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="BNI VA" onclick="pickChannel(this,'panelVA')">BNI VA</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="BRI VA" onclick="pickChannel(this,'panelVA')">BRI VA</button>
                            <button type="button" class="ch-btn px-4 py-2 rounded-xl text-sm font-semibold border-2 border-gray-200 bg-white text-gray-700" data-ch="Permata VA" onclick="pickChannel(this,'panelVA')">Permata VA</button>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT: Summary --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-900 flex items-center gap-2 mb-5 pb-4 border-b border-gray-50">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cart as $item)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100' }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-green-600">PKT-{{ $item['id'] }}</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-400">{{ $item['qty'] }} pax × Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-900 flex-shrink-0">
                                Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Kode Promo --}}
                    <div class="mb-5 pb-5 border-b border-gray-100">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kode Promo</label>
                        <div class="flex gap-2">
                            <input type="text" id="promoInput"
                                placeholder="Masukkan kode promo"
                                class="flex-1 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 uppercase tracking-widest"
                                maxlength="20">
                            <button type="button" onclick="applyPromo()"
                                class="bg-gray-900 hover:bg-gray-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                                Pakai
                            </button>
                        </div>
                        <div id="promoMsg" class="mt-2 text-xs font-medium hidden"></div>
                    </div>

                    {{-- Price Breakdown --}}
                    <div class="space-y-2.5 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Pengiriman</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Layanan (2%)</span>
                            <span>Rp {{ number_format($service, 0, ',', '.') }}</span>
                        </div>
                        <div id="discountRow" style="display:none;" class="flex justify-between text-green-600 font-medium">
                            <span id="discountLabel">Diskon Promo</span>
                            <span id="discountValue">- Rp 0</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between font-bold text-gray-900">
                            <span>Total Bayar</span>
                            <span class="text-xl text-green-600" id="totalDisplay">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 bg-green-50 border border-green-100 rounded-xl p-3 flex items-start gap-2 mb-5">
                        <svg class="w-4 h-4 text-green-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-xs text-green-700">Gratis ongkir wilayah DKI Jakarta & sekitarnya</p>
                    </div>

                    <button type="submit"
                        class="w-full text-white font-bold py-4 rounded-xl text-base transition-all hover:opacity-90 hover:shadow-lg active:scale-95"
                        style="background: linear-gradient(135deg, #16a34a, #15803d);">
                        Konfirmasi & Bayar Sekarang
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-3">
                        Dengan menekan tombol, Anda menyetujui
                        <a href="#" class="text-green-600 hover:underline">Syarat & Ketentuan</a>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
(function() {
    var baseTotal = {{ $total }};
    var currentDiscount = 0;

    // Load promo codes from server - safe way without PHP in JS
    var promoData = {};
    @foreach(\App\Models\PromoCode::where('is_active', true)->get() as $promo)
    promoData["{{ strtoupper($promo->code) }}"] = {
        type: "{{ $promo->discount_type }}",
        value: {{ $promo->discount_value }},
        min_order: {{ $promo->min_order ?? 0 }},
        description: "{{ addslashes($promo->description ?? '') }}"
    };
    @endforeach

    window.applyPromo = function() {
        var code = document.getElementById('promoInput').value.trim().toUpperCase();
        if (!code) { showMsg('Masukkan kode promo terlebih dahulu.', false); return; }

        var promo = promoData[code];
        if (!promo) { showMsg('Kode promo tidak valid atau sudah kadaluarsa.', false); resetDiscount(); return; }
        if (promo.min_order > 0 && baseTotal < promo.min_order) {
            showMsg('Minimum order Rp ' + promo.min_order.toLocaleString('id-ID') + ' untuk kode ini.', false);
            return;
        }

        currentDiscount = promo.type === 'percent'
            ? Math.round(baseTotal * promo.value / 100)
            : promo.value;

        document.getElementById('discountAmountInput').value = currentDiscount;
        document.getElementById('promoCodeInput').value = code;
        document.getElementById('discountLabel').textContent = 'Diskon (' + code + ')';
        document.getElementById('discountValue').textContent = '- Rp ' + currentDiscount.toLocaleString('id-ID');
        document.getElementById('discountRow').style.display = 'flex';
        document.getElementById('totalDisplay').textContent = 'Rp ' + Math.max(0, baseTotal - currentDiscount).toLocaleString('id-ID');
        showMsg('Promo berhasil diterapkan! ' + promo.description, true);
    };

    function resetDiscount() {
        currentDiscount = 0;
        document.getElementById('discountAmountInput').value = 0;
        document.getElementById('promoCodeInput').value = '';
        document.getElementById('discountRow').style.display = 'none';
        document.getElementById('totalDisplay').textContent = 'Rp ' + baseTotal.toLocaleString('id-ID');
    }

    function showMsg(text, success) {
        var el = document.getElementById('promoMsg');
        el.textContent = text;
        el.className = 'mt-2 text-xs font-medium ' + (success ? 'text-green-600' : 'text-red-500');
        el.classList.remove('hidden');
    }

    window.selectPayment = function(el) {
        document.querySelectorAll('.pay-method').forEach(function(c) {
            c.classList.remove('border-green-500', 'bg-green-50');
            c.classList.add('border-gray-200', 'bg-white');
            var dot = c.querySelector('.radio-dot');
            if (dot) { dot.style.background = ''; dot.innerHTML = ''; dot.style.borderColor = '#d1d5db'; }
        });

        el.classList.remove('border-gray-200', 'bg-white');
        el.classList.add('border-green-500', 'bg-green-50');
        var dot = el.querySelector('.radio-dot');
        if (dot) {
            dot.style.borderColor = '#16a34a';
            dot.style.background = '#16a34a';
            dot.innerHTML = '<div style="width:8px;height:8px;background:white;border-radius:50%;"></div>';
        }

        document.getElementById('paymentMethodInput').value = el.dataset.value;
        document.getElementById('paymentDetailInput').value = el.dataset.channel;

        ['panelBank','panelEwallet','panelVA'].forEach(function(id) {
            var p = document.getElementById(id);
            if (p) p.classList.add('hidden');
        });

        if (el.dataset.panel) {
            var panel = document.getElementById(el.dataset.panel);
            if (panel) panel.classList.remove('hidden');
        }
    };

    window.pickChannel = function(btn, panelId) {
        var panel = document.getElementById(panelId);
        if (!panel) return;
        panel.querySelectorAll('.ch-btn').forEach(function(b) {
            b.classList.remove('border-green-500','bg-green-600','border-amber-500','bg-amber-500','text-white');
            b.classList.add('border-gray-200','bg-white','text-gray-700');
        });
        btn.classList.remove('border-gray-200','bg-white','text-gray-700');
        btn.classList.add('border-green-500','bg-green-600','text-white');
        document.getElementById('paymentDetailInput').value = btn.dataset.ch;
    };
})();
</script>
@endsection
