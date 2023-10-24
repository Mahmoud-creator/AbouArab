@props(["products" => []])
@extends('layouts.app')
@section('main')
    <div class="swiper menu-swiper">
        <div class="swiper-wrapper">
            @foreach(\App\Models\Category::all() as $category)
                <x-menu-card image="{{ asset($category->image) }}" white-image="{{ asset($category->white_image) }}" name="{{ $category->name }}"></x-menu-card>
            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center">
        @foreach($products as $product)
            <x-product-card class="p-5 pl-sm-0 w-full" :product="$product"></x-product-card>
        @endforeach
    </div>
@endsection
