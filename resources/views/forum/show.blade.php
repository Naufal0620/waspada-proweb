<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $discussion->title }} — WASPADA</title>

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
            background: white;
            border-bottom: 1px solid #e5eaf1;
            padding: 18px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            color: #155eef;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 14px;
        }

        .container {
            width: min(850px, 90%);
            margin: 35px auto;
        }

        .back {
            display: inline-block;
            color: #526079;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .card {
            background: white;
            border: 1px solid #e5eaf1;
            border-radius: 15px;
            padding: 28px;
            margin-bottom: 20px;
        }

        .category {
            display: inline-block;
            background: #eef4ff;
            color: #155eef;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
        }

        h1 {
            font-size: clamp(25px, 4vw, 34px);
            line-height: 1.3;
            margin: 17px 0 12px;
            overflow-wrap: anywhere;
        }

        .meta {
            color: #778196;
            font-size: 13px;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .body-text {
            margin-top: 25px;
            line-height: 1.9;
            color: #364258;
            overflow-wrap: anywhere;
            white-space: pre-line;
        }

        .notice {
            background: #fff8e7;
            color: #795400;
            border: 1px solid #f4e3b1;
            padding: 14px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.7;
            margin-top: 24px;
        }

        h2 {
            font-size: 21px;
            margin: 0 0 20px;
        }

        .comment {
            border-top: 1px solid #edf0f5;
            padding: 18px 0;
        }

        .comment:first-of-type {
            border-top: none;
        }

        .comment-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            color: #778196;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .comment-body {
            color: #364258;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .reply {
            margin: 15px 0 0 22px;
            padding: 14px;
            border-left: 3px solid #dbe7ff;
            background: #f8faff;
            border-radius: 0 8px 8px 0;
        }

        .empty {
            color: #778196;
            line-height: 1.7;
        }

        .button {
            display: inline-block;
            border: none;
            background: #155eef;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 16px 5%;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: flex-end;
                gap: 10px;
            }

            .card {
                padding: 20px;
            }

            .container {
                margin: 25px auto;
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
            @else
                <a href="{{ route('login') }}">Masuk</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div style="padding:14px;background:#e8f7ed;color:#17663a;border-radius:10px;margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="padding:14px;background:#fff0f0;color:#b42318;border-radius:10px;margin-bottom:16px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <a href="{{ route('forum.index') }}" class="back">
            ← Kembali ke forum
        </a>

        <article class="card">

            <div class="vote-section">
                <p>
                    Total vote: <strong>{{ $discussion->votes_count }}</strong>
                </p>

                @auth
                    @php
                        $hasVoted = $discussion
                            ->votes()
                            ->where('user_id', auth()->id())
                            ->exists();
                    @endphp

                    <form action="{{ route('forum.votes.toggle', $discussion->slug) }}" method="POST">
                        @csrf

                        <button type="submit">
                            {{ $hasVoted ? 'Batalkan Vote' : '▲ Beri Vote' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        Login untuk memberi vote
                    </a>
                @endauth
            </div>

            <span class="category">
                {{ $discussion->category->name }}
            </span>

            <h1>{{ $discussion->title }}</h1>

            @auth
                <details style="margin: 20px 0;">
                    <summary style="cursor:pointer;color:#dc3545;font-weight:600;">
                        ⚑ Laporkan Diskusi
                    </summary>

                    <form action="{{ route('forum.reports.store', $discussion->slug) }}" method="POST"
                        style="margin-top:15px;">
                        @csrf

                        <label for="reason">Alasan laporan</label>

                        <select id="reason" name="reason" required>
                            <option value="">Pilih alasan</option>
                            <option value="Informasi menyesatkan">Informasi menyesatkan</option>
                            <option value="Dugaan penipuan">Dugaan penipuan</option>
                            <option value="Spam">Spam</option>
                            <option value="Data pribadi">Memuat data pribadi</option>
                            <option value="Pelecehan">Pelecehan atau serangan personal</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>

                        <label for="details" style="display:block;margin-top:12px;">
                            Keterangan tambahan (opsional)
                        </label>

                        <textarea id="details" name="details" rows="3" maxlength="2000"
                            placeholder="Jelaskan alasan laporan secara singkat..."></textarea>

                        <button type="submit">Kirim Laporan</button>
                    </form>
                </details>
            @endauth


            <div class="meta">
                <span>Oleh {{ $discussion->user->name }}</span>
                <span>
                    {{ $discussion->created_at->format('d M Y, H:i') }}
                </span>
                <span>{{ $discussion->votes_count }} dukungan</span>
            </div>

            <div class="body-text">{{ $discussion->body }}</div>

            <div class="notice">
                Diskusi ini merupakan informasi dari komunitas.
                Verifikasi informasi secara mandiri dan hindari membagikan
                data pribadi, kata sandi, PIN, atau kode OTP.
            </div>
        </article>

        <section class="card">
            <h2>Komentar ({{ $discussion->comments->count() }})</h2>

            @forelse ($discussion->comments as $comment)
                <article class="comment">
                    <div class="comment-meta">
                        <strong>{{ $comment->user->name }}</strong>
                        <span>
                            {{ $comment->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <div class="comment-body">{{ $comment->body }}</div>
                    @auth
                        <button type="button"
                            onclick="document.getElementById('reply-form-{{ $comment->id }}').hidden = !document.getElementById('reply-form-{{ $comment->id }}').hidden">
                            Balas
                        </button>

                        <form id="reply-form-{{ $comment->id }}"
                            action="{{ route('forum.comments.store', $discussion->slug) }}" method="POST" hidden>
                            @csrf

                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                            <textarea name="body" rows="3" minlength="2" maxlength="3000" required placeholder="Tulis balasan..."></textarea>

                            <button type="submit">Kirim Balasan</button>
                        </form>
                    @endauth


                    @foreach ($comment->replies as $reply)
                        <div class="reply">
                            <div class="comment-meta">
                                <strong>{{ $reply->user->name }}</strong>
                                <span>
                                    {{ $reply->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <div class="comment-body">{{ $reply->body }}</div>
                        </div>
                    @endforeach
                </article>
            @empty
                <p class="empty">
                    Belum ada komentar. Jadilah bagian dari diskusi yang
                    bermanfaat bagi komunitas.
                </p>
            @endforelse

            @auth
                <form action="{{ route('forum.comments.store', $discussion->slug) }}" method="POST">
                    @csrf

                    <label for="body">Tulis komentar</label>

                    <textarea id="body" name="body" rows="4" minlength="2" maxlength="3000" required
                        placeholder="Bagikan pendapat atau pengalaman yang relevan...">{{ old('body') }}</textarea>

                    @error('body')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror

                    <button type="submit">Kirim Komentar</button>
                </form>
            @else
                <p>
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                    untuk menulis komentar.
                </p>
            @endauth

        </section>
    </main>
</body>

</html>
