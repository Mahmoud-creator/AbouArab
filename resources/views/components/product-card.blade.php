@props(["product" => null])
@if($product)
    <div {{ $attributes->merge([ "class" => "swiper-slide text-left cursor-pointer" ]) }}>
        <div class="bg-white hover:ring hover:ring-red-400 transition-all">
            <img class="h-80 w-full object-center object-cover" src="{{ asset($product->image) }}" alt="burger">
            <div class="p-5 space-y-1 h-30">
                <p class="font-bold text-xl">{{ $product->name }}</p>
                <p class="font-bold text-red-400 text-lg">$ {{ $product->price }}</p>
                <p class="font-light text-sm text-gray-700">{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endif
