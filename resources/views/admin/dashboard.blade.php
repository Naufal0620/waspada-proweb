@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('breadcrumb', 'Dashboard Admin')

@php($activeMenu = 'dashboard')

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

@section('content')
    <section class="dashboard-heading">
        <div>
            <h1 class="dashboard-title">Dashboard Overview</h1>
            <p class="dashboard-description">
                Pantau aktivitas dan kelola platform WASPADA dari satu tempat.
            </p>
        </div>

        <div class="dashboard-date">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </section>

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Pengguna</span>
                <div class="stat-icon blue" aria-hidden="true">♙</div>
            </div>
            <h2 class="stat-value">{{ number_format($totalUsers) }}</h2>
            <p class="stat-caption">Seluruh akun yang terdaftar</p>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Diskusi</span>
                <div class="stat-icon cyan" aria-hidden="true">☷</div>
            </div>
            <h2 class="stat-value">{{ number_format($totalDiscussions) }}</h2>
            <p class="stat-caption">Diskusi dari seluruh status</p>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Diskusi Menunggu</span>
                <div class="stat-icon orange" aria-hidden="true">◷</div>
            </div>
            <h2 class="stat-value">{{ number_format($pendingDiscussions) }}</h2>
            <p class="stat-caption">Diskusi berstatus pending</p>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Total Laporan</span>
                <div class="stat-icon red" aria-hidden="true">⚑</div>
            </div>
            <h2 class="stat-value">{{ number_format($totalReports) }}</h2>
            <p class="stat-caption">Seluruh laporan diskusi</p>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Laporan Menunggu Review</span>
                <div class="stat-icon orange" aria-hidden="true">!</div>
            </div>
            <h2 class="stat-value">{{ number_format($pendingReports) }}</h2>
            <p class="stat-caption">Laporan berstatus pending</p>
        </article>

        <article class="stat-card">
            <div class="stat-card-top">
                <span class="stat-label">Pola Penipuan</span>
                <div class="stat-icon green" aria-hidden="true">◇</div>
            </div>
            <h2 class="stat-value">{{ number_format($totalPatterns) }}</h2>
            <p class="stat-caption">Pola yang tersimpan di sistem</p>
        </article>
    </section>

    <section class="dashboard-section">
        <h2 class="section-title">Ringkasan Moderasi</h2>
        <p class="section-description">
            Gambaran singkat pekerjaan yang perlu diperhatikan oleh tim WASPADA.
        </p>

        <div class="overview-list">
            <div class="overview-item">
                <span class="overview-dot orange"></span>
                <div>
                    <div class="overview-name">Diskusi perlu ditinjau</div>
                    <div class="overview-number">
                        {{ number_format($pendingDiscussions) }}
                    </div>
                </div>
            </div>

            <div class="overview-item">
                <span class="overview-dot orange"></span>
                <div>
                    <div class="overview-name">Laporan perlu ditinjau</div>
                    <div class="overview-number">
                        {{ number_format($pendingReports) }}
                    </div>
                </div>
            </div>
        </div>
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

@endsection
