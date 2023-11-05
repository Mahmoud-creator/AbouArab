@extends('layouts.dashboard')
@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center">
        @foreach($products as $product)
            <x-product-card class="p-5 pl-sm-0 w-full" :product="$product"></x-product-card>
        @endforeach
    </div>
@endsection
