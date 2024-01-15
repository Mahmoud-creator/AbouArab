@if(optional(optional(auth()->user())->cart)->count() > 0)
    <div id="sideCart" class="w-full min-h-full pb-10 bg-white sticky top-0 right-0">
        <div class="flex flex-row justify-between">
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
        @foreach(\App\Models\Cart::where('user_id', auth()->user()->id)->with('product')->get() as $item)
            <div class="mx-2 my-4 p-3 shadow-md hover:shadow-lg">
                <div class="flex flex-row">
                    <div class="w-3/5">
                        <p class="text-lg text-red-500 font-bold">{{ $item->quantity }} {{ $item->product->name }}</p>
                        <p class="text-md text-gray-700 font-bold">${{ $item->product->price }}</p>
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
                    <div class="">
                        <p class="font-semibold"><span class="text-red-500">${{ $item->getItemPrice() }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        <button id="checkout-to-cart" class="align-bottom flex flex-row justify-between items-center w-4/6 mx-auto bg-red-500 shadow-md text-white hover:bg-red-400 capitalize px-3 py-1.5 transition-all rounded-md">
            <span>Checkout</span>
            <span class="text-white text-sm font-semibold">${{ \App\Models\Cart::getTotalPrice() }}</span>
        </button>
    </div>
@else
    <div id="sideCart" class="w-full h-full bg-white">
        <div class="flex flex-row justify-between">
            <p class="capitalize font-bold mt-20 mx-auto text-red-500 text-xl tracking-wide">Your cart is empty!</p>
        </div>
    </div>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#checkout-to-cart').on('click', function (){
        window.location.href = '{{ route('page.bag') }}/checkout';
    })
    $('#clear-cart-button').on('click', function () {
        Swal.fire({
            title: 'Clear Cart?',
            text: 'Are you sure you want to clear your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('cart.clear') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#flash-message-container').toggle('hidden');
                        $('#flash-message').text(response.message);

                        setTimeout(function () {
                            $('#flash-message-container').toggle('hidden');
                        }, 2000)

                        $('#sideCart').load(window.location.href + ' #sideCart');
                    }
                })
            }
        });
    });
    $('#sideCart').on('click', '.delete-cart-item', function(){
        let $button = $(this);
        let id = $button.data('item-id');
        console.log(id);
        $.ajax({
            url: '{{ route('cart.delete') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                itemId: id
            },
            success: function (response) {
                $('#flash-message-container').toggle('hidden');
                $('#flash-message').text(response.message);

                setTimeout(function () {
                    $('#flash-message-container').toggle('hidden');
                }, 2000)

                $button.parent().parent().parent().remove();
                $('#sideCart').load(window.location.href + ' #sideCart');
            }
        })
    })

    $('#sideCart').on('click', '.quantity-button', function () {
        let $button = $(this);
        let $quantityInput = $('#mini-quantity-input');
        let id = $button.data('item-id');
        let action = 'increment';

        if($button.hasClass('mini-increment-button')){
            action = 'increment';
        }
        if($button.hasClass('mini-decrement-button')){
            action = 'decrement';
        }

        if($quantityInput.val() === 1 && action === 'decrement'){
            $('#flash-message-container').toggle('hidden');
            $('#flash-message').text('Quantity must be greater than 1');
            setTimeout(function () {
                $('#flash-message-container').toggle('hidden');
            }, 2000)
        }else{
            $.ajax({
                url: '{{ route('cart.mini.quantity') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    itemId: id,
                    action: action
                },
                success: function () {
                    $('#sideCart').load(window.location.href + ' #sideCart');
                }
            })
        }

    })
</script>
