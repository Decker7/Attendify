<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Event;
use App\Models\Attendance;


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
        // Fetch all events with attendance statistics and invitation counts
        $events = Event::with(['attendances', 'invitations'])->get()->map(function ($event) {
            $totalAttendances = $event->attendances->count();
            $present = $event->attendances->where('status', 'present')->count();
            $absent = $event->attendances->where('status', 'absent')->count();
            $notSigned = $event->attendances->where('status', 'not_signed')->count();
            $totalInvitations = $event->invitations->count();

            return [
                'id' => $event->id,
                'name' => $event->name,
                'date' => $event->date,
                'totalAttendances' => $totalAttendances,
                'present' => $present,
                'absent' => $absent,
                'notSigned' => $notSigned,
                'totalInvitations' => $totalInvitations,
            ];
        });

        // Calculate total number of attendees with 'present' status across all events
        $totalPresent = $events->sum('present');

        // Calculate total number of attendees with 'absent' status across all events
        $totalAbsent = $events->sum('absent');

        // Calculate the total number of invitations across all events
        $totalInvitationsSum = $events->sum('totalInvitations');

        return view('Attendance.AttendanceList', compact('events', 'totalPresent', 'totalAbsent', 'totalInvitationsSum'));
    }



    public function viewAttendance($eventId)
    {
        // Fetch the event with its related attendances and users
        $event = Event::with(['attendances.user'])->findOrFail($eventId);

        // Collect attendance data including user information
        $attendances = $event->attendances->map(function ($attendance) {
            return [
                'id' => $attendance->id,
                'status' => $attendance->status,
                'email' => $attendance->user->email,
                'user_name' => $attendance->user->name, // Assuming User model has a 'name' field
                'user_id' => $attendance->user_id,
            ];
        });

        // Pass the event and attendance data to the view
        return view('Attendance.AttendanceView', compact('event', 'attendances'));
    }

    public function updateAttendance(Request $request, $id)
    {
        // Find the attendance record in the attendances table
        $attendance = Attendance::findOrFail($id);

        // Update the status of the attendance
        $attendance->update(['status' => $request->status]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Attendance status updated successfully.');
    }
}
