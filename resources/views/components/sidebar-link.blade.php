@props(["name" => "", "route" => "", "icon" => ""])

<li class="font-semibold hover:ring-1 py-1.5 px-3 hover:ring-red-400 hover:text-red-400 @if(Route::Is($route)) ring-1 ring-red-400 text-red-400 @endif transition-all cursor-pointer">
    <a class="menu-btn" href={{ route($route) }}>
        <img class="hover:text-red-400 mx-auto w-10" src="{{ $icon }}" alt="home">
        {{ $name }}
    </a>
</li>
