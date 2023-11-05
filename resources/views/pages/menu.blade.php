@props(["products" => []])
@extends('layouts.app')
@section('main')
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
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.add-to-cart').on('click', function (){
                let id = $(this).data('id');
                $.ajax({
                    'url': '{{ route('cart.store') }}',
                    'type': 'POST',
                    'data': {
                        'productId': id,
                        '_token': '{{ csrf_token() }}',
                    },
                    'success': function (data) {
                        console.log(data.message);
                        setTimeout(function (){

                        }, 2000);
                    }
                })
            });
        })
    </script>
@endsection
