@extends('layouts.admin')

@section('title', 'Moderasi Postingan')
@section('breadcrumb', 'Moderasi Postingan')

@php($activeMenu = 'discussions')

@push('styles')
<style>
.moderation-page { color: #182230; }
.moderation-page .subtitle { color: #778399; font-size: 14px; }
.moderation-page .panel {
    background: #fff;
    border: 1px solid #e9edf4;
    border-radius: 15px;
    overflow: hidden;
}
.moderation-page .toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    border-bottom: 1px solid #e9edf4;
}
.moderation-page .toolbar h2 { margin: 0; font-size: 16px; }
.moderation-page .table-wrap { overflow-x: auto; }
.moderation-page table { width: 100%; border-collapse: collapse; }
.moderation-page th, .moderation-page td {
    padding: 15px 20px;
    border-bottom: 1px solid #edf0f5;
    text-align: left;
    font-size: 13px;
    vertical-align: middle;
}
.moderation-page th {
    color: #778399;
    background: #f8faff;
    font-weight: 600;
}
.moderation-page td { color: #475569; }
.moderation-page .post-title {
    color: #182230;
    font-weight: 600;
    text-decoration: none;
}
.moderation-page .post-title:hover { color: #315cf5; }
.moderation-page .category {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 7px;
    background: #edf1ff;
    color: #315cf5;
    font-size: 11px;
}
.moderation-page .pending {
    display: inline-block;
    padding: 5px 9px;
    border-radius: 7px;
    background: #fff4df;
    color: #9b6812;
    font-size: 11px;
    font-weight: 700;
}
.moderation-page .detail-link {
    color: #315cf5;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
}
.moderation-page .empty {
    padding: 48px 20px;
    text-align: center;
    color: #778399;
}
.moderation-page .alert {
    padding: 13px 16px;
    margin-bottom: 16px;
    border-radius: 10px;
    font-size: 13px;
}
.moderation-page .success {
    color: #166534;
    background: #ecfdf3;
    border: 1px solid #bbf7d0;
}
.moderation-page .error {
    color: #991b1b;
    background: #fef2f2;
    border: 1px solid #fecaca;
}
.moderation-page .pagination {
    padding: 18px 22px;
}
@media (max-width: 600px) {
    .moderation-page .toolbar { padding: 16px; }
    .moderation-page th, .moderation-page td { padding: 12px; }
}
</style>
@endpush

@section('content')
<div class="moderation-page">

    <section class="page-heading">
        <div>
            <h1>Moderasi Postingan</h1>
            <p class="subtitle">
                Periksa postingan pengguna sebelum dipublikasikan.
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
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel">
        <div class="toolbar">
            <h2>Menunggu Persetujuan</h2>
            <span class="pending">{{ $discussions->total() }} postingan</span>
        </div>

        @if ($discussions->isEmpty())
            <div class="empty">
                <h3>Tidak ada postingan pending</h3>
                <p>Semua postingan yang masuk sudah tidak menunggu persetujuan.</p>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Postingan</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discussions as $discussion)
                            <tr>
                                <td>
                                    <a class="post-title"
                                       href="{{ route('admin.discussions.show', $discussion->id) }}">
                                        {{ $discussion->title }}
                                    </a>
                                </td>
                                <td>{{ $discussion->user?->name ?? 'Pengguna tidak tersedia' }}</td>
                                <td>
                                    <span class="category">
                                        {{ $discussion->category?->name ?? 'Tanpa kategori' }}
                                    </span>
                                </td>
                                <td>{{ $discussion->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <a class="detail-link"
                                       href="{{ route('admin.discussions.show', $discussion->id) }}">
                                        Periksa →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $discussions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection