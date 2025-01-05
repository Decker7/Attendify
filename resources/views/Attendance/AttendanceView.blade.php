@extends('layouts.adminapp')

@section('admin')
    <div class="min-h-screen py-8 bg-gradient-to-r from-blue-100 to-green-100">
        <div class="container px-4 mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <div class="p-6 sm:p-8 bg-gradient-to-r from-blue-600 to-green-600">
                    <h1 class="mb-2 text-3xl font-bold text-white">{{ $event->name }}</h1>
                    <p class="text-xl text-blue-100">Attendance Details</p>
                    <p class="mt-2 text-blue-200">Event Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                </div>

                <div class="p-6 sm:p-8">
                    @if ($attendances->isEmpty())
                        <div class="py-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No attendance records</h3>
                            <p class="mt-1 text-sm text-gray-500">No attendance records found for this event.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Name</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Email</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($attendances as $attendance)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $attendance['user_name'] }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $attendance['email'] ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $attendance['status'] == 'present'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($attendance['status'] == 'absent'
                                                        ? 'bg-red-100 text-red-800'
                                                        : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($attendance['status']) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                <form action="{{ route('attendance.update', $attendance['id']) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status"
                                                        class="mr-2 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                        <option value="present"
                                                            {{ $attendance['status'] == 'present' ? 'selected' : '' }}>
                                                            Present</option>
                                                        <option value="absent"
                                                            {{ $attendance['status'] == 'absent' ? 'selected' : '' }}>Absent
                                                        </option>

                                                    </select>
                                                    <button type="submit"
                                                        class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-blue-500 rounded hover:bg-blue-700">
                                                        Update
                                                    </button>
                                                </form>
                                                <form action="{{ route('attendance.destroy', $attendance['id']) }}"
                                                    method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out bg-red-500 rounded hover:bg-red-700"
                                                        onclick="return confirm('Are you sure you want to delete this attendance record?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
