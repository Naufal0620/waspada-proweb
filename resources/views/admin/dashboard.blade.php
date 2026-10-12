@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('breadcrumb', 'Dashboard Overview')

@php($activeMenu = 'dashboard')

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
        <x-card class="flex flex-col justify-between">
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
        </x-card>

        {{-- Card 2: Total Discussions --}}
        <x-card class="flex flex-col justify-between">
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
        </x-card>

        {{-- Card 3: Pending Discussions --}}
        <x-card class="flex flex-col justify-between">
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
        </x-card>

        {{-- Card 4: Total Reports --}}
        <x-card class="flex flex-col justify-between">
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
        </x-card>

        {{-- Card 5: Pending Reports --}}
        <x-card class="flex flex-col justify-between">
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
        </x-card>

        {{-- Card 6: Total Patterns --}}
        <x-card class="flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Pola Penipuan</span>
                <div class="h-9 w-9 rounded-xl bg-[#c9f28a]/20 border border-[#c9f28a]/40 text-[#0b1411] dark:text-[#c9f28a] font-bold flex items-center justify-center">
                    ◇
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($totalPatterns) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Pola risiko tersimpan di sistem</div>
            </div>
        </x-card>

    </div>

    {{-- Moderation Action Overview Card --}}
    <x-card variant="elevated">
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
    </x-card>

    {{-- Recent Activity Feeds --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Diskusi Terbaru --}}
        <x-card class="flex flex-col justify-between">
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
                                    <x-badge :variant="$discussion->status === 'published' ? 'published' : ($discussion->status === 'pending' ? 'pending' : 'dismissed')">
                                        {{ ucfirst($discussion->status) }}
                                    </x-badge>
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
        </x-card>

        {{-- Laporan Terbaru --}}
        <x-card class="flex flex-col justify-between">
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
                                    <x-badge :variant="$report->status === 'pending' ? 'pending' : ($report->status === 'actioned' ? 'published' : 'dismissed')">
                                        {{ ucfirst($report->status) }}
                                    </x-badge>
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
        </x-card>

    </div>

</div>
@endsection
