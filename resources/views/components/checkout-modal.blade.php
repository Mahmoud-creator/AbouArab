@props(['address' => null])
<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="modalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity opacity-0">
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modalPanel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Checkout your order</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Please review your order before placing it. We will process your order as soon as possible. Thank you for shopping with us.</p>
                                </div>

                                <form id="checkout-form">
                                    <div class="space-y-6">
                                        <div class="border-b border-gray-900/10 pb-4">
                                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                                <div class="sm:col-span-3">
                                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Full name</label>
                                                    <div class="mt-2">
                                                        <input type="text" name="name" id="name" autocomplete="given-name" value="{{ auth()->user()->name }}"
                                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                                    <div class="mt-2">
                                                        <input id="email" name="email" type="email" autocomplete="email" value="{{ auth()->user()->email }}"
                                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Region</label>
                                                    <div class="mt-2">
                                                        <select id="region" name="region" autocomplete="region-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                            <option @if(optional($address)->region === 'Sad Al Bouchrieh') selected @endif>Sad Al Bouchrieh</option>
                                                            <option @if(optional($address)->region === 'Al-Hadath') selected @endif>Al-Hadath</option>
                                                            <option @if(optional($address)->region === 'Al-Mansouriey') selected @endif>Al-Mansouriey</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-3">
                                                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone number</label>
                                                    <div class="mt-2">
                                                        <input type="text" name="phone" id="phone" autocomplete="phone" value="{{ auth()->user()->phone }}"
                                                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                                <div class="col-span-2">
                                                    <label for="street_address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                                    <div class="mt-2">
                                                        <input type="text" name="street_address" id="street_address" value="{{ optional($address)->street }}" placeholder="ex: Saint Rita Street" autocomplete="street_address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="building_name" class="block text-sm font-medium leading-6 text-gray-900">Building Name</label>
                                                    <div class="mt-2">
                                                        <input type="text" name="building_name" id="building_name" value="{{ optional($address)->building }}" placeholder="ex: Cairo Tower Bld" autocomplete="building_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="floor_number" class="block text-sm font-medium leading-6 text-gray-900">Floor Number</label>
                                                    <div class="mt-2">
                                                        <input type="text" name="floor_number" id="floor_number" value="{{ optional($address)->floor }}" placeholder="ex: 2nd Floor" autocomplete="floor_number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="pb-4">
                                            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                                <div class="col-span-full">
                                                    <label for="note" class="block text-sm font-medium leading-6 text-gray-900">Additional notes</label>
                                                    <div class="mt-2">
                                                        <textarea id="note" name="note" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                                    </div>
                                                    <p class="mt-3 text-sm leading-6 text-gray-600">Write indicate if you have any specific requirements.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-2xl font-semibold leading-6 text-red-500">Total: <span id="total-price"></span>$</h3>
                                    <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button id="confirm-button" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Confirm</button>
                                        <button id="cancel-button" type="button" class="bg-gray-50 mt-3 inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
                url: "{{ route('cart.total') }}",
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
                _token: "{{ csrf_token() }}",
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
                url: "{{ route('checkout.store') }}",
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
                            window.location.href = `{{ route('page.menu') }}`;
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
</script>
