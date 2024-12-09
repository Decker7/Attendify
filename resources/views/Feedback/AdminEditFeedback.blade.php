@extends('layouts.adminapp')

@section('admin')
    <div class="min-h-screen py-12 bg-gradient-to-b from-blue-100 to-white">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 bg-blue-700 border-b border-blue-800 sm:px-20">
                    <h1 class="text-3xl font-extrabold text-white">
                        Edit Feedback
                    </h1>
                </div>

                <div class="p-6 bg-white">
                    <div class="mb-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12">
                                <img class="w-12 h-12 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($feedback->user->name) }}&color=7F9CF5&background=EBF4FF"
                                    alt="{{ $feedback->user->name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-lg font-medium text-blue-900">
                                    {{ $feedback->user->name }}
                                </div>
                                <div class="text-sm text-blue-500">
                                    For event: {{ $feedback->event->name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.feedback.update', $feedback->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="feedback" class="block mb-2 text-sm font-medium text-blue-700">Feedback</label>
                            <div class="relative">
                                <textarea id="feedback" name="feedback" rows="6"
                                    class="block w-full px-4 py-3 text-blue-900 transition duration-150 ease-in-out bg-white border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Edit the user's feedback here...">{{ old('feedback', $feedback->feedback) }}</textarea>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            @error('feedback')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a href="{{ route('admin.feedback.index') }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 transition duration-150 ease-in-out bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Feedbacks
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
