@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Event Attendance Dashboard</h1>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Events</h3>
                <p class="text-3xl font-bold text-blue-600">{{ count($events) }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Invitations</h3>
                <p class="text-3xl font-bold text-green-600">{{ $totalInvitationsSum }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Present</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalPresent }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-700">Total Absent</h3>
                <p class="text-3xl font-bold text-red-600">{{ $totalAbsent }}</p>
            </div>
        </div>

        <!-- Event List -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold text-gray-800">Event Attendance Summary</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse table-auto">
                    <thead>
                        <tr class="text-sm font-medium text-left text-gray-700 bg-gray-100">
                            <th class="p-4 border-b">Event Name</th>
                            <th class="p-4 border-b">Event Date</th>
                            <th class="p-4 border-b">Total Invitations</th>
                            <th class="p-4 border-b">Present</th>
                            <th class="p-4 border-b">Absent</th>
                            <th class="p-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 border-b">{{ $event['name'] }}</td>
                                <td class="p-4 border-b">{{ \Carbon\Carbon::parse($event['date'])->format('d M Y') }}</td>
                                <td class="p-4 border-b">{{ $event['totalInvitations'] }}</td>
                                <td class="p-4 border-b">
                                    <span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded-full">
                                        {{ $event['present'] }}
                                    </span>
                                </td>
                                <td class="p-4 border-b">
                                    <span class="px-2 py-1 text-sm text-red-800 bg-red-100 rounded-full">
                                        {{ $event['absent'] }}
                                    </span>
                                </td>
                               

                                <td class="p-4 border-b">
                                    <a href="{{ route('attendance.view', ['id' => $event['id']]) }}"
                                        class="text-blue-600 hover:underline">View Details</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
