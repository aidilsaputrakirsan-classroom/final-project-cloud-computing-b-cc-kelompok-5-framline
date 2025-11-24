<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI XXI')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
   
</head>

<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    {{-- Header Navbar --}}
    <header class="flex justify-between items-center px-6 md:px-12 py-4 bg-white dark:bg-gray-800 shadow">

        {{-- Logo --}}
        <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            SI <span class="text-red-600 dark:text-red-400">XXI</span>
        </span>

        {{-- Bagian Kanan Navbar --}}
        <div class="flex items-center space-x-6 text-sm font-medium">

            {{-- Toggle Tema --}}
            <button 
                id="themeToggle"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition"
            >
                <!-- Icon Light -->
                <svg id="iconLight" xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-yellow-500"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 18a6 6 0 100-12 6 6 0 000 12z"/>
                </svg>

                <!-- Icon Dark -->
                <svg id="iconDark" xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 text-gray-200 hidden"
                    viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21.64 13a1 1 0 00-1.05-.14 8 8 0 01-10.45-10.45 1 1 0 00-.14-1.05A1 1 0 008 2a10 10 0 1014 14 1 1 0 00-.36-1z"/>
                </svg>
            </button>

                @auth
                    <span class="hidden sm:block text-red-500 dark:text-gray-300">
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
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const html = document.documentElement;
            const toggleBtn = document.getElementById("themeToggle");
            const iconLight = document.getElementById("iconLight");
            const iconDark = document.getElementById("iconDark");

            // Apply saved theme
            if (localStorage.getItem("theme") === "dark") {
                html.classList.add("dark");
                iconLight.classList.add("hidden");
                iconDark.classList.remove("hidden");
            } else {
                html.classList.remove("dark");
                iconLight.classList.remove("hidden");
                iconDark.classList.add("hidden");
            }

            toggleBtn.addEventListener("click", () => {
                html.classList.toggle("dark");
                const isDark = html.classList.contains("dark");

                // Update icons
                if (isDark) {
                    iconLight.classList.add("hidden");
                    iconDark.classList.remove("hidden");
                    localStorage.setItem("theme", "dark");
                } else {
                    iconLight.classList.remove("hidden");
                    iconDark.classList.add("hidden");
                    localStorage.setItem("theme", "light");
                }
            });
        });
    </script>

</body>
</html>
