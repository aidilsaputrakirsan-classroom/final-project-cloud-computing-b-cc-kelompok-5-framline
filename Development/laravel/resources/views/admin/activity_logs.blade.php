@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Log Aktivitas Pengguna</h1>

    <div class="overflow-x-auto rounded-xl shadow-md">
        <table class="min-w-full bg-white border border-gray-300 rounded-xl overflow-hidden">
            <thead>
                <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Action</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Timestamp (WITA)</th>
                    <th class="py-3 px-6 text-left">Detail</th>
                </tr>
            </thead>

            <tbody class="text-gray-700 text-sm font-light">
                @forelse ($logs as $log)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                        <td class="py-3 px-6 whitespace-nowrap">
                            {{ $log->user ? $log->user->name : 'Guest' }}
                        </td>

                        <td class="py-3 px-6">
                            {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                        </td>

                        <td class="py-3 px-6">
                            @if ($log->action === 'login')
                                User logged in
                            @elseif ($log->action === 'logout')
                                User logged out
                            @elseif ($log->action === 'register')
                                User registered
                            @elseif ($log->action === 'add_favorite')
                                Added to favorites: {{ $log->film ? $log->film->title : '' }}
                            @elseif ($log->action === 'remove_favorite')
                                Removed from favorites: {{ $log->film ? $log->film->title : '' }}
                            @elseif ($log->action === 'watch_trailer')
                                Watched trailer: {{ $log->film ? $log->film->title : '' }}
                            @elseif ($log->action === 'open_film_detail')
                                Opened film detail: {{ $log->film ? $log->film->title : '' }}
                            @else
                                -
                            @endif
                        </td>

                        <td class="py-3 px-6">
                            {{ $log->performed_at->timezone('Asia/Makassar')->format('d M Y, H:i') }} WITA
                        </td>

                        <td class="py-3 px-6">
                            @if ($log->meta)
                                <pre class="whitespace-pre-wrap break-words bg-gray-50 p-2 rounded border text-xs">
{{ json_encode($log->meta, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}
                                </pre>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-600">No activity logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
