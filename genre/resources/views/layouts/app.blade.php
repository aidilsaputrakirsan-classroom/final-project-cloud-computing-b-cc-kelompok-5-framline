<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-XXI | {{ $title ?? 'Beranda' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .navbar-brand { font-weight: bold; letter-spacing: 1px; }
    footer { margin-top: 40px; padding: 20px 0; background: #fff; text-align:center; color:#6c757d; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">🎬 SI-XXI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          @if(auth()->user()->isAdmin())
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
          @endif
          <li class="nav-item"><a href="#" class="nav-link">{{ auth()->user()->name }}</a></li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">@csrf
              <button class="btn btn-link nav-link" type="submit">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>

<footer>
  <p>© {{ date('Y') }} SI-XXI. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
