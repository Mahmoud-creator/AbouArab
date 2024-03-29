@props(["products" => [], "customerAddress" => null, "checkout" => $checkout, "total" => $total])
@extends('layouts.app')
@section('main')
    @if( App\Models\Cart::where('user_id', auth()->user()->id)->count())
        <div class="max-w-6xl mx-auto">
            <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Addons</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($products as $cartItem)
                        @php
                            $product = $cartItem->product;
                            $addons = json_decode($cartItem->addons) ?? [];
                        @endphp
                        <tr class="overflow-x-auto border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-12 md:w-40" src="{{ asset($product->image) }}" alt="img"/>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="font-semibold flex items-center">
                                    <span>{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="font-semibold flex items-center">
                                    <span>{{ optional($product->category->first())->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="font-semibold flex items-center">
                                    @foreach($addons as $addon)
                                        <span class="text-red-500 pr-1">{{ $addon }} @if(!$loop->last)|@endif</span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="font-semibold flex items-center justify-center">
                                    <span>{{ $product->price }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="font-semibold flex items-center justify-center">
                                    <label>
                                        <input data-id="{{ $cartItem->id }}" name="quantity" type="number"
                                               value="{{ $cartItem->quantity }}" min="1" max="100" step="1"
                                               class="w-12 px-2 py-1 text-center">
                                    </label>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST">
                                        @csrf
                                        <button class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
            <div class="text-center w-full md:text-right">
                <button id="openModalButton"
                        class="rounded-md mx-auto px-3 py-1.5 bg-red-500 hover:bg-red-400 font-semibold transition-all text-white text-2xl">
                    Checkout
                </button>
            </div>
            <input type="hidden" id="open-checkout-flag" value="{{ $checkout ? 'true' : 'false' }}">
            <x-checkout-modal :address="$customerAddress"/>
        </div>
    @else
        <div class="max-w-6xl mx-auto text-center text-red-500 space-y-20 text-2xl mt-20">
            <h3>You haven't added anything to your bag</h3>
            <p><a href="{{ route('page.menu') }}"
                  class="px-3 py-1.5 bg-red-500 hover:bg-red-400 font-semibold transition-all text-white text-2xl">Order
                    Now</a></p>
            <button id="openModalButton">Send message</button>
        </div>
    @endif
@endsection
