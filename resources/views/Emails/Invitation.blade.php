<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Invitation</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-100">
    <div class="max-w-2xl p-8 mx-auto my-8 bg-white rounded-lg shadow-lg">
        <h1 class="mb-6 text-3xl font-bold text-center text-blue-600">You're Invited to {{ $eventName }}!</h1>

        <div class="mb-6">
            <p class="mb-4 text-gray-700">Hello {{ $recipientEmail }},</p>
            <p class="text-gray-700">You've been invited to attend the following event:</p>
        </div>

        <div class="p-4 mb-6 border-l-4 border-blue-500 bg-blue-50">
            <ul class="space-y-2">
                <li class="flex items-center">
                    <span class="w-24 font-semibold text-blue-700">Event:</span>
                    <span class="text-gray-800">{{ $eventName }}</span>
                </li>
                <li class="flex items-start">
                    <span class="w-24 font-semibold text-blue-700">Description:</span>
                    <span class="text-gray-800">{{ $eventDescription }}</span>
                </li>
                <li class="flex items-center">
                    <span class="w-24 font-semibold text-blue-700">Date:</span>
                    <span class="text-gray-800">{{ $eventDate }}</span>
                </li>
                <li class="flex items-center">
                    <span class="w-24 font-semibold text-blue-700">Location:</span>
                    <span class="text-gray-800">{{ $eventLocation }}</span>
                </li>
            </ul>
        </div>

        <p class="font-medium text-center text-gray-700">We hope to see you there!</p>

        <div class="mt-8 text-center">
            <a href="#"
                class="inline-block px-4 py-2 font-bold text-white transition duration-300 bg-blue-600 rounded hover:bg-blue-700">
                Confirm Attendance
            </a>
        </div>
    </div>
</body>

</html>
