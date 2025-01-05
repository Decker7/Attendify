@extends('layouts.adminapp')

@section('admin')
<div class="container px-4 mx-auto mt-8 sm:px-6 lg:px-8">
    <h1 class="mb-6 text-3xl font-bold text-gray-900">Add User</h1>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div>
            <label for="user_type" class="block text-sm font-medium text-gray-700">User Type</label>
            <select name="user_type" id="user_type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Add User</button>
        </div>
    </form>
</div>
@endsection
