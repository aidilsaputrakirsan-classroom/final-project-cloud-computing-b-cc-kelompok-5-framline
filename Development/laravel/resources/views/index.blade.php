<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinema XXI - Feel the Movies Beyond</title>
    <link rel="icon" href="/logo.png" />

    <!-- ✅ Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              netflix: '#e50914',
              dark: '#141414',
            },
            fontFamily: {
              sans: ['Poppins', 'sans-serif'],
            },
          },
        },
      };
    </script>

    <!-- ✅ Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- ✅ Font Awesome (for icons) -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
  /* Default: Dark Mode (Tailwind sudah dark) */

  /* LIGHT MODE OVERRIDE */
  body.light {
    background: #f5f5f5 !important;
    color: #111 !important;
  }

  body.light .text-white {
    color: #111 !important;
  }

  body.light .bg-dark,
  body.light .bg-gradient-to-b {
    background: #ffffff !important;
  }

  body.light .bg-slate-800,
  body.light .bg-slate-800\/70,
  body.light .bg-slate-800\/60 {
    background: #e5e7eb !important; /* slate-200 */
  }

  body.light .border-slate-700 {
    border-color: #999 !important;
  }

  body.light input {
    color: #111 !important;
  }

  body.light .text-gray-400 {
    color: #666 !important;
  }
</style>

<script>
  // === THEME SYSTEM ===
  document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "dark";
    document.body.classList.toggle("light", savedTheme === "light");
  });

  function toggleTheme() {
    const isLight = document.body.classList.toggle("light");
    localStorage.setItem("theme", isLight ? "light" : "dark");
  }
</script>

  </head>

  <body class="bg-dark text-white font-sans">
    <section
      class="min-h-screen bg-gradient-to-b from-black via-dark to-black text-white px-8 md:px-16 py-12"
    >
      <!-- Header -->
      <div class="flex justify-between items-center">
        <img src="/logo.png" alt="Cinema XXI" class="h-10" />
        <div class="space-x-4 flex items-center">
          <!-- 🔘 Toggle Theme -->
          <button 
              onclick="toggleTheme()" 
              class="px-3 py-2 border border-netflix rounded-full hover:bg-netflix transition"
          >
              <i class="fa fa-moon"></i>
          </button>

          <a
            href="{{ route('login') }}"
            class="px-4 py-2 border border-netflix rounded-full hover:bg-netflix transition"
          >
            Login
          </a>

          <a
            href="{{ route('register') }}"
            class="px-4 py-2 bg-netflix rounded-full hover:bg-red-600 transition"
          >
            Register
          </a>
        </div>

      </div>

      <!-- Hero Section -->
      <div class="text-center mt-24">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">
          Feel the <span class="text-netflix">Movies</span> Beyond
        </h1>
        <p class="text-gray-400 text-lg mb-8">
          Discover, explore, and experience films like never before.
        </p>
        <div
          class="max-w-2xl mx-auto flex items-center bg-slate-800/70 rounded-full px-5 py-3 shadow-lg backdrop-blur-md"
        >
          <input
            type="text"
            placeholder="Search movies or cinemas..."
            class="flex-grow bg-transparent outline-none text-white placeholder-gray-400"
          />
          <button
            class="p-3 bg-netflix rounded-full hover:bg-red-600 transition"
          >
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

      <!-- Browse Section -->
      <div class="mt-24">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold">Browse by Genre & Year</h2>
          <div class="flex items-center gap-2">
            <select
              class="bg-slate-800 border border-slate-700 rounded px-3 py-2"
            >
              <option>All Years</option>
              <option>2025</option>
              <option>2024</option>
            </select>
            <a href="#" class="text-netflix hover:underline">See All →</a>
          </div>
        </div>

        <div
          class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 text-center"
        >
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Action
          </button>
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Drama
          </button>
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Comedy
          </button>
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Horror
          </button>
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Romance
          </button>
          <button
            class="bg-slate-800/70 hover:bg-netflix/20 border border-slate-700 hover:border-netflix py-3 rounded-xl transition"
          >
            Adventure
          </button>
        </div>
      </div>

      <!-- Now Playing -->
      <div class="mt-24">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-2xl font-semibold">Now Playing</h2>
          <a href="#" class="text-netflix hover:underline">See All →</a>
        </div>

        <div
          class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6"
        >
          <div
            class="bg-slate-800/60 rounded-2xl overflow-hidden hover:scale-105 transition-transform shadow-lg"
          >
            <img
              src="/poster1.jpg"
              alt="Movie"
              class="w-full h-56 object-cover"
            />
            <div class="p-4">
              <h3 class="font-semibold text-lg">Roblox</h3>
              <p class="text-sm text-gray-400">Action | 2025</p>
            </div>
          </div>

          <div
            class="bg-slate-800/60 rounded-2xl overflow-hidden hover:scale-105 transition-transform shadow-lg"
          >
            <img
              src="/poster2.jpg"
              alt="Movie"
              class="w-full h-56 object-cover"
            />
            <div class="p-4">
              <h3 class="font-semibold text-lg">Popopo</h3>
              <p class="text-sm text-gray-400">Comedy | 2024</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
