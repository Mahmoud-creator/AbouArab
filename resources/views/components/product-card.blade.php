@props(["product" => null, "isAdmin" => false])
@if($product)
    <div {{ $attributes->merge([ "class" => "swiper-slide text-left cursor-pointer" ]) }}>
        <div class="bg-white hover:ring hover:ring-red-500 transition-all">

            <img data-src="{{ asset($product->image) }}" class="lazyload w-full object-center object-cover" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
            <div class="product-element p-5 space-y-2 h-30">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="image" value="{{ asset($product->image) }}">
                <input type="hidden" name="productName" value="{{ $product->name }}">
                <input type="hidden" name="productDescription" value="{{ $product->description }}">
                <input type="hidden" name="productPrice" value="{{ $product->price }}">
                <input type="hidden" name="productAddons" value="{{ $product->addons }}">

                <p class="font-bold text-xl">{{ $product->name }}</p>
                <p class="font-bold text-red-500 text-lg">$ {{ $product->price }}</p>
                <p class="font-light text-sm text-gray-700">{{ $product->description }}</p>
                @if(auth()->user() && (!isset($isAdmin) || !$isAdmin))
                    <button data-id="{{ $product->id }}" class="rounded add-to-cart bg-red-500 hover:bg-red-400 capitalize px-3 py-1.5 text-white transition-all">Add to cart</button>
                    <button data-id="{{ $product->id }}" class="rounded open-product-modal transform shadow-md bg-transparent text-red-500 hover:text-white hover:bg-red-500 capitalize px-3 py-1.5 transition-all">Customize</button>
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
