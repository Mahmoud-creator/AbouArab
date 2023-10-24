@props(["name" => "", "route" => "", "icon" => ""])

<li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-500 hover:text-red-500 @if(Route::Is($route)) ring-1 ring-red-500 text-red-500 @endif transition-all cursor-pointer">
    <a class="menu-btn" href={{ route($route) }}>
        <img class="hover:text-red-500 mx-auto w-10" src="{{ $icon }}" alt="home">
        {{ $name }}
    </a>
</li>
