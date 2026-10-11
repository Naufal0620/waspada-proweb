
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - WASPADA</title>
</head>
<body>
    <h1>Buat Akun WASPADA</h1>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label for="name">Nama</label>
        <input id="name" type="text" name="name"
            value="{{ old('name') }}" required autocomplete="name">
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input id="email" type="email" name="email"
            value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password"
            required autocomplete="new-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label for="password_confirmation">Konfirmasi password</label>
        <input id="password_confirmation" type="password"
            name="password_confirmation" required autocomplete="new-password">

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun?
        <a href="{{ route('login') }}">Masuk</a>
    </p>
</body>
</html>
