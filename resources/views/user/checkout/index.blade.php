@extends('layouts.app')
@section('title', 'Checkout — Splitbill')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <style>
        .payment-card { transition: all 0.25s ease; cursor: pointer; }
        .payment-card:hover { transform: translateY(-2px); }
        .payment-card.selected { border-color: #16a34a !important; background: #f0fdf4 !important; }
        .channel-btn { transition: all 0.2s ease; }
        .channel-btn.active { background: #16a34a; color: white; border-color: #16a34a; }
    </style>

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

    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <input type="hidden" name="payment_method" id="paymentMethodInput" value="transfer_bank">
        <input type="hidden" name="payment_detail" id="paymentDetailInput" value="BCA">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">

                {{-- Data Pelanggan --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                        <span class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center text-lg">👤</span>
                        Data Pelanggan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Pelanggan *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Telepon *</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" required
                                   placeholder="08xxxxxxxxxx"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Alamat Lengkap *</label>
                        <input type="text" name="address_1" value="{{ old('address_1') }}" required
                               placeholder="Nama jalan, nomor rumah, gedung, lantai"
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition">
                        @error('address_1') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kecamatan</label>
                            <input type="text" name="address_2" value="{{ old('address_2') }}"
                                   placeholder="Masukkan kecamatan"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kota / Kabupaten</label>
                            <input type="text" name="address_3" value="{{ old('address_3') }}"
                                   placeholder="Masukkan kota"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Catatan Tambahan</label>
                        <textarea name="notes" rows="2" placeholder="Alergi makanan, request khusus, dll."
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 hover:bg-white transition resize-none">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Jadwal --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                        <span class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center text-lg">📅</span>
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
                            <select name="delivery_time" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50">
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
                        <span class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center text-lg">💳</span>
                        Metode Pembayaran
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5" id="paymentMethods">
                        @foreach([
                            ['value'=>'transfer_bank','label'=>'Transfer Bank','sub'=>'BCA, Mandiri, BNI, BRI','icon'=>'🏦','default_channel'=>'BCA'],
                            ['value'=>'e_wallet','label'=>'E-Wallet','sub'=>'GoPay, OVO, ShopeePay','icon'=>'📱','default_channel'=>'GoPay'],
                            ['value'=>'credit_card','label'=>'Kartu Kredit','sub'=>'Visa, Mastercard','icon'=>'💳','default_channel'=>'Visa'],
                            ['value'=>'virtual_account','label'=>'Virtual Account','sub'=>'Mandiri, BNI, BRI','icon'=>'🏧','default_channel'=>'Mandiri VA'],
                            ['value'=>'cod','label'=>'Cash on Delivery','sub'=>'Bayar saat tiba','icon'=>'💵','default_channel'=>'COD'],
                            ['value'=>'qris','label'=>'QRIS','sub'=>'Semua bank & dompet','icon'=>'📲','default_channel'=>'QRIS'],
                        ] as $pm)
                        <div class="payment-card border-2 border-gray-200 rounded-2xl p-4 {{ $pm['value'] === 'transfer_bank' ? 'selected' : '' }}"
                             data-value="{{ $pm['value'] }}"
                             data-channel="{{ $pm['default_channel'] }}"
                             onclick="selectPayment('{{ $pm['value'] }}', '{{ $pm['default_channel'] }}')">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-2xl">{{ $pm['icon'] }}</span>
                                <div class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center payment-radio">
                                    @if($pm['value'] === 'transfer_bank')
                                    <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                                    @endif
                                </div>
                            </div>
                            <p class="font-bold text-gray-900 text-sm">{{ $pm['label'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $pm['sub'] }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Channel selectors --}}
                    <div id="channelTransfer" class="bg-blue-50 rounded-xl p-4">
                        <p class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-3">Pilih Bank Tujuan Transfer</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['BCA','Mandiri','BNI','BRI','CIMB Niaga','Permata'] as $bank)
                            <button type="button" onclick="selectChannel('{{ $bank }}')"
                                class="channel-btn border border-gray-200 bg-white px-4 py-2 rounded-xl text-sm font-medium text-gray-700 {{ $bank === 'BCA' ? 'active' : '' }}"
                                data-ch="{{ $bank }}">
                                {{ $bank }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div id="channelEwallet" class="bg-green-50 rounded-xl p-4 hidden">
                        <p class="text-xs font-bold text-green-700 uppercase tracking-wider mb-3">Pilih E-Wallet</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['GoPay','OVO','ShopeePay','Dana','LinkAja'] as $ew)
                            <button type="button" onclick="selectChannel('{{ $ew }}')"
                                class="channel-btn border border-gray-200 bg-white px-4 py-2 rounded-xl text-sm font-medium text-gray-700"
                                data-ch="{{ $ew }}">
                                {{ $ew }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    <div id="channelVA" class="bg-amber-50 rounded-xl p-4 hidden">
                        <p class="text-xs font-bold text-amber-700 uppercase tracking-wider mb-3">Pilih Bank Virtual Account</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Mandiri VA','BNI VA','BRI VA','Permata VA'] as $va)
                            <button type="button" onclick="selectChannel('{{ $va }}')"
                                class="channel-btn border border-gray-200 bg-white px-4 py-2 rounded-xl text-sm font-medium text-gray-700"
                                data-ch="{{ $va }}">
                                {{ $va }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-bold text-gray-900 flex items-center gap-2 mb-5 pb-4 border-b border-gray-50">
                        🛒 Ringkasan Pesanan
                    </h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cart as $item)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100' }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-green-600">PKT-{{ $item['id'] }}</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-400">{{ $item['qty'] }} pax</p>
                            </div>
                            <p class="text-sm font-bold text-gray-900 flex-shrink-0">
                                Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </p>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-2.5 text-sm border-t border-gray-100 pt-4">
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
                        <div class="border-t border-dashed border-gray-200 pt-3 flex justify-between font-bold text-gray-900">
                            <span>Total Bayar</span>
                            <span class="text-xl text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-4 bg-green-50 border border-green-100 rounded-xl p-3 flex items-start gap-2 mb-5">
                        <span class="text-green-600 text-sm">✓</span>
                        <p class="text-xs text-green-700">Gratis ongkir wilayah DKI Jakarta & sekitarnya</p>
                    </div>

                    <button type="submit"
                        class="w-full font-bold py-4 rounded-xl text-white text-base transition-all hover:shadow-lg active:scale-95"
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
function selectPayment(value, defaultChannel) {
    document.getElementById('paymentMethodInput').value = value;
    document.getElementById('paymentDetailInput').value = defaultChannel;

    document.querySelectorAll('.payment-card').forEach(card => {
        card.classList.remove('selected');
        const radio = card.querySelector('.payment-radio');
        if(radio) radio.innerHTML = '';
    });

    const selected = document.querySelector(`[data-value="${value}"]`);
    if(selected) {
        selected.classList.add('selected');
        const radio = selected.querySelector('.payment-radio');
        if(radio) radio.innerHTML = '<div class="w-2 h-2 bg-green-600 rounded-full"></div>';
    }

    document.getElementById('channelTransfer').classList.add('hidden');
    document.getElementById('channelEwallet').classList.add('hidden');
    document.getElementById('channelVA').classList.add('hidden');

    if(value === 'transfer_bank') document.getElementById('channelTransfer').classList.remove('hidden');
    else if(value === 'e_wallet') document.getElementById('channelEwallet').classList.remove('hidden');
    else if(value === 'virtual_account') document.getElementById('channelVA').classList.remove('hidden');

    document.querySelectorAll('.channel-btn').forEach(b => b.classList.remove('active'));
    const firstBtn = document.querySelector(`#channel${value === 'transfer_bank' ? 'Transfer' : value === 'e_wallet' ? 'Ewallet' : 'VA'} .channel-btn`);
    if(firstBtn) {
        firstBtn.classList.add('active');
        document.getElementById('paymentDetailInput').value = firstBtn.dataset.ch;
    }
}

function selectChannel(channel) {
    document.getElementById('paymentDetailInput').value = channel;
    document.querySelectorAll('.channel-btn').forEach(b => {
        b.classList.toggle('active', b.dataset.ch === channel);
    });
}
</script>
@endsection