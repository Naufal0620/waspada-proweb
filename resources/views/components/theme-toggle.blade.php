<button type="button" 
        id="theme-toggle-btn"
        class="inline-flex items-center justify-center p-2 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 dark:border-[#234235] dark:bg-[#12231c] dark:text-[#c9f28a] dark:hover:bg-[#193328] transition cursor-pointer shadow-sm select-none"
        title="Beralih Tema (Dark / Light)"
        aria-label="Toggle theme">
    {{-- Sun Icon (shown in dark mode to switch to light) --}}
    <svg id="theme-icon-sun" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>
    {{-- Moon Icon (shown in light mode to switch to dark) --}}
    <svg id="theme-icon-moon" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
    </svg>
</button>

<script>
    (function() {
        function syncIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            const sun = document.getElementById('theme-icon-sun');
            const moon = document.getElementById('theme-icon-moon');
            if (sun && moon) {
                if (isDark) {
                    sun.classList.remove('hidden');
                    moon.classList.add('hidden');
                } else {
                    sun.classList.add('hidden');
                    moon.classList.remove('hidden');
                }
            }
        }

        window.toggleTheme = function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
            syncIcons();
        };

        const btn = document.getElementById('theme-toggle-btn');
        if (btn) {
            btn.addEventListener('click', window.toggleTheme);
        }

        // Run immediately and on DOM load
        syncIcons();
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', syncIcons);
        }
    })();
</script>
