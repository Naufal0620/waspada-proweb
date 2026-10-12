
@extends('layouts.admin')

@section('title', 'Laporan Diskusi')
@section('breadcrumb', 'Laporan Diskusi')

@php($activeMenu = 'reports')

@push('styles')
<style>
    .reports-page {
        color: #182230;
    }

    .reports-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 26px;
    }

    .reports-title {
        margin: 0 0 7px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 25px;
        font-weight: 800;
        letter-spacing: -.6px;
    }

    .reports-description {
        margin: 0;
        color: #778399;
        line-height: 1.7;
    }

    .reports-count {
        flex-shrink: 0;
        padding: 9px 13px;
        background: #edf1ff;
        color: #315cf5;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
    }

    .reports-card {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(25, 42, 80, .035);
        overflow: hidden;
    }

    .reports-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 22px;
        border-bottom: 1px solid #e9edf4;
    }

    .reports-toolbar h2 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .reports-filter {
        display: flex;
        gap: 9px;
    }

    .reports-filter select {
        min-height: 39px;
        padding: 8px 32px 8px 11px;
        border: 1px solid #dce2ed;
        border-radius: 8px;
        background: #fff;
        color: #344054;
        font: inherit;
        font-size: 12px;
    }

    .reports-filter button {
        padding: 9px 13px;
        border: 0;
        border-radius: 8px;
        background: #315cf5;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .reports-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .reports-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .reports-table th {
        padding: 14px 20px;
        background: #f9faff;
        color: #778399;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .reports-table td {
        padding: 17px 20px;
        border-top: 1px solid #edf0f5;
        color: #475569;
        font-size: 12px;
        vertical-align: middle;
    }

    .reports-table tbody tr:hover {
        background: #fbfcff;
    }

    .report-discussion {
        display: block;
        min-width: 170px;
        max-width: 300px;
        color: #182230;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .report-discussion:hover {
        color: #315cf5;
    }

    .report-subtext {
        display: block;
        margin-top: 5px;
        color: #98a2b3;
        font-size: 11px;
    }

    .report-reason {
        max-width: 180px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .report-status {
        display: inline-flex;
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .report-status.pending {
        background: #fff4df;
        color: #9b6812;
    }

    .report-status.reviewed {
        background: #e8efff;
        color: #3157bc;
    }

    .report-status.dismissed {
        background: #f0f2f6;
        color: #657184;
    }

    .report-status.actioned {
        background: #e4f7ee;
        color: #16845b;
    }

    .report-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 11px;
        border: 1px solid #dce4ff;
        border-radius: 8px;
        background: #f3f5ff;
        color: #315cf5;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .report-action:hover {
        background: #e7ecff;
    }

    .reports-empty {
        padding: 45px 20px !important;
        text-align: center;
        color: #778399 !important;
        line-height: 1.8;
    }

    .reports-pagination {
        padding: 18px 22px;
        border-top: 1px solid #e9edf4;
    }

    .reports-pagination nav p {
        color: #778399;
        font-size: 12px;
    }

    .reports-pagination nav a,
    .reports-pagination nav span {
        font-size: 12px;
    }

    .reports-alert {
        margin-bottom: 18px;
        padding: 13px 16px;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        background: #ecfdf3;
        color: #166534;
    }

    @media (max-width: 650px) {
        .reports-heading,
        .reports-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .reports-title {
            font-size: 22px;
        }

        .reports-filter {
            width: 100%;
        }

        .reports-filter select {
            flex: 1;
            min-width: 0;
        }

        .reports-count {
            align-self: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="reports-page">

    <div class="reports-heading">
        <div>
            <h1 class="reports-title">Laporan Diskusi</h1>
            <p class="reports-description">
                Tinjau laporan pengguna dan pantau tindak lanjut diskusi
                dari panel administrasi.
            </p>
        </div>

        <div class="reports-count">
            {{ $reports->total() }} laporan
        </div>
    </div>

    @if (session('success'))
        <div class="reports-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    <section class="reports-card">
        <div class="reports-toolbar">
            <h2>Semua Laporan</h2>

            <form
                action="{{ route('admin.reports.index') }}"
                method="GET"
                class="reports-filter"
            >
                <select name="status" aria-label="Filter status laporan">
                    <option value="">Semua status</option>
                    <option value="pending"
                        @selected(request('status') === 'pending')>
                        Menunggu
                    </option>
                    <option value="reviewed"
                        @selected(request('status') === 'reviewed')>
                        Ditinjau
                    </option>
                    <option value="dismissed"
                        @selected(request('status') === 'dismissed')>
                        Ditolak
                    </option>
                    <option value="actioned"
                        @selected(request('status') === 'actioned')>
                        Ditindaklanjuti
                    </option>
                </select>

                <button type="submit">Filter</button>
            </form>
        </div>

        <div class="reports-table-wrap">
            <table class="reports-table">
                <thead>
                    <tr>
                        <th>Laporan</th>
                        <th>Pelapor</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('admin.reports.show', $report->id) }}"
                                    class="report-discussion"
                                >
                                    {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                                </a>

                                <span class="report-subtext">
                                    Laporan #{{ $report->id }}
                                </span>
                            </td>

                            <td>
                                {{ $report->reporter?->name ?? 'Pengguna tidak tersedia' }}
                            </td>

                            <td>
                                <div class="report-reason">
                                    {{ $report->reason }}
                                </div>
                            </td>

                            <td>
                                <span class="report-status {{ $report->status }}">
                                    @switch($report->status)
                                        @case('pending')
                                            Menunggu
                                            @break
                                        @case('reviewed')
                                            Ditinjau
                                            @break
                                        @case('dismissed')
                                            Ditolak
                                            @break
                                        @case('actioned')
                                            Ditindaklanjuti
                                            @break
                                        @default
                                            {{ ucfirst($report->status) }}
                                    @endswitch
                                </span>
                            </td>

                            <td>
                                {{ $report->created_at?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.reports.show', $report->id) }}"
                                    class="report-action"
                                >
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="reports-empty">
                                Belum ada laporan yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($reports->hasPages())
            <div class="reports-pagination">
                {{ $reports->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
