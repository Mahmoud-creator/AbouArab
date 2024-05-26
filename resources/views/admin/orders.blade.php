@extends('layouts.dashboard')
@section('content')
    <div class="w-full">
        @if(count($orders))
            {{-- <div class="flex flex-row gap-2 ml-3 md:ml0 md:w-48 w-full">
                <input type="text" class="rounded-md border-0 placeholder-gray-300" value="" id="search-orders" placeholder="Search orders">
                <button class="px-2 py-1.5 bg-green-500 text-white hover:bg-green-400 rounded-md border-0">Search</button>
            </div> --}}
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-center">Region</th>
                        <th class="py-3 px-6 text-center">Amount</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Date</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">
                            <td class="font-semibold py-3 px-6 text-let">
                                <span>{{ $order->id }}</span>
                            </td>
                            <td class="font-semibold py-3 px-6 text-let">

                                <span>{{ $order->name }}</span>

                            </td>
                            <td class="font-semibold py-3 px-6 text-let">

                                <span>{{ $order->phone }}</span>

                            </td>
                            <td class="font-semibold py-3 px-6 text-center">

                                <span>{{ $order->region }}</span>

                            </td>
                            <td class="font-semibold py-3 px-6 text-center">

                                <span>{{ $order->amount }}</span>

                            </td>
                            <td class="font-semibold py-3 px-6 text-center order-status-container">

                                @if($order->paid)
                                    <button data-id="{{ $order->id }}" data-status="0"
                                            class="order_status bg-green-400 text-white px-3 py-1 rounded-md font-semibold">
                                        Paid
                                    </button>
                                @else
                                    <button data-id="{{ $order->id }}" data-status="1"
                                            class="order_status bg-red-400 text-white px-3 py-1 rounded-md font-semibold">
                                        Not Paid
                                    </button>
                                @endif

                            </td>
                            <td class="font-semibold py-3 px-6 text-center">
                                <span>{{ $order->created_at->format('Y-m-d') }}</span>
                            </td>
                            <td class="font-semibold py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div data-order-id="{{ $order->id }}"
                                         class="openOrderButton w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                    <div data-order-id="{{ $order->id }}"
                                         class="delete-order w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <x-admin.order-modal/>
            </div>
            {{ $orders->links('vendor.pagination.tailwind') }}
        @else
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No
                        orders</h3>
                </div>
            </div>
        @endif
    </div>
@endsection
