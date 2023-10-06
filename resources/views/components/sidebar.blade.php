<section id="sidebar" class="hidden bg-white md:block md:h-screen md:w-full md:w-screen">
    <button class="sidebar-button m-5 absolute start-0 top-0 md:hidden z-index-10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
    </button>
    <div class="logo-container">
        <img class="logo" src="{{ asset('storage/logo_transparent.png') }}" alt="logo">
    </div>
    <nav id="menu">
        <ul id="menu-list">
            <li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 transition-all cursor-pointer">
                <a class="menu-btn">Home</a></li>
            <li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 transition-all cursor-pointer">
                <a class="menu-btn">Menu</a></li>
            <li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 transition-all cursor-pointer">
                <a class="menu-btn">About</a></li>
            <li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 transition-all cursor-pointer">
                <a class="menu-btn">Contact</a></li>
            <li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 transition-all cursor-pointer">
                <a class="menu-btn">About</a></li>
        </ul>
    </nav>
    <div id="sidebar-footer">
        <p><span class="hover:border-b hover:border-red-400 cursor-pointer hover:text-red-400">Contact</span> | <span class="hover:border-b hover:border-red-400 cursor-pointer hover:text-red-400">About</span></p>
    </div>
</section>
<script>
    {{--When sidebar-button is clicked using jquery, show sidebar.--}}
    $(".sidebar-button").click(function () {
        // make animation of sidebar
        $("#sidebar").toggleClass("hidden");
        // add animation to sidebar, when sidebar opens it comes down from top, when it closes it goes up from bottom
        $("#sidebar").toggleClass("top-0");
        $("#sidebar").toggleClass("bottom-0");

    })
</script>
