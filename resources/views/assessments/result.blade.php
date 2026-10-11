<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pemeriksaan — WASPADA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f6f8fc;
            color: #172033;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background: white;
            border-bottom: 1px solid #e8edf4;
            padding: 18px 7%;
            color: #155eef;
            font-size: 22px;
            font-weight: 800;
        }

        main {
            max-width: 820px;
            margin: 40px auto;
            padding: 0 20px 40px;
        }

        .card {
            background: white;
            border: 1px solid #e5eaf2;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 8px 30px rgba(20, 40, 80, .04);
        }

        .label {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        h1 {
            margin: 8px 0 12px;
            font-size: clamp(25px, 5vw, 32px);
            line-height: 1.3;
        }

        h2 {
            font-size: 19px;
            margin: 0 0 16px;
        }

        h3 {
            font-size: 16px;
            margin: 0 0 8px;
        }

        p {
            margin: 8px 0;
        }

        .risk {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .low {
            background: #dcfce7;
            color: #166534;
        }

        .warning {
            background: #fef3c7;
            color: #92400e;
        }

        .high {
            background: #fee2e2;
            color: #991b1b;
        }

        .description {
            color: #64748b;
            margin-top: 16px;
        }

        .section-heading {
            margin-bottom: 16px;
        }

        .pattern {
            padding: 18px;
            border: 1px solid #e5eaf2;
            border-radius: 12px;
            margin-top: 12px;
        }

        .pattern-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pattern p {
            color: #64748b;
            font-size: 14px;
        }

        .empty {
            padding: 18px;
            border-radius: 12px;
            background: #f8fafc;
            color: #64748b;
            font-size: 14px;
        }

        .list {
            padding-left: 22px;
            margin-bottom: 0;
        }

        .list li {
            margin: 9px 0;
        }

        .notice {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            color: #475569;
            font-size: 13px;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            margin-top: 8px;
            padding: 12px 18px;
            background: #155eef;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
            transition: background .2s;
        }

        .button:hover {
            background: #124ac2;
        }

        footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            padding: 0 20px 25px;
        }

        @media (max-width: 600px) {
            header {
                padding: 16px 20px;
            }

            main {
                margin-top: 24px;
                padding: 0 14px 30px;
            }

            .card {
                padding: 22px 18px;
            }
        }
    </style>
</head>
<body>
    <header>WASPADA</header>

    <main>
        @php
            $riskLabels = [
                'low' => 'Risiko Rendah',
                'warning' => 'Perlu Diwaspadai',
                'high' => 'Risiko Tinggi',
            ];

            $riskDescriptions = [
                'low' => 'Indikator yang dipilih belum memenuhi pola risiko yang terdaftar. Hal ini bukan jaminan bahwa transaksi aman.',
                'warning' => 'Indikator yang dipilih cocok dengan pola yang perlu diwaspadai. Periksa kembali permintaan dan identitas pihak terkait.',
                'high' => 'Indikator yang dipilih cocok dengan pola berisiko tinggi. Pertimbangkan untuk menunda transaksi dan jangan membagikan OTP atau kata sandi.',
            ];

            $recommendations = [
                'low' => [
                    'Tetap verifikasi identitas pihak terkait.',
                    'Periksa informasi transaksi sebelum menyetujui pembayaran.',
                    'Jangan membagikan OTP, kata sandi, atau data rahasia.',
                ],
                'warning' => [
                    'Periksa kembali identitas dan klaim pihak yang menghubungi.',
                    'Jangan terburu-buru mengikuti permintaan pembayaran.',
                    'Verifikasi informasi melalui saluran resmi yang kamu cari sendiri.',
                ],
                'high' => [
                    'Tunda transaksi sampai kebenaran informasi terverifikasi.',
                    'Jangan kirim uang atau kode OTP berdasarkan instruksi yang mencurigakan.',
                    'Jika sudah terlanjur bertransaksi, segera hubungi bank atau penyedia layanan terkait.',
                ],
            ];
        @endphp

        <section class="card">
            <div class="label">Hasil pemeriksaan</div>

            <h1>
                {{ $riskLabels[$assessment->risk_level] ?? 'Hasil Pemeriksaan' }}
            </h1>

            <span class="risk {{ $assessment->risk_level }}">
                {{ strtoupper($assessment->risk_level) }}
            </span>

            <p class="description">
                {{ $riskDescriptions[$assessment->risk_level] ??
                    'Periksa situasi kamu dengan hati-hati.' }}
            </p>
        </section>

        <section class="card">
            <div class="section-heading">
                <div class="label">Analisis pola</div>
                <h2>Pola yang terdeteksi</h2>
            </div>

            @forelse ($matchedPatterns as $pattern)
                <article class="pattern">
                    <div class="pattern-header">
                        <h3>{{ $pattern->name }}</h3>

                        <span class="risk {{ $pattern->risk_level }}">
                            {{ strtoupper($pattern->risk_level) }}
                        </span>
                    </div>

                    <p>{{ $pattern->description }}</p>

                    <div class="label" style="margin-top: 14px;">
                        Indikator pola
                    </div>

                    <ul class="list">
                        @foreach ($pattern->indicators as $patternIndicator)
                            <li>{{ $patternIndicator->label }}</li>
                        @endforeach
                    </ul>
                </article>
            @empty
                <div class="empty">
                    Belum ada pola terdaftar yang seluruh indikator
                    aktifnya cocok dengan pilihan kamu. Tetap berhati-hati
                    karena modus baru mungkin belum tercatat di sistem.
                </div>
            @endforelse
        </section>

        <section class="card">
            <h2>Indikator yang kamu pilih</h2>

            <ul class="list">
                @forelse ($assessment->indicators as $indicator)
                    <li>{{ $indicator->label }}</li>
                @empty
                    <li>Tidak ada indikator yang tercatat.</li>
                @endforelse
            </ul>
        </section>

        <section class="card">
            <h2>Saran tindakan</h2>

            <ul class="list">
                @foreach ($recommendations[$assessment->risk_level] ?? [] as $recommendation)
                    <li>{{ $recommendation }}</li>
                @endforeach
            </ul>

            <div class="notice">
                <strong>Penting:</strong>
                hasil ini berasal dari pencocokan indikator dengan pola
                yang terdaftar di WASPADA. Sistem tidak memverifikasi
                identitas pihak atau menjamin keamanan transaksi secara
                pasti. Gunakan hasil ini sebagai bahan pertimbangan,
                bukan satu-satunya dasar keputusan.
            </div>

            <a class="button" href="{{ route('assessments.create') }}">
                Periksa Situasi Lain
            </a>
        </section>
    </main>

    <footer>
        WASPADA &mdash; Kenali pola, periksa risiko, dan bertindak dengan hati-hati.
    </footer>
</body>
</html>
