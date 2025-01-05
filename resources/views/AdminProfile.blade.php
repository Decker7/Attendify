@extends('layouts.adminapp')

@section('admin')
    <div class="container px-4 mx-auto mt-8">
        <h1 class="mb-6 text-3xl font-bold text-blue-800">Admin Profile</h1>

        <!-- Display Admin Details -->
        <div class="p-6 mb-8 bg-white border border-blue-200 rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-semibold text-blue-700">Profile Details</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="flex items-center">
                    <span class="w-24 font-medium text-blue-600">Name:</span>
                    <span class="text-gray-800">{{ $admin->name }}</span>
                </div>
                <div class="flex items-center">
                    <span class="w-24 font-medium text-blue-600">Email:</span>
                    <span class="text-gray-800">{{ $admin->email }}</span>
                </div>
                <div class="flex items-center">
                    <span class="w-24 font-medium text-blue-600">User Type:</span>
                    <span class="text-gray-800">{{ $admin->user_type }}</span>
                </div>
            </div>
        </div>

        <!-- Change Password Form -->
        <div class="p-6 bg-white border border-blue-200 rounded-lg shadow-md">
            <h2 class="mb-6 text-2xl font-semibold text-blue-700">Change Password</h2>
            @if (session('success'))
                <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.changePassword') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700">Current
                        Password</label>
                    <input type="password" name="current_password" id="current_password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('current_password')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="new_password" id="new_password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('new_password')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm New
                        Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="px-6 py-3 text-white transition duration-150 ease-in-out bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update Password
                </button>
            </form>
        </div>
    </div>
@endsection
