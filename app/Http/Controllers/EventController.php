<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Invitation;
use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display the event creation form
    public function create()
    {
        return view('Events.EventsCreate'); // Ensure this view path matches your Blade file
    }

    // Handle the form submission and store the event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'emails' => 'required|array',
            'emails.*' => 'email',
        ]);

        // Create the event
        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $validated['location'],
        ]);

        // Create invitations and send emails
        foreach ($validated['emails'] as $email) {
            Invitation::create([
                'event_id' => $event->id,
                'email' => $email,
            ]);

            Mail::to($email)->send(new SendInvitation($event, $email));
        }

        return redirect()->route('events.create')->with('success', 'Event created and invitations sent!');
    }

    // Display a list of events
    public function index()
    {
        $events = Event::all(); // Fetch all events
        return view('Events.EventsList', compact('events')); // Pass events to the view
    }

    // Show the edit form for an event
    public function edit($id)
    {
        $event = Event::with('invitations')->findOrFail($id); // Eager load invitations
        return view('Events.EventsEdit', compact('event'));
    }


    // Update an event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->only(['name', 'description', 'date', 'location']));

        return redirect()->route('events.lists')->with('success', 'Event updated successfully.');
    }


    // Add a new invitation to an event
    public function addInvitation(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $event = Event::findOrFail($id);

        $invitation = $event->invitations()->create([
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Invitation added successfully.',
            'invitation' => $invitation, // Include the new invitation data for the frontend
        ]);
    }



    // Remove an invitation
    public function destroy($id)
    {
        $event = Event::findOrFail($id); // Find the event or throw a 404 error
        $event->delete(); // Delete the event
        return redirect()->route('events.lists')->with('success', 'Event deleted successfully.');
    }
}
