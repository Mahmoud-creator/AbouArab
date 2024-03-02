import {rerenderCart} from './utils';

$(document).ready(function () {
    const $openModalButton = $('.open-product-modal');
    const $modal = $('#product-modal');
    const $modalBackdrop = $('#product-modal-backdrop');
    const $modalPanel = $('#product-modal-panel');
    const $cancelButton = $('#cancel-button');
    const confirmButton = $('#confirm-button');

    // Function to show the modal
    function showModal(productEl) {
        let id = productEl.find('input[name="id"]').val();
        let image = productEl.find('input[name="image"]').val();
        let productName = productEl.find('input[name="productName"]').val();
        let productDescription = productEl.find('input[name="productDescription"]').val();
        let productPrice = productEl.find('input[name="productPrice"]').val();
        let productAddons = JSON.parse(productEl.find('input[name="productAddons"]').val());
        let productModalPrice = $('#product-modal-price');

        $('#product-modal-image').attr('src', image);
        $('#product-modal-name').text(productName);
        $('#product-modal-description').text(productDescription);
        $('#product-modal-id').data('product-id', id);
        productModalPrice.text(productPrice + '$');
        productModalPrice.data('price', productPrice);

        let addons = '';
        productAddons.forEach(function (productAddon) {
            addons +=
                `<div class="flex items-center me-4">
                        <input id="red-checkbox-${productAddon.slug}" type="checkbox" value="${productAddon.slug}" name="product-addons" class="product-addons w-4 h-4 text-red-600 bg-red-100 border-gray-300 rounded-full focus:ring-red-500 focus:ring-2">
                        <label for="red-checkbox-${productAddon.slug}" class="ms-2 text-sm font-medium text-gray-900">${productAddon.name}
                            <span class="text-xs text-red-400"> + ${productAddon.price}$</span>
                        </label>
                        </div>`;
        })

        $('#product-modal-addons').html(addons);

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
        }, 100);
    }

    // Add event listeners
    $cancelButton.on('click', function () {
        hideModal();
    });
    $openModalButton.on('click', function () {
        showModal($(this).parent());
    })

    $('.redirect-to-login').on('click', function(){
        window.location.href = route('user.login');
    })

    // Add to cart
    $('.add-to-cart-trigger').on('click', function () {
        console.log('clicked' , $(this).data('id'));
        let id = $(this).data('id');

        $.ajax({
            'url': route('cart.store'),
            'type': 'POST',
            'data': {
                'productId': id,
            },
            'success': function (data) {
                $('#cart-count').slideUp(500, function () {
                    $(this).text(data.total).slideDown(500);
                });
                $('#flash-message-container').toggle('hidden');
                $('#flash-message').html(data.message);
                setTimeout(function () {
                    $('#flash-message-container').toggle('hidden')
                }, 2000);
                console.log('data', data);

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
                    console.log('price is: ', parseFloat($(this).data("item-price")));
                    totalCheckout += parseFloat($(this).data("item-price"));
                })

                console.log('total checkout ', totalCheckout);

                $('#total-cart-price').text('$' + totalCheckout);
                // end calculate

            }
        })
    });

    $('.swiper-slide').hover(function () {
        let whiteImage = $(this).find('.whiteImage').val()
        $(this).find('.menu-icon').attr('src', whiteImage)
    }, function () {
        let image = $(this).find('.image').val()
        $(this).find('.menu-icon').attr('src', image)
    })
})
