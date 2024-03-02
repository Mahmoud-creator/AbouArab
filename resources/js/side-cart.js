import {rerenderCart} from './utils';

$(document).ready(function () {
    $('#checkout-to-cart').on('click', function () {
        window.location.href = route('page.bag') + '/checkout';
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
                    url: route('cart.clear'),
                    type: 'POST',
                    success: function (response) {
                        $('#flash-message-container').toggle('hidden');
                        $('#flash-message').text(response.message);

                        setTimeout(function () {
                            $('#flash-message-container').toggle('hidden');
                        }, 2000)

                        $('#cart-items-container').empty();
                        rerenderCart(false);
                    }
                })
            }
        });
    });
    $('#sideCart').on('click', '.delete-cart-item', function () {
        let $button = $(this);
        let id = $button.data('item-id');
        console.log(id);
        $.ajax({
            url: route('cart.delete'),
            type: 'POST',
            data: {
                itemId: id
            },
            success: function (response) {
                $('#flash-message-container').toggle('hidden');
                $('#flash-message').text(response.message);

                setTimeout(function () {
                    $('#flash-message-container').toggle('hidden');
                }, 2000)

                $button.parent().parent().parent().remove();
            }
        })
    })
    $('#sideCart').on('click', '.quantity-button', function () {
        let $button = $(this);
        let $quantityInput = $('#mini-quantity-input');
        let id = $button.data('item-id');
        let action = 'increment';

        if ($button.hasClass('mini-increment-button')) {
            action = 'increment';
        }
        if ($button.hasClass('mini-decrement-button')) {
            action = 'decrement';
        }

        if ($quantityInput.val() == 1 && action == 'decrement') {
            console.log('decrement final');
            $('#error-flash-message-container').toggle('hidden');
            $('#error-flash-message').text('Quantity must be greater than 1');
            setTimeout(function () {
                $('#error-flash-message-container').toggle('hidden');
            }, 2000)
        } else {
            $.ajax({
                url: route('cart.mini.quantity'),
                type: 'POST',
                data: {
                    itemId: id,
                    action: action
                },
                success: function (data) {
                    rerenderCart();

                    // Check if the template exists and remove it
                    let $existingCartItem = $('#item-'+data.cartItemId);
                    if ($existingCartItem.length > 0) {
                        $existingCartItem.remove();
                    }

                    // Add the new cart item template to #sideCart
                    $('#cart-items-container').prepend(data.cartItemView);

                    $('#cart-count').slideUp(500, function () {
                        $(this).text(data.total).slideDown(500);
                    });

                    // Calculate the total price
                    let totalCheckout = 0;
                    $('.item-price').each(function () {
                        totalCheckout += parseFloat($(this).data("item-price"));
                    })

                    console.log('total checkout ', totalCheckout);

                    $('#total-cart-price').text('$' + totalCheckout);
                    // end calculate

                }
            })
        }

    })
})
