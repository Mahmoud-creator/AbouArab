@extends('layouts.app')
@section('main')
    <div class="login-container flex flex-col md:flex-row container mx-auto md:mt-10 md:w-4/5">
        <div class="flex-1 rounded-tl-lg rounded-bl-lg">
            <img src="{{ asset('storage/banners/abou-arab.jpg') }}" class="object-cover object-center w-full h-full md:rounded-tl-xl md:rounded-bl-xl" alt="">
        </div>
        <div class="flex-1 md:rounded-tr-lg md:rounded-br-lg md:max-w-md md:mx-auto bg-white p-2 md:p-8 border shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Login to your account</h2>
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="email" id="email" name="email"
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
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                    <p class="mt-6">Don't have an account? <a href="{{ route('user.create') }}" class="text-red-500 hover:text-red-400">Register</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
