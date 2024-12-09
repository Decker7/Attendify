@extends('layouts.userapp')

@section('user')
    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-4xl mx-auto">
            <h1 class="mb-6 text-4xl font-extrabold text-center text-yellow-600">
                <span class="block">Share Your Thoughts</span>
                <span class="block text-2xl font-semibold text-gray-600">Event Feedback</span>
            </h1>

            @if (session('success'))
                <div class="p-4 mb-6 bg-yellow-100 border-l-4 border-yellow-500 rounded-md shadow-lg animate-pulse"
                    role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-800">
                                Success! {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($attendedEvents->isEmpty())
                <div class="p-8 text-center border-2 border-yellow-200 rounded-lg shadow-lg bg-yellow-50">
                    <svg class="w-16 h-16 mx-auto mb-4 text-yellow-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <p class="mb-2 text-xl font-bold text-yellow-700">No events attended yet</p>
                    <p class="text-yellow-600">Looks like you haven't attended any events. Join an event to share your
                        feedback!</p>
                </div>
            @else
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <div class="px-6 py-4 bg-yellow-500">
                        <h2 class="text-xl font-semibold text-white">Your Attended Events</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach ($attendedEvents as $attendance)
                            <div class="p-6 transition duration-300 ease-in-out hover:bg-yellow-50">
                                <h3 class="mb-3 text-xl font-semibold text-yellow-600">{{ $attendance->event->name }}</h3>
                                <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $attendance->event->id }}">
                                    <div>
                                        <label for="feedback-{{ $attendance->event->id }}"
                                            class="block mb-2 text-sm font-medium text-gray-700">Your Feedback</label>
                                        <textarea id="feedback-{{ $attendance->event->id }}" name="feedback" rows="4"
                                            class="block w-full px-3 py-2 mt-1 text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                                            placeholder="Share your thoughts about the event..." required></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">Your feedback helps us improve!</span>
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-300 ease-in-out bg-yellow-500 border border-transparent rounded-md shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                            Submit Feedback
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
@endsection
