<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Admin') | WASPADA</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary: #315cf5;
            --primary-light: #edf1ff;
            --background: #f6f8fc;
            --surface: #ffffff;
            --text: #182230;
            --muted: #778399;
            --border: #e9edf4;
            --sidebar-width: 250px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background: var(--background);
            color: var(--text);
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .admin-app {
            min-height: 100vh;
        }

        /* SIDEBAR */

        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            inset: 0 auto 0 0;
            display: flex;
            flex-direction: column;
            padding: 28px 18px 20px;
            z-index: 20;
            overflow-y: auto;
            transition: transform .25s ease;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 42px;
        }

        .admin-brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: var(--primary);
            display: grid;
            place-items: center;
            color: white;
            font-size: 22px;
            font-weight: 800;
        }

        .admin-brand-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -.8px;
        }

        .admin-brand-caption {
            display: block;
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
            margin-top: 3px;
        }

        .admin-nav-label {
            padding: 0 12px;
            margin: 0 0 12px;
            color: #9aa4b5;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .admin-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            color: #69768b;
            font-weight: 600;
            transition: .2s;
        }

        .admin-nav-link:hover {
            background: #f5f7ff;
            color: var(--primary);
        }

        .admin-nav-link.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .admin-nav-icon {
            width: 21px;
            text-align: center;
            font-size: 17px;
        }

        .admin-sidebar-bottom {
            margin-top: auto;
            padding-top: 28px;
        }

        .admin-sidebar-note {
            background: #f5f7ff;
            border: 1px solid #e7ebff;
            border-radius: 12px;
            padding: 15px;
            margin: 0 2px 22px;
        }

        .admin-sidebar-note strong {
            display: block;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .admin-sidebar-note p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            margin: 0;
        }

        .admin-profile {
            border-top: 1px solid var(--border);
            padding: 20px 5px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: #e9edff;
            color: var(--primary);
            font-weight: 800;
        }

        .admin-profile-name {
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .admin-profile-role {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        /* MAIN */

        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .admin-topbar {
            min-height: 76px;
            background: rgba(255, 255, 255, .95);
            border-bottom: 1px solid var(--border);
            padding: 14px 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .admin-breadcrumb {
            font-size: 13px;
            font-weight: 700;
        }

        .admin-topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-panel-badge {
            background: #edf1ff;
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
        }

        .admin-content {
            max-width: 1500px;
            margin: 0 auto;
            padding: 36px 38px 48px;
        }

        .admin-menu-toggle {
            display: none;
            border: 1px solid var(--border);
            background: white;
            border-radius: 8px;
            padding: 8px 11px;
            cursor: pointer;
        }

        .admin-sidebar-overlay {
            display: none;
        }

        @media (max-width: 1100px) {
            :root {
                --sidebar-width: 220px;
            }

            .admin-content {
                padding: 30px 24px;
            }

            .admin-topbar {
                padding: 14px 24px;
            }
        }

        @media (max-width: 760px) {
            .admin-sidebar {
                transform: translateX(-100%);
                width: 250px;
                box-shadow: 10px 0 35px rgba(0, 0, 0, .06);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-sidebar-overlay.open {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 15;
                background: rgba(15, 23, 42, .35);
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                min-height: 65px;
                padding: 12px 18px;
            }

            .admin-menu-toggle {
                display: inline-block;
            }

            .admin-content {
                padding: 27px 17px 35px;
            }

            .admin-panel-badge {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="admin-app">

        <aside class="admin-sidebar" id="adminSidebar">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <div class="admin-brand-icon">W</div>

                <div class="admin-brand-name">
                    WASPADA
                    <span class="admin-brand-caption">
                        Administration Center
                    </span>
                </div>
            </a>

            <div class="admin-nav-label">Workspace</div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-nav-link {{ ($activeMenu ?? '') === 'dashboard' ? 'active' : '' }}">
                    <span class="admin-nav-icon">▦</span>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="admin-nav-link {{ ($activeMenu ?? '') === 'users' ? 'active' : '' }}">
                    <span class="admin-nav-icon">♟</span>
                    Manajemen Pengguna
                </a>


                <a href="{{ route('moderator.reports.index') }}"
                    class="admin-nav-link {{ ($activeMenu ?? '') === 'reports' ? 'active' : '' }}">
                    <span class="admin-nav-icon">⚑</span>
                    Laporan Diskusi
                </a>

                <a href="{{ route('forum.index') }}"
                    class="admin-nav-link {{ ($activeMenu ?? '') === 'forum' ? 'active' : '' }}">
                    <span class="admin-nav-icon">☷</span>
                    Forum Publik
                </a>

                {{-- Menu berikutnya ditambahkan saat fitur tersedia. --}}
            </nav>

            <div class="admin-sidebar-bottom">
                <div class="admin-sidebar-note">
                    <strong>⚙️ Administrasi WASPADA</strong>
                    <p>
                        Kelola sistem secara bertanggung jawab.
                        Perubahan akses dan tindakan administratif
                        harus sesuai kewenangan.
                    </p>
                </div>

                <div class="admin-profile">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="admin-profile-name">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="admin-profile-role">
                            Administrator
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="admin-sidebar-overlay" id="adminSidebarOverlay" onclick="toggleAdminSidebar(false)">
        </div>

        <main class="admin-main">
            <header class="admin-topbar">
                <div style="display:flex;align-items:center;gap:13px;">
                    <button class="admin-menu-toggle" type="button" onclick="toggleAdminSidebar()"
                        aria-label="Buka navigasi">
                        ☰
                    </button>

                    <span class="admin-breadcrumb">
                        @yield('breadcrumb', 'Dashboard Admin')
                    </span>
                </div>

                <div class="admin-topbar-right">
                    <div class="admin-panel-badge">
                        ● Panel Administrasi
                    </div>

                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="admin-content">
                @yield('content')
            </div>
        </main>

        @stack('scripts')
    </div>

    <script>
        function toggleAdminSidebar(forceState) {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('adminSidebarOverlay');

            const shouldOpen = typeof forceState === 'boolean' ?
                forceState :
                !sidebar.classList.contains('open');

            sidebar.classList.toggle('open', shouldOpen);
            overlay.classList.toggle('open', shouldOpen);
        }
    </script>
</body>

</html>
