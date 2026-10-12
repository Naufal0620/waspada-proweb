@extends('layouts.admin')

@section('title', 'Detail Pengguna: ' . $user->name)
@section('breadcrumb', 'Manajemen Pengguna / Detail')

@php($activeMenu = 'users')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">

    {{-- Session Alerts --}}
    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if (session('error'))
        <x-alert type="error">
            {{ session('error') }}
        </x-alert>
    @endif

    @if ($errors->any())
        <x-alert type="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert>
    @endif

    {{-- Back Link --}}
    <div>
        <x-button variant="outline" size="sm" href="{{ route('admin.users.index') }}">
            ← Kembali ke Daftar Pengguna
        </x-button>
    </div>

    {{-- Main Detail Card --}}
    <x-card variant="elevated">
        
        {{-- Profile Header --}}
        <div class="flex items-center gap-4 pb-6 border-b border-slate-200 dark:border-[#1a3328]">
            <div class="h-14 w-14 rounded-2xl bg-[#c9f28a]/20 border border-[#c9f28a]/40 text-[#0b1411] dark:text-[#c9f28a] font-extrabold text-xl flex items-center justify-center uppercase">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                    {{ $user->name }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 dark:text-[#7b9c8e]">
                    {{ $user->email }}
                </p>
            </div>
        </div>

        {{-- Meta Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 py-6 border-b border-slate-200 dark:border-[#1a3328] text-xs sm:text-sm">
            <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1c3629] bg-slate-50/50 dark:bg-[#0c1813]">
                <div class="text-[11px] font-mono uppercase text-slate-400 dark:text-[#6a8d7e] mb-1">ID Pengguna</div>
                <div class="font-bold font-mono text-slate-800 dark:text-white">#USER-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>

            <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1c3629] bg-slate-50/50 dark:bg-[#0c1813]">
                <div class="text-[11px] font-mono uppercase text-slate-400 dark:text-[#6a8d7e] mb-1">Role Akun Saat Ini</div>
                <div>
                    <x-badge :variant="$user->role === 'admin' ? 'lime' : ($user->role === 'moderator' ? 'alert' : 'default')">
                        {{ ucfirst($user->role) }}
                    </x-badge>
                </div>
            </div>

            <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1c3629] bg-slate-50/50 dark:bg-[#0c1813]">
                <div class="text-[11px] font-mono uppercase text-slate-400 dark:text-[#6a8d7e] mb-1">Tanggal Registrasi</div>
                <div class="font-mono text-slate-800 dark:text-white">{{ $user->created_at?->format('d F Y, H:i') ?? '—' }}</div>
            </div>

            <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1c3629] bg-slate-50/50 dark:bg-[#0c1813]">
                <div class="text-[11px] font-mono uppercase text-slate-400 dark:text-[#6a8d7e] mb-1">Terakhir Diperbarui</div>
                <div class="font-mono text-slate-800 dark:text-white">{{ $user->updated_at?->format('d F Y, H:i') ?? '—' }}</div>
            </div>
        </div>

        {{-- Role Update Action --}}
        @if (auth()->id() !== $user->id)
            <div class="pt-6">
                <div class="mb-4">
                    <h2 class="text-sm font-bold text-slate-900 dark:text-white">
                        Pengaturan Hak Akses Pengguna
                    </h2>
                    <p class="text-xs text-slate-400 dark:text-[#769b8c] mt-0.5">
                        Tingkatkan atau turunkan izin pengguna ini di dalam platform WASPADA.
                    </p>
                </div>

                <form action="{{ route('admin.users.role.update', $user) }}" method="POST" class="flex flex-col sm:flex-row items-end gap-3 max-w-lg">
                    @csrf
                    @method('PATCH')

                    <div class="w-full sm:flex-1">
                        <label for="role" class="block text-[11px] font-mono uppercase text-slate-500 dark:text-[#7c9e8f] mb-1.5 font-bold">
                            Pilih Role Baru
                        </label>
                        <select name="role" id="role" required
                                class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#09130e] px-4 py-2.5 text-xs sm:text-sm text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none transition">
                            <option value="user" @selected($user->role === 'user')>User Biasa</option>
                            <option value="moderator" @selected($user->role === 'moderator')>Moderator</option>
                        </select>
                    </div>

                    <x-button variant="lime" type="submit" onclick="return confirm('Yakin ingin mengubah hak akses pengguna ini?')">
                        Simpan Perubahan
                    </x-button>
                </form>
            </div>
        @else
            <div class="pt-6 text-xs text-slate-400 dark:text-[#69897c] italic">
                * Anda sedang melihat profil Anda sendiri sebagai Administrator utama.
            </div>
        @endif

    </x-card>

</div>
@endsection
