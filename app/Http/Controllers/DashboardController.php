<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Assuming you have an Event model
use App\Models\User;  // Assuming you have a User model
use App\Models\Attendance; // Assuming you have an Attendance model

use Illuminate\Support\Facades\Auth; // For getting the current authenticated user
use App\Models\Invitation; // Assuming you have an Invitation model

class DashboardController extends Controller
{
    // Admin Dashboard
    public function admin()
    {
        // Fetching the necessary data
        $totalEvents = Event::count(); // Count total number of events
        $totalUsers = User::count(); // Count total number of users
        $upcomingEvents = Event::where('date', '>', now())->get(); // Get upcoming events with a date greater than the current date
        $nextEvents = Event::where('date', '>', now())->get()->count(); // Get upcoming events with a date greater than the current date
        $totalAttendance = Attendance::count(); // Count total attendance records

        // Pass the data to the view
        return view('Dashboard.DashboardAdmin', [
            'totalEvents' => $totalEvents,
            'totalUsers' => $totalUsers,
            'upcomingEvents' => $upcomingEvents, // Pass the actual events collection
            'totalAttendance' => $totalAttendance,
            'nextEvents' => $nextEvents,
        ]);
    }

    // User Dashboard
    public function user()
    {
        // Get the current authenticated user
        $currentUser = Auth::user();

        // Step 1: Count total invitations where the email matches the current user's email
        $userInvitationsCount = Invitation::where('email', $currentUser->email)->count();

        // Step 2: Retrieve event IDs from invitations where the user's email matches
        $invitedEventIds = Invitation::where('email', $currentUser->email)
            ->pluck('event_id'); // Get a collection of event IDs

        // Step 3: Find upcoming events where the date is greater than today
        $upcomingEventsCount = Event::whereIn('id', $invitedEventIds)
            ->where('date', '>', now()) // Filter by date
            ->count(); // Count the number of upcoming events

        // Step 4: Count the number of presents for the user (filter by 'present' status)
        $userPresentCount = Attendance::where('user_id', $currentUser->id)
            ->where('status', 'present') // Filter by attendance status
            ->whereIn('event_id', $invitedEventIds) // Make sure it's for events the user was invited to
            ->count();

        // Step 5: Calculate the attendance rate (if there are invitations)
        $attendanceRate = 0; // Default to 0 if there are no invitations
        if ($userInvitationsCount > 0) {
            $attendanceRate = ($userPresentCount / $userInvitationsCount) * 100;
        }

        // Pass the data to the view
        return view('Dashboard.DashboardUser', [
            'userInvitationsCount' => $userInvitationsCount,
            'upcomingEventsCount' => $upcomingEventsCount,
            'attendanceRate' => round($attendanceRate, 2), // Round the attendance rate to 2 decimal places
        ]);
    }
}
