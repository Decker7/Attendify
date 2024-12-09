@extends('layouts.userapp')

@section('user')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">My Events</h1>

        @if ($events->isEmpty())
            <div class="p-4 mb-6 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500" role="alert">
                <p class="font-bold">No events found</p>
                <p>You haven't been invited to any events yet.</p>
            </div>
        @else
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Event
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Description</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Location</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Attendance Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($events as $event)
                            @php
                                $attendance = \App\Models\Attendance::where('user_id', Auth::id())
                                    ->where('event_id', $event->id)
                                    ->first();
                            @endphp

                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $event->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($event->description, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($event->date)->format('M d, Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $event->location }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($attendance)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attendance->status == 'registered' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            Not Registered
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    @if (!$attendance)
                                        <form action="{{ route('register.attendance', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 font-bold text-white transition duration-150 ease-in-out bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                                                Register Attendance
                                            </button>
                                        </form>
                                    @elseif($attendance->status == 'registered')
                                        <form action="{{ route('mark.attendance', $event->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-4 py-2 font-bold text-white transition duration-150 ease-in-out bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                                                Mark as Attended
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">Attendance Marked</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
