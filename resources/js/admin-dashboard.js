$(() => {
    const userMenuButton = $('#user-menu-button');
    const userMenu = $('#user-menu');
    const mobileMenuButton = $('#mobile-menu-button');
    const mobileMenu = $('#mobile-menu');

    userMenuButton.click(function(event) {
        event.preventDefault();
        userMenu.toggleClass('hidden');
    });
    mobileMenuButton.click(function(event) {
        event.preventDefault();
        mobileMenu.toggleClass('hidden');
    });

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


})
