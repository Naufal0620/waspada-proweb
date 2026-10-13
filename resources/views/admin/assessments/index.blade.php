@extends('layouts.admin')

@section('title', 'Manajemen Data Asesmen Risiko')
@section('breadcrumb', 'Data Asesmen')

@php
    $activeMenu = 'assessments';
@endphp

@section('content')
<div class="space-y-6">

    {{-- Heading --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Pemeriksaan Risiko Pengguna
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#8ba79b] mt-1">
                Data telemetri asesmen yang dilakukan masyarakat melalui formulir skrining WASPADA.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="text-xs font-mono px-3 py-1.5 rounded-xl border border-slate-200 dark:border-[#203a2e] bg-white dark:bg-[#12221b] text-slate-700 dark:text-[#a0c5b5]">
                Total: <strong>{{ number_format($stats['total']) }}</strong> Asesmen
            </span>
        </div>
    </div>

    {{-- Filter Stats Bar --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <x-card class="p-4">
            <span class="text-[10px] font-mono uppercase tracking-wider text-rose-500 dark:text-rose-400 font-bold block mb-1">Risiko Tinggi</span>
            <div class="text-2xl font-bold font-mono text-rose-600 dark:text-rose-400">{{ $stats['high'] }}</div>
        </x-card>
        <x-card class="p-4">
            <span class="text-[10px] font-mono uppercase tracking-wider text-amber-500 dark:text-amber-400 font-bold block mb-1">Perlu Waspada</span>
            <div class="text-2xl font-bold font-mono text-amber-600 dark:text-amber-400">{{ $stats['warning'] }}</div>
        </x-card>
        <x-card class="p-4">
            <span class="text-[10px] font-mono uppercase tracking-wider text-emerald-600 dark:text-[#c9f28a] font-bold block mb-1">Risiko Rendah</span>
            <div class="text-2xl font-bold font-mono text-emerald-700 dark:text-[#c9f28a]">{{ $stats['low'] }}</div>
        </x-card>
        <x-card class="p-4">
            <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7f998d] font-bold block mb-1">Pengguna Terdaftar</span>
            <div class="text-2xl font-bold font-mono text-slate-900 dark:text-white">{{ $stats['registered'] }} <span class="text-xs font-normal text-slate-400">/ {{ $stats['guest'] }} tamu</span></div>
        </x-card>
    </div>

    {{-- Search & Filter Form --}}
    <x-card>
        <form method="GET" action="{{ route('admin.assessments.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID sesi, nama pengguna, atau email..."
                       class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-slate-50 dark:bg-[#0c1813] px-3.5 py-2 text-xs text-slate-900 dark:text-white placeholder:text-slate-400 focus:border-[#c9f28a] focus:outline-none">
            </div>

            <div>
                <select name="risk_level" class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-slate-50 dark:bg-[#0c1813] px-3.5 py-2 text-xs text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none">
                    <option value="">Semua Tingkat Risiko</option>
                    <option value="high" @selected(request('risk_level') === 'high')>Tinggi (High)</option>
                    <option value="warning" @selected(request('risk_level') === 'warning')>Waspada (Warning)</option>
                    <option value="low" @selected(request('risk_level') === 'low')>Rendah (Low)</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <select name="user_type" class="w-full rounded-xl border border-slate-200 dark:border-[#1e382c] bg-slate-50 dark:bg-[#0c1813] px-3.5 py-2 text-xs text-slate-900 dark:text-white focus:border-[#c9f28a] focus:outline-none">
                    <option value="">Semua Pengguna</option>
                    <option value="registered" @selected(request('user_type') === 'registered')>Pengguna Login</option>
                    <option value="guest" @selected(request('user_type') === 'guest')>Pengguna Tamu</option>
                </select>
                <x-button variant="lime" size="sm" type="submit">
                    Filter
                </x-button>
            </div>
        </form>
    </x-card>

    {{-- Main Table --}}
    <x-card>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="text-[11px] font-mono uppercase tracking-wider text-slate-500 dark:text-[#7d9f90] border-b border-slate-100 dark:border-[#1a3328]">
                    <tr>
                        <th class="py-3 px-4">ID Asesmen</th>
                        <th class="py-3 px-4">Pengguna</th>
                        <th class="py-3 px-4">Tingkat Risiko</th>
                        <th class="py-3 px-4">Status Info</th>
                        <th class="py-3 px-4">Indikator</th>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-[#172c21]">
                    @forelse ($assessments as $item)
                        @php
                            $badgeType = match($item->risk_level) {
                                'high' => 'danger',
                                'warning' => 'alert',
                                default => 'lime'
                            };
                            $badgeLabel = match($item->risk_level) {
                                'high' => 'CRITICAL DANGER',
                                'warning' => 'ELEVATED RISK',
                                default => 'LOW THREAT'
                            };
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-[#12221b]/50">
                            <td class="py-3 px-4 font-mono font-bold text-slate-800 dark:text-[#c4d8ce]">
                                #SEC-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-3 px-4">
                                @if($item->user)
                                    <div class="flex items-center gap-2">
                                        <div class="h-6 w-6 rounded-full bg-[#c9f28a] text-[#0b1411] font-bold text-[10px] flex items-center justify-center uppercase">
                                            {{ substr($item->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 dark:text-white leading-tight">{{ $item->user->name }}</p>
                                            <p class="text-[10px] font-mono text-slate-400">{{ $item->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-slate-100 dark:bg-[#152720] text-slate-500 font-mono text-[10px]">
                                        Tamu (Anonim)
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <x-badge :variant="$badgeType">
                                    {{ $badgeLabel }}
                                </x-badge>
                            </td>
                            <td class="py-3 px-4">
                                <span class="text-[11px] font-mono {{ $item->information_status === 'sufficient' ? 'text-emerald-700 dark:text-[#c9f28a]' : 'text-amber-600 dark:text-amber-400' }}">
                                    {{ ucfirst($item->information_status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-slate-600 dark:text-[#9eb5aa]">
                                <span class="font-semibold">{{ $item->indicators->count() }} sinyal</span>
                                <span class="text-[10px] text-slate-400 block">{{ $item->answers_count }} jawaban</span>
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-400 text-[11px]">
                                <div>{{ $item->created_at->format('d M Y') }}</div>
                                <div class="text-[10px]">{{ $item->created_at->format('H:i:s') }}</div>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <x-button variant="outline" size="sm" href="{{ route('admin.assessments.show', $item->id) }}">
                                    Rincian →
                                </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Tidak ada data pemeriksaan risiko yang cocok dengan kriteria filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-[#172c21]">
            {{ $assessments->links() }}
        </div>
    </x-card>

</div>
@endsection
