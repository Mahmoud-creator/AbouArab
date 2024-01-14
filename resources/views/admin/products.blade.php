@extends('layouts.dashboard')
@section('header-buttons')
    <button class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-400 transition-all">
        <a href="{{ route('admin.products.create') }}">Add product</a>
    </button>
@endsection
@section('content')
    @if(count($products))
        <div class="flex flex-row gap-2 ml-3 md:ml0 md:w-48 w-full">
            <input type="text" class="rounded-md border-0 placeholder-gray-300" value="" id="search-products" placeholder="Search products">
            <button class="px-2 py-1.5 bg-green-500 text-white hover:bg-green-400 rounded-md border-0">Search</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-center">
            @foreach($products as $product)
                <x-product-card class="p-5 pl-sm-0 w-full" :product="$product" isAdmin="true"></x-product-card>
            @endforeach
        </div>
        {{ $products->links('vendor.pagination.tailwind') }}

    @else
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No
                        products</h3>
                </div>
            </div>
        </div>
    @endif
@endsection
