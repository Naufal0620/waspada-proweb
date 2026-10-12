@extends('layouts.admin')

@section('title', 'Detail Laporan')
@section('breadcrumb', 'Detail Laporan')

@php($activeMenu = 'reports')

@push('styles')
<style>
.report-detail {
    color: #182230;
}

.report-detail .back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    color: #315cf5;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.report-detail .back-link:hover {
    color: #2449d8;
}

.report-detail .subtitle {
    margin: 0;
    color: #778399;
    line-height: 1.6;
}

.report-detail .card {
    padding: 24px;
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #e9edf4;
    border-radius: 15px;
    box-shadow: 0 4px 18px rgba(25, 42, 80, .035);
}

.report-detail .section-heading {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 22px;
}

.report-detail .section-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 11px;
    background: #eef2ff;
    color: #315cf5;
    font-size: 18px;
    font-weight: 700;
}

.report-detail .section-title {
    margin: 0 0 5px;
    color: #182230;
    font-size: 17px;
    font-weight: 700;
}

.report-detail .section-description {
    margin: 0;
    color: #778399;
    font-size: 13px;
    line-height: 1.6;
}

.report-detail .info-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
}

.report-detail .info-item {
    min-width: 0;
}

.report-detail .info-item.full-width {
    grid-column: 1 / -1;
}

.report-detail .label {
    display: block;
    margin-bottom: 8px;
    color: #778399;
    font-size: 12px;
    font-weight: 600;
}

.report-detail .value {
    margin: 0;
    color: #344054;
    font-size: 14px;
    line-height: 1.8;
    overflow-wrap: anywhere;
    white-space: pre-line;
}

.report-detail .discussion-title {
    color: #182230;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.6;
}

.report-detail .content-box {
    padding: 16px;
    border: 1px solid #edf0f5;
    border-radius: 10px;
    background: #f8faff;
}

.report-detail .status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.report-detail .status::before {
    content: "";
    width: 6px;
    height: 6px;
    flex-shrink: 0;
    border-radius: 50%;
    background: currentColor;
}

.report-detail .status-pending {
    background: #fff4df;
    color: #9b6812;
}

.report-detail .status-reviewed {
    background: #e8efff;
    color: #3157bc;
}

.report-detail .status-dismissed {
    background: #f0f2f6;
    color: #657184;
}

.report-detail .status-actioned {
    background: #e4f7ee;
    color: #16845b;
}

.report-detail .review-info {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid #edf0f5;
}

.report-detail .alert {
    padding: 14px 16px;
    margin-bottom: 18px;
    border: 1px solid transparent;
    border-radius: 10px;
    font-size: 14px;
    line-height: 1.6;
}

.report-detail .alert ul {
    margin: 8px 0 0;
    padding-left: 20px;
}

.report-detail .success {
    background: #ecfdf3;
    color: #166534;
    border-color: #bbf7d0;
}

.report-detail .error {
    background: #fef2f2;
    color: #991b1b;
    border-color: #fecaca;
}

.report-detail .notice {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 14px 15px;
    margin-bottom: 20px;
    border: 1px solid #dbeafe;
    border-radius: 10px;
    background: #f5f8ff;
    color: #475569;
    font-size: 13px;
    line-height: 1.7;
}

.report-detail .notice-icon {
    flex-shrink: 0;
    color: #315cf5;
    font-weight: 800;
}

.report-detail .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.report-detail .actions form {
    margin: 0;
}

.report-detail .button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 42px;
    padding: 10px 15px;
    border: 1px solid transparent;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s ease, border-color .2s ease;
}

.report-detail .button:hover {
    filter: brightness(.96);
}

.report-detail .blue {
    background: #315cf5;
    color: #fff;
}

.report-detail .gray {
    background: #fff;
    color: #475569;
    border-color: #d8dfeb;
}

.report-detail .green {
    background: #15803d;
    color: #fff;
}

.report-detail .completed {
    padding: 14px 16px;
    border: 1px solid #e5eaf2;
    border-radius: 10px;
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    line-height: 1.7;
}

.report-detail .completed strong {
    color: #182230;
}

@media (max-width: 700px) {
    .report-detail .card {
        padding: 18px;
    }

    .report-detail .info-grid,
    .report-detail .review-info {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .report-detail .info-item.full-width {
        grid-column: auto;
    }

    .report-detail .actions {
        flex-direction: column;
    }

    .report-detail .actions form,
    .report-detail .button {
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="report-detail">

    <a class="back-link" href="{{ route('admin.reports.index') }}">
        ← Kembali ke laporan
    </a>

    <section class="page-heading">
        <div>
            <h1>Detail Laporan #{{ $report->id }}</h1>
            <p class="subtitle">
                Periksa informasi laporan sebelum menentukan tindakan admin.
            </p>
        </div>
    </section>

    @if (session('success'))
        <div class="alert success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert error" role="alert">
            <strong>Gagal memproses laporan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="section-heading">
            <div class="section-icon">i</div>
            <div>
                <h2 class="section-title">Informasi Laporan</h2>
                <p class="section-description">
                    Informasi diskusi, pelapor, dan status peninjauan.
                </p>
            </div>
        </div>

        <div class="info-grid">

            <div class="info-item full-width">
                <span class="label">Diskusi yang dilaporkan</span>
                <h3 class="value discussion-title">
                    {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                </h3>
            </div>

            <div class="info-item full-width">
                <span class="label">Isi diskusi</span>
                <div class="content-box value">{{ $report->discussion?->body ?? 'Isi diskusi tidak tersedia.' }}</div>
            </div>

            <div class="info-item">
                <span class="label">Pelapor</span>
                <p class="value">
                    {{ $report->reporter?->name ?? 'Pengguna tidak tersedia' }}
                </p>
            </div>

            <div class="info-item">
                <span class="label">Status laporan</span>
                <div>
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
                </div>
            </div>

            <div class="info-item full-width">
                <span class="label">Alasan laporan</span>
                <p class="value">{{ $report->reason }}</p>
            </div>

            <div class="info-item full-width">
                <span class="label">Keterangan tambahan</span>
                <p class="value">
                    {{ $report->details ?: 'Tidak ada keterangan tambahan.' }}
                </p>
            </div>

        </div>

        @if ($report->reviewer || $report->reviewed_at)
            <div class="review-info">

                @if ($report->reviewer)
                    <div class="info-item">
                        <span class="label">Ditinjau oleh</span>
                        <p class="value">{{ $report->reviewer->name }}</p>
                    </div>
                @endif

                @if ($report->reviewed_at)
                    <div class="info-item">
                        <span class="label">Waktu peninjauan</span>
                        <p class="value">
                            {{ $report->reviewed_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                @endif

            </div>
        @endif
    </div>

    <div class="card">
        <div class="section-heading">
            <div class="section-icon">✓</div>
            <div>
                <h2 class="section-title">Tindakan Admin</h2>
                <p class="section-description">
                    Tentukan hasil peninjauan berdasarkan informasi yang tersedia.
                </p>
            </div>
        </div>

        <div class="notice">
            <span class="notice-icon">!</span>
            <span>
                Laporan bukan bukti otomatis bahwa diskusi melanggar aturan.
                Periksa isi diskusi dan keterangannya sebelum mengambil tindakan.
            </span>
        </div>

        @if (in_array($report->status, ['pending', 'reviewed']))

            <div class="actions">

                @if ($report->status === 'pending')
                    <form
                        action="{{ route('admin.reports.update', $report->id) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" value="reviewed">

                        <button class="button blue" type="submit">
                            ✓ Tandai Ditinjau
                        </button>
                    </form>
                @endif

                <form
                    action="{{ route('admin.reports.update', $report->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menolak laporan ini?');"
                >
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="dismissed">

                    <button class="button gray" type="submit">
                        Tolak Laporan
                    </button>
                </form>

                <form
                    action="{{ route('admin.reports.update', $report->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menyembunyikan diskusi ini dan menandai laporan sebagai ditindaklanjuti?');"
                >
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="actioned">

                    <button class="button green" type="submit">
                        Tindak Lanjuti →
                    </button>
                </form>

            </div>

        @else

            <div class="completed">
                Laporan ini sudah selesai diproses dengan status
                <strong>
                    @if ($report->status === 'dismissed')
                        Ditolak
                    @elseif ($report->status === 'actioned')
                        Ditindaklanjuti
                    @elseif ($report->status === 'reviewed')
                        Ditinjau
                    @else
                        {{ ucfirst($report->status) }}
                    @endif
                </strong>.
            </div>

        @endif
    </div>

</div>
@endsection