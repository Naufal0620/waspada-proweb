@extends('layouts.app')

@section('title', 'Atur Ulang Kata Sandi — WASPADA')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="w-full max-w-md">
        
        <x-card variant="elevated" class="p-8 sm:p-10">
            
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-300 dark:border-[#2b5442] bg-emerald-50 dark:bg-[#142820] shadow-sm">
                    <svg class="h-7 w-7 text-emerald-700 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Kata Sandi Baru</h1>
                <p class="text-xs text-slate-500 dark:text-[#7e9d90] mt-1.5 leading-relaxed">
                    Tentukan kata sandi baru yang aman untuk akun Anda.
                </p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Alamat Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email', $email) }}" 
                           required 
                           autocomplete="email"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Kata Sandi Baru
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           placeholder="Minimal 8 karakter"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-mono font-bold uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5] mb-2">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Ulangi kata sandi"
                           class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#0c1813] px-4 py-3 text-sm text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none focus:ring-1 focus:ring-[#c9f28a] transition">
                </div>

                <x-button variant="lime" type="submit" class="w-full py-3.5">
                    Perbarui Kata Sandi
                </x-button>
            </form>

        </x-card>
    </div>
</div>
@endsection
