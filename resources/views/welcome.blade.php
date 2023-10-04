<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Abou Arab</title>

        {{--jQuery--}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        {{--Font Awsome--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        {{--Tailwind CSS--}}
        <script src="https://cdn.tailwindcss.com"></script>
        {{--Swiper--}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        {{--Project Scripts--}}
        @vite('resources/js/app.js')
        {{--Project Styles--}}
        @vite('resources/css/app.css')

    </head>
    <body class="flex">
        <section id="sidebar">
            <div class="logo-container">
                <img class="logo" src="{{ asset('storage/logo_transparent.png') }}" alt="logo">
            </div>
            <nav id="menu">
                <ul id="menu-list">
                    <li>Home</li>
                    <li>Menu</li>
                    <li>About</li>
                    <li>Branches</li>
                    <li>Contact</li>
                </ul>
            </nav>
            <div id="sidebar-footer">
                <p>Contact | About</p>
            </div>
        </section>
        <main id="main-container" class="flex-grow">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide transition-all p-5 text-center hover:bg-red-400 hover:text-white">
                        <div class="flex flex-col gap-4">
                            <div>
                                <img class="menu-icon mx-auto" src="{{ asset('storage/icons/hamburger_3075935.svg') }}" alt="burger">
                            </div>
                            <div>
                                <p>Burgers</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide transition-all p-5 text-center hover:bg-red-400 hover:text-white">
                        <div class="flex flex-col gap-4">
                            <div>
                                <img class="menu-icon mx-auto" src="{{ asset('storage/icons/hamburger_3075935.svg') }}" alt="burger">
                            </div>
                            <div>
                                <p>Burgers</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide transition-all p-5 text-center hover:bg-red-400 hover:text-white">
                        <div class="flex flex-col gap-4">
                            <div>
                                <img class="menu-icon mx-auto" src="{{ asset('storage/icons/hamburger_3075935.svg') }}" alt="burger">
                            </div>
                            <div>
                                <p>Burgers</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide transition-all p-5 text-center hover:bg-red-400 hover:text-white">
                        <div class="flex flex-col gap-4">
                            <div>
                                <img class="menu-icon mx-auto" src="{{ asset('storage/icons/hamburger_3075935.svg') }}" alt="burger">
                            </div>
                            <div>
                                <p>Burgers</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide transition-all p-5 text-center hover:bg-red-400 hover:text-white">
                        <div class="flex flex-col gap-4">
                            <div>
                                <img class="menu-icon mx-auto" src="{{ asset('storage/icons/hamburger_3075935.svg') }}" alt="burger">
                            </div>
                            <div>
                                <p>Burgers</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </main>
    </body>
</html>
