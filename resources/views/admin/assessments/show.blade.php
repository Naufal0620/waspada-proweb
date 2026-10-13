@extends('layouts.admin')

@section('title', 'Detail Asesmen #SEC-' . str_pad($assessment->id, 5, '0', STR_PAD_LEFT))
@section('breadcrumb', 'Detail Asesmen')

@php
    $activeMenu = 'assessments';
@endphp

@section('content')
<div class="space-y-6 max-w-5xl">

    {{-- Top Action --}}
    <div class="flex items-center justify-between">
        <x-button variant="outline" size="sm" href="{{ route('admin.assessments.index') }}">
            ← Kembali ke Daftar Asesmen
        </x-button>

        <x-badge variant="default">
            UUID: {{ $assessment->session_id }}
        </x-badge>
    </div>

    {{-- Assessment Meta Card --}}
    <x-card variant="elevated">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 dark:border-[#193225]">
            <div>
                <span class="text-xs font-mono text-slate-400">Pemeriksaan Risiko Platform</span>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-1">
                    Sesi #SEC-{{ str_pad($assessment->id, 5, '0', STR_PAD_LEFT) }}
                </h1>
            </div>

            @php
                $badgeType = match($assessment->risk_level) {
                    'high' => 'danger',
                    'warning' => 'alert',
                    default => 'lime'
                };
            @endphp
            <x-badge :variant="$badgeType">
                {{ strtoupper($assessment->risk_level) }} THREAT
            </x-badge>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 text-xs">
            <div>
                <span class="text-slate-400 font-mono text-[10px] uppercase block mb-1">Identitas Pembuat</span>
                @if($assessment->user)
                    <div class="font-bold text-slate-900 dark:text-white text-sm">{{ $assessment->user->name }}</div>
                    <div class="text-slate-500 font-mono text-xs">{{ $assessment->user->email }}</div>
                    <div class="text-[11px] text-emerald-700 dark:text-[#c9f28a] mt-1">Peran: {{ ucfirst($assessment->user->role) }}</div>
                @else
                    <span class="text-slate-500 italic">Pengguna Tamu (Guest / Anonim)</span>
                @endif
            </div>

            <div>
                <span class="text-slate-400 font-mono text-[10px] uppercase block mb-1">Status Informasi & Pencocokan</span>
                <div class="font-semibold text-slate-800 dark:text-[#c4d8ce]">
                    Info: <span class="capitalize">{{ $assessment->information_status }}</span>
                </div>
                <div class="text-slate-500 font-mono text-xs mt-0.5">
                    Match: {{ $assessment->match_status === 'matched' ? 'Pola Cocok' : 'Tanpa Pola' }}
                </div>
            </div>

            <div>
                <span class="text-slate-400 font-mono text-[10px] uppercase block mb-1">Waktu Eksekusi</span>
                <div class="font-mono text-slate-800 dark:text-[#c4d8ce]">{{ $assessment->created_at->format('d F Y, H:i:s') }}</div>
                <div class="text-[11px] text-slate-400 font-mono">{{ $assessment->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </x-card>

    {{-- Questions & Answers Breakdown --}}
    <x-card>
        <h2 class="text-base font-bold text-slate-900 dark:text-white mb-4">
            Rincian Jawaban Pertanyaan ({{ $assessment->answers->count() }})
        </h2>

        <div class="space-y-3">
            @forelse($assessment->answers as $ans)
                <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1a3328] bg-slate-50 dark:bg-[#0c1813] text-xs">
                    <p class="font-semibold text-slate-900 dark:text-white text-sm">
                        {{ $ans->question->question_text }}
                    </p>
                    <div class="mt-2 flex items-center gap-2">
                        <span class="font-mono text-slate-400">Pilihan:</span>
                        <span class="font-bold text-emerald-700 dark:text-[#c9f28a]">
                            {{ $ans->option->label }} ({{ $ans->option->value }})
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-400 italic">Tidak ada rincian jawaban tersimpan.</p>
            @endforelse
        </div>
    </x-card>

    {{-- Indicators & Matched Patterns Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Selected Indicators --}}
        <x-card>
            <h2 class="text-base font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                Indikator Aktif Terdeteksi ({{ $assessment->indicators->count() }})
            </h2>

            <div class="space-y-2">
                @forelse($assessment->indicators as $ind)
                    <div class="p-3 rounded-lg border border-slate-200 dark:border-[#1b3427] bg-white dark:bg-[#0f1d17] text-xs flex items-center justify-between">
                        <span class="text-slate-800 dark:text-[#c4d8ce] font-medium">{{ $ind->label }}</span>
                        <span class="font-mono text-[10px] text-slate-400 uppercase">{{ $ind->category }}</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic">Tidak ada indikator yang aktif.</p>
                @endforelse
            </div>
        </x-card>

        {{-- Matched Patterns --}}
        <x-card>
            <h2 class="text-base font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                Pola Kejahatan yang Cocok ({{ count($matchedPatterns) }})
            </h2>

            <div class="space-y-3">
                @forelse($matchedPatterns as $pat)
                    <div class="p-4 rounded-xl border border-slate-200 dark:border-[#1e382b] bg-white dark:bg-[#12221b] text-xs">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-bold text-slate-900 dark:text-white">{{ $pat->name }}</span>
                            <span class="font-mono text-[10px] text-rose-500 uppercase">{{ $pat->risk_level }}</span>
                        </div>
                        <p class="text-slate-500 dark:text-[#8ba79b] leading-relaxed">{{ $pat->description }}</p>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic">Belum ada kecocokan pola spesifik dalam database.</p>
                @endforelse
            </div>
        </x-card>

    </div>

</div>
@endsection
