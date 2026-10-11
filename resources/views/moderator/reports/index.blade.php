@extends('layouts.moderator')

@section('title', 'Laporan Diskusi')
@section('breadcrumb', 'Laporan Diskusi')

@php($activeMenu = 'reports')


@push('styles')
<style>
    .reports-page .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .reports-page .subtitle {
        margin: 0;
        color: #778399;
        line-height: 1.6;
    }

    .reports-page .button {
        display: inline-block;
        padding: 11px 16px;
        background: #315cf5;
        color: #fff;
        border-radius: 9px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background .2s ease;
    }

    .reports-page .button:hover {
        background: #2449d8;
        color: #fff;
    }

    /* Card */
    .reports-page .card {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 15px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(25, 42, 80, .035);
    }

    /* Filter */
    .reports-page .filters {
        display: flex;
        gap: 12px;
        align-items: end;
        flex-wrap: wrap;
    }

    .reports-page .field {
        flex: 1;
        min-width: 190px;
    }

    .reports-page label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #182230;
    }

    .reports-page select {
        width: 100%;
        min-height: 42px;
        padding: 10px 12px;
        border: 1px solid #d8dfeb;
        border-radius: 8px;
        background: #fff;
        color: #182230;
        font-size: 14px;
    }

    .reports-page select:focus {
        outline: 2px solid #bfdbfe;
        border-color: #315cf5;
    }

    .reports-page .filter-button {
        min-height: 42px;
        border: 0;
        border-radius: 8px;
        padding: 0 18px;
        font-weight: 600;
        background: #315cf5;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease;
    }

    .reports-page .filter-button:hover {
        background: #2449d8;
    }

    .reports-page .reset-link {
        display: inline-flex;
        align-items: center;
        min-height: 42px;
        padding: 0 8px;
        color: #315cf5;
        text-decoration: none;
    }

    /* Table */
    .reports-page .table-wrap {
        overflow-x: auto;
        border-radius: 10px;
    }

    .reports-page table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
    }

    .reports-page th {
        text-align: left;
        background: #f8faff;
        color: #778399;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .8px;
        padding: 16px;
        white-space: nowrap;
    }

    .reports-page td {
        padding: 18px 16px;
        border-top: 1px solid #f0f2f7;
        vertical-align: top;
        font-size: 14px;
        line-height: 1.5;
    }

    .reports-page tbody tr {
        transition: background .18s ease;
    }

    .reports-page tbody tr:hover {
        background: #f8faff;
    }

    .reports-page .report-title {
        color: #182230;
        font-weight: 600;
    }

    /* Status */
    .reports-page .status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 11px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .reports-page .status::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        flex-shrink: 0;
    }

    .reports-page .status-pending {
        background: #fff4df;
        color: #9b6812;
    }

    .reports-page .status-reviewed {
        background: #e8efff;
        color: #3157bc;
    }

    .reports-page .status-dismissed {
        background: #f0f2f6;
        color: #657184;
    }

    .reports-page .status-actioned {
        background: #e4f7ee;
        color: #16845b;
    }

    /* Detail button */
    .reports-page .detail-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 11px;
        border: 1px solid #dfe6ff;
        border-radius: 8px;
        background: #f5f7ff;
        color: #315cf5;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        text-decoration: none;
        transition: background .2s ease, color .2s ease;
    }

    .reports-page .detail-link:hover {
        background: #315cf5;
        color: #fff;
    }

    /* Date and time */
    .reports-page .report-date {
        color: #344054;
        font-weight: 600;
        white-space: nowrap;
    }

    .reports-page .report-time {
        color: #98a2b3;
        font-size: 11px;
        margin-top: 5px;
        white-space: nowrap;
    }

    /* Empty state */
    .reports-page .empty {
        text-align: center;
        padding: 42px 20px;
        color: #778399;
    }

    .reports-page .empty strong {
        display: block;
        color: #182230;
        margin-bottom: 8px;
        font-size: 16px;
    }

    /* Pagination */
    .reports-page .pagination {
        padding: 20px 0 0;
        overflow-x: auto;
    }

    /* Success alert */
    .reports-page .alert {
        padding: 14px 16px;
        border: 1px solid #cceedd;
        border-radius: 11px;
        margin-bottom: 18px;
        background: #ecfdf3;
        color: #166534;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .reports-page .card {
            padding: 16px;
        }

        .reports-page .field {
            min-width: 100%;
        }

        .reports-page .filter-button {
            width: 100%;
        }

        .reports-page .page-heading {
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
    <div class="reports-page">

        <section class="page-heading">
            <div>
                <h1>Daftar Laporan</h1>
                <p class="subtitle">
                    Kelola laporan pengguna dan pantau hasil peninjauan diskusi.
                </p>
            </div>

            <a class="button" href="{{ route('forum.index') }}">
                Lihat Forum
            </a>
        </section>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <form action="{{ route('moderator.reports.index') }}" method="GET" class="filters">

                <div class="field">
                    <label for="status">Filter status laporan</label>

                    <select name="status" id="status">
                        <option value="">Semua status</option>

                        <option value="pending" @selected(request('status') === 'pending')>
                            Pending
                        </option>

                        <option value="reviewed" @selected(request('status') === 'reviewed')>
                            Reviewed
                        </option>

                        <option value="dismissed" @selected(request('status') === 'dismissed')>
                            Dismissed
                        </option>

                        <option value="actioned" @selected(request('status') === 'actioned')>
                            Actioned
                        </option>
                    </select>
                </div>

                <button type="submit" class="filter-button">
                    Terapkan Filter
                </button>

                @if (request()->filled('status'))
                    <a class="reset-link" href="{{ route('moderator.reports.index') }}">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Diskusi</th>
                            <th>Pelapor</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Waktu laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>
                        @if ($reports->count() > 0)
                            @foreach ($reports as $report)
                                <tr>
                                    <td>#{{ $report->id }}</td>

                                    <td>
                                        <span class="report-title">
                                            {{ $report->discussion->title ?? 'Diskusi tidak tersedia' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $report->reporter->name ?? 'Pengguna tidak tersedia' }}
                                    </td>

                                    <td>{{ $report->reason }}</td>

                                    <td>
                                        <span class="status status-{{ $report->status }}">
                                            @if ($report->status === 'pending')
                                                Menunggu
                                            @elseif ($report->status === 'reviewed')
                                                Ditinjau
                                            @elseif ($report->status === 'dismissed')
                                                Ditolak
                                            @elseif ($report->status === 'actioned')
                                                Ditindaklanjuti
                                            @else
                                                {{ ucfirst($report->status) }}
                                            @endif
                                        </span>
                                    </td>

                                    <td>
                                        <div class="report-date">
                                            {{ $report->created_at->format('d M Y') }}
                                        </div>
                                        <div class="report-time">
                                            {{ $report->created_at->format('H:i') }} WIB
                                        </div>
                                    </td>

                                    <td>
                                        <a class="detail-link" href="{{ route('moderator.reports.show', $report->id) }}">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <div class="empty">
                                        <strong>Belum ada laporan</strong>
                                        Tidak ada laporan yang cocok dengan filter ini.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>

            <div class="pagination">
                {{ $reports->links() }}
            </div>
        </div>

    </div>
@endsection
