@extends('layouts.userapp')

@section('user')
    <div class="container max-w-4xl px-4 py-8 mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center text-yellow-800">Donate to {{ $event->name }}</h1>

        <div class="p-6 mb-8 bg-yellow-100 rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold text-yellow-700">About This Event</h2>
            <p class="mb-4 text-yellow-600">{{ $event->description }}</p>
            <div class="flex justify-between text-sm text-yellow-600">
                <span><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('M d, Y H:i') }}</span>
                <span><strong>Location:</strong> {{ $event->location }}</span>
            </div>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-2xl font-semibold text-yellow-700">Why Donate?</h2>
                <ul class="space-y-2 text-yellow-600 list-disc list-inside">
                    <li>Support our community initiatives</li>
                    <li>Help us reach our fundraising goals</li>
                    <li>Make a positive impact on local projects</li>
                    <li>Contribute to the success of {{ $event->name }}</li>
                </ul>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-2xl font-semibold text-yellow-700">How Your Donation Helps</h2>
                <p class="mb-4 text-yellow-600">Your generous contribution will go towards:</p>
                <ul class="space-y-2 text-yellow-600 list-disc list-inside">
                    <li>Event materials and resources</li>
                    <li>Supporting volunteer efforts</li>
                    <li>Enhancing event experiences for all attendees</li>
                    <li>Furthering our mission and community impact</li>
                </ul>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-6 text-2xl font-semibold text-yellow-700">Make Your Donation</h2>
            <form action="{{ route('payment.checkout', ['eventId' => $event->id]) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="amount" class="block mb-1 text-sm font-medium text-yellow-700">Donation Amount
                        (MYR):</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-yellow-500 sm:text-sm">RM</span>
                        </div>
                        <input type="number" id="amount" name="amount" step="0.01" min="1" required
                            class="block w-full pl-10 pr-12 border-yellow-300 rounded-md focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            placeholder="0.00">
                    </div>
                </div>
                <button type="submit"
                    class="w-full px-4 py-3 text-sm font-medium text-white transition duration-150 ease-in-out transform bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 hover:-translate-y-1 hover:shadow-lg">
                    Donate via Stripe
                </button>
            </form>
        </div>

        <div class="mt-8 text-sm text-center text-yellow-600">
            <p>Thank you for your support! Your donation makes a difference.</p>
            <p class="mt-2">For any questions about donations, please contact us at <a href="mailto:support@example.com"
                    class="text-yellow-700 hover:underline">support@example.com</a></p>
        </div>
    </div>
@endsection
