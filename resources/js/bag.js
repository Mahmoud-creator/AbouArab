$(document).ready(function () {
    $('input[name="quantity"]').on('change', function () {
        let quantity = $(this).val();
        let id = $(this).data('id');
        $.ajax({
            url: route('cart.quantity'),
            method: "POST",
            data: {
                itemId: id,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content'),
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


    if ($("#open-checkout-flag").val() == 'true'){
        $('#openModalButton').click();
    }
})
