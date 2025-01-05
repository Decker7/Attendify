@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-900">{{ $event->name }}</h1>

        <!-- Event Details -->
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="p-6">
                <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
            </div>
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
                                <span class="text-sm text-gray-500">
                                    Invited on {{ \Carbon\Carbon::parse($invitation->created_at)->format('F j, Y') }}
                                </span>
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
