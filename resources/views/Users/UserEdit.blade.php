@extends('layouts.adminapp')

@section('admin')
<div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
    <h1 class="mb-6 text-3xl font-bold text-gray-900">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            <small class="text-gray-500">Leave blank to keep the current password</small>
        </div>
        <div>
            <label for="user_type" class="block text-sm font-medium text-gray-700">User Type</label>
            <select name="user_type" id="user_type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Update User</button>
        </div>
    </form>
</div>
@endsection
