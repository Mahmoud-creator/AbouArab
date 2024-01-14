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

@section('footer-scripts')
    <script>
        'use strict';
        $(document).ready(function () {
            if ($('#users').length > 0) {
                let options = {
                    chart: {height: 350, type: "line", toolbar: {show: false},},
                    dataLabels: {enabled: false},
                    stroke: {curve: "smooth"},
                    series: [{
                        name: "Orders",
                        color: '#3D5EE1',
                        data: [45, 60, 75, 51, 42, 42, 30]
                    }, {name: "Customers", color: '#70C4CF', data: [24, 48, 56, 32, 34, 52, 25]}],
                    xaxis: {categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],}
                }
                let chart = new ApexCharts(document.querySelector("#users"), options);
                chart.render();
            }
            if ($('#s-line-area').length > 0) {
                let sLineArea = {
                    chart: {height: 350, type: 'area', toolbar: {show: false,}},
                    dataLabels: {enabled: false},
                    stroke: {curve: 'smooth'},
                    series: [{name: 'series1', data: [31, 40, 28, 51, 42, 109, 100]}, {
                        name: 'series2',
                        data: [11, 32, 45, 32, 34, 52, 41]
                    }],
                    xaxis: {
                        type: 'datetime',
                        categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
                    },
                    tooltip: {x: {format: 'dd/MM/yy HH:mm'},}
                }
                let chart = new ApexCharts(document.querySelector("#s-line-area"), sLineArea);
                chart.render();
            }
            if ($('#s-col').length > 0) {
                let sCol = {
                    chart: {height: 350, type: 'bar', toolbar: {show: false,}},
                    plotOptions: {bar: {horizontal: false, columnWidth: '55%', endingShape: 'rounded'},},
                    dataLabels: {enabled: false},
                    stroke: {show: true, width: 2, colors: ['transparent']},
                    series: [{name: 'Net Profit', data: [44, 55, 57, 56, 61, 58, 63, 60, 66]}, {
                        name: 'Revenue',
                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                    }],
                    xaxis: {categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],},
                    yaxis: {title: {text: '$ (thousands)'}},
                    fill: {opacity: 1},
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$ " + val + " thousands"
                            }
                        }
                    }
                }
                let chart = new ApexCharts(document.querySelector("#s-col"), sCol);
                chart.render();
            }

        });

    </script>
@endsection
