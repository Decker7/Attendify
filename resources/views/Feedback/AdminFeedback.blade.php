@extends('layouts.adminapp')

@section('admin')
    <div class="min-h-screen py-12 bg-gradient-to-b from-blue-100 to-white">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 bg-blue-700 border-b border-blue-800 sm:px-20">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-extrabold text-white">
                            Manage Feedback
                        </h1>
                        <div class="text-sm text-blue-200">
                            Total Feedbacks: {{ $feedbacks->count() }}
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mx-6 mt-4 mb-4">
                        <div class="flex p-4 bg-green-100 border-l-4 border-green-500 rounded-r-lg shadow-md">
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-700">
                                    Success
                                </p>
                                <p class="mt-1 text-sm text-green-600">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-blue-200">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-blue-800 uppercase">
                                        Event
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-blue-800 uppercase">
                                        User
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-blue-800 uppercase">
                                        Feedback
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-blue-800 uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-blue-200">
                                @foreach ($feedbacks as $feedback)
                                    <tr class="transition-colors duration-200 hover:bg-blue-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-blue-900">{{ $feedback->event->name }}
                                            </div>
                                            <div class="text-sm text-blue-500">{{ $feedback->event->date }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($feedback->user->name) }}&color=7F9CF5&background=EBF4FF"
                                                        alt="{{ $feedback->user->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-blue-900">
                                                        {{ $feedback->user->name }}
                                                    </div>
                                                    <div class="text-sm text-blue-500">
                                                        {{ $feedback->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="max-w-xs overflow-hidden text-sm text-blue-900 overflow-ellipsis">
                                                {{ $feedback->feedback }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                            <a href="{{ route('admin.feedback.edit', $feedback->id) }}"
                                                class="mr-2 text-blue-600 hover:text-blue-900">
                                                <span class="px-2 py-1 text-blue-800 bg-blue-100 rounded-full">Edit</span>
                                            </a>
                                            <form action="{{ route('admin.feedback.destroy', $feedback->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 focus:outline-none"
                                                    onclick="return confirm('Are you sure you want to delete this feedback?')">
                                                    <span
                                                        class="px-2 py-1 text-red-800 bg-red-100 rounded-full">Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
