@props(["products" => []])
@extends('layouts.app')
@section('main')
    <div class="swiper menu-swiper">
        <div class="swiper-wrapper">
                <x-menu-card image="{{ asset('storage/icons/burger.svg') }}" white-image="{{ asset('storage/icons/burger-white.svg') }}" name="Burgers"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/fries.svg') }}" white-image="{{ asset('storage/icons/fries-white.svg') }}" name="Fries"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/pizza.svg') }}" white-image="{{ asset('storage/icons/pizza-white.svg') }}" name="Pizza"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/soda.svg') }}" white-image="{{ asset('storage/icons/soda-white.svg') }}" name="Soda"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/salad.svg') }}" white-image="{{ asset('storage/icons/salad-white.svg') }}" name="Salad"></x-menu-card>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center">
        @foreach($products as $product)
            <x-product-card class="p-5 pl-sm-0 w-full" :product="$product"></x-product-card>
        @endforeach
    </div>
@endsection
