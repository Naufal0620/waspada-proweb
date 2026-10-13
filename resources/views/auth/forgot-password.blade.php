@extends('layouts.app')

@section('title', 'Lupa Kata Sandi — WASPADA')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="w-full max-w-md">
        
        <x-card variant="elevated" class="p-8 sm:p-10">
            
            {{-- Top Icon & Headline --}}
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-300 dark:border-[#2b5442] bg-emerald-50 dark:bg-[#142820] shadow-sm">
                    <svg class="h-7 w-7 text-emerald-700 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Pemulihan Kata Sandi</h1>
                <p class="text-xs text-slate-500 dark:text-[#7e9d90] mt-1.5 leading-relaxed">
                    Masukkan email Anda untuk menerima tautan instruksi reset kata sandi akun.
                </p>
            </div>

            {{-- Status Alert --}}
            @if (session('status'))
                <x-alert type="success" class="mb-6">
                    {{ session('status') }}
                </x-alert>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Alamat Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           autocomplete="email"
                           placeholder="nama@email.com"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#526f62] focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <x-button variant="lime" type="submit" class="w-full py-3.5">
                    Kirim Tautan Pemulihan
                </x-button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-[#1a3328] text-center text-xs text-slate-500 dark:text-[#718f81]">
                Sudah ingat kata sandi Anda? 
                <a href="{{ route('login') }}" class="font-bold text-emerald-700 dark:text-[#c9f28a] hover:underline ml-1">
                    Kembali ke Login
                </a>
            </div>

        </x-card>
    </div>
</div>
@endsection
