<?php

namespace App\Http\Controllers;

use App\Mail\SendInvitation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        try {
            $toEmailAddress = $request->input('email');
            $welcomeMessage = "You're invited to Attendify!";
            $eventUrl = route('events.show', ['id' => $request->input('event_id')]);

            Mail::to($toEmailAddress)->send(new SendInvitation($welcomeMessage, $eventUrl));

            return back()->with('success', 'Invitation sent successfully!');
        } catch (\Exception $e) {
            Log::error("Unable to send email: " . $e->getMessage());
            return back()->withErrors('Unable to send email.');
        }
    }
}
