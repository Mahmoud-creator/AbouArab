@props(["products" => []])
@extends('layouts.app')
@section('main')
    <div class="container mx-auto mt-10 p-4">
        <h1 class="text-4xl font-semibold mb-6">About Us</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="about-title font-semibold mb-4">Our Story</h2>
            <p class="about-description text-gray-700 mb-4">
                On the initiative of Hajj Zuhair Arabi, the Abu Arab Bakery Company was established
                In the year 2000, in the Khaldeh area on the main road, it achieved great success
                Presenting the modern cake that was sold on bicycles.
            </p>
            <p class="about-description text-gray-700 mb-4">
                He turned it into a restaurant serving fast food.
                During these nineteen years, 12 new branches were opened within
                Lebanese territories.
            </p>
            <p class="about-description text-gray-700 mb-4">
                The first branch began offering Asrouniya cake with mountain thyme (green), Aleppo, and bacon cheese, then it began
                Hajj Zuhair Orabi, adding other ingredients such as kashkawan, akkawi, turkey, mortadial, and
                Chocolate until the flavors began to include pizza, sausage, and meat with dough.
            </p>
            <p class="about-description text-gray-700 mb-4">
                The word cake became associated with the name Abu Arab, as is said about the Hoover brand
                Kleenex.
            </p>

            <h2 class="about-title font-semibold mb-4">Our Mission</h2>
            <p class="about-description text-gray-700 mb-4">
                Providing the best service and quality to Abu Arab customers while maintaining a price that suits all classes of society
            </p>

            <h2 class="about-title font-semibold mb-4">Our Vision</h2>
            <p class="about-description text-gray-700">
                Growth and investment in Lebanon and the rest of the world to spread the culture of Levantine food (modern cake) and the generous service that characterizes the people of the Levant.
            </p>
        </div>

        <div class="mt-8 text-center">
            <h2 class="text-3xl font-semibold">Abou Arab</h2>
            <p class="text-gray-600">Your Trusted Source</p>
        </div>
    </div>
@endsection
