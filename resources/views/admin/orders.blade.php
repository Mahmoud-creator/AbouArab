@extends('layouts.dashboard')
@section('content')
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6 overflow-auto">
            @if(count($orders))
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
            @else
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No
                        orders</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        $(document).ready(function () {
            $('.order-status-container').on('click', '.order_status', function () {
                let status = $(this).data('status');
                let orderId = $(this).data('id');
                let parentContainer = $(this).parent();
                $.ajax({
                    'url': '{{ route('admin.orders.changeState') }}',
                    'type': 'POST',
                    'data': {
                        'id': orderId,
                        'status': status,
                        '_token': '{{ csrf_token() }}'
                    },
                    'success': function (data) {
                        $('#flash-message-container').toggle('hidden');
                        $('#flash-message').text(data.message);
                        setTimeout(function () {
                            $('#flash-message-container').toggle('hidden');
                        }, 2000);
                        if (status) {
                            parentContainer.html('<button data-id="' + orderId + '" data-status="0" class="order_status bg-green-400 text-white px-3 py-1 rounded-md font-semibold">Paid</button>');
                        } else {
                            parentContainer.html('<button data-id="' + orderId + '" data-status="1" class="order_status bg-red-400 text-white px-3 py-1 rounded-md font-semibold">Not Paid</button>');
                        }

                    }

                })
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            const $openModalButton = $('.openOrderButton');
            const $modal = $('#modal');
            const $modalBackdrop = $('#modalBackdrop');
            const $modalPanel = $('#modalPanel');
            const cancelButton = $('#cancel-button');
            const confirmButton = $('#confirm-button');

            // Function to show the modal
            function showModal() {
                $modal.css('display', 'block');
                setTimeout(function () {
                    $modalBackdrop.removeClass('opacity-0');
                    $modalPanel.removeClass('opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95');
                    $modalPanel.addClass('opacity-100 translate-y-0 sm:scale-100');
                }, 10);
            }

            function hideModal() {
                $modalBackdrop.addClass('opacity-0');
                $modalPanel.removeClass('opacity-100 translate-y-0 sm:scale-100');
                $modalPanel.addClass('opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95');
                setTimeout(function () {
                    $modal.css('display', 'none');
                }, 300);
            }


            // Add event listeners
            $openModalButton.on('click', function () {
                const orderId = $(this).data('order-id');

                const slots = {
                    orderId: $('#order-id'),
                    orderDate: $('#order-date'),
                    orderRegion: $('#order-region'),
                    orderAmount: $('#order-amount'),
                    orderNote: $('#order-note'),
                    orderStatus: $('#order-status'),
                    customerName: $('#customer-name'),
                    customerEmail: $('#customer-email'),
                    customerPhone: $('#customer-phone'),
                    customerAddress: $('#customer-address'),
                    itemsBody: $('#items-body'),
                };

                Object.values(slots).forEach(slot => slot.html(''));

                $.ajax({
                    url: '{{ route('admin.orders.show') }}',
                    type: 'GET',
                    data: {
                        id: orderId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        const data = response.data;
                        const statusHtml = data.paid ? '<span class="bg-green-400 text-white px-3 py-1 rounded-md font-semibold">Paid</span>' : '<span class="bg-red-400 text-white px-3 py-1 rounded-md font-semibold">Not Paid</span>';

                        slots.orderId.html(data.id);
                        slots.orderDate.html(data.created_at);
                        slots.orderRegion.html(data.region);
                        slots.orderAmount.html(data.amount);
                        slots.orderNote.html(data.note);
                        slots.orderStatus.html(statusHtml);
                        slots.customerName.html(data.name);
                        slots.customerEmail.html(data.email);
                        slots.customerPhone.html(data.phone);
                        slots.customerAddress.html(data.address);

                        data.items.forEach(item => {
                            const addonsText = item.addons ? JSON.parse(item.addons || '[]').join(' | ') : '';

                            slots.itemsBody.append(`
                                <tr class="font-semibold hover:bg-gray-100 cursor-pointer border-b border-gray-200">
                                    <td><img src="http://127.0.0.1:8000/${item.product.image}" class="w-24" alt=""></td>
                                    <td>${item.product.name}</td>
                                    <td>${addonsText}</td>
                                    <td>${item.quantity}</td>
                                    <td>$ ${item.price}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function (data) {
                        console.log("ERROR: " + data);
                    }
                });

                showModal();
            });
            cancelButton.click(hideModal);
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.delete-order').on('click', function () {
                let orderId = $(this).data('order-id');
                let row = $(this).parent().parent().parent();
                confirm("Are you sure you want to delete this order?") ? $.ajax({
                    'url': '{{ route('admin.orders.delete') }}',
                    'type': 'POST',
                    'data': {
                        'order_id': orderId,
                        '_token': '{{ csrf_token() }}'
                    },
                    'success': function (data) {
                        $('#flash-message-container').toggle('hidden');
                        $('#flash-message').text(data.message);
                        setTimeout(function () {
                            $('#flash-message-container').toggle('hidden');
                        }, 2000)
                        row.remove();
                    }
                }) : false
            })
        })
    </script>
@endsection
