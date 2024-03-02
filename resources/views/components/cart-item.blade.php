@props(['item', 'id'])
<div id="item-{{ $item->id }}" class="mx-2 my-4 p-3 shadow-md hover:shadow-lg">
    <div class="flex flex-row">
        <div class="w-3/5">
            <p class="sc-product-name text-lg text-red-500 font-bold">{{ $item->quantity }} {{ $item->product->name }}</p>
            <p class="sc-product-price text-md text-gray-700 font-bold">${{ $item->product->price }}</p>
        </div>
        <div class="w-2/5">
            <img class="lazyload w-full object-center object-cover"
                 src="{{ asset($item->product->image) }}"
                 alt="{{ $item->product->name }}">
        </div>
    </div>
    @if($item->getAddons())
        <div>
            @foreach($item->getAddons() as $addon)
                <div class="flex flex-row space-x-5">
                    <p class="text-sm text-gray-700 font-bold">{{ $addon->name }}</p>
                    <p class="text-xs text-gray-700">$ {{ $addon->price }}</p>
                </div>
            @endforeach
        </div>
    @endif
    <div class="flex flex-row items-center justify-between mt-3">
        <div class="flex items-center max-w-[4rem]">
            <button data-item-id="{{ $item->id }}"
                    class="mini-decrement-button hover:text-red-500 quantity-button text-sm">
                <x-icons.minus class="w-2 h-3 text-gray-700 hover:text-red-500"/>
            </button>
            <input type="text" id="mini-quantity-input" aria-describedby="helper-text-explanation"
                   class="bg-transparent block border-0 h-11 py-2.5 text-center text-gray-700 text-sm user-select-none w-full"
                   disabled value="{{ $item->quantity }}" required>
            <button data-item-id="{{ $item->id }}"
                    class="mini-increment-button quantity-button hover:text-red-500 text-sm">
                <x-icons.plus class="w-2 h-3 text-gray-700 hover:text-red-500"/>
            </button>
        </div>
        <div class="flex items-center justify-center space-x-2">
            <button data-item-id="{{ $item->id }}" class="delete-cart-item fa-solid fa-trash text-sm text-red-500 hover:text-red-400"></button>
        </div>
        <div class="item-price" data-item-price="{{ $item->getItemPrice() }}">
            <p class="font-semibold"><span class="text-red-500">${{ $item->getItemPrice() }}</span>
            </p>
        </div>
    </div>
</div>
