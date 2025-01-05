@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-8 text-4xl font-bold text-center text-blue-800">Event Donation Management</h1>

        <div class="p-6 mb-8 bg-blue-100 rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold text-blue-700">Donation Management Overview</h2>
            <p class="mb-4 text-blue-600">
                As an admin, you have the ability to control donation statuses for all events. Use this dashboard to open or
                close donations for each event as needed. Remember that opening donations allows users to contribute
                financially to the event's success.
            </p>
            <div class="grid gap-4 text-sm md:grid-cols-3">
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="mb-2 font-semibold text-blue-700">Total Events</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $events->count() }}</p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="mb-2 font-semibold text-blue-700">Open for Donations</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $events->filter(function ($event) {return $event->donate && $event->donate->donation_open;})->count() }}
                    </p>
                </div>
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="mb-2 font-semibold text-blue-700">Closed for Donations</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $events->filter(function ($event) {return !$event->donate || !$event->donate->donation_open;})->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-blue-200 bg-blue-50">
                <h2 class="text-2xl font-semibold text-blue-800">Event Donation List</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-white bg-blue-600">
                            <th class="px-4 py-3 text-left">#</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Donation Status</th>
                            <th class="px-4 py-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr class="transition duration-150 ease-in-out border-b border-blue-100 hover:bg-blue-50">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium text-blue-700">{{ $event->name }}</td>
                                <td class="px-4 py-3 text-blue-600">{{ Str::limit($event->description, 50) }}</td>
                                <td class="px-4 py-3 text-blue-600">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    @if ($event->donate && $event->donate->donation_open)
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Open</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">Closed</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('donate.toggle', $event->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-4 py-2 text-sm font-medium text-white rounded-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                                            @if ($event->donate && $event->donate->donation_open) bg-red-500 hover:bg-red-600
                                            @else
                                                bg-green-500 hover:bg-green-600 @endif
                                        ">
                                            @if ($event->donate && $event->donate->donation_open)
                                                Close Donation
                                            @else
                                                Open Donation
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-blue-500">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 text-sm text-center text-blue-600">
            <p>Need help managing donations? Contact the support team at <a href="mailto:support@example.com"
                    class="text-blue-700 hover:underline">support@example.com</a></p>
        </div>
    </div>
@endsection
