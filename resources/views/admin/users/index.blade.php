@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('breadcrumb', 'Manajemen Pengguna')

@php($activeMenu = 'users')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Manajemen Pengguna
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
                Kelola hak akses dan telusuri profil pengguna platform WASPADA.
            </p>
        </div>

        <x-badge variant="lime">
            {{ $users->total() }} Pengguna Terdaftar
        </x-badge>
    </div>

    {{-- Table Container --}}
    <x-card class="p-0 overflow-hidden">
        
        {{-- Search & Filter Toolbar --}}
        <form method="GET" action="{{ route('admin.users.index') }}" 
              class="p-4 sm:p-5 border-b border-slate-200 dark:border-[#1c3629] flex flex-col sm:flex-row gap-3 bg-slate-50/50 dark:bg-[#0c1813]/60">
            
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email pengguna..."
                class="flex-1 rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#09130e] px-4 py-2.5 text-xs sm:text-sm text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-[#527063] focus:border-[#c9f28a] focus:outline-none transition"
            >

            <select name="role" 
                    class="rounded-xl border border-slate-200 dark:border-[#1e382c] bg-white dark:bg-[#09130e] px-4 py-2.5 text-xs sm:text-sm text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none transition">
                <option value="">Semua Role</option>
                <option value="user" @selected(request('role') === 'user')>User Biasa</option>
                <option value="moderator" @selected(request('role') === 'moderator')>Moderator</option>
                <option value="admin" @selected(request('role') === 'admin')>Administrator</option>
            </select>

            <x-button variant="lime" size="sm" type="submit">
                Filter
            </x-button>

            @if(request()->hasAny(['search', 'role']))
                <x-button variant="outline" size="sm" href="{{ route('admin.users.index') }}">
                    Reset
                </x-button>
            @endif
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-[#1a3328] bg-slate-100/60 dark:bg-[#0c1813] text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#769b8b]">
                        <th class="py-3.5 px-6">Identitas Pengguna</th>
                        <th class="py-3.5 px-6">Role Akses</th>
                        <th class="py-3.5 px-6">Tanggal Bergabung</th>
                        <th class="py-3.5 px-6 text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-[#172c21]">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-[#12241c]/50 transition">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-xl bg-[#c9f28a]/20 border border-[#c9f28a]/40 text-[#0b1411] dark:text-[#c9f28a] font-bold text-xs flex items-center justify-center uppercase flex-shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 dark:text-white leading-tight">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-[11px] text-slate-400 dark:text-[#6d8d7e]">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-purple-500/10 text-purple-600 dark:text-purple-300 border border-purple-500/30">
                                        ADMIN
                                    </span>
                                @elseif($user->role === 'moderator')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/10 text-amber-600 dark:text-amber-300 border border-amber-500/30">
                                        MODERATOR
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-slate-500/10 text-slate-600 dark:text-[#90aba0] border border-slate-300 dark:border-[#213d30]">
                                        USER
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-slate-500 dark:text-[#7f9e90] font-mono text-xs">
                                {{ $user->created_at?->format('d M Y') ?? '—' }}
                            </td>

                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.users.show', $user) }}" 
                                   class="inline-flex items-center gap-1 font-bold text-xs text-[#059669] dark:text-[#c9f28a] hover:underline">
                                    <span>Detail Role</span>
                                    <span>→</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-xs text-slate-400 dark:text-[#6e8a7d]">
                                Tidak ada akun pengguna yang sesuai dengan filter pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-[#1a3328]">
                {{ $users->links() }}
            </div>
        @endif

    </x-card>

</div>
@endsection
