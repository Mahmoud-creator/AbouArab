$(() => {
    $('.order-status-container').on('click', '.order_status', function () {
        let status = $(this).data('status');
        let orderId = $(this).data('id');
        let parentContainer = $(this).parent();
        $.ajax({
            'url': route('admin.orders.changeState'), 'type': 'POST', 'data': {
                'id': orderId, 'status': status, '_token': csrf_token()
            }, 'success': function (data) {
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
            url: route('admin.orders.show'), type: 'GET', data: {
                id: orderId, _token: csrf_token()
            }, success: function (response) {
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
            }, error: function (data) {
                console.log("ERROR: " + data);
            }
        });

        showModal();
    });
    cancelButton.click(hideModal);

    $('.delete-order').on('click', function () {
        let orderId = $(this).data('order-id');
        let row = $(this).parent().parent().parent();
        confirm("Are you sure you want to delete this order?") ? $.ajax({
            'url': route('admin.orders.delete'), 'type': 'POST', 'data': {
                'order_id': orderId, '_token': csrf_token()
            }, 'success': function (data) {
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

