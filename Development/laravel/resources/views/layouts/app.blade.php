<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI XXI')</title>

    {{-- Tailwind & Font --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Global Style --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #000;
            color: white;
            min-height: 100vh;
        }
        .nav-btn {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .nav-btn-primary {
            background-color: #e50914;
            color: white;
        }
        .nav-btn-primary:hover {
            background-color: #b20710;
        }
        .nav-btn-outline {
            border: 1px solid #e50914;
            color: white;
        }
        .nav-btn-outline:hover {
            background-color: #e50914;
            color: white;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-black text-white">

    {{-- ✅ NAVBAR: Cinematic Netflix Style --}}
    <header class="fixed top-0 left-0 w-full z-50 bg-black border-b border-neutral-800">
        <div class="flex items-center justify-between px-6 md:px-12 py-4">

            {{-- 🔥 Logo SI XXI --}}
            <a href="{{ route('home') }}" class="text-3xl font-extrabold tracking-wide">
                <span class="text-white">SI</span><span class="text-red-600"> XXI</span>
            </a>

            {{-- 🔥 Menu kanan (Login/Register atau Profil) --}}
            <div class="flex items-center space-x-4 text-sm font-medium">
                @auth
                    <span class="hidden sm:block text-gray-300">
                        Hi, {{ Auth::user()->name }}
                    </span>

                    {{-- Dropdown Profile --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center font-semibold text-white hover:ring-2 hover:ring-red-600 transition">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-3 w-56 bg-neutral-900 border border-neutral-800 rounded-xl shadow-xl z-50">
                            <div class="px-4 py-3 border-b border-neutral-800">
                                <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-neutral-800">
                                    My m.tix
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-neutral-800 text-red-500">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Register</a>
                @endguest
            </div>
        </div>
    </header>

    {{-- Spacer agar konten tidak ketiban header --}}
    <div class="h-20"></div>

    {{-- ✅ MAIN CONTENT --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Scripts --}}
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
