<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemeriksaan Risiko — WASPADA</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f6f8fc;
            color: #172033;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .navbar {
            background: #fff;
            border-bottom: 1px solid #e8edf4;
            padding: 18px 7%;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #155eef;
            letter-spacing: -0.5px;
        }

        .container {
            max-width: 850px;
            margin: 48px auto;
            padding: 0 20px;
        }

        .eyebrow {
            color: #155eef;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h1 {
            margin: 10px 0;
            font-size: clamp(28px, 5vw, 40px);
            line-height: 1.2;
        }

        .intro {
            color: #64748b;
            max-width: 650px;
            margin-bottom: 28px;
        }

        .card {
            background: white;
            border: 1px solid #e5eaf2;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(20, 40, 80, .04);
        }

        .section-title {
            margin: 0 0 5px;
            font-size: 20px;
        }

        .muted {
            color: #64748b;
            font-size: 14px;
            margin-top: 0;
        }

        .indicator-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .indicator {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: .2s;
        }

        .indicator:hover {
            border-color: #8bb5ff;
            background: #f8fbff;
        }

        .indicator:has(input:checked) {
            border-color: #155eef;
            background: #eff6ff;
        }

        .indicator input {
            width: 17px;
            height: 17px;
            margin-top: 4px;
            accent-color: #155eef;
            flex-shrink: 0;
        }

        .indicator strong {
            display: block;
            font-size: 14px;
        }

        .category {
            color: #64748b;
            font-size: 12px;
            text-transform: capitalize;
        }

        .error {
            margin-top: 18px;
            padding: 12px 14px;
            background: #fff1f2;
            color: #be123c;
            border-radius: 10px;
            font-size: 14px;
        }

        .button {
            width: 100%;
            margin-top: 24px;
            border: 0;
            border-radius: 10px;
            padding: 15px;
            background: #155eef;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .button:hover { background: #124ac2; }

        .notice {
            margin-top: 18px;
            color: #64748b;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container { margin: 30px auto; }
            .card { padding: 20px; }
            .indicator-list { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="brand">WASPADA</div>
    </header>

    <main class="container">
        <div class="eyebrow">Pemeriksaan risiko digital</div>

        <h1>Kenali risikonya sebelum bertransaksi.</h1>

        <p class="intro">
            Pilih tanda-tanda yang kamu temukan pada situasi yang sedang
            dihadapi. WASPADA akan membandingkannya dengan pola risiko
            yang telah terdaftar.
        </p>

        <form action="{{ route('assessments.store') }}" method="POST">
            @csrf

            <section class="card">
                <h2 class="section-title">Apa yang kamu temukan?</h2>

                <p class="muted">
                    Pilih satu atau lebih indikator yang sesuai.
                </p>

                @if ($errors->any())
                    <div class="error" role="alert">
                        {{ $errors->first('indicators') ??
                           'Periksa kembali pilihan indikator kamu.' }}
                    </div>
                @endif

                <div class="indicator-list">
                    @forelse ($indicators as $indicator)
                        <label class="indicator">
                            <input
                                type="checkbox"
                                name="indicators[]"
                                value="{{ $indicator->id }}"
                                @checked(
                                    in_array(
                                        $indicator->id,
                                        old('indicators', [])
                                    )
                                )
                            >

                            <span>
                                <strong>{{ $indicator->label }}</strong>
                                <span class="category">
                                    {{ $indicator->category }}
                                </span>
                            </span>
                        </label>
                    @empty
                        <p>
                            Belum ada indikator aktif. Silakan coba lagi
                            setelah indikator tersedia.
                        </p>
                    @endforelse
                </div>

                @if ($indicators->isNotEmpty())
                    <button class="button" type="submit">
                        Periksa Risiko
                    </button>
                @endif

                <p class="notice">
                    Hasil pemeriksaan merupakan indikasi awal,
                    bukan jaminan bahwa transaksi aman atau penipuan.
                </p>
            </section>
        </form>
    </main>
</body>
</html>
