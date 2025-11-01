<!DOCTYPE html>
<html>
<head><title>Dashboard Admin</title></head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ Auth::user()->username }} ({{ Auth::user()->role->role_name }})</p>
    <form action="{{ route('logout') }}" method="POST">@csrf<button>Logout</button></form>
</body>
</html>
