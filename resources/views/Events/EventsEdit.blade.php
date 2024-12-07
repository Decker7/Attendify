@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-900">Edit Event</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 rounded-r-lg">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <!-- Update Event Form -->
            <form id="updateEventForm" action="{{ route('events.update', $event->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Event Details -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="name" id="name" value="{{ $event->name }}" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date & Time</label>
                        <input type="datetime-local" name="date" id="date" value="{{ $event->date }}" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="md:col-span-2">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" value="{{ $event->location }}" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ $event->description }}</textarea>
                    </div>
                </div>

                <!-- Update Event Button -->
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="px-4 py-2 text-white transition-colors duration-300 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Event
                    </button>
                </div>
            </form>
        </div>

        <!-- List Invitations -->
        <div class="mt-8 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Invitations</h3>
            </div>
            <div class="p-6">
                @if ($event->invitations->isNotEmpty())
                    <ul class="divide-y divide-gray-200">
                        @foreach ($event->invitations as $invitation)
                            <li class="flex items-center justify-between py-3">
                                <span class="text-gray-800">{{ $invitation->email }}</span>
                                <span class="text-sm text-gray-500">Invited on
                                    {{ $invitation->created_at->format('M d, Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="italic text-gray-500">No invitations sent yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
