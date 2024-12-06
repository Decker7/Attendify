@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-900">Create Event</h1>

        @if ($errors->any())
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-md">
                <ul class="pl-5 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                    Event Name
                </label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="name" id="name" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="description">
                    Description
                </label>
                <textarea
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    name="description" id="description" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="date">
                    Date and Time
                </label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="datetime-local" name="date" id="date" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700" for="location">
                    Location
                </label>
                <input
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                    type="text" name="location" id="location" required>
            </div>
            <!-- Other event fields remain the same -->
            <div id="email-inputs" class="mb-4">
                <label class="block mb-2 text-sm font-bold text-gray-700">
                    Invite Users
                </label>
                <div class="mb-2">
                    <input
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        type="email" name="emails[]" placeholder="Enter email address" required>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <button type="button" id="add-email"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Add Another Email
                </button>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                    Create Event and Send Invitations
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-email').addEventListener('click', function() {
            var emailInputs = document.getElementById('email-inputs');
            var newInput = document.createElement('div');
            newInput.className = 'mb-2';
            newInput.innerHTML = `
                <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" type="email" name="emails[]" placeholder="Enter email address" required>
            `;
            emailInputs.appendChild(newInput);
        });
    </script>
@endsection
