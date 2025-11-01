<!DOCTYPE html>
<html>
<head>
    <title>Login - SI XXI</title>
</head>
<body>
    <h2>Login ke SI XXI</h2>
    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
</body>
</html>
