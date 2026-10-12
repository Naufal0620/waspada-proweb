<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'WASPADA — Security You Can Rely On')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Theme Init Script (Prevent Flash of Incorrect Theme) -->
    <script>
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: light)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#f5f8f6] dark:bg-[#0b1411] text-[#13221c] dark:text-[#f1f5f3] antialiased selection:bg-[#c9f28a] selection:text-[#0b1411] relative overflow-x-hidden">

    {{-- Koflow Top Bar & Navbar --}}
    <header class="w-full bg-white/95 dark:bg-[#0b1411] border-b border-slate-200 dark:border-[#1c2c26] sticky top-0 z-50 transition-colors backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                {{-- Brand Logo --}}
                <div class="flex items-center gap-10">
                    <a href="{{ route('assessments.create') }}" class="flex items-center gap-3 group">
                        <div class="h-9 w-9 rounded-xl bg-slate-100 dark:bg-[#14231e] border border-slate-200 dark:border-[#233b31] p-1.5 flex items-center justify-center transition group-hover:border-[#c9f28a]/60">
                            <img src="{{ asset('images/icon.svg') }}" alt="WASPADA" class="h-6 w-6 object-contain">
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-1">
                            waspada<span class="h-1.5 w-1.5 rounded-full bg-[#15803d] dark:bg-[#c9f28a]"></span>
                        </span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-[#9eb3a8]">
                        <a href="{{ route('assessments.create') }}" 
                           class="transition hover:text-slate-950 dark:hover:text-white flex items-center gap-1.5 {{ request()->routeIs('assessments.*') ? 'text-emerald-700 dark:text-[#c9f28a] font-semibold' : '' }}">
                            Cek Risiko
                        </a>
                        <a href="{{ route('forum.index') }}" 
                           class="transition hover:text-slate-950 dark:hover:text-white flex items-center gap-1.5 {{ request()->routeIs('forum.*') ? 'text-emerald-700 dark:text-[#c9f28a] font-semibold' : '' }}">
                            Forum Komunitas
                        </a>
                    </nav>
                </div>

                {{-- Right CTA, Theme Toggle & Auth --}}
                <div class="flex items-center gap-3 sm:gap-4">
                    {{-- Dark/Light Toggle --}}
                    <x-theme-toggle />

                    @auth
                        <div class="flex items-center gap-3">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-xs font-mono px-3 py-1.5 rounded-lg bg-[#14231e] border border-[#233b31] text-[#c9f28a] hover:bg-[#1a2d26] transition">
                                    Panel Admin
                                </a>
                            @elseif(in_array(auth()->user()->role, ['moderator', 'admin']))
                                <a href="{{ route('moderator.dashboard') }}" class="text-xs font-mono px-3 py-1.5 rounded-lg bg-[#14231e] border border-[#233b31] text-[#c9f28a] hover:bg-[#1a2d26] transition">
                                    Panel Mod
                                </a>
                            @endif

                            <div class="flex items-center gap-2 pl-3 border-l border-[#1c2c26]">
                                <div class="h-8 w-8 rounded-full bg-[#c9f28a] text-[#0b1411] font-bold text-xs flex items-center justify-center uppercase">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:inline-block text-xs font-medium text-[#c4d6cd]">
                                    {{ auth()->user()->name }}
                                </span>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs text-[#788e83] hover:text-rose-400 p-1.5 transition" title="Logout">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 dark:text-[#c4d6cd] hover:text-slate-950 dark:hover:text-white px-3 py-2 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="rounded-lg bg-[#c9f28a] px-5 py-2.5 text-xs sm:text-sm font-bold text-[#0b1411] shadow-[0_2px_12px_rgba(201,242,138,0.25)] transition hover:bg-[#d8faa2] active:scale-95">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Koflow Big Signature Footer (Adaptive Dark/Light) --}}
    <footer class="bg-slate-100 dark:bg-[#070e0c] border-t border-slate-200 dark:border-[#14231e] text-slate-600 dark:text-[#8ea499] pt-20 pb-12 overflow-hidden relative transition-colors">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            
            {{-- Big Watermark Brand in Footer (just like Koflow image) --}}
            <div class="select-none pointer-events-none text-center font-extrabold text-[ clamp(4rem,14vw,11rem) ] text-slate-200 dark:text-[#0d1c16] tracking-tighter leading-none mb-12 flex items-center justify-center gap-4 transition-colors">
                <img src="{{ asset('images/icon.svg') }}" alt="" class="h-16 w-16 sm:h-28 sm:w-28 opacity-15 dark:opacity-20">
                <span>waspada</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-8 pb-16 border-b border-slate-200 dark:border-[#14231e] text-xs">
                <div class="col-span-2">
                    <div class="flex items-center gap-2 text-slate-900 dark:text-white font-bold text-base mb-3">
                        <img src="{{ asset('images/icon.svg') }}" alt="WASPADA" class="h-5 w-5">
                        <span>WASPADA Cyber Threat Node</span>
                    </div>
                    <p class="text-slate-500 dark:text-[#71877c] max-w-sm leading-relaxed mb-6">
                        Sistem deteksi dini penipuan online, pinjaman ilegal, dan perlindungan privasi digital berbasis pencocokan pola risiko komunitas.
                    </p>
                    <div class="inline-flex items-center gap-2 rounded-full border border-emerald-300 dark:border-[#1f382e] bg-emerald-50 dark:bg-[#0c1813] px-3 py-1 font-mono text-[11px] text-emerald-800 dark:text-[#c9f28a]">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600 dark:bg-[#c9f28a] animate-pulse"></span>
                        SYSTEM ONLINE & SECURE
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-3 text-sm">Fitur Utama</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('assessments.create') }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Deteksi Pola Risiko</a></li>
                        <li><a href="{{ route('forum.index') }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Forum Komunitas</a></li>
                        <li><a href="{{ route('assessments.create') }}#stats" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Metrik Keamanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-3 text-sm">Edukasi & Bantuan</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('forum.index') }}?category=pinjol-ilegal" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Pola Pinjol Ilegal</a></li>
                        <li><a href="{{ route('forum.index') }}?category=social-engineering" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Modus Phishing</a></li>
                        <li><a href="https://patrolisiber.id" target="_blank" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Portal Patroli Siber</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-3 text-sm">Akses Akun</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Masuk Akun</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-700 dark:hover:text-[#c9f28a] transition">Daftar Pengguna Baru</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400 dark:text-[#5f7469]">
                <div>&copy; {{ date('Y') }} WASPADA Project. Terinspirasi dari alur keamanan data digital.</div>
                <div class="flex gap-6">
                    <span>Privacy First</span>
                    <span>No Data Tracking</span>
                    <span>Open Community</span>
                </div>
            </div>

        </div>
    </footer>

    @stack('scripts')
</body>
</html>
