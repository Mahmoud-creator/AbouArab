@props(["products" => []])
@extends('layouts.app')
@section('header-scripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js"></script>
@endsection
@section('main')
    <div class="w-full flex flex-row h-full">
        <div class="w-full md:w-3/4">
            <div class="swiper menu-swiper">
                <div class="swiper-wrapper">
                    @foreach(\App\Models\Category::all() as $category)
                        <x-menu-card :category="$category"></x-menu-card>
                    @endforeach
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center">
                @foreach($products as $product)
                    <x-product-card class="p-5 pl-sm-0 w-full" :product="$product"></x-product-card>
                @endforeach
            </div>
            <x-product-modal/>
{{--            <div class="mx-4">--}}
{{--                {{ $products->links() }}--}}
{{--            </div>--}}
        </div>

        <div class="hidden md:block md:w-1/5 fixed top-0 right-0" style="height: 100%">
            @include('components.sideCart')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            const $openModalButton = $('.open-product-modal');
            const $modal = $('#product-modal');
            const $modalBackdrop = $('#product-modal-backdrop');
            const $modalPanel = $('#product-modal-panel');
            const cancelButton = $('#cancel-button');
            const confirmButton = $('#confirm-button');

            // Function to show the modal
            function showModal(productEl) {
                let id = productEl.find('input[name="id"]').val();
                let image = productEl.find('input[name="image"]').val();
                let productName = productEl.find('input[name="productName"]').val();
                let productDescription = productEl.find('input[name="productDescription"]').val();
                let productPrice = productEl.find('input[name="productPrice"]').val();
                let productAddons = JSON.parse(productEl.find('input[name="productAddons"]').val());

                $('#product-modal-image').attr('src', image);
                $('#product-modal-name').text(productName);
                $('#product-modal-description').text(productDescription);
                $('#product-modal-price').text(productPrice + '$');
                $('#product-modal-price').data('price', productPrice);
                $('#product-modal-id').data('product-id', id);

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
            $openModalButton.on('click', function () {
                showModal($(this).parent());
            })

            // Add to cart
            $('.add-to-cart').on('click', function () {
                let id = $(this).data('id');
                $.ajax({
                    'url': '{{ route('cart.store') }}',
                    'type': 'POST',
                    'data': {
                        'productId': id,
                        '_token': '{{ csrf_token() }}',
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

                        $('#sideCart').load(window.location.href + ' #sideCart');
                    }
                })
            });

            cancelButton.click(hideModal);
        })
    </script>
@endsection
