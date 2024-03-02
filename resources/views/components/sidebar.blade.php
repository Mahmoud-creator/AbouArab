<section id="sidebar" class="hidden bg-white md:block md:h-screen md:w-full md:w-screen">
    <button class="sidebar-button m-5 absolute start-0 top-0 md:hidden z-index-10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
    </button>
    <div class="logo-container">
        <a href="{{ route('page.home') }}">
            <img class="logo" src="{{ asset('storage/logo/logo-transparent.png') }}" alt="logo">
        </a>
    </div>
    <nav id="menu">
        <ul id="menu-list">
            <x-sidebar-link name="Home" :route="'page.home'" icon="{{ asset('storage/svgs/home.svg') }}"/>
            <x-sidebar-link name="Menu" :route="'page.menu'" icon="{{ asset('storage/svgs/menu.svg') }}"/>
            <x-sidebar-link name="Bag" :route="'page.bag'" icon="{{ asset('storage/svgs/bag.svg') }}">
                @php
                    $user = auth()->user();
                    $totalQuantity = $user ? App\Models\Cart::getTotalQuantity() : '';
                    $cartCount = $totalQuantity == 0 ? '' : $totalQuantity;
                @endphp
                <span class="text-sm text-red-500" id="cart-count">{{ $cartCount }}</span>
            </x-sidebar-link>
            <x-sidebar-link name="Contact" :route="'page.contact'" icon="{{ asset('storage/svgs/contact.svg') }}"/>
            <x-sidebar-link name="About" :route="'page.about'" icon="{{ asset('storage/svgs/about.svg') }}"/>
        </ul>
    </nav>
    @auth
        <div id="sidebar-footer">
            <p>
                <span class="hover:border-b hover:border-red-500 cursor-pointer hover:text-red-500">
{{--                    <a href="{{ route('user.profile') }}">--}}
{{--                        Profile--}}
{{--                    </a>--}}
{{--                </span> | --}}
                <span class="hover:border-b hover:border-red-500 cursor-pointer hover:text-red-500">
                    <a href="{{ route('user.logout') }}">
                        Logout
                    </a>
                </span>
            </p>
        </div>
    @endauth
    @guest
        <div id="sidebar-footer">
            <p>
                <span class="hover:border-b hover:border-red-500 cursor-pointer hover:text-red-500">
                    <a href="{{ route('user.create') }}">
                        Sign Up
                    </a>
                </span> | <span class="hover:border-b hover:border-red-500 cursor-pointer hover:text-red-500">
                    <a href="{{ route('user.login') }}">
                        Log In
                    </a>
                </span>
            </p>
        </div>
    @endguest
</section>
