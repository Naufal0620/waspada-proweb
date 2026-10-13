@extends('layouts.app')

@section('title', 'Verifikasi Email Anda — WASPADA')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-12 px-4 sm:px-6">
    <div class="w-full max-w-md">
        
        <x-card variant="elevated" class="p-8 sm:p-10 text-center">
            
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-300 dark:border-[#2b5442] bg-emerald-50 dark:bg-[#142820] shadow-sm">
                <svg class="h-7 w-7 text-emerald-700 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white mb-2">
                Verifikasi Alamat Email
            </h1>
            
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#7e9d90] mb-6 leading-relaxed">
                Terima kasih telah mendaftar! Sebelum melanjutkan, mohon periksa inbox email Anda untuk mengklik tautan verifikasi.
            </p>

            @if (session('status') == 'verification-link-sent')
                <x-alert type="success" class="mb-6">
                    Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                </x-alert>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <x-button variant="lime" type="submit" class="w-full py-3">
                    Kirim Ulang Email Verifikasi
                </x-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-xs text-slate-400 hover:text-rose-500 underline transition">
                    Keluar dari Akun
                </button>
            </form>

        </x-card>
    </div>
</div>
@endsection
