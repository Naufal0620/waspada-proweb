@extends('layouts.app')

@section('title', 'Dashboard Saya — WASPADA')

@section('content')
<div class="py-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Session Alerts --}}
    @if (session('success'))
        <x-alert type="success" class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    {{-- User Header Welcome Card --}}
    <x-card variant="elevated" class="mb-8 p-6 sm:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 rounded-2xl bg-[#c9f28a] text-[#0b1411] font-extrabold text-2xl flex items-center justify-center uppercase shadow-md flex-shrink-0">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                            Halo, {{ $user->name }}
                        </h1>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-[#c9f28a] uppercase">
                            Warga Waspada
                        </span>
                    </div>
                    <p class="text-xs font-mono text-slate-500 dark:text-[#8ea499]">
                        {{ $user->email }} • Anggota sejak {{ $user->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-button variant="lime" size="sm" href="{{ route('assessments.create') }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Skrining Risiko Baru</span>
                </x-button>
                <x-button variant="outline" size="sm" href="{{ route('forum.create') }}">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Tulis di Forum</span>
                </x-button>
            </div>
        </div>
    </x-card>

    {{-- Metric Stat Cards Bento --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <x-card class="flex items-center gap-4 hover:border-emerald-300 dark:hover:border-[#2b5442] transition">
            <div class="h-12 w-12 rounded-xl bg-emerald-100 dark:bg-[#14261e] border border-emerald-200 dark:border-[#203c30] flex items-center justify-center text-emerald-700 dark:text-[#c9f28a] flex-shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7f998d]">Total Skrining</p>
                <p class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $stats['total_assessments'] }}</p>
            </div>
        </x-card>

        <x-card class="flex items-center gap-4 hover:border-rose-300 dark:hover:border-rose-800 transition">
            <div class="h-12 w-12 rounded-xl bg-rose-100 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-900/40 flex items-center justify-center text-rose-600 dark:text-rose-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7f998d]">Risiko Kritis</p>
                <p class="text-2xl font-bold font-mono text-rose-600 dark:text-rose-400">{{ $stats['high_risk_assessments'] }}</p>
            </div>
        </x-card>

        <x-card class="flex items-center gap-4 hover:border-amber-300 dark:hover:border-amber-800 transition">
            <div class="h-12 w-12 rounded-xl bg-amber-100 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/40 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7f998d]">Perlu Waspada</p>
                <p class="text-2xl font-bold font-mono text-amber-600 dark:text-amber-400">{{ $stats['warning_assessments'] }}</p>
            </div>
        </x-card>

        <x-card class="flex items-center gap-4 hover:border-slate-300 dark:hover:border-[#21352d] transition">
            <div class="h-12 w-12 rounded-xl bg-slate-100 dark:bg-[#15231e] border border-slate-200 dark:border-[#21352d] flex items-center justify-center text-slate-700 dark:text-[#9eb5aa] flex-shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7f998d]">Diskusi Saya</p>
                <p class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $stats['total_discussions'] }} <span class="text-xs text-slate-400 font-normal">topik</span></p>
            </div>
        </x-card>
    </div>

    {{-- Content Layout: Assessments & Discussions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Assessment History (2 Columns) --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-slate-200 dark:border-[#172c21]">
                <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                    Riwayat Pemeriksaan Risiko
                </h2>
                <span class="text-xs font-mono text-slate-500 dark:text-[#7f998d]">
                    {{ $assessments->total() }} catatan
                </span>
            </div>

            @forelse ($assessments as $item)
                @php
                    $badgeType = match($item->risk_level) {
                        'high' => 'danger',
                        'warning' => 'alert',
                        default => 'lime'
                    };
                    $badgeText = match($item->risk_level) {
                        'high' => 'CRITICAL DANGER',
                        'warning' => 'ELEVATED RISK',
                        default => 'LOW THREAT'
                    };
                @endphp
                <x-card class="hover:border-[#c9f28a]/60 transition">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100 dark:border-[#172c21]">
                        <div class="flex items-center gap-2.5">
                            <x-badge :variant="$badgeType">
                                {{ $badgeText }}
                            </x-badge>
                            <span class="text-xs font-mono font-bold text-slate-700 dark:text-[#c4d8ce]">
                                #SEC-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <span class="text-xs font-mono text-slate-400 dark:text-[#6f8f80]">
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <div class="py-3 text-xs text-slate-600 dark:text-[#a0b5ab]">
                        <p class="font-semibold text-slate-800 dark:text-[#c4d8ce] mb-2">
                            {{ $item->indicators->count() }} Sinyal Indikator Terdeteksi:
                        </p>
                        <div class="flex flex-wrap gap-1.5">
                            @forelse ($item->indicators->take(3) as $indicator)
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-[#12221b] border border-slate-200 dark:border-[#1d3529] text-[11px] text-slate-700 dark:text-[#c4d8ce]">
                                    {{ $indicator->label }}
                                </span>
                            @empty
                                <span class="text-slate-400 italic text-[11px]">Tidak ada indikator bahaya yang dicentang</span>
                            @endforelse
                            @if ($item->indicators->count() > 3)
                                <span class="px-2 py-1 rounded-lg bg-slate-100 dark:bg-[#12221b] text-[11px] text-slate-500 font-mono">
                                    +{{ $item->indicators->count() - 3 }} lainnya
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 dark:border-[#172c21] flex items-center justify-between">
                        <span class="text-[11px] font-mono text-slate-400">
                            Status Informasi: <strong class="text-slate-700 dark:text-[#c4d8ce] capitalize">{{ $item->information_status }}</strong>
                        </span>
                        <x-button variant="outline" size="sm" href="{{ route('assessments.show', $item->id) }}">
                            Buka Rincian Mitigasi →
                        </x-button>
                    </div>
                </x-card>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 dark:border-[#1c3328] p-8 text-center text-slate-500 dark:text-[#7f998d]">
                    <svg class="w-10 h-10 mx-auto text-slate-400 dark:text-[#526f62] mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="font-bold text-slate-800 dark:text-white">Belum Ada Riwayat Pemeriksaan Risiko</p>
                    <p class="text-xs text-slate-500 dark:text-[#7f998d] mt-1 mb-4">Uji indikator mencurigakan untuk mendeteksi potensi penipuan online.</p>
                    <x-button variant="lime" size="sm" href="{{ route('assessments.create') }}">
                        Mulai Skrining Pertama
                    </x-button>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $assessments->links() }}
            </div>
        </div>

        {{-- User Forum Discussions (1 Column) --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between pb-2 border-b border-slate-200 dark:border-[#172c21]">
                <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                    Diskusi Saya
                </h2>
                <x-button variant="outline" size="sm" href="{{ route('forum.create') }}">
                    + Tulis
                </x-button>
            </div>

            @forelse ($discussions as $disc)
                <x-card class="hover:border-[#c9f28a]/60 transition">
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <x-badge variant="lime">
                            {{ $disc->category->name }}
                        </x-badge>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded {{ $disc->status === 'published' ? 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-[#c9f28a]' : ($disc->status === 'pending' ? 'bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300' : 'bg-rose-100 dark:bg-rose-950/60 text-rose-800 dark:text-rose-300') }}">
                            {{ strtoupper($disc->status) }}
                        </span>
                    </div>

                    <h3 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-2 mb-2">
                        <a href="{{ route('forum.show', $disc->slug) }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">
                            {{ $disc->title }}
                        </a>
                    </h3>

                    <div class="flex items-center justify-between text-[11px] font-mono text-slate-500 dark:text-[#7f998d] pt-2 border-t border-slate-100 dark:border-[#172c21]">
                        <span>{{ $disc->votes_count }} vote • {{ $disc->comments_count }} komentar</span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('forum.edit', $disc->slug) }}" class="text-emerald-700 dark:text-[#c9f28a] font-semibold hover:underline">
                                Edit
                            </a>
                        </div>
                    </div>
                </x-card>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 dark:border-[#1c3328] p-6 text-center text-slate-500 dark:text-[#7f998d]">
                    <p class="text-xs">Anda belum membuat topik diskusi di forum.</p>
                    <a href="{{ route('forum.create') }}" class="mt-2 inline-block text-xs font-semibold text-emerald-700 dark:text-[#c9f28a] hover:underline">
                        Mulai diskusi baru →
                    </a>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $discussions->links() }}
            </div>
        </div>

    </div>

</div>
@endsection
