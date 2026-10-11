
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - WASPADA</title>
</head>
<body>
    <h1>Masuk ke WASPADA</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email"
            value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password"
            required autocomplete="current-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label>
            <input type="checkbox" name="remember" value="1">
            Ingat saya
        </label>

        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
    </p>
    <p><a href="{{ route('assessments.create') }}">Kembali ke cek risiko</a></p>
</body>
</html>
