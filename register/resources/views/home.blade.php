@extends('layouts.app')

@section('title', 'Beranda - Cinema XXI')

@section('content')
<style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(to bottom right, #e8f6ff, #ffffff);
        min-height: 100vh;
    }

    .nav-btn {
        @apply px-4 py-2 rounded-full font-semibold transition duration-200;
    }
</style>

<!-- Navbar -->
<header class="flex items-center justify-between p-4 md:px-12 shadow-sm bg-white">
    <div class="flex items-center space-x-4">
        <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Cinema_XXI_logo.svg"
             alt="Cinema XXI" class="h-6">
        <button class="flex items-center text-gray-700 font-medium border border-gray-200 px-3 py-1 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 11c0 1.104-.896 2-2 2s-2-.896-2-2 .896-2 2-2 2 .896 2 2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-.896-2-2-2-2 .896-2 2zM4.929 19.071a10 10 0 1114.142 0" />
            </svg>
            Balikpapan
        </button>
    </div>

    <div class="flex items-center space-x-6 text-sm font-medium">
        <a href="#" class="text-gray-700 hover:text-teal-700">Promos</a>
        <a href="#" class="text-gray-700 hover:text-teal-700">Now Playing</a>
        <a href="#" class="text-gray-700 hover:text-teal-700">Coming Soon</a>

        <!-- Jika sudah login -->
        @auth
        <div class="flex items-center space-x-3">
            <span class="text-gray-800">Hai, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-teal-700 text-white px-4 py-2 rounded-full hover:bg-teal-800">
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </div>
</header>

<!-- Hero Section -->
<section class="text-center mt-10">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-600 mt-2">Enjoy your favorite movies anytime with Cinema XXI</p>

    <div class="mt-6 flex justify-center">
        <div class="relative w-80 md:w-1/2">
            <input type="text" placeholder="Search movies or cinemas"
                   class="w-full px-6 py-3 rounded-full shadow text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 absolute right-5 top-3.5 text-gray-400"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
        </div>
    </div>

    <div class="mt-8 flex justify-center space-x-6">
        <div class="flex flex-col items-center">
            <div class="p-4 border border-teal-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M3 10h18M3 14h18M3 18h18"/>
                </svg>
            </div>
            <p class="mt-2 text-sm font-medium text-gray-700">Cinema</p>
        </div>
        <div class="flex flex-col items-center">
            <div class="p-4 border border-teal-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M12 8v8m0 0l-4-4m4 4l4-4M4 4h16v16H4z"/>
                </svg>
            </div>
            <p class="mt-2 text-sm font-medium text-gray-700">Movies</p>
        </div>
        <div class="flex flex-col items-center">
            <div class="p-4 border border-teal-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M5 12h14M12 5v14"/>
                </svg>
            </div>
            <p class="mt-2 text-sm font-medium text-gray-700">m.food</p>
        </div>
        <div class="flex flex-col items-center">
            <div class="p-4 border border-teal-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-700"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                           d="M20 12H4"/>
                </svg>
            </div>
            <p class="mt-2 text-sm font-medium text-gray-700">Private Booking</p>
        </div>
    </div>
</section>

<!-- Promo Section -->
<section class="mt-10 px-8 md:px-16">
    <div class="flex overflow-x-auto space-x-4 pb-4">
        <img src="https://dummyimage.com/300x150/004d40/ffffff&text=Promo+1" class="rounded-xl shadow-md">
        <img src="https://dummyimage.com/300x150/00695c/ffffff&text=Promo+2" class="rounded-xl shadow-md">
        <img src="https://dummyimage.com/300x150/00897b/ffffff&text=Promo+3" class="rounded-xl shadow-md">
    </div>
</section>

<!-- Now Playing Section -->
<section class="mt-10 px-8 md:px-16">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-gray-800">Now Playing</h2>
        <button class="text-teal-700 font-medium hover:underline">See all →</button>
    </div>
    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
            <img src="https://dummyimage.com/200x280/ccc/fff&text=Movie+1" class="rounded-lg">
        </div>
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
            <img src="https://dummyimage.com/200x280/aaa/fff&text=Movie+2" class="rounded-lg">
        </div>
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
            <img src="https://dummyimage.com/200x280/999/fff&text=Movie+3" class="rounded-lg">
        </div>
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-2">
            <img src="https://dummyimage.com/200x280/777/fff&text=Movie+4" class="rounded-lg">
        </div>
    </div>
</section>
@endsection
