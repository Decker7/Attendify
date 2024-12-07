@extends('layouts.adminapp')

@section('admin')
<div class="container px-4 py-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">{{ $event->name }} - Attendance Details</h1>
    <p class="mb-4 text-gray-600">Event Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-sm font-medium text-left text-gray-700">Name</th>
                    <th class="px-6 py-3 text-sm font-medium text-left text-gray-700">Email</th>
                    <th class="px-6 py-3 text-sm font-medium text-left text-gray-700">Status</th>
                    <th class="px-6 py-3 text-sm font-medium text-left text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $attendance->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $attendance->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($attendance->status) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="border-gray-300 rounded">
                                    <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                    <option value="not_signed" {{ $attendance->status == 'not_signed' ? 'selected' : '' }}>Not Signed</option>
                                </select>
                                <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-600 rounded">Update</button>
                            </form>
                            <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
