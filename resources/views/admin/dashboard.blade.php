@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('breadcrumb', 'Dashboard Overview')

@php
    $activeMenu = 'dashboard';
@endphp

@section('content')
<div class="space-y-8">

    {{-- Top Heading --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Dashboard Overview
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
                Pusat metrik dan pemantauan aktivitas keamanan platform WASPADA.
            </p>
        </div>

        <div class="self-start sm:self-auto px-3.5 h-8 inline-flex items-center gap-1.5 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-white dark:bg-[#12221b] text-xs font-mono text-slate-600 dark:text-[#a0c5b5] shadow-sm leading-none">
            <span>◷</span><span>{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- Stats Bento Grid (6 Metrics) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

        {{-- Card 1: Total Users --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Total Pengguna</span>
                <div class="h-9 w-9 rounded-xl bg-[#c9f28a]/20 border border-[#c9f28a]/40 text-[#0b1411] dark:text-[#c9f28a] font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($totalUsers) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Seluruh akun yang terdaftar</div>
            </div>
        </div>

        {{-- Card 2: Total Discussions --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Total Diskusi</span>
                <div class="h-9 w-9 rounded-xl bg-teal-500/10 border border-teal-500/30 text-teal-600 dark:text-teal-400 font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($totalDiscussions) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Diskusi dari seluruh kategori</div>
            </div>
        </div>

        {{-- Card 3: Pending Discussions --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Diskusi Menunggu</span>
                <div class="h-9 w-9 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-600 dark:text-amber-400 font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($pendingDiscussions) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Menunggu moderasi persetujuan</div>
            </div>
        </div>

        {{-- Card 4: Total Reports --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Total Laporan</span>
                <div class="h-9 w-9 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($totalReports) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Seluruh tiket laporan pengguna</div>
            </div>
        </div>

        {{-- Card 5: Pending Reports --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Laporan Pending</span>
                <div class="h-9 w-9 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-600 dark:text-rose-400 font-bold flex items-center justify-center">
                    !
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($pendingReports) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Laporan perlu ditindaklanjuti</div>
            </div>
        </div>

        {{-- Card 6: Total Assessments --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Total Asesmen</span>
                <div class="h-9 w-9 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-[#c9f28a] font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($totalAssessments) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">{{ number_format($highRiskAssessments) }} terdeteksi risiko tinggi</div>
            </div>
        </div>

    </div>

    {{-- Moderation Action Overview Card --}}
    <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#12221b] border-slate-200 dark:border-[#254637] shadow-[0_15px_35px_rgba(0,0,0,0.06)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
        <h2 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-1 flex items-center gap-2">
            <span class="h-2 w-2 rounded-full bg-[#c9f28a]"></span>
            Tindakan Prioritas Moderasi
        </h2>
        <p class="text-xs text-slate-500 dark:text-[#7e9f90] mb-6">
            Antrean verifikasi konten dan laporan masyarakat yang membutuhkan aksi administrator.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-[#213f30] bg-slate-50 dark:bg-[#0c1813] hover:border-[#c9f28a]/50 transition group">
                <div class="flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-amber-400"></span>
                    <div>
                        <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-[#c9f28a] transition">
                            Laporan Perlu Ditinjau
                        </div>
                        <div class="text-[11px] text-slate-400 dark:text-[#6b8b7e]">
                            Tinjau pelanggaran konten diskusi
                        </div>
                    </div>
                </div>
                <div class="font-mono font-bold text-lg text-slate-900 dark:text-white">
                    {{ number_format($pendingReports) }}
                </div>
            </a>

            <a href="{{ route('forum.index') }}"
               class="flex items-center justify-between p-4 rounded-xl border border-slate-200 dark:border-[#213f30] bg-slate-50 dark:bg-[#0c1813] hover:border-[#c9f28a]/50 transition group">
                <div class="flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-[#c9f28a]"></span>
                    <div>
                        <div class="text-xs font-bold text-slate-800 dark:text-white group-hover:text-[#c9f28a] transition">
                            Diskusi Menunggu Verifikasi
                        </div>
                        <div class="text-[11px] text-slate-400 dark:text-[#6b8b7e]">
                            Tinjau draft postingan baru
                        </div>
                    </div>
                </div>
                <div class="font-mono font-bold text-lg text-slate-900 dark:text-white">
                    {{ number_format($pendingDiscussions) }}
                </div>
            </a>

        </div>
    </div>

    {{-- Recent Activity Feeds --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Diskusi Terbaru --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-[#1b3427]">
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">Diskusi Terbaru</h2>
                        <p class="text-xs text-slate-500 dark:text-[#7e9f90] mt-0.5">Lima diskusi terakhir yang masuk ke sistem.</p>
                    </div>
                    <a href="{{ route('forum.index') }}" class="text-xs font-mono text-[#15803d] dark:text-[#c9f28a] hover:underline">
                        Lihat Forum →
                    </a>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-[#193225]">
                    @forelse ($latestDiscussions as $discussion)
                        @php
                            $dStatusClass = match($discussion->status) {
                                'published' => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-[#c9f28a]',
                                'pending'   => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                default     => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400',
                            };
                        @endphp
                        <div class="py-3.5 first:pt-0 last:pb-0 flex items-start gap-3">
                            <div class="h-8 w-8 rounded-lg bg-teal-500/10 border border-teal-500/20 text-teal-600 dark:text-teal-400 font-mono font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                D
                            </div>
                            <div class="min-w-0 flex-1">
                                @if ($discussion->status === 'published')
                                    <a href="{{ route('forum.show', $discussion->slug) }}" class="text-xs sm:text-sm font-bold text-slate-800 dark:text-white hover:text-[#15803d] dark:hover:text-[#c9f28a] transition line-clamp-1">
                                        {{ $discussion->title }}
                                    </a>
                                @else
                                    <h3 class="text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 line-clamp-1">
                                        {{ $discussion->title }}
                                    </h3>
                                @endif
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 text-[11px] text-slate-400 dark:text-[#6b8b7e]">
                                    <span class="{{ $dStatusClass }}">{{ ucfirst($discussion->status) }}</span>
                                    <span>•</span>
                                    <span>{{ $discussion->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-slate-400 dark:text-[#6b8b7e]">
                            Belum ada diskusi yang tercatat.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-slate-100 dark:border-[#1b3427] text-[11px] font-mono text-slate-400 dark:text-[#5d7c6f]">
                Menampilkan maksimal 5 diskusi terbaru
            </div>
        </div>

        {{-- Laporan Terbaru --}}
        <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-[#1b3427]">
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">Laporan Terbaru</h2>
                        <p class="text-xs text-slate-500 dark:text-[#7e9f90] mt-0.5">Laporan yang baru dikirim oleh pengguna.</p>
                    </div>
                    <a href="{{ route('admin.reports.index') }}" class="text-xs font-mono text-[#15803d] dark:text-[#c9f28a] hover:underline">
                        Kelola Laporan →
                    </a>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-[#193225]">
                    @forelse ($latestReports as $report)
                        @php
                            $rStatusClass = match($report->status) {
                                'actioned' => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-[#c9f28a]',
                                'pending'  => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                default    => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400',
                            };
                        @endphp
                        <div class="py-3.5 first:pt-0 last:pb-0 flex items-start gap-3">
                            <div class="h-8 w-8 rounded-lg bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 font-mono font-bold text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                !
                            </div>
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="text-xs sm:text-sm font-bold text-slate-800 dark:text-white hover:text-rose-600 dark:hover:text-rose-400 transition line-clamp-1">
                                    {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                                </a>
                                <p class="text-xs text-slate-500 dark:text-[#7e9f90] mt-0.5 line-clamp-1">
                                    {{ $report->reason }}
                                </p>
                                <div class="flex flex-wrap items-center gap-2 mt-1.5 text-[11px] text-slate-400 dark:text-[#6b8b7e]">
                                    <span class="{{ $rStatusClass }}">{{ ucfirst($report->status) }}</span>
                                    <span>•</span>
                                    <span>{{ $report->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-xs text-slate-400 dark:text-[#6b8b7e]">
                            Belum ada laporan diskusi.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="pt-4 mt-4 border-t border-slate-100 dark:border-[#1b3427] text-[11px] font-mono text-slate-400 dark:text-[#5d7c6f]">
                Menampilkan maksimal 5 laporan terbaru
            </div>
        </div>

    </div>

    {{-- Asesmen Risiko Terbaru --}}
    <div class="rounded-2xl sm:rounded-3xl border p-6 sm:p-8 backdrop-blur-xl transition-colors bg-white dark:bg-[#0f1d17] border-slate-200 dark:border-[#1b3327] shadow-sm dark:shadow-[0_10px_30px_rgba(0,0,0,0.4)]">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-[#1b3427]">
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                    Pemeriksaan Risiko Terbaru oleh Pengguna
                </h2>
                <p class="text-xs text-slate-500 dark:text-[#7e9f90] mt-0.5">Pantau skrining ancaman siber dan penipuan yang dilakukan masyarakat.</p>
            </div>
            <a href="{{ route('admin.assessments.index') }}" class="text-xs font-mono text-[#15803d] dark:text-[#c9f28a] hover:underline">
                Lihat Semua Asesmen →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7d9f90] border-b border-slate-100 dark:border-[#1a3328]">
                    <tr>
                        <th class="py-2.5 px-3">Sesi / ID</th>
                        <th class="py-2.5 px-3">Pengguna</th>
                        <th class="py-2.5 px-3">Tingkat Risiko</th>
                        <th class="py-2.5 px-3">Indikator Terpilih</th>
                        <th class="py-2.5 px-3">Waktu</th>
                        <th class="py-2.5 px-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-[#172c21]">
                    @forelse ($latestAssessments as $asm)
                        @php
                            $asmColorClass = match($asm->risk_level) {
                                'high'    => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                'warning' => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                default   => 'inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-[#c9f28a]',
                            };
                            $asmLabel = match($asm->risk_level) {
                                'high'    => 'CRITICAL',
                                'warning' => 'WARNING',
                                default   => 'LOW',
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-[#12221b]/50">
                            <td class="py-3 px-3 font-mono font-semibold text-slate-800 dark:text-[#c4d8ce]">
                                #SEC-{{ str_pad($asm->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-3 px-3">
                                @if($asm->user)
                                    <span class="font-bold text-slate-900 dark:text-white">{{ $asm->user->name }}</span>
                                    <span class="block text-[10px] text-slate-400 font-mono">{{ $asm->user->email }}</span>
                                @else
                                    <span class="text-slate-400 font-mono italic">Pengguna Tamu (Anonim)</span>
                                @endif
                            </td>
                            <td class="py-3 px-3">
                                <span class="{{ $asmColorClass }}">{{ $asmLabel }}</span>
                            </td>
                            <td class="py-3 px-3 text-slate-600 dark:text-[#9eb5aa]">
                                {{ $asm->indicators->count() }} sinyal terdeteksi
                            </td>
                            <td class="py-3 px-3 font-mono text-slate-400 text-[11px]">
                                {{ $asm->created_at->diffForHumans() }}
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="{{ route('admin.assessments.show', $asm->id) }}" class="text-emerald-700 dark:text-[#c9f28a] font-semibold hover:underline">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-400">Belum ada asesmen tersimpan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
