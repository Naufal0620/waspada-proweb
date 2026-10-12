@extends('layouts.app')

@section('title', 'Daftar Akun Baru — WASPADA')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="w-full max-w-md">
        
        <x-card variant="elevated" class="p-8 sm:p-10">
            
            {{-- Top Icon & Headline --}}
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-300 dark:border-[#2b5442] bg-emerald-50 dark:bg-[#142820] shadow-sm">
                    <img src="{{ asset('images/icon.svg') }}" alt="WASPADA" class="h-8 w-8 object-contain">
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Buat Akun</h1>
                <p class="text-xs text-slate-500 dark:text-[#7e9d90] mt-1.5">Bergabung dengan jaringan pelindung keamanan siber</p>
            </div>

            {{-- Register Form --}}
            <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                @csrf

                {{-- Name Input --}}
                <div>
                    <label for="name" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Nama Lengkap / Samaran
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autocomplete="name"
                           placeholder="Nama Anda"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Alamat Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email"
                           placeholder="nama@email.com"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div>
                    <label for="password" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Kata Sandi
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           placeholder="Minimal 8 karakter"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Confirmation Input --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Konfirmasi Kata Sandi
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Ketik ulang kata sandi"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <x-button variant="lime" type="submit" class="w-full py-3.5">
                        Daftar Akun Baru
                    </x-button>
                </div>
            </form>

            {{-- Footer Links --}}
            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-[#1a3328] text-center text-xs text-slate-500 dark:text-[#718f81]">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-emerald-700 dark:text-[#c9f28a] hover:underline ml-1">
                    Masuk di sini
                </a>
            </div>

        </x-card>
    </div>
</div>
@endsection
