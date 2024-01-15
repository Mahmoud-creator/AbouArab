@extends('layouts.app')
@section('main')
    <div class="registration-container mx-auto md:mt-10 flex flex-col-reverse md:flex-row md:w-4/5">
        <div class="flex-1 max-w-md bg-white border md:rounded-tl-lg md:rounded-bl-lg shadow-md md:p-8 md:mx-auto p-4">
            <h2 class="text-2xl font-semibold mb-6">Create a new user account</h2>
            <form action="{{ route('user.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="text" id="name" name="name"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="email" id="email" name="email"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="text" id="phone" name="phone"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="password" id="password" name="password"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Register
                    </button>
                    <p class="mt-6">Already have an account? <a href="{{ route('user.login') }}" class="text-red-500 hover:text-red-400">Login</a></p>
                </div>
            </form>
        </div>
        <div class="flex-1 rounded-tr-lg rounded-br-lg">
            <img src="{{ asset('storage/banners/abou-arab.jpg') }}" class="object-cover object-center w-full h-full rounded-tr-xl rounded-br-xl" alt="">
        </div>
    </div>
@endsection
