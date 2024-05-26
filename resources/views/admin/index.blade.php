@props(['title' => $title,
        'totalProfit' => $totalProfit,
        'pendingProfit' => $pendingProfit,
        'totalOrders' => $totalOrders,
        'totalUsers' => $totalUsers,
        'todayOrders' => $todayOrders,
        'activeCarts' => $activeCarts,
        'totalProducts' => $totalProducts,
        'totalAddons' => $totalAddons,
        'ordersStats' => $ordersStats,
        'profitStats' => $profitStats
        ])

@extends('layouts.dashboard')

@section('header-scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('content')


    <!-- Start Content -->
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4 mb-4 md:mb-8">
        <section>
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-gray-800">Total Profit</span>
                        <span class="text-lg font-semibold">${{ $totalProfit }}</span>
                    </div>
                    <svg class="w-12 h-12 text-gray-800 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-[#00e396] rounded">${{ $pendingProfit }}</span>
                    <span>Pending</span>
                </div>
            </div>
        </section>
        <section>
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-gray-800">Total Orders</span>
                        <span class="text-lg font-semibold">{{ $totalOrders }}</span>
                    </div>
                    <svg class="w-12 h-12 text-gray-800 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-[#00e396] rounded">{{ $todayOrders }}</span>
                    <span>Today's Orders</span>
                </div>
            </div>
        </section>
        <section>
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-gray-800">Total Users</span>
                        <span class="text-lg font-semibold">{{ $totalUsers }}</span>
                    </div>
                    <svg class="w-12 h-12 text-gray-800 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-[#00e396] rounded">{{ $activeCarts }}</span>
                    <span>Active Carts</span>
                </div>
            </div>
        </section>
        <section>
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-gray-800">Total Products</span>
                        <span class="text-lg font-semibold">{{ $totalProducts }}</span>
                    </div>
                    <svg class="w-12 h-12 text-gray-800 dark:text-primary-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                </div>
                <div>
                    <span class="inline-block px-2 text-sm text-white bg-[#00e396] rounded">{{ $totalAddons }}</span>
                    <span>Products Addons</span>
                </div>
            </div>
        </section>
    </div>

    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2">
            <p class="text-gray-600 font-semibold text-md ml-6 md:ml-10">Users per month:</p>
            <div id="users"></div>
        </div>
        <div class="w-full md:w-1/2">
            <p class="text-gray-600 font-semibold text-md ml-6 md:ml-10">Orders per month:</p>
            <div id="s-col"></div>
        </div>
        <div class="w-full">
            <div id="s-line-area"></div>
        </div>
    </div>
@endsection

