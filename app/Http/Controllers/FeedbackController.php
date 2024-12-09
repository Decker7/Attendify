<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $attendedEvents = Attendance::where('user_id', $userId)->with('event')->get();
        return view('Feedback.UserFeedback', compact('attendedEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'feedback' => 'required|string|max:255',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully!');
    }
}
