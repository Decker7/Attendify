@extends('layouts.userapp')

@section('user')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>

    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-2 text-xl font-semibold text-gray-700">My Events</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $myEventsCount ?? 0 }}</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-2 text-xl font-semibold text-gray-700">Attended Events</h2>
            <p class="text-3xl font-bold text-green-600">{{ $attendedEventsCount ?? 0 }}</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-2 text-xl font-semibold text-gray-700">Upcoming Events</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $upcomingEventsCount ?? 0 }}</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-2 text-xl font-semibold text-gray-700">Attendance Rate</h2>
            <p class="text-3xl font-bold text-yellow-600">{{ $attendanceRate ?? '0%' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-2xl font-semibold text-gray-800">Upcoming Events</h2>
                @if(isset($upcomingEvents) && count($upcomingEvents) > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($upcomingEvents as $event)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <span class="text-lg font-semibold text-blue-600">
                                            {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($event->date)->format('M') }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $event->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $event->location }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="#" class="inline-flex items-center px-3 py-1 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-full hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-800">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No upcoming events.</p>
                @endif
            </div>
        </div>

        <div>
            <div class="p-6 mb-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-2xl font-semibold text-gray-800">Quick Actions</h2>
                <div class="space-y-4">
                    <a href="#" class="block w-full px-4 py-2 text-sm font-medium text-center text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-800">
                        Register for Event
                    </a>
                    <a href="#" class="block w-full px-4 py-2 text-sm font-medium text-center text-blue-600 transition duration-150 ease-in-out bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-blue-200">
                        View My Events
                    </a>
                    <a href="#" class="block w-full px-4 py-2 text-sm font-medium text-center text-blue-600 transition duration-150 ease-in-out bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-blue-200">
                        Check Attendance
                    </a>
                </div>
            </div>

            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="mb-4 text-2xl font-semibold text-gray-800">Recent Activity</h2>
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    <ul class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <li class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full"></span>
                                <span class="text-sm text-gray-500">{{ $activity }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No recent activity.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection