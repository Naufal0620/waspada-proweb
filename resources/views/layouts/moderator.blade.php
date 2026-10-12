<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel Moderator') | WASPADA</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Theme Init Script -->
    <script>
        if (localStorage.getItem('theme') === 'light' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: light)').matches)) {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-[#f5f8f6] dark:bg-[#0b1411] text-[#13221c] dark:text-[#f1f5f3] antialiased selection:bg-[#c9f28a] selection:text-[#0b1411] min-h-screen">

    <div class="min-h-screen flex">

        {{-- Mobile Overlay --}}
        <div id="modSidebarOverlay" 
             onclick="toggleModSidebar(false)"
             class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

        {{-- SIDEBAR --}}
        <aside id="modSidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out bg-white dark:bg-[#0d1813] border-r border-slate-200 dark:border-[#1a3328] flex flex-col justify-between p-5">
            
            <div>
                {{-- Logo & Brand --}}
                <div class="flex items-center gap-3 px-2 py-3 mb-8 border-b border-slate-100 dark:border-[#172c21]">
                    <div class="h-9 w-9 rounded-xl bg-[#14261f] border border-[#234235] p-1.5 flex items-center justify-center">
                        <img src="{{ asset('images/icon.svg') }}" alt="WASPADA" class="h-6 w-6 object-contain">
                    </div>
                    <div>
                        <span class="text-base font-extrabold tracking-tight text-slate-900 dark:text-white flex items-center gap-1">
                            waspada<span class="h-1.5 w-1.5 rounded-full bg-[#c9f28a]"></span>
                        </span>
                        <span class="text-[10px] font-mono tracking-wider uppercase text-[#4d7363]">Moderator Panel</span>
                    </div>
                </div>

                {{-- Navigation Label --}}
                <div class="px-2 text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400 dark:text-[#527364] mb-2">
                    Tinjauan & Moderasi
                </div>

                {{-- Nav Links --}}
                <nav class="space-y-1.5">
                    <a href="{{ route('moderator.dashboard') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition {{ ($activeMenu ?? '') === 'dashboard' ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]' : 'text-slate-600 dark:text-[#90aba0] hover:bg-slate-100 dark:hover:bg-[#12231c] hover:text-slate-900 dark:hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard Mod</span>
                    </a>

                    <a href="{{ route('moderator.reports.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition {{ ($activeMenu ?? '') === 'reports' ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]' : 'text-slate-600 dark:text-[#90aba0] hover:bg-slate-100 dark:hover:bg-[#12231c] hover:text-slate-900 dark:hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                        <span>Laporan Masuk</span>
                    </a>

                    <div class="pt-4 pb-1 px-2 text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400 dark:text-[#527364]">
                        Akses Komunitas
                    </div>

                    <a href="{{ route('forum.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold text-slate-600 dark:text-[#90aba0] hover:bg-slate-100 dark:hover:bg-[#12231c] hover:text-slate-900 dark:hover:text-white transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                        <span>Lihat Forum Publik</span>
                    </a>
                </nav>
            </div>

            {{-- Sidebar Footer / Mod Profile --}}
            <div class="pt-4 border-t border-slate-100 dark:border-[#172c21]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="h-8 w-8 rounded-full bg-[#c9f28a] text-[#0b1411] font-bold text-xs flex items-center justify-center uppercase flex-shrink-0">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-xs font-bold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] font-mono text-slate-400 dark:text-[#6e8d80]">{{ ucfirst(auth()->user()->role) }}</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-400 transition" title="Logout">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- MAIN CONTENT AREA --}}
        <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
            
            {{-- Topbar --}}
            <header class="h-16 bg-white/95 dark:bg-[#0d1813]/90 border-b border-slate-200 dark:border-[#1a3328] sticky top-0 z-30 px-4 sm:px-8 flex items-center justify-between backdrop-blur">
                <div class="flex items-center gap-3">
                    <button type="button" 
                            onclick="toggleModSidebar()" 
                            class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-[#152a20]"
                            aria-label="Toggle menu">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-xs sm:text-sm font-bold font-mono uppercase tracking-wider text-slate-700 dark:text-[#a0c5b5]">
                        @yield('breadcrumb', 'Dashboard Moderator')
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <x-theme-toggle />

                    <div class="hidden sm:inline-flex items-center gap-2 px-3 py-1 rounded-full border border-amber-500/30 bg-amber-950/40 text-amber-400 text-xs font-mono">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                        Moderator Node
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        function toggleModSidebar(forceState) {
            const sidebar = document.getElementById('modSidebar');
            const overlay = document.getElementById('modSidebarOverlay');
            const isOpen = sidebar.classList.contains('translate-x-0');
            const shouldOpen = typeof forceState === 'boolean' ? forceState : !isOpen;

            if (shouldOpen) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
