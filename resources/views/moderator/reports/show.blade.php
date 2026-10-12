@extends('layouts.moderator')

@section('title', 'Detail Laporan #' . $report->id)
@section('breadcrumb', 'Detail Laporan')

@php($activeMenu = 'reports')

@section('content')
<div class="space-y-6 max-w-4xl">

    {{-- Back Link --}}
    <div>
        <a href="{{ route('moderator.reports.index') }}" 
           class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-[#15803d] dark:text-[#c9f28a] hover:underline">
            ← Kembali ke daftar laporan
        </a>
    </div>

    {{-- Header --}}
    <div>
        <div class="flex items-center gap-3">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Detail Laporan #{{ $report->id }}
            </h1>
            <x-badge :variant="$report->status === 'pending' ? 'pending' : ($report->status === 'actioned' ? 'published' : ($report->status === 'reviewed' ? 'default' : 'dismissed'))">
                {{ match($report->status) {
                    'pending' => 'Menunggu',
                    'reviewed' => 'Ditinjau',
                    'dismissed' => 'Ditolak',
                    'actioned' => 'Ditindaklanjuti',
                    default => ucfirst($report->status),
                } }}
            </x-badge>
        </div>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
            Periksa informasi laporan sebelum menentukan keputusan dan tindakan moderator.
        </p>
    </div>

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    @if (isset($errors) && $errors->any())
        <x-alert type="error">
            <span class="font-bold">Gagal memproses laporan:</span>
            <ul class="list-disc list-inside mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    {{-- Main Information Card --}}
    <x-card>
        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-slate-100 dark:border-[#1c3629]">
            <div class="h-9 w-9 rounded-xl bg-teal-500/10 border border-teal-500/20 text-teal-600 dark:text-teal-400 font-bold flex items-center justify-center">
                i
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Informasi Laporan</h2>
                <p class="text-xs text-slate-500 dark:text-[#7e9f90]">Data diskusi, pelapor, dan rincian aduan.</p>
            </div>
        </div>

        <div class="space-y-5 text-xs">
            <div>
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                    Diskusi yang Dilaporkan
                </span>
                <h3 class="text-base font-bold text-slate-900 dark:text-white">
                    {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                </h3>
            </div>

            <div>
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                    Isi Diskusi
                </span>
                <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1f3a2c] bg-slate-50 dark:bg-[#0c1813] text-slate-800 dark:text-[#cfdfd7] leading-relaxed whitespace-pre-line text-xs">
                    {{ $report->discussion?->body ?? 'Isi diskusi tidak tersedia.' }}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                        Pelapor
                    </span>
                    <p class="font-bold text-slate-800 dark:text-white">
                        {{ $report->reporter?->name ?? 'Pengguna tidak tersedia' }}
                    </p>
                </div>

                <div>
                    <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                        Waktu Laporan
                    </span>
                    <p class="font-mono text-slate-700 dark:text-[#a0c5b5]">
                        {{ $report->created_at?->format('d M Y, H:i') ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="pt-2">
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                    Alasan Laporan
                </span>
                <p class="p-3 rounded-lg bg-rose-500/10 border border-rose-500/20 text-rose-700 dark:text-rose-300 font-medium">
                    {{ $report->reason }}
                </p>
            </div>

            <div>
                <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                    Keterangan Tambahan
                </span>
                <p class="text-slate-600 dark:text-[#8ba79b]">
                    {{ $report->details ?: 'Tidak ada keterangan tambahan.' }}
                </p>
            </div>

            @if ($report->reviewer || $report->reviewed_at)
                <div class="pt-4 border-t border-slate-100 dark:border-[#1c3629] grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if ($report->reviewer)
                        <div>
                            <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                                Ditinjau Oleh
                            </span>
                            <p class="font-bold text-slate-800 dark:text-white">
                                {{ $report->reviewer->name }}
                            </p>
                        </div>
                    @endif

                    @if ($report->reviewed_at)
                        <div>
                            <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 dark:text-[#6a8c7e] block mb-1">
                                Waktu Peninjauan
                            </span>
                            <p class="font-mono text-slate-700 dark:text-[#a0c5b5]">
                                {{ $report->reviewed_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </x-card>

    {{-- Moderator Actions Card --}}
    <x-card>
        <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100 dark:border-[#1c3629]">
            <div class="h-9 w-9 rounded-xl bg-[#c9f28a]/20 border border-[#c9f28a]/30 text-[#0b1411] dark:text-[#c9f28a] font-bold flex items-center justify-center">
                ✓
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Tindakan Moderator</h2>
                <p class="text-xs text-slate-500 dark:text-[#7e9f90]">Tentukan status penanganan terhadap laporan ini.</p>
            </div>
        </div>

        <div class="mb-5 p-3 rounded-xl border border-sky-500/20 bg-sky-500/10 text-sky-800 dark:text-sky-300 text-xs flex items-start gap-2.5">
            <span class="font-bold">!</span>
            <span>
                Laporan bukan bukti otomatis bahwa diskusi melanggar aturan. Periksa isi diskusi dan keterangannya sebelum mengambil tindakan final.
            </span>
        </div>

        @if (in_array($report->status, ['pending', 'reviewed']))
            <div class="flex flex-wrap items-center gap-3">
                @if ($report->status === 'pending')
                    <form action="{{ route('moderator.reports.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="reviewed">
                        <x-button variant="dark" type="submit">
                            ✓ Tandai Ditinjau
                        </x-button>
                    </form>
                @endif

                <form action="{{ route('moderator.reports.update', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak laporan ini?');">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="dismissed">
                    <x-button variant="outline" type="submit">
                        Tolak Laporan
                    </x-button>
                </form>

                <form action="{{ route('moderator.reports.update', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menyembunyikan diskusi ini dan menandai laporan sebagai ditindaklanjuti?');">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="actioned">
                    <x-button variant="lime" type="submit">
                        Tindak Lanjuti & Sembunyikan Diskusi →
                    </x-button>
                </form>
            </div>
        @else
            <div class="p-4 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-slate-50 dark:bg-[#0c1813] text-xs text-slate-600 dark:text-[#a0c5b5]">
                Laporan ini sudah selesai diproses dengan status <strong class="text-slate-900 dark:text-white uppercase">{{ $report->status }}</strong>.
            </div>
        @endif
    </x-card>

</div>
@endsection
