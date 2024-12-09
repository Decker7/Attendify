<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user', 'event')->get();
        return view('Feedback.AdminFeedback', compact('feedbacks'));
    }

    public function edit($id)
    {
        $feedback = Feedback::with('user', 'event')->findOrFail($id);
        return view('Feedback.AdminEditFeedback', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|string|max:255',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback updated successfully!');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback deleted successfully!');
    }
}
