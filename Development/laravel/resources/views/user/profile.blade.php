@extends('layouts.app')

@section('title', 'My m.tix')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white via-blue-50 to-blue-100 px-6 py-10 text-gray-800 flex flex-col items-center">

    <!-- Konten Tengah -->
    <div class="w-full max-w-2xl">

        <!-- Breadcrumb -->
         <!-- Tombol Dark Mode -->
<button id="themeToggle"
    class="fixed top-5 right-5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 
           shadow-md p-3 rounded-full flex items-center justify-center cursor-pointer transition">
    <i id="themeIcon" class="bi bi-moon-fill text-gray-700 dark:text-yellow-300 text-xl"></i>
</button>

<script>
    // Cek localStorage -> set tema sebelumnya
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }

    // Update ikon sesuai tema
    function updateIcon() {
        const icon = document.getElementById("themeIcon");
        if (document.documentElement.classList.contains('dark')) {
            icon.classList.remove("bi-moon-fill");
            icon.classList.add("bi-sun-fill");
        } else {
            icon.classList.remove("bi-sun-fill");
            icon.classList.add("bi-moon-fill");
        }
    }

    // Jalankan saat awal
    updateIcon();

    // Toggle Tema saat tombol diklik
    document.getElementById("themeToggle").addEventListener("click", function () {
        document.documentElement.classList.toggle("dark");

        // Simpan preferensi
        if (document.documentElement.classList.contains('dark')) {
            localStorage.setItem("theme", "dark");
        } else {
            localStorage.setItem("theme", "light");
        }

        updateIcon();
    });
</script>

        <p class="text-sm text-gray-500 mb-4 text-center md:text-left">Beranda /
            <span class="text-gray-800 font-medium">My m.tix</span>
        </p>

        <!-- Judul -->
        <h1 class="text-3xl font-semibold mb-6 text-center md:text-left">My m.tix</h1>

        <!-- Profil -->
        <div class="flex items-center justify-between bg-white/60 backdrop-blur-sm border border-gray-100 rounded-xl p-5 shadow-sm mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gray-700 text-white font-bold text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="text-lg font-semibold capitalize">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-sm">{{ Auth::user()->phone ?? '628xxxxxxxx' }}</p>
                </div>
            </div>
            <button class="text-gray-500 hover:text-teal-600">
                <i class="bi bi-pencil"></i>
            </button>
        </div>

        <!-- Pengaturan -->
        <div class="space-y-6">

           
            

            <!-- Bagian Aktivitas -->
            <div>
                <h4 class="font-semibold text-gray-600 text-sm uppercase tracking-wider mb-3">Aktivitas Saya</h4>

                <ul class="space-y-2">
                    <!-- Film Favorit -->
                    <li onclick="window.location.href='{{ route('profile.favorites') }}'"
                        class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-heart-fill text-gray-600 text-lg"></i>
                            <span class="font-medium">Daftar Film Favorit</span>
                        </div>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </li>

                    <!-- History Pengguna -->
                    <li onclick="window.location.href='{{ route('profile.history') }}'"
                        class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <i class="bi bi-clock-history text-gray-600 text-lg"></i>
                            <span class="font-medium">Riwayat Tontonan</span>
                        </div>
                        <i class="bi bi-chevron-right text-gray-400"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
