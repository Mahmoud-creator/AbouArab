@props(["products" => []])
@extends('layouts.app')
@section('main')
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6">We would love to hear from you!</h2>
            <form action="{{ route('contact.store') }}" method="POST">
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
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Subject</label>
                    @error('subject') <span class="text-red-500">{{ $message }}</span> @enderror
                    <input type="text" id="subject" name="subject"
                           class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                           required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
                    <textarea id="message" name="message" rows="4"
                              class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-500"
                              required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
