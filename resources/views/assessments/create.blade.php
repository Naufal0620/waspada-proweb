@extends('layouts.app')

@section('title', 'Security You Can Rely On — WASPADA')

@section('content')

{{-- =========================================================================
     SECTION 1: HERO SECTION (SHIELD ORBIT AESTHETIC - ADAPTIVE)
     ========================================================================= --}}
<section class="relative bg-white dark:bg-[#0b1411] pt-12 pb-24 overflow-hidden border-b border-slate-200 dark:border-[#182a23] transition-colors">
    
    {{-- Soft Radial Glows --}}
    <div class="pointer-events-none absolute top-10 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-emerald-500/10 dark:bg-[#234d3b]/20 blur-[130px] rounded-full"></div>

    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center relative z-10">
        
        {{-- Rating / Social Proof Pill (Directly from Koflow reference) --}}
        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-[#21382e] bg-slate-50 dark:bg-[#12211b] px-4 py-1.5 text-xs text-slate-700 dark:text-[#a3c4b5] mb-8 shadow-sm">
            <span class="text-[#15803d] dark:text-[#c9f28a] font-bold">100%</span>
            <span class="text-slate-400 dark:text-[#6d8a7c]">•</span>
            <span>Anonim, Tanpa Rekam Jejak Data Pribadi</span>
        </div>

        {{-- Big Bold Editorial Headline --}}
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 dark:text-white max-w-3xl mx-auto leading-[1.15] mb-6">
            Security You Can Rely On <br>
            for Fraud Prevention
        </h1>

        <p class="max-w-2xl mx-auto text-sm sm:text-base text-slate-600 dark:text-[#92ada0] leading-relaxed mb-9">
            Pemeriksaan keamanan data digital & transaksi online. Kenali pola penipuan, pinjol ilegal, dan manipulasi sosial sebelum kamu melakukan transfer.
        </p>

        {{-- Green CTA Button --}}
        <div class="flex items-center justify-center gap-4 mb-16">
            <a href="#assessment-form" 
               class="inline-flex items-center gap-2 rounded-lg bg-[#c9f28a] px-7 py-3 text-sm font-bold text-[#0b1411] shadow-[0_4px_20px_rgba(201,242,138,0.25)] transition hover:bg-[#d8faa2] hover:scale-105 active:scale-95">
                <span>Mulai Skrining Risiko</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>

        {{-- Central Giant Shield Graphic with Concentric Borders & Micro Orbit Nodes (Koflow Signature) --}}
        <div class="relative mx-auto max-w-lg flex items-center justify-center pt-4">
            
            {{-- Outer concentric border ring 1 --}}
            <div class="relative w-72 h-80 sm:w-96 sm:h-[400px] border border-slate-200 dark:border-[#1b352a]/70 rounded-[48px] flex items-center justify-center p-6 bg-gradient-to-b from-slate-50 dark:from-[#11231c]/50 to-transparent shadow-sm">
                
                {{-- Inner ring 2 --}}
                <div class="w-full h-full border border-slate-300 dark:border-[#274d3d]/90 rounded-[38px] flex items-center justify-center p-8 bg-white/90 dark:bg-[#0e1d17]/80 backdrop-blur-sm shadow-md dark:shadow-[inset_0_0_40px_rgba(39,77,61,0.2)]">
                    
                    {{-- Central glowing shield icon --}}
                    <div class="relative flex flex-col items-center">
                        <div class="h-28 w-28 sm:h-36 sm:w-36 rounded-3xl bg-slate-50 dark:bg-[#172c23] border border-emerald-500/30 dark:border-[#c9f28a]/40 p-5 shadow-lg dark:shadow-[0_0_50px_rgba(201,242,138,0.2)] flex items-center justify-center">
                            <img src="{{ asset('images/icon.svg') }}" alt="WASPADA Shield" class="h-full w-full object-contain">
                        </div>
                        <span class="mt-4 font-mono text-xs text-[#15803d] dark:text-[#c9f28a] tracking-widest uppercase font-bold">ACTIVE DEFENSE</span>
                    </div>

                </div>

                {{-- Micro-nodes on edges (koflow style) --}}
                <div class="absolute -top-3 left-1/4 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                    DATA ENCRYPTED
                </div>
                <div class="absolute bottom-8 -right-3 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                    ZERO LOGS
                </div>
                <div class="absolute top-1/2 -left-4 -translate-y-1/2 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                    PATTERNS READY
                </div>
            </div>

        </div>

    </div>

    {{-- Trusted Nodes Ticker (Koflow style logo bar below shield) --}}
    <div class="mt-20 border-t border-slate-200 dark:border-[#162921] pt-8">
        <div class="mx-auto max-w-5xl px-4 flex flex-wrap items-center justify-center gap-8 sm:gap-16 text-xs font-mono uppercase tracking-wider text-slate-500 dark:text-[#637d71]">
            <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                OJK Database Inspired
            </span>
            <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Anti-Phishing Detection
            </span>
            <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Heuristic Matching
            </span>
            <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Community Powered
            </span>
        </div>
    </div>
</section>


{{-- =========================================================================
     SECTION 2: LIGHT SECTION (SCALE & STATS - Koflow Middle Light Section)
     ========================================================================= --}}
<section id="stats" class="bg-[#f2f4f2] dark:bg-[#0c1813] text-[#13221c] dark:text-[#f1f5f3] py-20 border-b border-[#dde3df] dark:border-[#192f24] transition-colors">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        
        {{-- Section Eyebrow --}}
        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#35614d] dark:text-[#c9f28a] mb-4">
            <span class="h-2.5 w-2.5 rounded-sm bg-[#35614d] dark:bg-[#c9f28a]"></span>
            <span>Deteksi Cepat Tanpa Kompromi</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7">
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f1d17] dark:text-white leading-tight mb-5">
                    Lindungi Keputusan Finansial <br>
                    Secara Real-time
                </h2>
                <p class="text-sm sm:text-base text-[#4f645a] dark:text-[#90aba0] leading-relaxed max-w-xl mb-6">
                    Mekanisme pencocokan indikator heuristik mengenali karakteristik pinjaman online tanpa izin, tautan phishing transfer, hingga intimidasi debt-collector sebelum kerugian terjadi.
                </p>
                <a href="#assessment-form" 
                   class="inline-flex items-center gap-2 rounded-lg bg-[#14261f] dark:bg-[#c9f28a] px-6 py-2.5 text-xs font-bold text-white dark:text-[#0b1411] transition hover:bg-[#1f3a2f] dark:hover:bg-[#d8faa2] shadow-sm">
                    Coba Pemeriksaan Sekarang
                </a>
            </div>

            {{-- Big Circular Radar graphic (inspired by light section globe in Koflow) --}}
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-64 h-64 rounded-full border-4 border-white dark:border-[#1a3328] bg-[#e4eae5] dark:bg-[#12221b] shadow-lg flex items-center justify-center p-6 transition-colors">
                    <div class="w-full h-full rounded-full border-2 border-dashed border-[#8ba699] dark:border-[#2b4c3e] flex items-center justify-center relative animate-[spin_60s_linear_infinite]">
                        <div class="absolute -top-3 bg-white dark:bg-[#1a3328] px-2.5 py-0.5 rounded-full shadow text-[10px] font-bold text-[#234d3b] dark:text-[#c9f28a]">Akses Rekening</div>
                        <div class="absolute -bottom-3 bg-white dark:bg-[#1a3328] px-2.5 py-0.5 rounded-full shadow text-[10px] font-bold text-[#234d3b] dark:text-[#c9f28a]">Izin Kontak</div>
                    </div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center">
                        <img src="{{ asset('images/icon.svg') }}" alt="" class="h-10 w-10 opacity-70 mb-1">
                        <span class="text-xs font-bold text-[#14261f] dark:text-white">Telemetry Radar</span>
                        <span class="text-[10px] text-[#556e62] dark:text-[#7d9f90]">Active Filtering</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Big Numbers Grid (99.9%, 100%, 24/7, Full) from Koflow reference --}}
        <div class="mt-20 pt-12 border-t border-[#d8e0db] dark:border-[#182e23] grid grid-cols-2 md:grid-cols-4 gap-8 text-center transition-colors">
            <div>
                <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                    {{ count($indicators) }}
                </div>
                <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">Indikator Terdaftar</div>
                <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Sinyal modus aktif</div>
            </div>

            <div>
                <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                    100%
                </div>
                <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">Bebas Pelacakan</div>
                <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Privasi sepenuhnya terlindungi</div>
            </div>

            <div>
                <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                    &lt; 0.1s
                </div>
                <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">Waktu Analisis</div>
                <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Pencocokan seketika</div>
            </div>

            <div>
                <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                    Terbuka
                </div>
                <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">Akses Publik</div>
                <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Dapat diakses kapan saja</div>
            </div>
        </div>

    </div>
</section>


{{-- =========================================================================
     SECTION 3: ASSESSMENT BENTO FORM (INTERACTIVE SECURITY ENGINE)
     ========================================================================= --}}
<section id="assessment-form" class="bg-slate-50 dark:bg-[#0b1411] py-24 relative transition-colors">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        
        {{-- Section Title --}}
        <div class="text-center max-w-2xl mx-auto mb-14">
            <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-[#21382e] bg-white dark:bg-[#12211b] px-3.5 py-1 text-[11px] font-mono text-emerald-700 dark:text-[#c9f28a] mb-4 shadow-sm">
                <span>01. MODUL PEMERIKSAAN RISIKO</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-bold text-slate-900 dark:text-white tracking-tight">
                Pilih Tanda-Tanda yang Kamu Temukan
            </h2>
            <p class="mt-3 text-xs sm:text-sm text-slate-600 dark:text-[#8ca89b] leading-relaxed">
                Centang setiap indikator yang kamu curigai pada pihak terkait. WASPADA akan mengkorelasikannya dengan database pola risiko penipuan.
            </p>
        </div>

        <form action="{{ route('assessments.store') }}" method="POST">
            @csrf

            {{-- Bento Card Form Box --}}
            <div class="rounded-3xl border border-slate-200 dark:border-[#1f372c] bg-white dark:bg-[#101e18] p-6 sm:p-10 shadow-lg dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                
                {{-- Form Toolbar Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100 dark:border-[#1b3127]">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-lg bg-emerald-50 dark:bg-[#182f25] border border-emerald-200 dark:border-[#2c5341] flex items-center justify-center text-emerald-700 dark:text-[#c9f28a]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Sinyal Kecurigaan</h3>
                            <p class="text-xs text-slate-500 dark:text-[#7d9b8e]">Kamu dapat memilih lebih dari satu indikator</p>
                        </div>
                    </div>

                    <span class="self-start sm:self-auto text-xs px-3 py-1 rounded-md bg-slate-100 dark:bg-[#162a21] border border-slate-200 dark:border-[#264939] text-emerald-800 dark:text-[#c9f28a] font-mono">
                        {{ count($indicators) }} Opsi Tersedia
                    </span>
                </div>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="mt-6 rounded-xl border border-rose-500/40 bg-rose-50 dark:bg-rose-950/40 p-4 text-xs text-rose-700 dark:text-rose-300 flex items-center gap-3" role="alert">
                        <svg class="w-5 h-5 flex-shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>{{ $errors->first('indicators') ?? 'Periksa kembali pilihan indikator kamu.' }}</div>
                    </div>
                @endif

                {{-- Interactive Indicator Tiles (Bento Grid) --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-3.5">
                    @forelse ($indicators as $indicator)
                        <label class="group relative flex cursor-pointer items-start gap-4 rounded-xl border border-slate-200 dark:border-[#1b3328] bg-slate-50/80 dark:bg-[#0c1813] p-4.5 transition hover:border-emerald-500/50 hover:bg-slate-100 dark:hover:border-[#c9f28a]/50 dark:hover:bg-[#13251d] has-[:checked]:border-emerald-600 dark:has-[:checked]:border-[#c9f28a] has-[:checked]:bg-emerald-50/60 dark:has-[:checked]:bg-[#172c22] has-[:checked]:shadow-sm">
                            
                            {{-- Checkbox Input --}}
                            <div class="pt-0.5">
                                <input
                                    type="checkbox"
                                    name="indicators[]"
                                    value="{{ $indicator->id }}"
                                    class="h-4.5 w-4.5 rounded border-slate-300 dark:border-[#2e5643] bg-white dark:bg-[#08120e] text-emerald-600 dark:text-[#c9f28a] focus:ring-emerald-500 cursor-pointer accent-[#15803d] dark:accent-[#c9f28a]"
                                    @checked(in_array($indicator->id, old('indicators', [])))
                                >
                            </div>

                            {{-- Text & Category --}}
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-slate-800 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-[#c9f28a] transition leading-snug">
                                    {{ $indicator->label }}
                                </div>
                                
                                @if(!empty($indicator->category))
                                    <div class="mt-2">
                                        <span class="inline-flex items-center rounded px-2 py-0.5 text-[10px] font-mono uppercase tracking-wider bg-slate-200/60 dark:bg-[#142820] text-slate-600 dark:text-[#a0c7b6] border border-slate-300 dark:border-[#224436]">
                                            {{ $indicator->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Active Checked Marker --}}
                            <div class="opacity-0 group-has-[:checked]:opacity-100 transition text-emerald-600 dark:text-[#c9f28a] pt-0.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>
                    @empty
                        <div class="col-span-2 rounded-xl border border-dashed border-slate-200 dark:border-[#1f372c] p-8 text-center text-xs text-slate-400 dark:text-[#6e8a7d]">
                            Belum ada indikator aktif yang terdaftar di database sistem.
                        </div>
                    @endforelse
                </div>

                {{-- Action Bar --}}
                @if ($indicators->isNotEmpty())
                    <div class="mt-8 pt-6 border-t border-slate-100 dark:border-[#1b3127] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-slate-500 dark:text-[#718f81] flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Analisis didasarkan pada kecocokan pola matematis awal.</span>
                        </div>

                        <button type="submit" 
                                class="w-full sm:w-auto rounded-lg bg-[#c9f28a] text-[#0b1411] px-8 py-3.5 text-sm font-bold shadow-md hover:bg-[#d8faa2] active:scale-95 flex items-center justify-center gap-2 transition cursor-pointer">
                            <span>Jalankan Pemeriksaan Risiko</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                @endif

            </div>
        </form>
    </div>
</section>


{{-- =========================================================================
     SECTION 4: TESTIMONIALS / QUOTE CARDS (ADAPTIVE DARK/LIGHT)
     ========================================================================= --}}
<section class="bg-slate-100 dark:bg-[#0e1a15] py-20 border-t border-b border-slate-200 dark:border-[#182b22] text-slate-800 dark:text-white transition-colors">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
        
        {{-- Floating Pill Bubbles from Koflow reference --}}
        <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 mb-12">
            <span class="px-4 py-2 rounded-full bg-white dark:bg-[#152720] border border-slate-200 dark:border-[#234235] text-xs text-slate-700 dark:text-[#a0c5b5] flex items-center gap-2 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                "Membantu verifikasi pinjol"
            </span>
            <span class="px-4 py-2 rounded-full bg-emerald-50 dark:bg-[#1b3329] border border-emerald-300 dark:border-[#c9f28a]/40 text-xs text-emerald-900 dark:text-white font-medium flex items-center gap-2 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-600 dark:bg-[#c9f28a]"></span>
                "100% Cepat dan Anonim"
            </span>
            <span class="px-4 py-2 rounded-full bg-white dark:bg-[#152720] border border-slate-200 dark:border-[#234235] text-xs text-slate-700 dark:text-[#a0c5b5] flex items-center gap-2 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-500 dark:bg-[#c9f28a]"></span>
                "Edukasi pola penipuan"
            </span>
        </div>

        {{-- Big Quote Icon --}}
        <div class="mx-auto h-12 w-12 rounded-full bg-emerald-100 dark:bg-[#1b3329] border border-emerald-200 dark:border-[#2d5744] flex items-center justify-center text-emerald-700 dark:text-[#c9f28a] mb-6">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
        </div>

        <h3 class="text-2xl sm:text-3xl font-bold max-w-2xl mx-auto leading-snug mb-3 text-slate-900 dark:text-white">
            Komunitas Dibangun Atas Dasar Kepercayaan, Edukasi, dan Keamanan Bersama.
        </h3>
        <p class="text-xs sm:text-sm text-slate-500 dark:text-[#7e9d90] mb-12">
            Bagikan temuan mencurigakan untuk melindungi pengguna lain dari jeratan penipuan.
        </p>

        {{-- 3 Column Testimonials Grid (Directly matching Koflow layout) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <div class="rounded-2xl border border-slate-200 dark:border-[#1d352b] bg-white dark:bg-[#12221b] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-sm">
                <p class="mb-4">"Saya hampir mentransfer DP pinjaman sebelum mengecek indikator transfer di WASPADA. Ternyata polanya identik dengan penipuan rekening pribadi."</p>
                <div class="font-bold text-slate-900 dark:text-white text-xs">Arif Wicaksono</div>
                <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Wiraswasta, Surabaya</div>
            </div>

            <div class="rounded-2xl border border-emerald-200 dark:border-[#274c3d] bg-white dark:bg-[#14261f] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-md">
                <p class="mb-4">"Forum diskusinya sangat membuka mata tentang modus manipulasi APK surat tilang atau kurir paket. Sangat penting bagi orang tua dan keluarga."</p>
                <div class="font-bold text-slate-900 dark:text-white text-xs">Dian Lestari</div>
                <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Pengguna Komunitas, Jakarta</div>
            </div>

            <div class="rounded-2xl border border-slate-200 dark:border-[#1d352b] bg-white dark:bg-[#12221b] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-sm">
                <p class="mb-4">"Analisis risikonya instan dan langsung memberikan saran mitigasi yang konkret seperti lapor ke bank atau blokir kontak."</p>
                <div class="font-bold text-slate-900 dark:text-white text-xs">Reza Fahmi</div>
                <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Mahasiswa, Bandung</div>
            </div>
        </div>

    </div>
</section>

@endsection
