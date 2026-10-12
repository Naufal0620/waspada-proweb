<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Panel Admin') | WASPADA</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/icon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- Inisialisasi tema --}}
    <script>
        (() => {
            const savedTheme = localStorage.getItem('theme');
            const prefersLight = window.matchMedia('(prefers-color-scheme: light)').matches;
            const useLight = savedTheme === 'light' ||
                (!savedTheme && prefersLight);

            document.documentElement.classList.toggle('dark', !useLight);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen bg-[#f5f8f6] text-[#13221c] antialiased
             selection:bg-[#c9f28a] selection:text-[#0b1411]
             dark:bg-[#0b1411] dark:text-[#f1f5f3]">

    <div class="min-h-screen">

        {{-- Overlay untuk sidebar mobile --}}
        <div id="adminSidebarOverlay"
            onclick="toggleAdminSidebar(false)"
            class="fixed inset-0 z-40 hidden bg-slate-950/60 backdrop-blur-sm lg:hidden">
        </div>

        {{-- SIDEBAR --}}
        <aside id="adminSidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col
                   justify-between border-r border-slate-200 bg-white p-5
                   transition-transform duration-200 ease-in-out
                   dark:border-[#1a3328] dark:bg-[#0d1813]
                   lg:translate-x-0">

            <div>
                {{-- Logo --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="mb-8 flex items-center gap-3 border-b border-slate-100 px-2 py-3
                           dark:border-[#172c21]">

                    <div class="flex h-9 w-9 items-center justify-center rounded-xl
                                border border-[#234235] bg-[#14261f] p-1.5">
                        <img src="{{ asset('images/icon.svg') }}"
                            alt="WASPADA"
                            class="h-6 w-6 object-contain">
                    </div>

                    <div>
                        <span class="flex items-center gap-1 text-base font-extrabold
                                     tracking-tight text-slate-900 dark:text-white">
                            waspada
                            <span class="h-1.5 w-1.5 rounded-full bg-[#c9f28a]"></span>
                        </span>

                        <span class="font-mono text-[10px] uppercase tracking-wider
                                     text-[#4d7363]">
                            Admin Workspace
                        </span>
                    </div>
                </a>

                {{-- Label navigasi --}}
                <div class="mb-2 px-2 font-mono text-[10px] font-bold uppercase
                            tracking-wider text-slate-400 dark:text-[#527364]">
                    Manajemen Sistem
                </div>

                <nav class="space-y-1.5">

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                        text-xs font-bold transition
                        {{ ($activeMenu ?? '') === 'dashboard'
                            ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-[#90aba0] dark:hover:bg-[#12231c] dark:hover:text-white' }}">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>

                        <span>Dashboard</span>
                    </a>

                    {{-- Manajemen Pengguna --}}
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                        text-xs font-bold transition
                        {{ ($activeMenu ?? '') === 'users'
                            ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-[#90aba0] dark:hover:bg-[#12231c] dark:hover:text-white' }}">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>

                        <span>Manajemen Pengguna</span>
                    </a>

                    {{-- Moderasi Postingan --}}
                    <a href="{{ route('admin.discussions.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                        text-xs font-bold transition
                        {{ ($activeMenu ?? '') === 'discussions'
                            ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-[#90aba0] dark:hover:bg-[#12231c] dark:hover:text-white' }}">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                        </svg>

                        <span>Moderasi Postingan</span>
                    </a>

                    {{-- Laporan Diskusi --}}
                    <a href="{{ route('admin.reports.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                        text-xs font-bold transition
                        {{ ($activeMenu ?? '') === 'reports'
                            ? 'bg-[#c9f28a] text-[#0b1411] shadow-[0_2px_10px_rgba(201,242,138,0.25)]'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-[#90aba0] dark:hover:bg-[#12231c] dark:hover:text-white' }}">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>

                        <span>Laporan Diskusi</span>
                    </a>

                    {{-- Akses Publik --}}
                    <div class="px-2 pb-1 pt-4 font-mono text-[10px] font-bold
                                uppercase tracking-wider text-slate-400
                                dark:text-[#527364]">
                        Akses Publik
                    </div>

                    <a href="{{ route('forum.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                               text-xs font-bold text-slate-600 transition
                               hover:bg-slate-100 hover:text-slate-900
                               dark:text-[#90aba0] dark:hover:bg-[#12231c]
                               dark:hover:text-white">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-1.414-.586L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586" />
                        </svg>

                        <span>Lihat Forum Publik</span>
                    </a>

                    <a href="{{ route('assessments.create') }}"
                        class="flex items-center gap-3 rounded-xl px-3.5 py-2.5
                               text-xs font-bold text-slate-600 transition
                               hover:bg-slate-100 hover:text-slate-900
                               dark:text-[#90aba0] dark:hover:bg-[#12231c]
                               dark:hover:text-white">

                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>

                        <span>Halaman Cek Risiko</span>
                    </a>
                </nav>
            </div>

            {{-- Profil dan Logout --}}
            <div class="border-t border-slate-100 pt-4 dark:border-[#172c21]">
                <div class="flex items-center justify-between gap-2">

                    <div class="flex min-w-0 items-center gap-2.5">
                        <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center
                                    rounded-full bg-[#c9f28a] text-xs font-bold
                                    uppercase text-[#0b1411]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">
                            <div class="truncate text-xs font-bold text-slate-800
                                        dark:text-white">
                                {{ auth()->user()->name }}
                            </div>

                            <div class="font-mono text-[10px] text-slate-400
                                        dark:text-[#6e8d80]">
                                Administrator
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="rounded-lg p-2 text-slate-400 transition
                                   hover:bg-rose-50 hover:text-rose-500
                                   dark:hover:bg-rose-950/30"
                            title="Logout"
                            aria-label="Logout">

                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex min-h-screen min-w-0 flex-col lg:pl-64">

            {{-- Topbar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between
                           border-b border-slate-200 bg-white/95 px-4 backdrop-blur
                           sm:px-8 dark:border-[#1a3328] dark:bg-[#0d1813]/90">

                <div class="flex items-center gap-3">

                    <button type="button"
                        onclick="toggleAdminSidebar()"
                        class="rounded-lg p-2 text-slate-500 transition
                               hover:bg-slate-100 dark:hover:bg-[#152a20]
                               lg:hidden"
                        aria-label="Buka atau tutup menu"
                        aria-controls="adminSidebar">

                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <span class="font-mono text-xs font-bold uppercase tracking-wider
                                 text-slate-700 sm:text-sm dark:text-[#a0c5b5]">
                        @yield('breadcrumb', 'Dashboard')
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <x-theme-toggle />

                    <div class="hidden items-center gap-2 rounded-full border
                                border-emerald-500/30 bg-emerald-950/40 px-3 py-1
                                font-mono text-xs text-emerald-400 sm:inline-flex">
                        <span class="h-1.5 w-1.5 animate-pulse rounded-full
                                     bg-emerald-400"></span>
                        Admin Workspace
                    </div>
                </div>
            </header>

            {{-- Halaman aktif --}}
            <main class="mx-auto w-full max-w-7xl flex-1 p-4 sm:p-8">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- JavaScript sidebar mobile --}}
    <script>
        function toggleAdminSidebar(forceState) {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminSidebarOverlay');

            if (!sidebar || !overlay) return;

            const isOpen = sidebar.classList.contains('translate-x-0');
            const shouldOpen = typeof forceState === 'boolean'
                ? forceState
                : !isOpen;

            sidebar.classList.toggle('-translate-x-full', !shouldOpen);
            sidebar.classList.toggle('translate-x-0', shouldOpen);
            overlay.classList.toggle('hidden', !shouldOpen);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                toggleAdminSidebar(false);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>