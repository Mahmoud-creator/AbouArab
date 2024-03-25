export function rerenderCart(show = true) {
    let cartHeader = $("#cart-header");
    let cartItemsContainer = $("#cart-items-container");
    let checkoutButton = $("#checkout-to-cart");
    let emptyCartContainer = $("#empty-cart-container");

    if (show){
        // If the header cart is hidden, show it
        if (cartHeader.hasClass('hidden')) {
            cartHeader.removeClass('hidden');
            cartHeader.addClass('flex');
        }

        // If the cart items container is hidden, show it
        if (cartItemsContainer.hasClass('hidden')) {
            cartItemsContainer.removeClass('hidden');
        }

        // If the empty cart container is visible, hide it
        if (!emptyCartContainer.hasClass('hidden')) {
            emptyCartContainer.addClass('hidden');
            emptyCartContainer.removeClass('flex');
        }

        // If the checkout button is hidden, show it
        if (checkoutButton.hasClass('hidden')) {
            checkoutButton.removeClass('hidden');
            checkoutButton.addClass('flex');
        }
    }else{
        // If the header cart is visible, hide it
        if (!cartHeader.hasClass('hidden')) {
            cartHeader.addClass('hidden');
            cartHeader.removeClass('flex');
        }

        // If the cart items container is visible, hide it
        if (!cartItemsContainer.hasClass('hidden')) {
            cartItemsContainer.addClass('hidden');
        }

        // If the empty cart container is hidden, show it
        if (emptyCartContainer.hasClass('hidden')) {
            emptyCartContainer.removeClass('hidden');
            emptyCartContainer.addClass('flex');
        }

        // If the checkout button is visible, hide it
        if (!checkoutButton.hasClass('hidden')) {
            checkoutButton.addClass('hidden');
            checkoutButton.removeClass('flex');
        }
    }
}

export function calculateTotalCartPrice() {

}
