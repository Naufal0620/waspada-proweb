<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Diskusi — WASPADA</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            color: #172033;
        }

        .container {
            width: min(760px, 92%);
            margin: 40px auto;
        }

        .card {
            background: white;
            border: 1px solid #e5eaf1;
            border-radius: 16px;
            padding: 28px;
        }

        h1 { margin-top: 0; }

        .description {
            color: #647087;
            line-height: 1.7;
        }

        label {
            display: block;
            font-weight: 700;
            margin: 20px 0 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8dfeb;
            border-radius: 9px;
            font: inherit;
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        .hint {
            color: #778196;
            font-size: 13px;
            margin-top: 7px;
        }

        .error {
            color: #c62828;
            font-size: 13px;
            margin-top: 6px;
        }

        .notice {
            background: #fff8e7;
            border: 1px solid #f4e3b1;
            border-radius: 10px;
            padding: 14px;
            margin-top: 20px;
            font-size: 13px;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        button, .back {
            padding: 12px 16px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #155eef;
            color: white;
            border: none;
        }

        .back {
            background: white;
            color: #364258;
            border: 1px solid #d8dfeb;
        }

        @media (max-width: 500px) {
            .card { padding: 20px; }
        }
    </style>
</head>

<body>
    <main class="container">
        <a class="back" href="{{ route('forum.index') }}">
            ← Kembali ke forum
        </a>

        <section class="card" style="margin-top: 20px;">
            <h1>Buat Diskusi</h1>

            <p class="description">
                Bagikan pengalaman atau informasi yang dapat membantu
                komunitas mengenali risiko penipuan.
            </p>

            <form action="{{ route('forum.store') }}" method="POST">
                @csrf

                <label for="title">Judul diskusi</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    maxlength="200"
                    minlength="10"
                    required
                    value="{{ old('title') }}"
                    placeholder="Contoh: Tawaran kerja meminta biaya pendaftaran"
                >
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Pilih kategori</option>

                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="body">Isi diskusi</label>
                <textarea
                    id="body"
                    name="body"
                    minlength="30"
                    maxlength="10000"
                    required
                    placeholder="Ceritakan situasinya, tanda-tanda yang kamu temukan, dan hal yang perlu diwaspadai."
                >{{ old('body') }}</textarea>
                <p class="hint">
                    Minimal 30 karakter. Jangan tuliskan kata sandi,
                    PIN, kode OTP, alamat rumah, atau data pribadi orang lain.
                </p>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="notice">
                    Diskusi akan ditinjau moderator sebelum diterbitkan.
                    Sampaikan pengalaman secara faktual dan hindari
                    tuduhan yang belum dapat diverifikasi.
                </div>

                <div class="actions">
                    <button type="submit">Kirim untuk Ditinjau</button>
                    <a class="back" href="{{ route('forum.index') }}">
                        Batal
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
