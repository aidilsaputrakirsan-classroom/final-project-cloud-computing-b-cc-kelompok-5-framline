<!DOCTYPE html>
<html>
<head>
    <title>Register - SI XXI</title>
</head>
<body>
    <h2>Daftar Akun Baru</h2>
    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif
    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
</body>
</html>
