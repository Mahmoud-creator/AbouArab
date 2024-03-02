@props(["products" => []])
@extends('layouts.app')
@section('main')
    <div class="w-full flex flex-row h-full">
        <div class="w-full md:w-3/4">
            <div class="swiper menu-swiper">
                <div class="swiper-wrapper">
                    <x-menu-card :all="true"></x-menu-card>
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
        </div>

        <div class="hidden md:block md:w-1/5 fixed top-0 right-0" style="height: 100%">
            @include('components.sideCart')
        </div>
    </div>
@endsection
