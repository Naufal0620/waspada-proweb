@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('breadcrumb', 'Dashboard Overview')

@php($activeMenu = 'dashboard')

<<<<<<< HEAD
@push('styles')
    <style>
        .dashboard-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(23px, 3vw, 29px);
            font-weight: 800;
            letter-spacing: -1px;
            margin: 0 0 8px;
        }

        .dashboard-description {
            color: var(--muted);
            line-height: 1.7;
            margin: 0;
            font-size: 13px;
        }

        .dashboard-date {
            flex-shrink: 0;
            padding: 10px 13px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: #657187;
            font-size: 12px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 23px;
            min-width: 0;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(31, 51, 94, .06);
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 22px;
        }

        .stat-label {
            color: #66738a;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            font-size: 19px;
            font-weight: 700;
        }

        .stat-icon.blue {
            color: #315cf5;
            background: #edf1ff;
        }

        .stat-icon.cyan {
            color: #0787a5;
            background: #e8f8fc;
        }

        .stat-icon.orange {
            color: #c77a12;
            background: #fff4df;
        }

        .stat-icon.red {
            color: #d64b59;
            background: #fff0f1;
        }

        .stat-icon.green {
            color: #16835d;
            background: #e7f8ef;
        }

        .stat-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(27px, 3vw, 34px);
            line-height: 1.2;
            letter-spacing: -1px;
            font-weight: 800;
            margin: 0 0 10px;
            overflow-wrap: anywhere;
        }

        .stat-caption {
            font-size: 12px;
            line-height: 1.6;
            color: var(--muted);
            margin: 0;
        }

        .dashboard-section {
            margin-top: 30px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
        }

        .section-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 7px;
        }

        .section-description {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
            margin: 0;
        }

        .overview-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 22px;
        }

        .overview-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 12px;
            min-width: 0;
        }

        .overview-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            flex-shrink: 0;
            background: var(--primary);
        }

        .overview-dot.orange {
            background: #e7a12b;
        }

        .overview-name {
            font-size: 12px;
            color: #68758a;
            margin-bottom: 5px;
        }

        .overview-number {
            font-size: 19px;
            font-weight: 800;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }


        .activity-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .activity-panel {
            min-width: 0;
            overflow: hidden;
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .activity-panel-header {
            padding: 21px 22px;
            border-bottom: 1px solid var(--border);
        }

        .activity-panel-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 800;
            margin: 0 0 6px;
        }

        .activity-panel-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin: 0;
            line-height: 1.6;
        }

        .activity-list {
            padding: 0 22px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 17px 0;
            border-bottom: 1px solid #f0f2f7;
        }

        .activity-item:last-child {
            border-bottom: 0;
        }

        .activity-marker {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: var(--primary);
            background: var(--primary-light);
            font-weight: 800;
        }

        .activity-details {
            min-width: 0;
            flex: 1;
        }

        .activity-name {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.6;
            overflow-wrap: anywhere;
            margin: 0 0 5px;
        }

        .activity-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .activity-status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
            background: #edf1ff;
            color: #315cf5;
        }

        .status-pending {
            background: #fff4df;
            color: #a76808;
        }

        .status-published,
        .status-actioned {
            background: #e7f8ef;
            color: #16835d;
        }

        .status-rejected,
        .status-hidden {
            background: #fff0f1;
            color: #c83e4d;
        }

        .status-reviewed {
            background: #e8f8fc;
            color: #087e99;
        }

        .status-dismissed {
            background: #f0f2f6;
            color: #68758a;
        }

        .activity-empty {
            text-align: center;
            padding: 30px 16px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .activity-panel-footer {
            border-top: 1px solid var(--border);
            padding: 14px 22px;
            color: var(--muted);
            font-size: 11px;
        }

        .activity-link {
            display: block;
            color: var(--text);
            text-decoration: none;
            transition: color .2s ease;
        }

        .activity-link:hover {
            color: var(--primary);
        }


        @media (max-width: 900px) {
            .activity-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1050px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .dashboard-heading {
                flex-direction: column;
                margin-bottom: 22px;
            }

            .dashboard-date {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 13px;
            }

            .stat-card {
                padding: 19px;
            }

            .stat-card-top {
                margin-bottom: 15px;
            }

            .overview-list {
                grid-template-columns: 1fr;
            }

            .dashboard-section {
                padding: 19px;
                margin-top: 22px;
            }
        }
    </style>
@endpush

=======
>>>>>>> f4e819a (edit desain dikit ajah)
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

        <div class="self-start sm:self-auto px-3.5 py-1.5 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-white dark:bg-[#12221b] text-xs font-mono text-slate-600 dark:text-[#a0c5b5] shadow-sm">
            ◷ &nbsp;{{ now()->translatedFormat('l, d F Y') }}
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
            
            <a href="{{ route('moderator.reports.index') }}" 
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
<<<<<<< HEAD
    </section>


    <section class="activity-grid">

        {{-- Diskusi Terbaru --}}
        <div class="activity-panel">
            <div class="activity-panel-header">
                <h2 class="activity-panel-title">Diskusi Terbaru</h2>
                <p class="activity-panel-subtitle">
                    Lima diskusi terakhir yang masuk ke platform.
                </p>
            </div>

            <div class="activity-list">
                @forelse ($latestDiscussions as $discussion)
                    <article class="activity-item">
                        <div class="activity-marker" aria-hidden="true">D</div>

                        <div class="activity-details">

                            @if ($discussion->status === 'published')
                                <a href="{{ route('forum.show', $discussion->slug) }}" class="activity-name activity-link">
                                    {{ $discussion->title }}
                                </a>
                            @else
                                <h3 class="activity-name">
                                    {{ $discussion->title }}
                                </h3>
                            @endif


                            <div class="activity-meta">
                                <span class="activity-status status-{{ $discussion->status }}">
                                    {{ ucfirst($discussion->status) }}
                                </span>

                                <span>
                                    {{ $discussion->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="activity-empty">
                        Belum ada diskusi yang tercatat.
                    </div>
                @endforelse
            </div>

            <div class="activity-panel-footer">
                Menampilkan maksimal 5 diskusi terbaru
            </div>
        </div>

        {{-- Laporan Terbaru --}}
        <div class="activity-panel">
            <div class="activity-panel-header">
                <h2 class="activity-panel-title">Laporan Terbaru</h2>
                <p class="activity-panel-subtitle">
                    Laporan yang baru dikirim oleh pengguna.
                </p>
            </div>

            <div class="activity-list">
                @forelse ($latestReports as $report)
                    <article class="activity-item">
                        <div class="activity-marker" aria-hidden="true">!</div>

                        <div class="activity-details">

                            <a href="{{ route('moderator.reports.show', $report->id) }}"
                                class="activity-name activity-link">
                                {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                            </a>


                            <div class="activity-meta">
                                <span class="activity-status status-{{ $report->status }}">
                                    {{ ucfirst($report->status) }}
                                </span>

                                <span>
                                    {{ $report->reason }}
                                </span>
                            </div>

                            <div class="activity-meta" style="margin-top: 5px;">
                                {{ $report->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="activity-empty">
                        Belum ada laporan diskusi.
                    </div>
                @endforelse
            </div>

            <div class="activity-panel-footer">
                Menampilkan maksimal 5 laporan terbaru
            </div>
        </div>

    </section>

=======
    </x-card>

</div>
>>>>>>> f4e819a (edit desain dikit ajah)
@endsection
