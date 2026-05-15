@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')

{{-- Hero --}}
<div class="relative bg-gray-900 overflow-hidden" style="min-height:480px">
    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1400&q=80"
         alt="About Hero" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-24 text-center">
        <span class="inline-block bg-green-500/20 border border-green-400/30 text-green-300 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">
            Tentang Kami
        </span>
        <h1 class="text-5xl font-bold text-white leading-tight mb-6">
            Kurator Kuliner<br>
            <span class="text-green-400">Nusantara Modern</span>
        </h1>
        <p class="text-white/70 text-lg leading-relaxed max-w-2xl mx-auto">
            Splitbill hadir untuk menghadirkan pengalaman kuliner Indonesia yang autentik, higienis, dan berkelas untuk setiap momen istimewa Anda.
        </p>
    </div>
</div>

{{-- Stats --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-bold text-green-600">500+</p>
                <p class="text-gray-500 text-sm mt-1">Menu Tersedia</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-green-600">10K+</p>
                <p class="text-gray-500 text-sm mt-1">Pelanggan Puas</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-green-600">4.9★</p>
                <p class="text-gray-500 text-sm mt-1">Rating Rata-rata</p>
            </div>
            <div>
                <p class="text-4xl font-bold text-green-600">8+</p>
                <p class="text-gray-500 text-sm mt-1">Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</div>

{{-- Story --}}
<div class="max-w-5xl mx-auto px-4 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="text-green-600 font-bold text-sm uppercase tracking-widest">Kisah Kami</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3 mb-5 leading-tight">
                Berawal dari Cinta pada<br>Masakan Indonesia
            </h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                Splitbill lahir dari kecintaan mendalam pada kekayaan kuliner Nusantara. Kami percaya bahwa setiap hidangan Indonesia menyimpan cerita, tradisi, dan cita rasa yang tak ternilai.
            </p>
            <p class="text-gray-600 leading-relaxed mb-6">
                Sejak 2016, kami telah melayani ribuan acara korporat, pernikahan, syukuran, hingga momen keluarga dengan standar kualitas tertinggi menggunakan bahan-bahan segar pilihan dari petani lokal.
            </p>
            <div class="flex items-center gap-4">
                <div class="w-12 h-0.5 bg-green-600"></div>
                <p class="text-green-700 font-semibold text-sm italic">"Setiap suapan adalah karya seni kuliner."</p>
            </div>
        </div>
        <div class="relative">
            <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=80"
                 alt="Our Story" class="rounded-3xl shadow-xl w-full object-cover" style="height:380px">
            <div class="absolute -bottom-4 -left-4 bg-green-600 text-white rounded-2xl p-4 shadow-lg">
                <p class="text-2xl font-bold">8+</p>
                <p class="text-xs text-green-100">Tahun Melayani</p>
            </div>
        </div>
    </div>
</div>

{{-- Values --}}
<div class="bg-gray-50 py-20">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-600 font-bold text-sm uppercase tracking-widest">Nilai Kami</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-3">Komitmen yang Kami Pegang</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-md transition">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Kualitas Premium</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Hanya bahan-bahan segar pilihan dari petani lokal terpercaya yang masuk ke dapur kami.</p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-md transition">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Tepat Waktu</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Setiap pesanan dikirimkan sesuai jadwal yang disepakati, tanpa toleransi keterlambatan.</p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-gray-100 hover:border-green-200 hover:shadow-md transition">
                <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Cinta & Dedikasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Setiap hidangan dimasak dengan penuh cinta dan dedikasi untuk menciptakan pengalaman kuliner terbaik.</p>
            </div>
        </div>
    </div>
</div>

{{-- Team --}}
<div class="max-w-5xl mx-auto px-4 py-20">
    <div class="text-center mb-12">
        <span class="text-green-600 font-bold text-sm uppercase tracking-widest">Tim Kami</span>
        <h2 class="text-3xl font-bold text-gray-900 mt-3">Kurator di Balik Cita Rasa</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        @foreach([
            ['name' => 'Chef Danish Athaya Natasurendra', 'role' => 'Head Chef & Co-Founder', 'img' => 'https://images.unsplash.com/photo-1607631568010-a87245c0daf8?w=300&q=80'],
            ['name' => 'Muhammad Sayyid Husain Al-karim', 'role' => 'Culinary Director', 'img' => 'https://images.unsplash.com/photo-1607631568010-a87245c0daf8?w=300&q=80'],
            ['name' => 'Qiageng Berke Jaisyurrohman', 'role' => 'Operations Manager', 'img' => 'https://images.unsplash.com/photo-1607631568010-a87245c0daf8?w=300&q=80'],
        ] as $member)
        <div class="text-center group">
            <div class="relative inline-block mb-4">
                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center mx-auto shadow-lg group-hover:shadow-xl transition">
                    <span class="text-white text-3xl font-bold">{{ substr($member['name'], 6, 1) }}</span>
                </div>
                <div class="absolute -bottom-2 -right-2 w-7 h-7 bg-green-600 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <h3 class="font-bold text-gray-900">{{ $member['name'] }}</h3>
            <p class="text-green-600 text-sm">{{ $member['role'] }}</p>
        </div>
        @endforeach
    </div>
</div>

{{-- CTA --}}
<div class="bg-green-600 py-16" id="tentang">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Siap Memesan Katering Premium?</h2>
        <p class="text-green-100 mb-8 text-lg">Hubungi kami sekarang dan dapatkan konsultasi menu gratis untuk acara Anda.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('packages.index') }}"
               class="bg-white text-green-700 font-bold px-8 py-3.5 rounded-xl hover:bg-green-50 transition shadow-lg">
                Lihat Menu Lengkap
            </a>
            <a href="https://wa.me/6281234567890" target="_blank"
               class="border-2 border-white text-white font-bold px-8 py-3.5 rounded-xl hover:bg-white hover:text-green-700 transition">
                Hubungi via WhatsApp
            </a>
        </div>
    </div>
</div>

@endsection
