import {rerenderCart} from './utils';

$(document).ready(function () {

    let quantityInput = $('#quantity-input')
    let incrementButton = $('#increment-button')
    let decrementButton = $('#decrement-button')
    let confirmButton = $('#confirm-button')

    incrementButton.on('click', function () {
        let count = Number(quantityInput.val()) + 1;
        quantityInput.val(count)
        $('#product-modal-price').text($('#product-modal-price').data('price') * count + '$');
    })
    decrementButton.on('click', function () {
        if (Number(quantityInput.val()) > 1) {
            let count = Number(quantityInput.val()) - 1;
            quantityInput.val(count);
            $('#product-modal-price').text($('#product-modal-price').data('price') * count + '$');
        }
    })

    confirmButton.on('click', function () {
        let id = $('#product-modal-id').data('product-id');
        let quantity = quantityInput.val();
        let productAddons = $('input[name="product-addons"]:checked').map(function () {
            return $(this).val();
        }).toArray();

        $.ajax({
            'url': route('cart.store.addons'),
            'type': 'POST',
            'data': {
                'productId': id,
                'quantity': quantity,
                'productAddons': productAddons,
            },
            'success': function (data) {
                $('#cancel-button').click();
                $('#cart-count').slideUp(500, function () {
                    $(this).text(data.total).slideDown(500);
                });
                $('#flash-message-container').toggle('hidden');
                $('#flash-message').html(data.message);
                setTimeout(function () {
                    $('#flash-message-container').toggle('hidden')
                }, 2000);


                rerenderCart();


                // Check if the template exists and remove it
                let $existingCartItem = $('#item-'+data.cartItemId);
                if ($existingCartItem.length > 0) {
                    $existingCartItem.remove();
                }

                // Add the new cart item template to #sideCart
                $('#cart-items-container').prepend(data.cartItemView);

                // Calculate the total price
                let totalCheckout = 0;
                $('.item-price').each(function () {
                    totalCheckout += parseFloat($(this).data("item-price"));
                })

                $('#total-cart-price').text('$' + totalCheckout);
            },
            'error': function (data) {
                console.log('reached error');
                console.log(data);
            }
        })
    });
})
