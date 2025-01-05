<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Event;
use App\Models\DonatePool;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createCheckoutSession($eventId, Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $event = Event::findOrFail($eventId);
        Stripe::setApiKey(config('services.stripe.secret'));

        session(['stripe_amount' => $request->amount]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => $event->name,
                    ],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['eventId' => $eventId]),
            'cancel_url' => route('payment.cancel', ['eventId' => $eventId]),
        ]);

        return redirect($session->url);
    }

    public function handleSuccess($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();

        DonatePool::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'amount' => session('stripe_amount'),
        ]);

        session()->forget('stripe_amount');

        return redirect()->route('user.event.donations')->with('success', 'Payment successful and donation recorded.');
    }

    public function handleCancel($eventId)
    {
        return redirect()->route('donation.form', $eventId)->with('error', 'Payment was canceled.');
    }
}
