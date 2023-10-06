@props(["class" => "","image" => "", "name" => "", "price" => "", "description" => ""])
<div class="swiper-slide text-left cursor-pointer {{ $class }}">
    <div class="bg-white hover:ring hover:ring-red-400 transition-all">
        <img class="w-full object-center object-cover" src="{{ $image }}" alt="burger">
        <div class="p-5 space-y-3">
            <p class="font-bold text-xl">Pizza</p>
            <p class="font-bold text-red-400 text-lg">$10</p>
            <p class="font-light text-md text-gray-700">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>
    </div>
</div>
