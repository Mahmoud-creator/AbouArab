<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/logo-transparent.png') }}">

    {{--Font Awsome--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{--Swiper--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}

    @routes

    {{--Project Scripts & Styles--}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @yield('header-scripts')


    {{--CSRF Token--}}

</head>

<body class="flex flex-col sm:flex-row relative">
    <button class="sidebar-button m-5 absolute start-0 top-0 md:hidden z-10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
    </button>
    <div class="md:hidden bg-white h-14 w-full text-right flex flex-row-reverse items-center justify-items-end">
        <p class="mr-2 text-md font-semibold">{{ $title }}</p>
    </div>
    @include('components.sidebar')

    <main id="main-container" class="flex-grow relative overflow-y-auto overflow-x-hidden">

        @yield('main')

        @include('components.footer')

    </main>

    <x-flash-message />
</body>
@yield('scripts')
</html>
