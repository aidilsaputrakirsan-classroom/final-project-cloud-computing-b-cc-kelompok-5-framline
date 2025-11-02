<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }
        .content {
            flex: 1;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h3 class="mb-4">My Dashboard</h3>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="#" class="nav-link text-white">🏠 Dashboard</a></li>
            <li><a href="#" class="nav-link text-white">🎬 Data Film</a></li>
            <li><a href="#" class="nav-link text-white">🎭  Genre</a></li>
            <li><a href="#" class="nav-link text-white">👥 Pengguna</a></li>
        </ul>
        <hr>
        <a href="#" class="text-white">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content p-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
