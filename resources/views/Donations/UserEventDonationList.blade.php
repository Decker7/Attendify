@extends('layouts.userapp')

@section('user')
    <div class="container max-w-4xl px-4 py-8 mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center text-yellow-800">Event Donation List</h1>

        @foreach ($events as $event)
            <div
                class="p-6 mb-8 transition duration-300 ease-in-out bg-white border-l-4 border-yellow-500 rounded-lg shadow-md hover:shadow-lg">
                <h2 class="mb-3 text-2xl font-semibold text-yellow-700">{{ $event->name }}</h2>
                <p class="mb-4 text-gray-600">{{ $event->description }}</p>
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <p class="mb-2 font-medium text-yellow-600">
                            <span class="inline-block w-5 h-5 mr-2 bg-yellow-200 rounded-full"></span>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                        </p>
                        <p class="font-medium">
                            <strong>Status:</strong>
                            @if ($event->donate && $event->donate->donation_open)
                                <span class="px-2 py-1 text-sm text-green-500 bg-green-100 rounded-full">Donation Open</span>
                            @else
                                <span class="px-2 py-1 text-sm text-red-500 bg-red-100 rounded-full">Donation Closed</span>
                            @endif
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @if ($event->donate && $event->donate->donation_open)
                            <a href="{{ route('donation.form', $event->id) }}"
                                class="inline-block px-6 py-3 text-white transition duration-300 ease-in-out transform bg-yellow-500 rounded-full hover:bg-yellow-600 hover:-translate-y-1 hover:shadow-md">
                                Donate Now
                            </a>
                        @else
                            <p class="italic text-gray-500">Donations are currently closed for this event.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if ($events->isEmpty())
            <div class="p-8 text-center bg-yellow-100 rounded-lg shadow-inner">
                <p class="text-xl text-yellow-800">No events are currently available for donation.</p>
            </div>
        @endif
    </div>
@endsection
