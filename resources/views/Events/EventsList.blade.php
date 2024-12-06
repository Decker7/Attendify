@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Event Management</h1>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-3">
            <div class="p-4 bg-blue-100 border-l-4 border-blue-500 rounded-r-lg">
                <div class="font-semibold text-blue-700">Total Events</div>
                <div class="text-2xl font-bold">{{ $events->count() }}</div>
            </div>
            <div class="p-4 bg-green-100 border-l-4 border-green-500 rounded-r-lg">
                <div class="font-semibold text-green-700">Upcoming Events</div>
                <div class="text-2xl font-bold">{{ $events->where('date', '>=', now())->count() }}</div>
            </div>
            <div class="p-4 bg-purple-100 border-l-4 border-purple-500 rounded-r-lg">
                <div class="font-semibold text-purple-700">Past Events</div>
                <div class="text-2xl font-bold">{{ $events->where('date', '<', now())->count() }}</div>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($events->isEmpty())
            <div class="p-4 text-blue-700 bg-blue-100 border-l-4 border-blue-500" role="alert">
                <p class="font-bold">Information</p>
                <p>No events have been created yet.</p>
            </div>
        @else
            <div class="relative overflow-x-auto overflow-y-auto bg-white rounded-lg shadow">
                <table class="relative w-full whitespace-no-wrap bg-white border-collapse table-auto table-striped">
                    <thead>
                        <tr class="text-left">
                            <th
                                class="sticky top-0 px-6 py-3 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-100 border-b border-gray-200">
                                Event Name</th>
                            <th
                                class="sticky top-0 px-6 py-3 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-100 border-b border-gray-200">
                                Description</th>
                            <th
                                class="sticky top-0 px-6 py-3 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-100 border-b border-gray-200">
                                Date</th>
                            <th
                                class="sticky top-0 px-6 py-3 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-100 border-b border-gray-200">
                                Location</th>
                            <th
                                class="sticky top-0 px-6 py-3 text-xs font-bold tracking-wider text-gray-600 uppercase bg-gray-100 border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="px-6 py-4 border-t border-gray-200 border-dashed">{{ $event->name }}</td>
                                <td class="px-6 py-4 border-t border-gray-200 border-dashed">
                                    {{ Str::limit($event->description, 50) }}</td>
                                <td class="px-6 py-4 border-t border-gray-200 border-dashed">
                                    {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</td>
                                <td class="px-6 py-4 border-t border-gray-200 border-dashed">{{ $event->location }}</td>
                                <td class="px-6 py-4 border-t border-gray-200 border-dashed">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('events.show', $event->id) }}"
                                            class="text-blue-500 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600"
                                                onclick="return confirm('Are you sure you want to delete this event?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
