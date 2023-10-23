@extends('layouts.app')
@section('main')
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Create a new user account</h2>
            <form action="{{ route('user.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="text" id="name" name="name"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                           required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="email" id="email" name="email"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                           required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="text" id="phone" name="phone"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                           required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="password" id="password" name="password"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                           required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                           required>
                </div>
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
