@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-gray-100 to-gray-200">
  <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex" style="min-height:620px">

    {{-- LEFT: Hero --}}
    <div class="hidden lg:flex w-1/2 relative flex-col justify-end overflow-hidden"
         style="background:linear-gradient(180deg,#052e16 0%,#14532d 60%,#052e16 100%)">
      <div class="absolute inset-0 opacity-15">
        <svg width="100%" height="100%" viewBox="0 0 400 620">
          <circle cx="200" cy="280" r="200" fill="none" stroke="#86efac" stroke-width="1"/>
          <circle cx="200" cy="280" r="150" fill="none" stroke="#86efac" stroke-width="0.5"/>
          <circle cx="200" cy="280" r="100" fill="none" stroke="#86efac" stroke-width="0.5"/>
          <circle cx="200" cy="280" r="50"  fill="none" stroke="#86efac" stroke-width="0.5"/>
        </svg>
      </div>
      <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=80"
           alt="Tumpeng"
           class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-50">
      <div class="relative z-10 p-10 pb-12">
        <div class="inline-flex items-center gap-2 rounded-full px-4 py-2 mb-6"
             style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2)">
          <div class="w-2 h-2 rounded-full bg-green-400"></div>
          <span class="text-white text-xs font-medium">Bergabung Sekarang</span>
        </div>
        <h2 class="text-white text-4xl font-bold leading-tight mb-3">
          Mulai Perjalanan<br>Kuliner Anda.
        </h2>
        <p class="text-white text-sm leading-relaxed opacity-80">
          Daftar dan nikmati ribuan pilihan<br>menu katering premium Indonesia.
        </p>
        <div class="flex items-center gap-6 mt-8">
          <div class="text-center">
            <div class="text-white font-bold text-xl">500+</div>
            <div class="text-white text-xs opacity-60">Menu Tersedia</div>
          </div>
          <div class="w-px h-8 bg-white opacity-20"></div>
          <div class="text-center">
            <div class="text-white font-bold text-xl">10K+</div>
            <div class="text-white text-xs opacity-60">Pelanggan Puas</div>
          </div>
          <div class="w-px h-8 bg-white opacity-20"></div>
          <div class="text-center">
            <div class="text-white font-bold text-xl">4.9★</div>
            <div class="text-white text-xs opacity-60">Rating</div>
          </div>
        </div>
      </div>
    </div>

    {{-- RIGHT: Register Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 lg:p-12 overflow-y-auto">
      <div class="mb-6">
        <a href="/" class="text-2xl font-bold text-green-700">Splitbill</a>
        <h1 class="text-2xl font-bold text-gray-900 mt-4">Buat Akun Baru</h1>
        <p class="text-gray-500 text-sm mt-1">Isi data diri Anda untuk memulai.</p>
      </div>

      @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Name --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <input
              type="text"
              name="name"
              value="{{ old('name') }}"
              required
              placeholder="Masukkan nama lengkap"
              @class([
                'w-full pl-10 pr-4 py-3 bg-gray-50 rounded-xl text-sm border focus:outline-none focus:ring-2 focus:ring-green-500 transition',
                'border-red-400 bg-red-50' => $errors->has('name'),
                'border-gray-200'          => !$errors->has('name'),
              ])
            >
          </div>
        </div>

        {{-- Email --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <input
              type="email"
              name="email"
              value="{{ old('email') }}"
              required
              placeholder="nama@email.com"
              @class([
                'w-full pl-10 pr-4 py-3 bg-gray-50 rounded-xl text-sm border focus:outline-none focus:ring-2 focus:ring-green-500 transition',
                'border-red-400 bg-red-50' => $errors->has('email'),
                'border-gray-200'          => !$errors->has('email'),
              ])
            >
          </div>
        </div>

        {{-- Phone --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <input
              type="tel"
              name="phone"
              value="{{ old('phone') }}"
              placeholder="08xxxxxxxxxx"
              class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition"
            >
          </div>
        </div>

        {{-- Password --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <div class="relative" x-data="{ show: false }">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <input
              :type="show ? 'text' : 'password'"
              name="password"
              required
              placeholder="Min. 8 karakter"
              @class([
                'w-full pl-10 pr-12 py-3 bg-gray-50 rounded-xl text-sm border focus:outline-none focus:ring-2 focus:ring-green-500 transition',
                'border-red-400 bg-red-50' => $errors->has('password'),
                'border-gray-200'          => !$errors->has('password'),
              ])
            >
            <button type="button" @click="show = !show"
              class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
              <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <svg x-show="show" class="w-4 h-4" style="display:none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>
              </svg>
            </button>
          </div>
        </div>

        {{-- Confirm Password --}}
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <input
              type="password"
              name="password_confirmation"
              required
              placeholder="Ulangi password"
              class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition"
            >
          </div>
        </div>

        {{-- Terms --}}
        <label class="flex items-start gap-2 cursor-pointer">
          <input type="checkbox" required
            class="w-4 h-4 mt-0.5 rounded border-gray-300 text-green-600 focus:ring-green-500">
          <span class="text-xs text-gray-500">
            Dengan mendaftar, saya menyetujui
            <a href="#" class="text-green-600 hover:underline">Syarat & Ketentuan</a>
            dan
            <a href="#" class="text-green-600 hover:underline">Kebijakan Privasi</a>
            Splitbill.
          </span>
        </label>

        <button type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition-all duration-200 hover:shadow-lg active:scale-95 mt-2">
          Daftar Sekarang
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </button>
      </form>

      {{-- Social --}}
      <div class="flex items-center gap-4 my-5">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400">Atau daftar dengan</span>
        <div class="flex-1 h-px bg-gray-200"></div>
      </div>
      <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('social.login', 'google') }}"
          class="flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-700 font-medium hover:bg-gray-50 transition">
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Google
        </a>
        <a href="{{ route('social.login', 'facebook') }}"
          class="flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-700 font-medium hover:bg-gray-50 transition">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#1877F2">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
          </svg>
          Facebook
        </a>
      </div>

      <p class="text-center text-sm text-gray-500 mt-5">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:text-green-700">
          Masuk di sini
        </a>
      </p>
    </div>
  </div>

  <p class="text-center text-xs text-gray-400 mt-6">
    © 2024 Splitbill. Kurator Kuliner Nusantara Modern.
  </p>
</div>
@endsection
