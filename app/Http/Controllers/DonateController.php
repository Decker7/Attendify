<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Donate;
use App\Models\DonatePool;
use Illuminate\Http\Request;
use App\Models\Invitation; // Assuming you have an Invitation model
use Illuminate\Support\Facades\Auth;

class DonateController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all events with selected fields
        $events = Event::select('id', 'name', 'description', 'date')->get();

        // Pass the events data to the EventDonateList view
        return view('Donations.EventDonateList', compact('events'));
    }

    public function toggleDonationStatus($eventId)
    {
        // Find the event and associated donation
        $event = Event::findOrFail($eventId);
        $donation = Donate::where('event_id', $eventId)->first();

        if (!$donation) {
            // If donation does not exist, create one
            $donation = new Donate();
            $donation->event_id = $eventId;
            $donation->donation_open = true; // Set donation to open initially
            $donation->save();
        } else {
            // Toggle the donation status
            $donation->donation_open = !$donation->donation_open;
            $donation->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Donation status updated.');
    }

    public function userEventDonationList()
    {
        // Get the current authenticated user's email
        $userEmail = Auth::user()->email;

        // Retrieve the events that the user has been invited to
        $invitedEvents = Invitation::where('email', $userEmail)->pluck('event_id');

        // Get the details of the events from the Event table
        $events = Event::whereIn('id', $invitedEvents)->get();

        // Pass the events data to the UserEventDonationList view
        return view('Donations.UserEventDonationList', compact('events'));
    }

    public function showDonationForm($eventId)
    {
        // Retrieve the event details
        $event = Event::findOrFail($eventId);

        // Show the donation form view
        return view('Donations.donate', compact('event'));
    }

    /**
     * Store a donation for a specific event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $eventId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDonation(Request $request, $eventId)
    {
        // Validate the donation amount
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Create the donation record
        DonatePool::create([
            'user_id' => Auth::id(),
            'event_id' => $eventId,
            'amount' => $request->amount,
        ]);

        // Redirect back with a success message
        return redirect()->route('user.event.donations')->with('success', 'Your donation has been successfully submitted!');
    }
}
