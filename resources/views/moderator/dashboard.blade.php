@extends('layouts.moderator')

@section('title', 'Dashboard Moderator')
@section('breadcrumb', 'Dashboard')

@php($activeMenu = 'dashboard')

@section('content')

    <section class="page-heading">
        <div>
            <h1>Dashboard Moderator</h1>
            <p>
                Pantau laporan, tinjau diskusi, dan jaga kualitas
                komunitas WASPADA.
            </p>
        </div>

        <div class="date-label">
            ◷ &nbsp; {{ now()->translatedFormat('d F Y') }}
        </div>
    </section>

    {{-- STATISTIK --}}

    <section class="stats-grid">

        <article class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Diskusi Menunggu Moderasi</div>
                <div class="stat-icon icon-orange">◷</div>
            </div>

            <div class="stat-value">{{ $pendingDiscussions }}</div>

            <div class="stat-description">
                Diskusi baru yang belum ditinjau
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Laporan Pending</div>
                <div class="stat-icon icon-blue">⚑</div>
            </div>

            <div class="stat-value">{{ $pendingReports }}</div>

            <div class="stat-description">
                Laporan pengguna yang membutuhkan pemeriksaan
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-top">
                <div class="stat-label">Diskusi Terpublikasi</div>
                <div class="stat-icon icon-green">✓</div>
            </div>

            <div class="stat-value">{{ $publishedDiscussions }}</div>

            <div class="stat-description">
                Diskusi yang tersedia untuk publik
            </div>
        </article>

    </section>

    {{-- LAPORAN TERBARU --}}

    <section class="panel">
        <div class="panel-header">
            <div>
                <h2>Laporan Terbaru</h2>
                <p>
                    Laporan yang masih menunggu pemeriksaan moderator
                </p>
            </div>

            <a href="{{ route('moderator.reports.index') }}" class="text-link">
                Lihat semua →
            </a>
        </div>

        @if ($latestReports->isNotEmpty())
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Diskusi</th>
                            <th>Pelapor</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($latestReports as $report)
                            <tr>
                                <td>
                                    <div class="discussion-title">
                                        {{ $report->discussion->title }}
                                    </div>
                                    <div class="sub-text">
                                        Dilaporkan
                                        {{ $report->created_at->format('d M Y') }}
                                    </div>
                                </td>

                                <td>{{ $report->reporter->name }}</td>

                                <td>{{ $report->reason }}</td>

                                <td>
                                    <span class="status status-pending">
                                        Menunggu
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('moderator.reports.show', $report->id) }}" class="text-link">
                                        Tinjau →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">✓</div>
                <h3>Belum ada laporan yang menunggu pemeriksaan</h3>
                <p>
                    Semua tenang untuk saat ini. Laporan dari pengguna
                    akan muncul di sini ketika tersedia.
                </p>
            </div>
        @endif
    </section>

    {{-- INFORMASI MODERASI --}}

    <section class="notice">
        <div class="notice-icon">ⓘ</div>
        <div>
            <h3>Prinsip moderasi WASPADA</h3>
            <p>
                Periksa konteks dan informasi pendukung sebelum
                mengambil tindakan. Bedakan pengalaman pribadi,
                dugaan, dan informasi yang telah terverifikasi.
                Hindari menyimpulkan bahwa seseorang melakukan
                penipuan hanya berdasarkan satu laporan.
            </p>
        </div>
    </section>

@endsection
