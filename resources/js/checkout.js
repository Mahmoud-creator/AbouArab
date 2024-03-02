$(document).ready(function() {
    // Get references to modal elements
    const $openModalButton = $('#openModalButton');
    const $modal = $('#modal');
    const $modalBackdrop = $('#modalBackdrop');
    const $modalPanel = $('#modalPanel');
    const cancelButton = $('#cancel-button');
    const confirmButton = $('#confirm-button');

    // Function to show the modal
    function showModal() {
        $modal.css('display', 'block');
        $.ajax({
            url: route('cart.total'),
            type: 'GET',
            success: function(response) {
                $('#total-price').text(response.total);
            },
            error: function(response) {
                console.log(response)
            }
        })
        setTimeout(function() {
            $modalBackdrop.removeClass('opacity-0');
            $modalPanel.removeClass('opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95');
            $modalPanel.addClass('opacity-100 translate-y-0 sm:scale-100');
        }, 10); // Use a small delay to ensure the transition effect works properly
    }

    // Function to hide the modal
    function hideModal() {
        $modalBackdrop.addClass('opacity-0');
        $modalPanel.removeClass('opacity-100 translate-y-0 sm:scale-100');
        $modalPanel.addClass('opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95');
        setTimeout(function() {
            $modal.css('display', 'none');
        }, 300); // Adjust the timing based on your transition duration
    }

    // Add event listeners
    $openModalButton.click(showModal);
    cancelButton.click(hideModal);

    confirmButton.on('click', function (event){
        event.preventDefault();

        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $('#name').val(),
            email: $('#email').val(),
            region: $('#region').val(),
            phone: $('#phone').val(),
            street_address: $('#street_address').val(),
            building_name: $('#building_name').val(),
            floor_number: $('#floor_number').val(),
            note: $('#note').val(),
        };

        $.ajax({
            url: route('checkout.store'),
            type: "POST",
            data: formData,
            success: function (data) {
                if (data.errors) {
                    console.log("errors")
                    console.log(data)
                    $('.error-message').remove();
                    let generalErrors = '';
                    $.each(data.errors, function (key, value) {
                        const inputField = $(`#${key}`);
                        inputField.addClass('border-red-500');
                        inputField.after(`<p class="text-red-500 text-sm error-message">${value}</p>`);
                    });
                } else {
                    console.log("no errors")
                    console.log(data)
                    $('#flash-message-container').toggle('hidden');
                    $('#flash-message').text(data.message);
                    setTimeout(function () {
                        $('#flash-message-container').toggle('hidden');
                        let message = `
                                [Your Restaurant/Company Logo]

                                Invoice

                                Invoice Number: [Unique Invoice Number]

                                Date: [Date of Purchase]

                                Customer Information:

                                Name: [Customer's Name]
                                Email: [Customer's Email]
                                Phone Number: [Customer's Phone Number]
                                Delivery Address: [Customer's Delivery Address]
                                Order Details:

                                Item #1: [Name of the Dish/Item] - [Quantity] x [Price per unit] = [Total for Item #1]
                                Item #2: [Name of the Dish/Item] - [Quantity] x [Price per unit] = [Total for Item #2]
                                ...
                                Item #n: [Name of the Dish/Item] - [Quantity] x [Price per unit] = [Total for Item #n]
                                Subtotal: [Sum of all item totals]

                                Tax: [Tax Amount]

                                Delivery Fee: [If applicable]

                                Total Amount: [Subtotal + Tax + Delivery Fee]

                                Payment Method: [Payment Method Used]`

                    }, 2000)
                    hideModal();
                }
            },
            error: function (data) {
                console.log("ERROR: " + data);
            }
        })
        // confirmButton.click(hideModal);
    })

    cancelButton.on('click', function (event) {
        event.preventDefault();
    })

});
