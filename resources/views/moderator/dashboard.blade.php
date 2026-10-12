@extends('layouts.moderator')

@section('title', 'Dashboard Moderator')
@section('breadcrumb', 'Dashboard')

@php($activeMenu = 'dashboard')

@section('content')
<div class="space-y-8">

    {{-- Top Heading --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Dashboard Moderator
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
                Pantau laporan, tinjau diskusi baru, dan jaga kebersihan ekosistem komunitas WASPADA.
            </p>
        </div>

        <div class="self-start sm:self-auto px-3.5 h-8 inline-flex items-center gap-1.5 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-white dark:bg-[#12221b] text-xs font-mono text-slate-600 dark:text-[#a0c5b5] shadow-sm leading-none">
            <span>◷</span><span>{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    {{-- Stats Bento Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">

        {{-- Card 1: Pending Discussions --}}
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
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Diskusi baru yang belum ditinjau</div>
            </div>
        </x-card>

        {{-- Card 2: Pending Reports --}}
        <x-card class="flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Laporan Pending</span>
                <div class="h-9 w-9 rounded-xl bg-rose-500/15 border border-rose-500/30 text-rose-600 dark:text-rose-400 font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($pendingReports) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Laporan perlu pemeriksaan</div>
            </div>
        </x-card>

        {{-- Card 3: Published Discussions --}}
        <x-card class="flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-mono font-bold uppercase tracking-wider text-slate-500 dark:text-[#7d9f90]">Diskusi Terpublikasi</span>
                <div class="h-9 w-9 rounded-xl bg-[#c9f28a]/20 border border-[#c9f28a]/40 text-[#0b1411] dark:text-[#c9f28a] font-bold flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight font-mono">
                    {{ number_format($publishedDiscussions) }}
                </div>
                <div class="text-xs text-slate-400 dark:text-[#6c8c7d] mt-1">Diskusi aktif di forum publik</div>
            </div>
        </x-card>

    </div>

    {{-- Laporan Terbaru --}}
    <x-card class="!p-0 overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-200 dark:border-[#1e382d] flex items-center justify-between gap-4 bg-slate-50/50 dark:bg-[#0c1813]/60">
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">Laporan Terbaru</h2>
                <p class="text-xs text-slate-500 dark:text-[#7e9f90]">Laporan yang masih menunggu pemeriksaan tindakan moderator.</p>
            </div>
            <a href="{{ route('moderator.reports.index') }}" class="text-xs font-mono font-bold text-[#15803d] dark:text-[#c9f28a] hover:underline">
                Lihat Semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 dark:border-[#1a3328] bg-slate-50 dark:bg-[#0e1d17] text-slate-500 dark:text-[#789a8b] font-mono text-[11px] uppercase tracking-wider">
                        <th class="py-3 px-4 sm:px-6">Diskusi Terkait</th>
                        <th class="py-3 px-4">Pelapor</th>
                        <th class="py-3 px-4">Alasan</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 sm:px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-[#172c21]">
                    @forelse ($latestReports as $report)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-[#12221b]/60 transition">
                            <td class="py-3.5 px-4 sm:px-6 max-w-xs">
                                <div class="font-bold text-slate-900 dark:text-white line-clamp-1">
                                    {{ $report->discussion->title }}
                                </div>
                                <span class="text-[10px] font-mono text-slate-400 dark:text-[#5d7c6f]">
                                    Dilaporkan {{ $report->created_at->format('d M Y') }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300">
                                {{ $report->reporter->name }}
                            </td>

                            <td class="py-3.5 px-4 max-w-xs text-slate-600 dark:text-[#8ba79b]">
                                <span class="line-clamp-1">{{ $report->reason }}</span>
                            </td>

                            <td class="py-3.5 px-4">
                                <x-badge variant="pending">
                                    Menunggu
                                </x-badge>
                            </td>

                            <td class="py-3.5 px-4 sm:px-6 text-right whitespace-nowrap">
                                <a href="{{ route('moderator.reports.show', $report->id) }}" 
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-[#234234] bg-white dark:bg-[#12241c] text-slate-700 dark:text-[#a0c5b5] hover:border-[#c9f28a] hover:text-[#15803d] dark:hover:text-[#c9f28a] text-[11px] font-bold transition">
                                    Tinjau →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 dark:text-[#6a8c7e]">
                                Belum ada laporan yang menunggu pemeriksaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    {{-- Informasi Moderasi Notice --}}
    <x-card class="border-sky-500/20 bg-sky-50/50 dark:bg-sky-950/10">
        <div class="flex items-start gap-3 text-xs">
            <div class="h-6 w-6 rounded-md bg-sky-500/20 text-sky-700 dark:text-sky-400 flex items-center justify-center font-bold flex-shrink-0">
                i
            </div>
            <div>
                <h3 class="font-bold text-sky-900 dark:text-sky-200 text-sm mb-1">Prinsip Moderasi WASPADA</h3>
                <p class="text-sky-800/80 dark:text-sky-300/80 leading-relaxed">
                    Periksa konteks dan informasi pendukung sebelum mengambil tindakan. Bedakan pengalaman pribadi, dugaan, dan informasi yang telah terverifikasi. Hindari menyimpulkan bahwa seseorang melakukan penipuan hanya berdasarkan satu laporan tanpa bukti petunjuk yang memadai.
                </p>
            </div>
        </div>
    </x-card>

</div>
@endsection
