@php($cartHasItem = optional(optional(auth()->user())->cart)->count() > 0)
<div id="sideCart" class="w-full min-h-full pb-10 bg-white sticky top-0 right-0">
        {{--If the cart is not empty--}}
        <div id="cart-header" class="@if($cartHasItem) flex @else hidden @endif flex-row justify-between">
            <a href="{{ route('page.bag') }}" role="button"
               class="text-gray-700 text-sm p-5 font-bold cursor-pointer hover:text-red-400 transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p class="text-sm">View Cart</p>
                </div>
            </a>
            <a role="button" id="clear-cart-button"
               class="text-gray-700 text-sm p-5 font-bold cursor-pointer hover:text-red-400 transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-trash"></i>
                    <p class="text-sm">Clear Cart</p>
                </div>
            </a>
        </div>
        <div id="cart-items-container" class="@if(!$cartHasItem) hidden @endif">
            @auth
                @foreach(\App\Models\Cart::where('user_id', auth()->user()->id)->with('product')->get() as $item)
                    <x-cart-item :item="$item"></x-cart-item>
                @endforeach
            @endauth
        </div>
        <button id="checkout-to-cart" class="align-bottom @if(!$cartHasItem) hidden @else flex @endif flex-row justify-between items-center w-4/6 mx-auto bg-red-500 shadow-md text-white hover:bg-red-400 capitalize px-3 py-1.5 transition-all rounded-md">
            <span>Checkout</span>
            <span id="total-cart-price" class="text-white text-sm font-semibold">${{ \App\Models\Cart::getTotalPrice() }}</span>
        </button>

        {{--If the cart is empty--}}
        <div id="empty-cart-container" class="@if($cartHasItem) hidden @else flex @endif  flex-row justify-between">
            <p class="capitalize font-bold mt-20 mx-auto text-red-500 text-xl tracking-wide">Your cart is empty!</p>
        </div>
</div>
