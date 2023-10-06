@extends('layouts.app')
@section('main')
    <div class="swiper menu-swiper">
        <div class="swiper-wrapper">
{{--            @for($i=0;$i<5;$i++)--}}
                <x-menu-card image="{{ asset('storage/icons/burger.svg') }}" white-image="{{ asset('storage/icons/burger-white.svg') }}" name="Burgers"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/fries.svg') }}" white-image="{{ asset('storage/icons/fries-white.svg') }}" name="Fries"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/pizza.svg') }}" white-image="{{ asset('storage/icons/pizza-white.svg') }}" name="Pizza"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/soda.svg') }}" white-image="{{ asset('storage/icons/soda-white.svg') }}" name="Soda"></x-menu-card>
                <x-menu-card image="{{ asset('storage/icons/salad.svg') }}" white-image="{{ asset('storage/icons/salad-white.svg') }}" name="Salad"></x-menu-card>
{{--            @endfor--}}
        </div>
    </div>
    <div class="swiper product-swiper">
        <div class="swiper-wrapper">
{{--            @for($i=0;$i<5;$i++)--}}
                <x-product-card class="p-5 pl-sm-0" image="{{ asset('storage/images/WAE07841.JPG') }}" name="Pizza" price="10" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."></x-product-card>
                <x-product-card class="p-5 pl-sm-0" image="{{ asset('storage/images/WAE07843.JPG') }}" name="Pizza" price="10" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."></x-product-card>
                <x-product-card class="p-5 pl-sm-0" image="{{ asset('storage/images/WAE07845.JPG') }}" name="Pizza" price="10" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."></x-product-card>
                <x-product-card class="p-5 pl-sm-0" image="{{ asset('storage/images/WAE07857.JPG') }}" name="Pizza" price="10" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."></x-product-card>
                <x-product-card class="p-5 pl-sm-0" image="{{ asset('storage/images/WAE07867.JPG') }}" name="Pizza" price="10" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."></x-product-card>
{{--            @endfor--}}
        </div>
    </div>
@endsection
