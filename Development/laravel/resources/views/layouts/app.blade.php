<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinema XXI')</title>

    {{-- Tailwind & Font --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Global Style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #e8f6ff, #ffffff);
            min-height: 100vh;
        }

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

    @stack('styles')
</head>

<body class="min-h-screen flex flex-col">

    {{-- ✅ Sticky Navbar Global --}}
    <header
        x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
        :class="scrolled ? 'backdrop-blur-md bg-white/90 shadow-sm' : 'bg-white'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 border-b border-gray-100"
    >
        <div class="flex items-center justify-between px-6 md:px-12 py-4">
            {{-- Logo dan Lokasi --}}
            <div class="flex items-center space-x-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Cinema_XXI_logo.svg"
                    alt="Cinema XXI" class="h-6">

                <button class="flex items-center text-gray-700 font-medium border border-gray-200 px-3 py-1 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 1.104-.896 2-2 2s-2-.896-2-2 .896-2 2-2 2 .896 2 2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zM4.929 19.071a10 10 0 1114.142 0" />
                    </svg>
                    Choose
                </button>
            </div>

            {{-- Menu kanan (Profil / Login / Register) --}}
            <div class="flex items-center space-x-6 text-sm font-medium">
                @auth
                    <span class="text-gray-700 hidden sm:block">
                        Hi, {{ Auth::user()->name }}
                    </span>

                    {{-- Dropdown Profile --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-9 h-9 bg-gray-200 rounded-full flex items-center justify-center font-semibold text-gray-800 hover:ring-2 hover:ring-teal-500 transition">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-3 w-60 bg-white/90 backdrop-blur-md border border-gray-100 rounded-xl shadow-lg z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    My m.tix
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest
                    {{-- Kalau belum login --}}
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-outline">Login</a>
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary">Register</a>
                @endguest
            </div>
        </div>
    </header>

    {{-- Spacer biar konten gak ketiban header --}}
    <div class="h-20"></div>

    {{-- Konten utama --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Script tambahan --}}
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
