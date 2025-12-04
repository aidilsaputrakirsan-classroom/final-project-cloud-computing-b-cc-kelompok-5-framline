@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <div class="flex items-center justify-between gap-4 mb-4">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-sm font-semibold
                      text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2
                      focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                ← Kembali ke Dashboard
            </a>
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
            Log Aktivitas Pengguna
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Riwayat singkat aktivitas login, favorit, dan interaksi pengguna dengan film.
        </p>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-xs font-semibold uppercase tracking-wide dark:bg-gray-800 dark:text-gray-300">
                        <th class="py-3 px-4 sm:px-6">User</th>
                        <th class="py-3 px-4 sm:px-6">Action</th>
                        <th class="py-3 px-4 sm:px-6">Timestamp (WITA)</th>
                        <th class="py-3 px-4 sm:px-6">Detail</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($logs as $log)
                        @php
                            $filmTitle = $log->film->title ?? ($log->meta['film_title'] ?? null);
                        @endphp

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                            {{-- User --}}
                            <td class="py-3 px-4 sm:px-6 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                {{ $log->user ? $log->user->name : 'Guest' }}
                            </td>

                            {{-- Action --}}
                            <td class="py-3 px-4 sm:px-6 whitespace-nowrap">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                    bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                                    {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                </span>
                            </td>

                            {{-- Timestamp --}}
                            <td class="py-3 px-4 sm:px-6 whitespace-nowrap text-gray-700 dark:text-gray-200">
                                <div class="flex flex-col">
                                    <span>
                                        {{ $log->performed_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $log->performed_at->diffForHumans() }}
                                    </span>
                                </div>
                            </td>

                            {{-- Detail --}}
                            <td class="py-3 px-4 sm:px-6 text-gray-800 dark:text-gray-100">
                                @if ($log->action === 'login')
                                    User logged in
                                @elseif ($log->action === 'logout')
                                    User logged out
                                @elseif ($log->action === 'register')
                                    User registered
                                @elseif ($log->action === 'add_favorite')
                                    Added to favorites:
                                    <span class="font-semibold">
                                        {{ $filmTitle ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'remove_favorite')
                                    Removed from favorites:
                                    <span class="font-semibold">
                                        {{ $filmTitle ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'watch_trailer')
                                    Watched trailer:
                                    <span class="font-semibold">
                                        {{ $filmTitle ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'open_film_detail')
                                    Opened film detail:
                                    <span class="font-semibold">
                                        {{ $filmTitle ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'create_film')
                                    Created new film:
                                    <span class="font-semibold">
                                        {{ $log->meta['film_title'] ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'update_film')
                                    Updated film:
                                    <span class="font-semibold">
                                        {{ $log->meta['film_title'] ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'delete_film')
                                    Deleted film:
                                    <span class="font-semibold">
                                        {{ $log->meta['film_title'] ?? '(unknown film)' }}
                                    </span>
                                @elseif ($log->action === 'create_genre')
                                    Created new genre:
                                    <span class="font-semibold">
                                        {{ $log->meta['genre_name'] ?? '(unknown genre)' }}
                                    </span>
                                @elseif ($log->action === 'update_genre')
                                    Updated genre:
                                    <span class="font-semibold">
                                        {{ $log->meta['genre_name'] ?? '(unknown genre)' }}
                                    </span>
                                @elseif ($log->action === 'delete_genre')
                                    Deleted genre:
                                    <span class="font-semibold">
                                        {{ $log->meta['genre_name'] ?? '(unknown genre)' }}
                                    </span>
                                @elseif ($log->action === 'add_user')
                                    Added new regular user:
                                    <span class="font-semibold">
                                        {{ $log->meta['added_user_name'] ?? '(unknown user)' }} ({{ $log->meta['added_user_email'] ?? '(unknown email)' }})
                                    </span>
                                @elseif ($log->action === 'delete_user')
                                    Deleted regular user:
                                    <span class="font-semibold">
                                        {{ $log->meta['deleted_user_name'] ?? '(unknown user)' }} ({{ $log->meta['deleted_user_email'] ?? '(unknown email)' }})
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-6 px-4 sm:px-6 text-center text-sm text-gray-500 dark:text-gray-400">
                                No activity logs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 bg-gray-50 px-4 py-3 sm:px-6 flex items-center justify-between
                    dark:border-gray-800 dark:bg-gray-900">
            <div class="text-xs text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-700 dark:text-gray-200">
                    {{ $logs->firstItem() ?? 0 }}–{{ $logs->lastItem() ?? 0 }}
                </span>
                of
                <span class="font-semibold text-gray-700 dark:text-gray-200">
                    {{ $logs->total() }}
                </span>
                activities
            </div>
            <div class="text-sm">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
