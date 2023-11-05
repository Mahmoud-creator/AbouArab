@props(["product" => null, "isAdmin" => false])
@if($product)
    <div {{ $attributes->merge([ "class" => "swiper-slide text-left cursor-pointer" ]) }}>
        <div class="bg-white hover:ring hover:ring-red-500 transition-all">
            <img class="h-80 w-full object-center object-cover" src="{{ asset($product->image) }}" alt="burger">
            <div class="p-5 space-y-2 h-30">
                <p class="font-bold text-xl">{{ $product->name }}</p>
                <p class="font-bold text-red-500 text-lg">$ {{ $product->price }}</p>
                <p class="font-light text-sm text-gray-700">{{ $product->description }}</p>
                @if(auth()->user() && (!isset($isAdmin) || !$isAdmin))
                    <button data-id="{{ $product->id }}" class="add-to-cart bg-red-500 hover:bg-red-400 capitalize px-3 py-1.5 text-white transition-all">Add to cart</button>
                @endif
                @if(isset($isAdmin) && $isAdmin)
                    <div class="flex justify-between">
                        <form action="{{ route('admin.products.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button class="bg-red-500 hover:bg-red-400 capitalize px-3 py-1.5 text-white transition-all">Delete</button>
                        </form>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-400 capitalize px-3 py-1.5 text-white transition-all">Edit</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
