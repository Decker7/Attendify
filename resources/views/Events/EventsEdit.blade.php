@extends('layouts.adminapp')

@section('admin')
    <div class="container mx-auto mt-8">
        <h1 class="mb-6 text-3xl font-bold">Edit Event</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                <ul class="pl-5 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Update Event Form -->
        <form id="updateEventForm" action="{{ route('events.update', $event->id) }}" method="POST"
            class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
            @csrf
            @method('PUT')

            <!-- Event Details -->
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Event Name:</label>
                <input type="text" name="name" id="name" value="{{ $event->name }}" required
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
                <textarea name="description" id="description" rows="5" required
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">{{ $event->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="date" class="block mb-2 text-sm font-bold text-gray-700">Date & Time:</label>
                <input type="datetime-local" name="date" id="date" value="{{ $event->date }}" required
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="location" class="block mb-2 text-sm font-bold text-gray-700">Location:</label>
                <input type="text" name="location" id="location" value="{{ $event->location }}" required
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <!-- Invitations Management -->
            <div class="mb-4">
                <h3 class="mb-2 text-lg font-bold text-gray-700">Manage Invitations:</h3>

                <!-- Add Email Form -->
                <div class="flex items-center mb-4 space-x-2">
                    <input type="email" id="new-email" placeholder="Enter email address" required
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                    <button type="button" id="add-email"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                        Add
                    </button>
                </div>

                <!-- List Current Invitations -->
                <ul id="invitation-list" class="mt-4">
                    @foreach ($event->invitations as $invitation)
                        <li class="flex items-center justify-between py-2 border-b" data-id="{{ $invitation->id }}">
                            <span>{{ $invitation->email }}</span>
                            <button type="button" class="px-2 py-1 text-white bg-red-500 rounded remove-invitation"
                                data-id="{{ $invitation->id }}">
                                Remove
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Update Event Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Update Event
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addEmailBtn = document.getElementById('add-email');
            const emailInput = document.getElementById('new-email');
            const invitationList = document.getElementById('invitation-list');

            // Add Invitation
            addEmailBtn.addEventListener('click', () => {
                const email = emailInput.value.trim();

                if (!email) {
                    alert('Please enter an email address.');
                    return;
                }

                fetch(`{{ route('events.addInvitation', $event->id) }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            email
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const li = document.createElement('li');
                            li.classList.add('flex', 'items-center', 'justify-between', 'py-2',
                                'border-b');
                            li.dataset.id = data.invitation.id;
                            li.innerHTML = `
                                <span>${data.invitation.email}</span>
                                <button type="button" class="px-2 py-1 text-white bg-red-500 rounded remove-invitation" data-id="${data.invitation.id}">
                                    Remove
                                </button>
                            `;
                            invitationList.appendChild(li);
                            emailInput.value = '';
                        } else {
                            alert(data.message || 'Error adding invitation.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An unexpected error occurred. Please try again.');
                    });
            });

            // Remove Invitation
            invitationList.addEventListener('click', (e) => {
                if (!e.target.classList.contains('remove-invitation')) return;

                const id = e.target.dataset.id;

                fetch(`{{ route('admin.invitations.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`[data-id="${id}"]`).remove();
                        } else {
                            alert(data.message || 'Error removing invitation.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An unexpected error occurred. Please try again.');
                    });
            });
        });
    </script>
@endsection
