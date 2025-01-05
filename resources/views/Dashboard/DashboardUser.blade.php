@extends('layouts.userapp')

@section('user')
    <div class="min-h-screen bg-yellow-50">
        <div class="container max-w-6xl px-4 py-12 mx-auto">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-yellow-800">Welcome, {{ Auth::user()->name }}!</h1>
                <p class="mt-2 text-xl text-yellow-600">Manage your events and attendance with ease.</p>
            </div>

            <!-- User Stats -->
            <div class="grid grid-cols-1 gap-6 mb-12 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 bg-white border-l-4 border-yellow-400 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-yellow-700">Total Events</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $userInvitationsCount }}</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-yellow-400 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-yellow-700">Upcoming Events</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $upcomingEventsCount }}</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-yellow-400 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-yellow-700">Attendance Rate</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $attendanceRate }}%</p>
                </div>
                <div class="p-6 bg-white border-l-4 border-yellow-400 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-yellow-700">Total Donations</h3>
                    <p class="text-3xl font-bold text-yellow-600">$250</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-yellow-700">View My Events</h2>
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <p class="mb-4 text-yellow-600">Keep track of the events you've created and joined. Stay organized and
                        never miss an important date.</p>
                    <a href="{{ route('user.events') }}"
                        class="inline-block px-6 py-3 text-sm font-medium text-white transition duration-300 ease-in-out transform bg-yellow-500 rounded-full hover:bg-yellow-600 hover:-translate-y-1 hover:shadow-md">View
                        Events</a>
                </div>

                <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-yellow-700">Give Feedback</h2>
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <p class="mb-4 text-yellow-600">We value your feedback. Share your thoughts to help us improve and
                        enhance your experience.</p>
                    <a href="{{route('feedback.index')}}"
                        class="inline-block px-6 py-3 text-sm font-medium text-white transition duration-300 ease-in-out transform bg-yellow-500 rounded-full hover:bg-yellow-600 hover:-translate-y-1 hover:shadow-md">Give
                        Feedback</a>
                </div>


                <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-yellow-700">Recent Activity</h2>
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-center text-yellow-600">
                            <span class="w-4 h-4 mr-2 bg-yellow-200 rounded-full"></span>
                            Attended "Community Cleanup" event
                        </li>
                        <li class="flex items-center text-yellow-600">
                            <span class="w-4 h-4 mr-2 bg-yellow-200 rounded-full"></span>
                            Donated $50 to "Local Food Bank"
                        </li>
                        <li class="flex items-center text-yellow-600">
                            <span class="w-4 h-4 mr-2 bg-yellow-200 rounded-full"></span>
                            Created "Neighborhood Watch" event
                        </li>
                    </ul>
                </div>
            </div>

            {{-- <!-- Upcoming Events Preview -->
            <div class="mt-12">
                <h2 class="mb-6 text-2xl font-semibold text-yellow-800">Upcoming Events</h2>
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-yellow-100">
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Event Name</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Location</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-yellow-200">
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-yellow-800 whitespace-nowrap">Community Garden
                                    Planting</td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">May 15, 2023</td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">Central Park</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-yellow-800 whitespace-nowrap">Charity Run</td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">June 1, 2023</td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">City Stadium</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-yellow-800 whitespace-nowrap">Tech Workshop
                                </td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">June 10, 2023</td>
                                <td class="px-6 py-4 text-sm text-yellow-600 whitespace-nowrap">Community Center</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
