@extends('layouts.userapp')

@section('user')
    <div class="container px-4 py-8 mx-auto max-w-7xl">
        <h1 class="mb-8 text-3xl font-bold text-yellow-800">My Events</h1>

        @if ($events->isEmpty())
            <div class="p-6 mb-6 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500 rounded-r-lg shadow-md"
                role="alert">
                <p class="mb-2 text-xl font-bold">No events found</p>
                <p class="text-yellow-600">You haven't been invited to any events yet. Check back later for upcoming events!
                </p>
            </div>
        @else
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-yellow-200">
                        <thead class="bg-yellow-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Event Name</th>
                               
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Location</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Attendance Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-yellow-700 uppercase">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-yellow-200">
                            @foreach ($events as $event)
                                @php
                                    $attendance = \App\Models\Attendance::where('user_id', Auth::id())
                                        ->where('event_id', $event->id)
                                        ->first();
                                @endphp

                                <tr class="transition duration-150 ease-in-out hover:bg-yellow-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-yellow-900">{{ $event->name }}</div>
                                    </td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-yellow-700">
                                            {{ \Carbon\Carbon::parse($event->date)->format('M d, Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-yellow-700">{{ $event->location }}</div>
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
                                                    class="px-4 py-2 text-white transition duration-150 ease-in-out transform bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 hover:-translate-y-1 hover:shadow-md">
                                                    Register Attendance
                                                </button>
                                            </form>
                                        @elseif($attendance->status == 'registered')
                                            <form action="{{ route('mark.attendance', $event->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-4 py-2 text-white transition duration-150 ease-in-out transform bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 hover:-translate-y-1 hover:shadow-md">
                                                    Mark as Attended
                                                </button>
                                            </form>
                                        @elseif($attendance->status == 'present')
                                            <span class="font-semibold text-green-600">Attendance Marked</span>
                                        @else
                                            <span class="font-semibold text-yellow-600">Attendee Absent</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
