<!DOCTYPE html>
<html>
<head><title>Dashboard User</title></head>
<body>
    <h1>Dashboard User</h1>
    <p>Halo, {{ Auth::user()->username }} ({{ Auth::user()->role->role_name }})</p>
    <form action="{{ route('logout') }}" method="POST">@csrf<button>Logout</button></form>
</body>
</html>
