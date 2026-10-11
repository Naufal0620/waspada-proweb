<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi — WASPADA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            color: #172033;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5eaf1;
            padding: 18px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            color: #155eef;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
        }

        .container {
            width: min(1100px, 90%);
            margin: 40px auto;
        }

        .hero {
            background: #eaf2ff;
            padding: 32px;
            border-radius: 18px;
            margin-bottom: 28px;
        }

        .hero h1 {
            margin: 0 0 12px;
            font-size: clamp(26px, 4vw, 36px);
        }

        .hero p {
            color: #526079;
            line-height: 1.7;
            margin: 0;
        }

        .button {
            display: inline-block;
            background: #155eef;
            color: white;
            border: none;
            padding: 11px 16px;
            border-radius: 9px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .button-outline {
            display: inline-block;
            padding: 10px 15px;
            border: 1px solid #d8dfeb;
            border-radius: 9px;
            background: white;
            font-size: 14px;
        }

        .toolbar {
            display: flex;
            gap: 12px;
            margin-bottom: 22px;
        }

        .toolbar input,
        .toolbar select {
            min-width: 0;
            padding: 12px;
            border: 1px solid #d8dfeb;
            border-radius: 9px;
            background: white;
            font-size: 14px;
        }

        .toolbar input {
            flex: 1;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 16px;
        }

        .discussion-list {
            display: grid;
            gap: 14px;
        }

        .discussion-card {
            background: white;
            border: 1px solid #e5eaf1;
            border-radius: 14px;
            padding: 22px;
        }

        .category {
            display: inline-block;
            background: #eef4ff;
            color: #155eef;
            padding: 5px 9px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }

        .discussion-card h3 {
            margin: 13px 0 8px;
            font-size: 19px;
        }

        .description {
            color: #596579;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
            color: #778196;
            font-size: 13px;
        }

        .empty {
            background: white;
            border: 1px dashed #cbd5e1;
            padding: 35px 20px;
            text-align: center;
            border-radius: 14px;
            color: #596579;
        }

        .pagination {
            margin-top: 24px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 12px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 16px 5%;
                align-items: flex-start;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: flex-end;
                gap: 10px;
            }

            .container {
                margin: 25px auto;
            }

            .hero {
                padding: 23px;
            }

            .toolbar {
                flex-direction: column;
            }

            .toolbar input,
            .toolbar select,
            .toolbar button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <a href="{{ route('assessments.create') }}" class="brand">
            WASPADA
        </a>

        <nav class="nav-links">
            <a href="{{ route('assessments.create') }}">Cek Risiko</a>
            <a href="{{ route('forum.index') }}">Forum</a>

            @auth
                <span>{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="button" type="submit">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}" class="button">Daftar</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div style="background:#e8f7ed;color:#17663a;padding:14px;border-radius:10px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif
        <section class="hero">
            <h1>Forum Diskusi WASPADA</h1>
            <p>
                Kenali pola penipuan melalui pengalaman dan diskusi
                komunitas. Bagikan informasi yang bermanfaat agar
                orang lain lebih waspada sebelum bertransaksi.
            </p>

            <div style="margin-top: 20px;">
                @auth
                    <a href="{{ route('forum.create') }}" class="button">
                        + Buat Diskusi
                    </a>
                @else
                    <a href="{{ route('login') }}" class="button">
                        Masuk untuk Berdiskusi
                    </a>
                @endauth
            </div>
        </section>

        <form action="{{ route('forum.index') }}" method="GET"
              class="toolbar">
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari diskusi atau pola penipuan..."
                aria-label="Cari diskusi"
            >

            <select name="category" aria-label="Filter kategori">
                <option value="">Semua kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->slug }}"
                        @selected(request('category') === $category->slug)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="button">Cari</button>
        </form>

        <h2 class="section-title">Diskusi Terbaru</h2>

        <section class="discussion-list">
            @forelse ($discussions as $discussion)
                <article class="discussion-card">
                    <span class="category">
                        {{ $discussion->category->name }}
                    </span>

                    <h3>
                        <a href="{{ route('forum.show', $discussion->slug) }}">
                            {{ $discussion->title }}
                        </a>
                    </h3>

                    <p class="description">
                        {{ \Illuminate\Support\Str::limit($discussion->body, 180) }}
                    </p>

                    <div class="meta">
                        <span>Oleh {{ $discussion->user->name }}</span>
                        <span>
                            {{ $discussion->created_at->format('d M Y') }}
                        </span>
                        <span>{{ $discussion->comments_count }} komentar</span>
                        <span>{{ $discussion->votes_count }} dukungan</span>
                    </div>
                </article>
            @empty
                <div class="empty">
                    <h3>Belum ada diskusi</h3>
                    <p>
                        @if (request()->filled('q') || request()->filled('category'))
                            Tidak ditemukan diskusi yang sesuai dengan pencarianmu.
                        @else
                            Diskusi yang telah disetujui moderator akan muncul di sini.
                        @endif
                    </p>
                </div>
            @endforelse
        </section>

        <div class="pagination">
            {{ $discussions->links() }}
        </div>

        <p style="margin-top: 30px; color: #778196; font-size: 12px; line-height: 1.7;">
            Informasi yang dibagikan anggota merupakan pengalaman dan
            laporan komunitas, bukan jaminan bahwa suatu pihak telah
            melakukan tindak pidana. Tetap verifikasi informasi sebelum
            mengambil keputusan.
        </p>
    </main>
</body>
</html>
