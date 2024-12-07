<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Event;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Invitation removed successfully.'
        ]);
    }

    public function attendanceList()
    {
        // Fetch all events with attendance statistics
        $events = Event::with('attendances')->get()->map(function ($event) {
            $total = $event->attendances->count();
            $present = $event->attendances->where('status', 'present')->count();
            $absent = $event->attendances->where('status', 'absent')->count();
            $notSigned = $event->attendances->where('status', 'not_signed')->count();

            return [
                'id' => $event->id,
                'name' => $event->name,
                'date' => $event->date,
                'total' => $total,
                'present' => $present,
                'absent' => $absent,
                'notSigned' => $notSigned,
            ];
        });

        return view('Attendance.AttendanceList', compact('events'));
    }

    public function viewAttendance($eventId)
    {
        $event = Event::with('attendances')->findOrFail($eventId);

        $attendances = $event->attendances;

        return view('Attendance.AttendanceView', compact('event', 'attendances'));
    }
    public function updateAttendance(Request $request, $id)
    {
        $attendance = Invitation::findOrFail($id);
        $attendance->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Attendance status updated successfully.');
    }
}
