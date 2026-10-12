@extends('layouts.app')

@section('title', 'Hasil Analisis Risiko — WASPADA')

@section('content')
<div class="py-10 max-w-4xl mx-auto px-4 sm:px-6">

    @php
        $riskConfig = [
            'low' => [
                'label' => 'Risiko Rendah / Pola Bersih',
                'badge' => 'LOW THREAT',
                'badgeVariant' => 'lime',
                'border' => 'border-emerald-300 dark:border-[#2d5c46]',
                'bg' => 'bg-emerald-50 dark:bg-[#12261e]',
                'text' => 'text-emerald-800 dark:text-[#c9f28a]',
                'bar' => 'w-1/4 bg-emerald-600 dark:bg-[#c9f28a]',
                'desc' => 'Indikator yang dipilih belum mencocoki pola risiko terdaftar di database. Tetap lakukan verifikasi ganda sebelum transfer.',
            ],
            'warning' => [
                'label' => 'Perlu Diwaspadai / Anomali Terdeteksi',
                'badge' => 'ELEVATED RISK',
                'badgeVariant' => 'alert',
                'border' => 'border-amber-300 dark:border-amber-500/40',
                'bg' => 'bg-amber-50 dark:bg-[#1e2013]',
                'text' => 'text-amber-800 dark:text-amber-400',
                'bar' => 'w-2/3 bg-amber-500 dark:bg-amber-400',
                'desc' => 'Indikator yang dipilih cocok dengan pola anomali yang perlu diwaspadai. Jangan terburu-buru melakukan pembayaran atau membagikan identitas.',
            ],
            'high' => [
                'label' => 'Risiko Tinggi / Indikasi Bahaya',
                'badge' => 'CRITICAL DANGER',
                'badgeVariant' => 'danger',
                'border' => 'border-rose-300 dark:border-rose-500/50',
                'bg' => 'bg-rose-50 dark:bg-[#221316]',
                'text' => 'text-rose-800 dark:text-rose-400',
                'bar' => 'w-full bg-rose-600 dark:bg-rose-500',
                'desc' => 'Indikator sangat identik dengan pola penipuan/pemerasan terdaftar. Tunda transaksi sekarang juga dan jangan bagikan kode OTP!',
            ]
        ];

        $currentRisk = $riskConfig[$assessment->risk_level] ?? $riskConfig['warning'];

        $recommendations = [
            'low' => [
                'Periksa nomor rekening pada situs kredibilitas resmi seperti CekRekening.id.',
                'Periksa rincian jumlah transfer sebelum konfirmasi otentikasi.',
                'Jangan pernah membagikan password, PIN, atau OTP ke siapapun.',
            ],
            'warning' => [
                'Verifikasi identitas pihak pemanggil dari saluran kontak publik resmi mereka.',
                'Tolak instruksi yang meminta penginstalan aplikasi dari luar Play Store / App Store.',
                'Jangan terpengaruh intimidasi waktu atau janji keuntungan instan.',
            ],
            'high' => [
                'Hentikan seluruh komunikasi dan jangan transfer dana sepeserpun!',
                'Blokir nomor telepon dan laporkan kontak mencurigakan tersebut.',
                'Bila sudah transfer, segera hubungi call center bank Anda untuk blokir darurat.',
            ],
        ];
    @endphp

    {{-- Top Navigation Link --}}
    <div class="mb-6 flex items-center justify-between">
        <x-button variant="outline" size="sm" href="{{ route('assessments.create') }}">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Pemeriksaan Baru</span>
        </x-button>

        <x-badge variant="default">
            ID: #SEC-{{ str_pad($assessment->id, 5, '0', STR_PAD_LEFT) }}
        </x-badge>
    </div>

    {{-- Big Main Threat Card --}}
    <x-card class="{{ $currentRisk['border'] }} {{ $currentRisk['bg'] }} mb-8 relative overflow-hidden transition-colors">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 pb-6 border-b border-slate-200/60 dark:border-white/10">
            <div>
                <x-badge :variant="$currentRisk['badgeVariant']" class="mb-3">
                    {{ $currentRisk['badge'] }}
                </x-badge>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    {{ $currentRisk['label'] }}
                </h1>
            </div>

            <div class="w-full sm:w-48 bg-white/80 dark:bg-[#09130e]/80 p-3 rounded-xl border border-slate-200 dark:border-white/10 shadow-sm">
                <div class="flex justify-between text-[11px] font-mono text-slate-500 dark:text-[#89a89b] mb-1.5">
                    <span>Threat Level</span>
                    <span class="{{ $currentRisk['text'] }} font-bold">{{ strtoupper($assessment->risk_level) }}</span>
                </div>
                <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-[#182921] overflow-hidden">
                    <div class="h-full {{ $currentRisk['bar'] }} rounded-full"></div>
                </div>
            </div>
        </div>

        <p class="mt-6 text-sm sm:text-base text-slate-700 dark:text-[#c4d6cd] leading-relaxed">
            {{ $currentRisk['desc'] }}
        </p>
    </x-card>

    {{-- Bento Grid Analysis --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        
        {{-- Matched Patterns --}}
        <x-card>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                    Pola Terdeteksi ({{ count($matchedPatterns) }})
                </h2>
                <x-badge variant="default">Database Match</x-badge>
            </div>

            <div class="space-y-3.5">
                @forelse ($matchedPatterns as $pattern)
                    <div class="rounded-xl border border-slate-200 dark:border-[#1d382c] bg-slate-50 dark:bg-[#12221b] p-4 text-xs transition-colors">
                        <div class="flex items-center justify-between gap-2 mb-2 font-bold text-slate-900 dark:text-white">
                            <span>{{ $pattern->name }}</span>
                            <span class="font-mono text-[10px] text-emerald-700 dark:text-[#c9f28a] uppercase">{{ $pattern->risk_level }}</span>
                        </div>
                        <p class="text-slate-600 dark:text-[#7d9e90] leading-relaxed mb-3">{{ $pattern->description }}</p>
                        
                        <div class="font-mono text-[10px] text-emerald-800 dark:text-[#a4c9b9] mb-1 font-semibold">Indikator Terkait:</div>
                        <ul class="space-y-1 pl-4 list-disc marker:text-emerald-600 dark:marker:text-[#c9f28a] text-slate-700 dark:text-[#c4d8ce]">
                            @foreach ($pattern->indicators as $patternIndicator)
                                <li>{{ $patternIndicator->label }}</li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-slate-200 dark:border-[#1f372c] p-6 text-center text-xs text-slate-400 dark:text-[#6e8e80]">
                        Belum ada pola spesifik yang terverifikasi penuh sesuai pilihan Anda. Tetap berhati-hati terhadap variasi modus baru.
                    </div>
                @endforelse
            </div>
        </x-card>

        {{-- Selected Indicators --}}
        <x-card class="flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                        Input Pilihan Anda ({{ count($assessment->indicators) }})
                    </h2>
                    <x-badge variant="default">Telemetry</x-badge>
                </div>

                <div class="space-y-2">
                    @forelse ($assessment->indicators as $indicator)
                        <div class="flex items-center gap-2.5 rounded-lg border border-slate-200 dark:border-[#1c3328] bg-slate-50 dark:bg-[#0c1813] p-3 text-xs text-slate-800 dark:text-[#d2e4dc] transition-colors">
                            <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-[#c9f28a] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>{{ $indicator->label }}</span>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 dark:text-[#637d71]">Tidak ada indikator yang dipilih.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-[#1b3127]">
                <p class="text-xs text-slate-500 dark:text-[#7d9e90] mb-3">Butuh pendapat atau cerita dari korban modus serupa?</p>
                <x-button variant="dark" href="{{ route('forum.index') }}" class="w-full">
                    Telusuri Diskusi Komunitas
                </x-button>
            </div>
        </x-card>

    </div>

    {{-- Mitigation & Next Steps --}}
    <x-card variant="elevated">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            Saran Tindakan & Langkah Pencegahan
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
            @foreach ($recommendations[$assessment->risk_level] ?? [] as $index => $rec)
                <div class="rounded-xl border border-slate-200 dark:border-[#1e382c] bg-slate-50 dark:bg-[#0c1813] p-4 text-xs transition-colors">
                    <span class="font-mono text-emerald-700 dark:text-[#c9f28a] font-bold block mb-1">0{{ $index + 1 }}.</span>
                    <p class="text-slate-700 dark:text-[#c1d6cc] leading-relaxed">{{ $rec }}</p>
                </div>
            @endforeach
        </div>

        <x-alert type="warning">
            <strong>Disclaimer:</strong> Hasil pemeriksaan merupakan kalkulasi kecocokan indikator awal dan tidak menggantikan proses penegakan hukum resmi. Gunakan sebagai pertimbangan kehati-hatian.
        </x-alert>

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <x-button variant="lime" href="{{ route('assessments.create') }}" class="w-full sm:w-auto">
                Periksa Situasi Lain
            </x-button>
            <x-button variant="outline" href="{{ route('forum.create') }}" class="w-full sm:w-auto">
                + Laporkan Temuan ke Forum
            </x-button>
        </div>
    </x-card>

</div>
@endsection
