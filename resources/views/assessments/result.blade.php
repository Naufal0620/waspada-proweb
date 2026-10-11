<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pemeriksaan — WASPADA</title>

    <style>
        * { box-sizing: border-box; }

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
            max-width: 760px;
            margin: 48px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border: 1px solid #e5eaf2;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(20, 40, 80, .04);
        }

        .label {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
        }

        h1 { margin: 8px 0 12px; }

        .risk {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 999px;
            font-size: 14px;
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

        .description { color: #64748b; }

        .list {
            padding-left: 22px;
        }

        .list li { margin: 10px 0; }

        .notice {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            color: #475569;
            font-size: 13px;
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            margin-top: 22px;
            padding: 12px 18px;
            background: #155eef;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
        }

        .button:hover { background: #124ac2; }
    </style>
</head>
<body>
    <header>WASPADA</header>

    <main>
        <section class="card">
            <div class="label">Hasil pemeriksaan</div>

            @php
                $riskLabels = [
                    'low' => 'Risiko Rendah',
                    'warning' => 'Perlu Diwaspadai',
                    'high' => 'Risiko Tinggi',
                ];

                $riskDescriptions = [
                    'low' => 'Indikator yang dipilih belum memenuhi pola risiko yang terdaftar. Ini bukan berarti transaksi pasti aman.',
                    'warning' => 'Indikator yang dipilih cocok dengan pola yang perlu diwaspadai. Periksa kembali permintaan dan identitas pihak terkait.',
                    'high' => 'Indikator yang dipilih cocok dengan pola berisiko tinggi. Tunda transaksi dan jangan berikan OTP atau kata sandi.',
                ];
            @endphp

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

            <h2>Indikator yang kamu pilih</h2>

            <ul class="list">
                @foreach ($assessment->indicators as $indicator)
                    <li>{{ $indicator->label }}</li>
                @endforeach
            </ul>

            <div class="notice">
                <strong>Ingat:</strong>
                hasil ini berdasarkan pencocokan pola yang terdaftar,
                bukan verifikasi pasti terhadap pihak atau transaksi.
                Jangan membagikan OTP, kata sandi, atau data rahasia
                kepada pihak yang tidak dapat diverifikasi.
            </div>

            <a class="button" href="{{ route('assessments.create') }}">
                Periksa Situasi Lain
            </a>
        </section>
    </main>
</body>
</html>
