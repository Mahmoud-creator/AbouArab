@extends('layouts.app')
@section('main')
    <section class="w-full h-screen text-center space-y-10">
        <div class="w-full md:w-5/6 md:rounded-xl flex flex-col-reverse lg:flex-row mx-auto md:mt-10 shadow-md bg-white" style="min-height: 500px">
            <!-- Section 1: Kaake -->
            <div class="flex-1">
                <div class="md:p-9 px-4">

                    <h1 class="text-4xl font-bold md:mb-4 text-yellow-600">Kaake</h1>
                    <hr class="border-t-2 border-red-300 my-6">
                    <div class="text-gray-700">
                        <p class="md:leading-loose md:tracking-wide mb-4 text-yellow-600">Indulge in the delightful flavors of our traditional Kaake.</p>
                        <p class="md:leading-loose md:tracking-wide mb-4 text-red-600">Made with love and sprinkled with a touch of nostalgia.</p>
                        <p class="md:leading-loose md:tracking-wide mb-4 text-gray-700">Our Kaake is the perfect companion for your tea or coffee.</p>
                    </div>

                    <div class="text-md mb-6 md:mb-0 md:text-2xl font-bold text-red-600">
                        <a href="{{ route('products.category', 1) }}" class="px-4 py-2 inline-block text-white bg-red-600 hover:bg-red-700 rounded-md transition duration-300">Try now</a>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <img src="{{ asset('storage/banners/kaake.jpg') }}" alt="Kaake"
                     class="md:rounded-tr-xl md:rounded-br-xl w-full h-full object-center object-cover">
            </div>
        </div>

        <div class="w-full md:w-5/6 mx-auto md:rounded-xl flex flex-col lg:flex-row mt-10 shadow-md bg-white" style="min-height: 500px">
            <!-- Section 2: Kaake Double and Triple Cheese -->
            <div class="flex-1">
                <img src="{{ asset('storage/banners/pizza-double.jpg') }}" alt="Cheese"
                     class="md:rounded-tl-xl md:rounded-bl-xl w-full h-full object-center object-cover">
            </div>
            <div class="flex-1">
                <div class="md:p-9 px-4">

                    <h1 class="text-4xl font-bold md:mb-4 text-red-600">Kaake Double and Triple Cheese</h1>
                    <hr class="border-t-2 border-red-300 my-6">

                    <div class="text-gray-700">

                        <p class="md:leading-loose md:tracking-wide mb-4 text-red-600">Experience the ultimate cheesy delight with our Kaake Double and Triple Cheese.</p>
                        <p class="md:leading-loose md:tracking-wide mb-4 text-gray-700">Each bite is a symphony of flavors as the rich cheese oozes out, leaving you craving for more.</p>

                    </div>

                    <div class="text-md mb-6 md:mb-0 md:text-2xl font-bold text-red-600">
                        <a href="{{ route('products.category', 2) }}" class="px-4 py-2 inline-block text-white bg-red-600 hover:bg-red-700 rounded-md transition duration-300">Try now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-5/6 md:rounded-xl flex flex-col-reverse lg:flex-row mx-auto md:mt-10 shadow-md bg-white" style="min-height: 500px">
            <!-- Section 3: Pizza -->
            <div class="flex-1">
                <div class="md:p-9 px-4">

                    <h1 class="text-4xl font-bold md:mb-4 text-yellow-600">Pizza</h1>
                    <hr class="border-t-2 border-red-300 my-6">

                    <div class="text-gray-700">
                        <p class="mb-4 md:leading-loose md:tracking-wide text-yellow-600">Embark on a culinary journey with our artisanal pizzas.</p>
                        <p class="mb-4 md:leading-loose md:tracking-wide text-gray-700">Crafted with the finest ingredients and baked to perfection, our pizzas promise to satisfy your cravings and delight your taste buds.</p>
                    </div>

                    <div class="text-md mb-6 md:mb-0 md:text-2xl font-bold text-red-600">
                        <a href="{{ route('products.category', 3) }}" class="px-4 py-2 inline-block text-white bg-red-600 hover:bg-red-700 rounded-md transition duration-300">Try now</a>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <img src="{{ asset('storage/banners/pizza.jpg') }}" alt="Pizza"
                     class="md:rounded-tr-xl md:rounded-br-xl w-full h-full object-center object-cover">
            </div>
        </div>

        <div class="w-full md:w-5/6 mx-auto md:rounded-xl flex flex-col lg:flex-row mt-10 shadow-md bg-white" style="min-height: 500px">
            <!-- Section 4: Beverages -->
            <div class="flex-1">
                <img src="{{ asset('storage/banners/beverages.jpg') }}" alt="Beverages"
                     class="md:rounded-tl-xl md:rounded-bl-xl w-full h-full object-center object-cover">
            </div>
            <div class="flex-1">
                <div class="md:p-9 px-4">

                    <h1 class="text-4xl font-bold md:mb-4 text-red-600">Beverages</h1>
                    <hr class="border-t-2 border-red-300 my-6">

                    <div class="text-gray-700">
                        <p class="mb-4 md:leading-loose md:tracking-wide text-red-600">Quench your thirst with our refreshing range of beverages.</p>
                        <p class="mb-4 md:leading-loose md:tracking-wide text-gray-700">From aromatic coffees to fruity concoctions, our beverages are the perfect complement to your delicious meal.</p>
                    </div>

                    <div class="text-md mb-6 md:mb-0 md:text-2xl font-bold text-red-600">
                        <a href="{{ route('products.category', 4) }}" class="px-4 py-2 inline-block text-white bg-red-600 hover:bg-red-700 rounded-md transition duration-300">Try now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-5/6 md:rounded-xl flex flex-col-reverse lg:flex-row mx-auto md:mt-10 shadow-md bg-white" style="min-height: 500px">
            <!-- Section 5: Desserts -->
            <div class="flex-1">
                <div class="md:p-9 px-4">

                    <h1 class="text-4xl font-bold md:mb-4 text-yellow-600">Desserts</h1>
                    <hr class="border-t-2 border-red-300 my-6">

                    <div class="text-gray-700">
                        <p class="mb-4 md:leading-loose md:tracking-wide text-yellow-600">Indulge your sweet tooth with our heavenly desserts.</p>
                        <p class="mb-4 md:leading-loose md:tracking-wide text-gray-700">From creamy cheesecakes to mouthwatering chocolate treats, our desserts are the perfect finale to your dining experience.</p>
                    </div>

                    <div class="text-md mb-6 md:mb-0 md:text-2xl font-bold text-red-600">
                        <a href="{{ route('products.category', 5) }}" class="px-4 py-2 inline-block text-white bg-red-600 hover:bg-red-700 rounded-md transition duration-300">Try now</a>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <img src="{{ asset('storage/banners/donut.jpg') }}" alt="Desserts"
                     class="md:rounded-tr-xl md:rounded-br-xl w-full h-full object-center object-cover">
            </div>
        </div>

    </section>
@endsection
