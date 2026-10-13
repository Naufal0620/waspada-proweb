@extends('layouts.admin')

@section('title', 'Periksa Postingan')
@section('breadcrumb', 'Periksa Postingan')

@php
    $activeMenu = 'discussions';
@endphp

@push('styles')
<style>
.discussion-review { color: #182230; }
.discussion-review .back {
    display: inline-block;
    margin-bottom: 20px;
    color: #315cf5;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}
.discussion-review .panel {
    padding: 24px;
    margin-bottom: 20px;
    background: #fff;
    border: 1px solid #e9edf4;
    border-radius: 15px;
}
.discussion-review .muted { color: #778399; font-size: 13px; }
.discussion-review .post-body {
    margin-top: 22px;
    color: #344054;
    font-size: 14px;
    line-height: 1.9;
    white-space: pre-line;
    overflow-wrap: anywhere;
}
.discussion-review .status {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 7px;
    background: #fff4df;
    color: #9b6812;
    font-size: 12px;
    font-weight: 700;
}
.discussion-review .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.discussion-review .actions form { margin: 0; }
.discussion-review button {
    padding: 11px 16px;
    border: 0;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}
.discussion-review .approve { background: #15803d; color: #fff; }
.discussion-review .reject {
    background: #fff;
    color: #b42318;
    border: 1px solid #fecaca;
}
.discussion-review .alert {
    padding: 13px 16px;
    margin-bottom: 16px;
    border-radius: 10px;
    font-size: 13px;
}
.discussion-review .error {
    color: #991b1b;
    background: #fef2f2;
    border: 1px solid #fecaca;
}
@media (max-width: 600px) {
    .discussion-review .panel { padding: 18px; }
    .discussion-review .actions { flex-direction: column; }
    .discussion-review .actions form,
    .discussion-review button { width: 100%; }
}
</style>
@endpush

@section('content')
<div class="discussion-review">

    <a class="back" href="{{ route('admin.discussions.index') }}">
        ← Kembali ke daftar postingan
    </a>

    <section class="page-heading">
        <div>
            <h1>Periksa Postingan</h1>
            <p class="muted">Periksa isi postingan sebelum mengambil keputusan.</p>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert error" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel">
        <span class="status">{{ ucfirst($discussion->status) }}</span>

        <h2>{{ $discussion->title }}</h2>

        <p class="muted">
            Penulis: {{ $discussion->user?->name ?? 'Pengguna tidak tersedia' }}
            · Kategori: {{ $discussion->category?->name ?? 'Tanpa kategori' }}
            · {{ $discussion->created_at->format('d M Y, H:i') }}
        </p>

        <div class="post-body">{{ $discussion->body }}</div>
    </div>

    @if ($discussion->status === 'pending')
        <div class="panel">
            <h2>Keputusan Moderasi</h2>
            <p class="muted">
                Setujui jika postingan layak dipublikasikan.
                Jika ditolak, postingan tetap tersimpan tetapi tidak muncul di forum publik.
            </p>

            <div class="actions">
                <form
                    action="{{ route('admin.discussions.approve', $discussion->id) }}"
                    method="POST"
                    onsubmit="return confirm('Setujui dan publikasikan postingan ini?')"
                >
                    @csrf
                    @method('PATCH')
                    <button class="approve" type="submit">
                        ✓ Setujui dan Publikasikan
                    </button>
                </form>

                <form
                    action="{{ route('admin.discussions.reject', $discussion->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menolak postingan ini?')"
                >
                    @csrf
                    @method('PATCH')
                    <button class="reject" type="submit">
                        Tolak Postingan
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="panel">
            <h3>Postingan sudah diproses</h3>
            <p class="muted">
                Status saat ini: {{ $discussion->status }}.
                Aksi persetujuan hanya tersedia untuk postingan pending.
            </p>
        </div>
    @endif

</div>
@endsection