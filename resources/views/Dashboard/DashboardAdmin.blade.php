@extends('layouts.adminapp')

@section('admin')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-900">Admin Dashboard</h1>

            <!-- KPI Section -->
            <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Total Events</h2>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalEvents }}</p> <!-- Display total events -->
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Total Users</h2>
                        <p class="text-3xl font-bold text-green-600">{{ $totalUsers }}</p> <!-- Display total users -->
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Upcoming Events</h2>
                        <p class="text-3xl font-bold text-yellow-600">{{ $nextEvents }}</p>
                        <!-- Display upcoming events -->
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Total Attendance</h2>
                        <p class="text-3xl font-bold text-purple-600">{{ $totalAttendance }}</p>
                        <!-- Display total attendance -->
                    </div>
                </div>
            </div>


            <!-- Upcoming Events Section -->
            <div class="mb-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Upcoming Events</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Event Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Date
                                    </th>
                                   
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($upcomingEvents as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->name }}</td> <!-- Event Name -->
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->date }}</td>
                                        <!-- Event Date -->
                                        
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <a href="{{ route('events.show', $event->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No upcoming events.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="{{route('events.lists')}}" class="text-indigo-600 hover:text-indigo-900">View All
                            Upcoming Events</a>
                    </div>
                </div>
            </div>


            <!-- Recent Events Section -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Recent Events</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Event Name</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Attendees</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Summer Workshop</td>
                                    <td class="px-6 py-4 whitespace-nowrap">2023-08-20</td>
                                    <td class="px-6 py-4 whitespace-nowrap">150</td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Product Launch</td>
                                    <td class="px-6 py-4 whitespace-nowrap">2023-08-15</td>
                                    <td class="px-6 py-4 whitespace-nowrap">200</td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">View All Recent Events</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
