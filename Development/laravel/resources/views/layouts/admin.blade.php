    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  <div class="flex min-h-screen">
    <aside class="w-64 bg-gray-900 text-white p-5 space-y-6">
      <h2 class="text-xl font-bold">🎬 Cinema XXI Admin</h2>
      <nav class="space-y-3">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.genres.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Genres</a>
        <a href="{{ route('admin.movies.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Movies</a>
        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Users</a>
      </nav>
      <form action="{{ route('logout') }}" method="POST" class="pt-10">
        @csrf
        <button class="bg-red-600 w-full py-2 rounded hover:bg-red-700">Logout</button>
      </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      @yield('content')
    </main>
  </div>

</body>
</html>
