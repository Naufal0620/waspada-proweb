<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Panel Moderator') | WASPADA</title>

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
            --success: #16845b;
            --warning: #b7791f;
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

        .app {
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            inset: 0 auto 0 0;
            display: flex;
            flex-direction: column;
            padding: 28px 18px 20px;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 42px;
        }

        .brand-icon {
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

        .brand-name {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .brand-caption {
            display: block;
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
            margin-top: 3px;
            letter-spacing: 0;
        }

        .nav-label {
            padding: 0 12px;
            margin: 0 0 12px;
            color: #9aa4b5;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            color: #69768b;
            font-weight: 600;
            transition: .2s;
        }

        .nav-link:hover {
            background: #f5f7ff;
            color: var(--primary);
        }

        .nav-link.active {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-icon {
            width: 21px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .sidebar-note {
            background: #f5f7ff;
            border: 1px solid #e7ebff;
            border-radius: 12px;
            padding: 15px;
            margin: 0 2px 22px;
        }

        .sidebar-note strong {
            display: block;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .sidebar-note p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            margin: 0;
        }

        .profile {
            border-top: 1px solid var(--border);
            padding: 20px 5px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
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

        .profile-name {
            font-size: 12px;
            font-weight: 700;
        }

        .profile-role {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
        }

        /* MAIN */

        .main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            height: 76px;
            background: rgba(255, 255, 255, .9);
            border-bottom: 1px solid var(--border);
            padding: 0 38px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .breadcrumb {
            color: var(--muted);
            font-size: 12px;
        }

        .breadcrumb strong {
            color: var(--text);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .panel-badge {
            background: #edf1ff;
            color: var(--primary);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
        }

        .content {
            max-width: 1500px;
            margin: 0 auto;
            padding: 36px 38px 48px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-heading h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(24px, 3vw, 30px);
            letter-spacing: -1px;
            margin: 0 0 9px;
        }

        .page-heading p {
            color: var(--muted);
            margin: 0;
            line-height: 1.7;
        }

        .date-label {
            background: white;
            border: 1px solid var(--border);
            padding: 10px 14px;
            border-radius: 9px;
            color: #68758a;
            white-space: nowrap;
            font-size: 12px;
        }

        /* STATS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 23px;
            box-shadow: 0 3px 12px rgba(25, 42, 80, .025);
            min-width: 0;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 24px;
        }

        .stat-label {
            color: #69768b;
            font-weight: 600;
            line-height: 1.5;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .icon-orange {
            color: #b7791f;
            background: #fff4df;
        }

        .icon-blue {
            color: #315cf5;
            background: #edf1ff;
        }

        .icon-green {
            color: #16845b;
            background: #e4f7ee;
        }

        .stat-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 34px;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .stat-description {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* PANELS */

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 15px;
            box-shadow: 0 3px 12px rgba(25, 42, 80, .025);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 23px 25px;
            border-bottom: 1px solid var(--border);
        }

        .panel-header h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 16px;
            margin: 0 0 6px;
            letter-spacing: -.3px;
        }

        .panel-header p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
        }

        .text-link {
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 620px;
        }

        th {
            background: #fafbfe;
            color: #8290a5;
            text-align: left;
            padding: 14px 25px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 700;
        }

        td {
            padding: 18px 25px;
            border-top: 1px solid #f0f2f7;
            font-size: 12px;
            vertical-align: middle;
        }

        .discussion-title {
            color: #202b3c;
            font-weight: 700;
            line-height: 1.6;
        }

        .sub-text {
            color: var(--muted);
            margin-top: 5px;
            font-size: 11px;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff3d9;
            color: #9b6812;
        }

        .status-published {
            background: #e1f7eb;
            color: #16794f;
        }

        .status-reviewed {
            background: #e8efff;
            color: #3157bc;
        }

        .status-dismissed {
            background: #f0f2f6;
            color: #657184;
        }

        .status-actioned {
            background: #fce8e8;
            color: #b33a3a;
        }

        .empty-state {
            padding: 42px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            margin: 0 auto 15px;
            background: #f0f4ff;
            color: var(--primary);
            border-radius: 16px;
            font-size: 24px;
        }

        .empty-state h3 {
            font-size: 14px;
            margin: 0 0 8px;
        }

        .empty-state p {
            font-size: 12px;
            color: var(--muted);
            margin: 0;
            line-height: 1.7;
        }

        /* MODERATION NOTICE */

        .notice {
            border: 1px solid #e1e8ff;
            background: #f0f4ff;
            padding: 19px 22px;
            border-radius: 13px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .notice-icon {
            color: var(--primary);
            font-size: 21px;
        }

        .notice h3 {
            font-size: 13px;
            margin: 0 0 7px;
        }

        .notice p {
            color: #64718a;
            font-size: 12px;
            line-height: 1.8;
            margin: 0;
        }

        /* RESPONSIVE */

        .menu-toggle {
            display: none;
            border: 1px solid var(--border);
            background: white;
            border-radius: 8px;
            padding: 8px 11px;
            cursor: pointer;
        }

        @media (max-width: 1100px) {
            :root {
                --sidebar-width: 220px;
            }

            .content {
                padding: 30px 24px;
            }

            .topbar {
                padding: 0 24px;
            }

            .stats-grid {
                gap: 12px;
            }

            .stat-card {
                padding: 18px;
            }
        }

        @media (max-width: 760px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
                box-shadow: 10px 0 35px rgba(0, 0, 0, .06);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                height: 65px;
                padding: 0 18px;
            }

            .menu-toggle {
                display: inline-block;
            }

            .content {
                padding: 27px 17px 35px;
            }

            .page-heading {
                flex-direction: column;
                margin-bottom: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-top {
                margin-bottom: 14px;
            }

            .stat-value {
                font-size: 29px;
            }

            .panel-header {
                padding: 19px;
            }

            .panel-header p {
                line-height: 1.6;
            }

            th,
            td {
                padding: 15px 17px;
            }

            .date-label {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="app">

        <aside class="sidebar" id="sidebar">
            <a href="{{ route('moderator.dashboard') }}" class="brand">
                <div class="brand-icon">W</div>
                <div class="brand-name">
                    WASPADA
                    <span class="brand-caption">Trust & Safety Center</span>
                </div>
            </a>

            <div class="nav-label">Workspace</div>

            <nav class="nav-menu">
                <a href="{{ route('moderator.dashboard') }}"
                    class="nav-link {{ ($activeMenu ?? '') === 'dashboard' ? 'active' : '' }}">
                    <span class="nav-icon">▦</span>
                    Dashboard
                </a>

                <a href="{{ route('moderator.reports.index') }}"
                    class="nav-link {{ ($activeMenu ?? '') === 'reports' ? 'active' : '' }}">
                    <span class="nav-icon">⚑</span>
                    Laporan Diskusi
                </a>

                <a href="{{ route('forum.index') }}"
                    class="nav-link {{ ($activeMenu ?? '') === 'forum' ? 'active' : '' }}">
                    <span class="nav-icon">☷</span>
                    Forum Publik
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="sidebar-note">
                    <strong>🛡️ Moderasi yang bertanggung jawab</strong>
                    <p>
                        Tinjau laporan berdasarkan informasi yang tersedia.
                        Laporan pengguna bukan bukti otomatis bahwa suatu
                        tuduhan benar.
                    </p>
                </div>

                <div class="profile">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="profile-name">
                            {{ auth()->user()->name }}
                        </div>
                        <div class="profile-role">
                            {{ ucfirst(auth()->user()->role) }}
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main">

            <header class="topbar">
                <div style="display:flex;align-items:center;gap:13px;">
                    <button class="menu-toggle" type="button"
                        onclick="document.getElementById('sidebar').classList.toggle('open')"
                        aria-label="Buka navigasi">
                        ☰
                    </button>

                    <strong>@yield('breadcrumb', 'Dashboard')</strong>
                </div>

                <div class="topbar-right">
                    <div class="panel-badge">● Panel Moderasi</div>
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="content">
                @yield('content')
            </div>
        </main>

        @stack('scripts')
    </div>
</body>

</html>
