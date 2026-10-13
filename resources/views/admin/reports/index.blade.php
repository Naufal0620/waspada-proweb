@extends('layouts.admin')

@section('title', 'Laporan Diskusi')
@section('breadcrumb', 'Laporan Diskusi')

@php
    $activeMenu = 'reports';
@endphp

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Laporan Diskusi
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
                Tinjau laporan pengguna dan kelola tindak lanjut konten forum dari panel admin.
            </p>
        </div>

        <div class="self-start sm:self-auto px-3.5 py-1.5 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-white dark:bg-[#12221b] text-xs font-mono text-slate-600 dark:text-[#a0c5b5] shadow-sm">
            Total Laporan: <span class="font-bold text-[#15803d] dark:text-[#c9f28a]">{{ $reports->total() }}</span>
        </div>
    </div>

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif

    {{-- Table Card --}}
    <x-card class="!p-0 overflow-hidden">
        {{-- Toolbar --}}
        <div class="p-4 sm:p-5 border-b border-slate-200 dark:border-[#1e382d] flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50 dark:bg-[#0c1813]/60">
            <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">
                Daftar Laporan Masuk
            </h2>

            <form action="{{ route('admin.reports.index') }}" method="GET" class="flex items-center gap-2">
                <select name="status" 
                        aria-label="Filter status laporan"
                        class="text-xs rounded-xl border border-slate-200 dark:border-[#224032] bg-white dark:bg-[#102018] text-slate-800 dark:text-white px-3 py-2 focus:outline-none focus:border-[#c9f28a]">
                    <option value="">Semua Status</option>
                    <option value="pending" @selected(request('status') === 'pending')>Menunggu</option>
                    <option value="reviewed" @selected(request('status') === 'reviewed')>Ditinjau</option>
                    <option value="dismissed" @selected(request('status') === 'dismissed')>Ditolak</option>
                    <option value="actioned" @selected(request('status') === 'actioned')>Ditindaklanjuti</option>
                </select>

                <x-button variant="lime" type="submit" class="!py-2 !px-3 !text-xs">
                    Filter
                </x-button>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-[#1a3328] bg-slate-50 dark:bg-[#0e1d17] text-slate-500 dark:text-[#789a8b] font-mono text-[11px] uppercase tracking-wider">
                        <th class="py-3 px-4 sm:px-6">Laporan & Diskusi</th>
                        <th class="py-3 px-4">Pelapor</th>
                        <th class="py-3 px-4">Alasan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-[#172c21]">
                    @forelse ($reports as $report)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-[#12221b]/60 transition">
                            <td class="py-3.5 px-4 sm:px-6 max-w-xs">
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="font-bold text-slate-900 dark:text-white hover:text-[#15803d] dark:hover:text-[#c9f28a] transition line-clamp-1">
                                    {{ $report->discussion?->title ?? 'Diskusi tidak tersedia' }}
                                </a>
                                <span class="text-[10px] font-mono text-slate-400 dark:text-[#5d7c6f]">
                                    Laporan #{{ $report->id }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300">
                                {{ $report->reporter?->name ?? 'Pengguna tidak tersedia' }}
                            </td>

                            <td class="py-3.5 px-4 max-w-xs text-slate-600 dark:text-[#8ba79b]">
                                <span class="line-clamp-1">{{ $report->reason }}</span>
                            </td>

                            <td class="py-3.5 px-4">
                                <x-badge :variant="$report->status === 'pending' ? 'pending' : ($report->status === 'actioned' ? 'published' : ($report->status === 'reviewed' ? 'default' : 'dismissed'))">
                                    {{ match($report->status) {
                                        'pending' => 'Menunggu',
                                        'reviewed' => 'Ditinjau',
                                        'dismissed' => 'Ditolak',
                                        'actioned' => 'Ditindaklanjuti',
                                        default => ucfirst($report->status),
                                    } }}
                                </x-badge>
                            </td>

                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-500 dark:text-[#6a8c7e] whitespace-nowrap">
                                {{ $report->created_at?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td class="py-3.5 px-4 sm:px-6 text-right whitespace-nowrap">
                                <a href="{{ route('admin.reports.show', $report->id) }}" 
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-[#234234] bg-white dark:bg-[#12241c] text-slate-700 dark:text-[#a0c5b5] hover:border-[#c9f28a] hover:text-[#15803d] dark:hover:text-[#c9f28a] text-[11px] font-bold transition">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 dark:text-[#6a8c7e]">
                                Belum ada laporan yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($reports->hasPages())
            <div class="p-4 border-t border-slate-200 dark:border-[#1a3328]">
                {{ $reports->links() }}
            </div>
        @endif
    </x-card>

</div>
@endsection
