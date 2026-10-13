@extends('layouts.app')

@section('title', 'WASPADA — Security You Can Rely On for Fraud Prevention')

@section('content')

    {{-- =========================================================================
     SECTION 1: HERO SECTION
     ========================================================================= --}}
    <section
        class="relative bg-white dark:bg-[#0b1411] pt-12 pb-24 overflow-hidden border-b border-slate-200 dark:border-[#182a23] transition-colors">

        {{-- Soft Radial Glows --}}
        <div
            class="pointer-events-none absolute top-10 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-emerald-500/10 dark:bg-[#234d3b]/20 blur-[130px] rounded-full">
        </div>

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center relative z-10">

            {{-- Rating / Social Proof Pill --}}
            <div
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-[#21382e] bg-slate-50 dark:bg-[#12211b] px-4 py-1.5 text-xs text-slate-700 dark:text-[#a3c4b5] mb-8 shadow-sm">
                <span class="text-[#15803d] dark:text-[#c9f28a] font-bold">100%</span>
                <span class="text-slate-400 dark:text-[#6d8a7c]">•</span>
                <span>Anonim, Tanpa Rekam Jejak Data Pribadi</span>
            </div>

            {{-- Big Bold Editorial Headline --}}
            <h1
                class="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 dark:text-white max-w-3xl mx-auto leading-[1.15] mb-6">
                Security You Can Rely On <br>
                for Fraud Prevention
            </h1>

            <p class="max-w-2xl mx-auto text-sm sm:text-base text-slate-600 dark:text-[#92ada0] leading-relaxed mb-9">
                Pemeriksaan keamanan data digital & transaksi online. Kenali pola penipuan, pinjol ilegal, dan manipulasi
                sosial sebelum kamu melakukan transfer.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap items-center justify-center gap-4 mb-16">
                <a href="{{ route('assessments.create') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-[#c9f28a] px-7 py-3 text-sm font-bold text-[#0b1411] shadow-[0_4px_20px_rgba(201,242,138,0.25)] transition hover:bg-[#d8faa2] hover:scale-105 active:scale-95">
                    <span>Mulai Skrining Risiko</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="{{ route('forum.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-300 dark:border-[#244636] bg-white dark:bg-[#12221b] px-6 py-3 text-sm font-semibold text-slate-800 dark:text-[#d3e6dd] hover:bg-slate-50 dark:hover:bg-[#182e24] transition shadow-sm">
                    <span>Jelajahi Forum Komunitas</span>
                </a>
            </div>

            {{-- Central Giant Shield Graphic --}}
            <div class="relative mx-auto max-w-lg flex items-center justify-center pt-4">

                <div
                    class="relative w-72 h-80 sm:w-96 sm:h-[400px] border border-slate-200 dark:border-[#1b352a]/70 rounded-[48px] flex items-center justify-center p-6 bg-gradient-to-b from-slate-50 dark:from-[#11231c]/50 to-transparent shadow-sm">

                    <div
                        class="w-full h-full border border-slate-300 dark:border-[#274d3d]/90 rounded-[38px] flex items-center justify-center p-8 bg-white/90 dark:bg-[#0e1d17]/80 backdrop-blur-sm shadow-md dark:shadow-[inset_0_0_40px_rgba(39,77,61,0.2)]">

                        <div class="relative flex flex-col items-center">
                            <div
                                class="h-28 w-28 sm:h-36 sm:w-36 rounded-3xl bg-slate-50 dark:bg-[#172c23] border border-emerald-500/30 dark:border-[#c9f28a]/40 p-5 shadow-lg dark:shadow-[0_0_50px_rgba(201,242,138,0.2)] flex items-center justify-center">
                                <img src="{{ asset('images/icon.svg') }}" alt="WASPADA Shield"
                                    class="h-full w-full object-contain">
                            </div>
                            <span
                                class="mt-4 font-mono text-xs text-[#15803d] dark:text-[#c9f28a] tracking-widest uppercase font-bold">ACTIVE
                                DEFENSE</span>
                        </div>

                    </div>

                    <div
                        class="absolute -top-3 left-1/4 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                        DATA ENCRYPTED
                    </div>
                    <div
                        class="absolute bottom-8 -right-3 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                        ZERO LOGS
                    </div>
                    <div
                        class="absolute top-1/2 -left-4 -translate-y-1/2 h-6 px-2.5 rounded-full bg-white dark:bg-[#162921] border border-slate-200 dark:border-[#2c4e40] text-[10px] font-mono text-slate-700 dark:text-[#a2c7b7] flex items-center gap-1.5 shadow">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                        PATTERNS READY
                    </div>
                </div>

            </div>

        </div>

        {{-- Trusted Nodes Ticker --}}
        <div class="mt-20 border-t border-slate-200 dark:border-[#162921] pt-8">
            <div
                class="mx-auto max-w-5xl px-4 flex flex-wrap items-center justify-center gap-8 sm:gap-16 text-xs font-mono uppercase tracking-wider text-slate-500 dark:text-[#637d71]">
                <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    OJK Database Inspired
                </span>
                <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Anti-Phishing Detection
                </span>
                <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Heuristic Matching
                </span>
                <span class="flex items-center gap-2 text-slate-700 dark:text-[#8ea89c]">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-[#c9f28a]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Community Powered
                </span>
            </div>
        </div>
    </section>

    {{-- =========================================================================
     SECTION 2: FEATURES & HOW IT WORKS
     ========================================================================= --}}
    <section id="stats"
        class="bg-[#f2f4f2] dark:bg-[#0c1813] text-[#13221c] dark:text-[#f1f5f3] py-20 border-b border-[#dde3df] dark:border-[#192f24] transition-colors">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            <div
                class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#35614d] dark:text-[#c9f28a] mb-4">
                <span class="h-2.5 w-2.5 rounded-sm bg-[#35614d] dark:bg-[#c9f28a]"></span>
                <span>Deteksi Cepat Tanpa Kompromi</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <div class="lg:col-span-7">
                    <h2
                        class="text-3xl sm:text-4xl font-bold tracking-tight text-[#0f1d17] dark:text-white leading-tight mb-5">
                        Lindungi Keputusan Finansial <br>
                        Secara Real-time
                    </h2>
                    <p class="text-sm sm:text-base text-[#4f645a] dark:text-[#90aba0] leading-relaxed max-w-xl mb-6">
                        Mekanisme pencocokan indikator heuristik mengenali karakteristik pinjaman online tanpa izin, tautan
                        phishing transfer, hingga intimidasi debt-collector sebelum kerugian terjadi.
                    </p>
                    <a href="{{ route('assessments.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-[#14261f] dark:bg-[#c9f28a] px-6 py-2.5 text-xs font-bold text-white dark:text-[#0b1411] transition hover:bg-[#1f3a2f] dark:hover:bg-[#d8faa2] shadow-sm">
                        Coba Pemeriksaan Sekarang
                    </a>
                </div>

                {{-- Telemetry Radar visual --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div
                        class="relative w-64 h-64 rounded-full border-4 border-white dark:border-[#1a3328] bg-[#e4eae5] dark:bg-[#12221b] shadow-lg flex items-center justify-center p-6 transition-colors">
                        <div
                            class="w-full h-full rounded-full border-2 border-dashed border-[#8ba699] dark:border-[#2b4c3e] flex items-center justify-center relative animate-[spin_60s_linear_infinite]">
                            <div
                                class="absolute -top-3 bg-white dark:bg-[#1a3328] px-2.5 py-0.5 rounded-full shadow text-[10px] font-bold text-[#234d3b] dark:text-[#c9f28a]">
                                Akses Rekening</div>
                            <div
                                class="absolute -bottom-3 bg-white dark:bg-[#1a3328] px-2.5 py-0.5 rounded-full shadow text-[10px] font-bold text-[#234d3b] dark:text-[#c9f28a]">
                                Izin Kontak</div>
                        </div>
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none text-center">
                            <img src="{{ asset('images/icon.svg') }}" alt="" class="h-10 w-10 opacity-70 mb-1">
                            <span class="text-xs font-bold text-[#14261f] dark:text-white">Telemetry Radar</span>
                            <span class="text-[10px] text-[#556e62] dark:text-[#7d9f90]">Active Filtering</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Metrics Grid --}}
            <div
                class="mt-20 pt-12 border-t border-[#d8e0db] dark:border-[#182e23] grid grid-cols-2 md:grid-cols-4 gap-8 text-center transition-colors">
                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                        {{ $stats['total_indicators'] }}
                    </div>
                    <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">
                        Indikator Risiko
                    </div>
                    <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Sinyal modus aktif</div>
                </div>

                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                        {{ $stats['total_patterns'] }}
                    </div>
                    <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">
                        Pola Ancaman
                    </div>
                    <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Basis data terverifikasi</div>
                </div>

                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                        100%
                    </div>
                    <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">
                        Bebas Pelacakan
                    </div>
                    <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Privasi terlindungi</div>
                </div>

                <div>
                    <div class="text-4xl sm:text-5xl font-extrabold text-[#0e1d17] dark:text-white tracking-tight">
                        {{ $stats['total_discussions'] }}
                    </div>
                    <div class="mt-2 text-xs font-bold text-[#204032] dark:text-[#c9f28a] uppercase tracking-wider">
                        Diskusi Warga
                    </div>
                    <div class="text-[11px] text-[#61796e] dark:text-[#789688] mt-1">Komunitas aktif</div>
                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================================
     SECTION 3: THREE STEP SCREENING WORKFLOW
     ========================================================================= --}}
    <section class="py-20 bg-white dark:bg-[#0b1411] border-b border-slate-200 dark:border-[#182a23]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="font-mono text-xs text-emerald-700 dark:text-[#c9f28a] uppercase font-bold tracking-wider">ALUR DETEKSI RISIKO</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-2">
                    Tiga Langkah Mudah Mengamankan Diri
                </h2>
                <p class="text-slate-500 dark:text-[#8ba79b] text-xs sm:text-sm mt-3">
                    Hanya membutuhkan waktu kurang dari satu menit untuk memastikan Anda tidak sedang dimanipulasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-card class="relative">
                    <span class="font-mono text-2xl font-black text-emerald-700 dark:text-[#c9f28a] block mb-3">01</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Jawab Sinyal Indikator</h3>
                    <p class="text-xs text-slate-600 dark:text-[#90aba0] leading-relaxed">
                        Centang pertanyaan terkait situasi Anda: ada transfer mendesak, tawaran hadiah, ancaman siber, atau akses nomor kontak pribadi.
                    </p>
                </x-card>

                <x-card class="relative">
                    <span class="font-mono text-2xl font-black text-emerald-700 dark:text-[#c9f28a] block mb-3">02</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Pencocokan Pola Heuristik</h3>
                    <p class="text-xs text-slate-600 dark:text-[#90aba0] leading-relaxed">
                        Algoritma WASPADA mengkorelasikan sinyal indikator dengan puluhan varian modus penipuan dan pinjol ilegal yang pernah dilaporkan.
                    </p>
                </x-card>

                <x-card class="relative">
                    <span class="font-mono text-2xl font-black text-emerald-700 dark:text-[#c9f28a] block mb-3">03</span>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Dapatkan Panduan Mitigasi</h3>
                    <p class="text-xs text-slate-600 dark:text-[#90aba0] leading-relaxed">
                        Terima skor bahaya (Rendah / Waspada / Kritis) beserta tindakan darurat yang harus Anda lakukan segera sebelum terlambat.
                    </p>
                </x-card>
            </div>

            <div class="mt-12 text-center">
                <x-button variant="lime" href="{{ route('assessments.create') }}">
                    Mulai Uji Sekarang →
                </x-button>
            </div>
        </div>
    </section>

    {{-- =========================================================================
     SECTION 4: LATEST COMMUNITY DISCUSSIONS
     ========================================================================= --}}
    <section class="py-20 bg-slate-50 dark:bg-[#0e1914] border-b border-slate-200 dark:border-[#182a23]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
                <div>
                    <span class="font-mono text-xs text-emerald-700 dark:text-[#c9f28a] uppercase font-bold tracking-wider">KOMUNITAS WASPADA</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">
                        Temuan & Laporan Warga Terkini
                    </h2>
                </div>
                <x-button variant="outline" size="sm" href="{{ route('forum.index') }}">
                    Lihat Semua Diskusi →
                </x-button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($latestDiscussions as $item)
                    <x-card class="flex flex-col justify-between hover:border-[#c9f28a]/50 transition">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <x-badge variant="lime">{{ $item->category->name }}</x-badge>
                                <span class="text-[10px] font-mono text-slate-400">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm line-clamp-2 mb-2">
                                <a href="{{ route('forum.show', $item->slug) }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-600 dark:text-[#90aba0] line-clamp-3 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($item->body), 120) }}
                            </p>
                        </div>
                        <div class="pt-3 border-t border-slate-100 dark:border-[#172c21] flex items-center justify-between text-[11px] font-mono text-slate-500 dark:text-[#7f998d]">
                            <span>Oleh {{ $item->user->name }}</span>
                            <span>{{ $item->comments_count }} komentar</span>
                        </div>
                    </x-card>
                @empty
                    <div class="col-span-3 text-center py-8 text-xs text-slate-500">
                        Belum ada diskusi terbuka.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- =========================================================================
     SECTION 5: COMMUNITY TESTIMONIALS
     ========================================================================= --}}
    <section class="bg-white dark:bg-[#0b1411] py-20 transition-colors">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">

            <div class="mx-auto h-12 w-12 rounded-full bg-emerald-100 dark:bg-[#1b3329] border border-emerald-200 dark:border-[#2d5744] flex items-center justify-center text-emerald-700 dark:text-[#c9f28a] mb-6">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path
                        d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                </svg>
            </div>

            <h3 class="text-2xl sm:text-3xl font-bold max-w-2xl mx-auto leading-snug mb-3 text-slate-900 dark:text-white">
                Komunitas Dibangun Atas Dasar Kepercayaan, Edukasi, dan Keamanan Bersama.
            </h3>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-[#7e9d90] mb-12">
                Bagikan temuan mencurigakan untuk melindungi pengguna lain dari jeratan penipuan.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <div
                    class="rounded-2xl border border-slate-200 dark:border-[#1d352b] bg-white dark:bg-[#12221b] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-sm">
                    <p class="mb-4">"Saya hampir mentransfer DP pinjaman sebelum mengecek indikator transfer di WASPADA.
                        Ternyata polanya identik dengan penipuan rekening pribadi."</p>
                    <div class="font-bold text-slate-900 dark:text-white text-xs">Arif Wicaksono</div>
                    <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Wiraswasta, Surabaya</div>
                </div>

                <div
                    class="rounded-2xl border border-emerald-200 dark:border-[#274c3d] bg-white dark:bg-[#14261f] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-md">
                    <p class="mb-4">"Forum diskusinya sangat membuka mata tentang modus manipulasi APK surat tilang atau
                        kurir paket. Sangat penting bagi orang tua dan keluarga."</p>
                    <div class="font-bold text-slate-900 dark:text-white text-xs">Dian Lestari</div>
                    <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Pengguna Komunitas, Jakarta</div>
                </div>

                <div
                    class="rounded-2xl border border-slate-200 dark:border-[#1d352b] bg-white dark:bg-[#12221b] p-6 text-xs leading-relaxed text-slate-600 dark:text-[#92b0a3] shadow-sm">
                    <p class="mb-4">"Analisis risikonya instan dan langsung memberikan saran mitigasi yang konkret
                        seperti lapor ke bank atau blokir kontak."</p>
                    <div class="font-bold text-slate-900 dark:text-white text-xs">Reza Fahmi</div>
                    <div class="text-[10px] text-slate-400 dark:text-[#6b8c7e]">Mahasiswa, Bandung</div>
                </div>
            </div>

        </div>
    </section>

@endsection
