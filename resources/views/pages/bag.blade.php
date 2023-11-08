@props(["products" => []])
@extends('layouts.app')
@section('main')
    @if( App\Models\Cart::where('user_id', auth()->user()->id)->count())
        <div class="max-w-6xl mx-auto">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($products as $cartItem)
                        @php
                            $product = $cartItem->product
                        @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-40" src="{{ asset($product->image) }}" alt="img" />
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ optional($product->category->first())->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span>{{ $product->price }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <label>
                                        <input data-id="{{ $cartItem->id }}" name="quantity" type="number" value="{{ $cartItem->quantity }}" min="1" max="100" step="1" class="w-12 px-2 py-1 text-center" >
                                    </label>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST">
                                        @csrf
                                        <button class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <button id="openModalButton" class="px-3 py-1.5 bg-red-500 hover:bg-red-400 font-semibold transition-all text-white text-2xl float-right">Checkout</button>
            <x-checkout-modal />
        </div>
    @else
        <div class="max-w-6xl mx-auto text-center text-red-500 space-y-20 text-2xl mt-20">
            <h3>You haven't added anything to your bag</h3>
            <p><a href="{{ route('page.menu') }}" class="px-3 py-1.5 bg-red-500 hover:bg-red-400 font-semibold transition-all text-white text-2xl">Order Now</a></p>

        </div>
    @endif


@endsection
@section('scripts')
    <script>
        $('input[name="quantity"]').on('change', function () {
            let quantity = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.quantity') }}",
                method: "POST",
                data: {
                    itemId: id,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#flash-message-container').toggle('hidden');
                    $('#flash-message').text(data.message);
                    setTimeout(function () {
                        $('#flash-message-container').toggle('hidden');
                    }, 2000)
                }
            })
        })
    </script>
@endsection
