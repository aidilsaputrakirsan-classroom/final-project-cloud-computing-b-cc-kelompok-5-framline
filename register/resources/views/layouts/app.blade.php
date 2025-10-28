<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinema XXI')</title>

    {{-- Tailwind & Font --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Global Style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #e8f6ff, #ffffff);
            min-height: 100vh;
        }

        /* Tambahan kelas nav-btn yang tadinya error karena @apply tidak bisa langsung di style tag */
        .nav-btn {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .nav-btn-primary {
            background-color: #0f766e;
            color: white;
        }

        .nav-btn-primary:hover {
            background-color: #0d665f;
        }

        .nav-btn-outline {
            border: 1px solid #0f766e;
            color: #0f766e;
        }

        .nav-btn-outline:hover {
            background-color: #0f766e;
            color: white;
        }
    </style>

    {{-- Tempat tambahan CSS dari halaman lain --}}
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">
    {{-- Navbar Optional: kalau ingin global navbar bisa diletakkan di sini --}}
    {{-- @include('partials.navbar') --}}

    {{-- Konten utama --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Script tambahan (opsional) --}}
    @stack('scripts')
</body>
</html>
