@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard_main.css') }}">

    <div class="sidebodydiv px-4 py-1">
        <div class="sidebodyhead">
            <h4 class="m-0 text-uppercase">Dashboard</h4>
        </div>

        <div class="container px-0 mt-3 dashboard-main">
            <div class="row">

                <!-- Head Card -->
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Employee</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                           <!-- <h6 class="card2h6 mb-0 text-end">Last 30 days <br> 2568</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Customers</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                            <!--<h6 class="card2h6 mb-0 text-end">+15.03% <i class="fas fa-arrow-trend-up"></i></h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Category</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                            <!--<h6 class="card2h6 mb-0 text-end">Last 30 days <br> 2568</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Subcategory</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                            <!--<h6 class="card2h6 mb-0 text-end">-0.36% <i class="fas fa-arrow-trend-down"></i></h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Product</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                            <!--<h6 class="card2h6 mb-0 text-end">Last 30 days <br> 2568</h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Today</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                            <!--<h6 class="card2h6 mb-0 text-end">-0.36% <i class="fas fa-arrow-trend-down"></i></h6>-->
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">New Orders</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Not Delivered</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">In Progress</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0">0(s)</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-2 col-xl-2 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead_1">
                            <h6 class="card1h6">Completed</h6>
                        </div>
                        <div class="cardscntnt">
                            <h5 class="card1h5 mb-0">0(s)</h5>
                        </div>
                    </div>
                </div>
                

                <!-- Middle Div -->
                <!-- <div class="col-sm-12 col-md-7 col-xl-7 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Recent Orders</h6>
                            <div class="card-input">
                                <input type="text" id="customSearch" class="form-control rounded-1 filterInput w-100"
                                    placeholder=" Search">
                            </div>
                        </div>
                        <div class="table-wrapper cardtable">
                            <table class="example table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Order Id</th>
                                        <th>Order Date</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    
                                    <tr>
                                        <td>Hub 1</td>
                                        <td>Surf Excel</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-primary">Shipped</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 2</td>
                                        <td>Sakthi Masala</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-success">Confirmed</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 3</td>
                                        <td>Park Avenue</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 4</td>
                                        <td>Sunsilk</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-primary">Shipped</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 5</td>
                                        <td>Clinic Plus</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-success">Confirmed</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 6</td>
                                        <td>Sunsilk</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-primary">Shipped</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 7</td>
                                        <td>Surf Excel</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 8</td>
                                        <td>Sakthi Masala</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-primary">Shipped</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hub 9</td>
                                        <td>Park Avenue</td>
                                        <td>15 Nov, 2024</td>
                                        <td>15</td>
                                        <td>₹ 15000</td>
                                        <td><span class="text-warning">Pending</span></td>

                                    </tr>
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-sm-12 col-md-5 col-xl-5 pe-0 mb-3 row">
                    <div class="col-sm-12 col-md-12 col-xl-12 pe-0">
                        <div class="cardsdiv">
                            <div class="cardshead">
                                <h6 class="card1h6">Earning Stage</h6>
                                <h6 class="card1h6 text-end">0</h6>
                            </div>
                            <div class="cardscntnt_1">
                                <div class="cardct">
                                    <div class="carddivide">
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 1</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                        <div class="brdr"></div>
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 2</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                        <div class="brdr"></div>
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 3</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                    </div>
                                    <div class="card_img ms-auto">
                                        <img src="{{ asset('assets/images/icon1.png') }}" height="40px" alt="">
                                    </div>
                                </div>
                                <div class="cardct mt-3">
                                    <h6 class="card2h6 mb-0">262 Ready to Move Earning Stage</h6>
                                    <h6 class="card2h6 text-success text-end mb-0"><i class="fas fa-arrow-trend-up">&nbsp;
                                            0
                                            %</i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-12 pe-0">
                        <div class="cardsdiv">
                            <div class="cardshead">
                                <h6 class="card1h6">Grow Stage</h6>
                                <h6 class="card1h6 text-end">0</h6>
                            </div>
                            <div class="cardscntnt_1">
                                <div class="cardct">
                                    <div class="carddivide">
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 1</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                        <div class="brdr"></div>
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 2</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                        <div class="brdr"></div>
                                        <div>
                                            <h6 class="card1h6 mb-1">Level 3</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                    </div>
                                    <div class="card_img ms-auto">
                                        <img src="{{ asset('assets/images/icon2.png') }}" height="40px" alt="">
                                    </div>
                                </div>
                                <div class="cardct mt-3">
                                    <h6 class="card2h6 mb-0">262 Ready to Move Earning Stage</h6>
                                    <h6 class="card2h6 text-success text-end mb-0"><i class="fas fa-arrow-trend-up">&nbsp;
                                            0
                                            %</i></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-12 pe-0">
                        <div class="cardsdiv">
                            <div class="cardshead">
                                <h6 class="card1h6">Overall</h6>
                            </div>
                            <div class="cardscntnt_1">
                                <div class="cardct">
                                    <div class="carddivide_1">
                                        <div>
                                            <h6 class="card1h6 mb-1">Grow Stage</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                        <div class="brdr"></div>
                                        <div>
                                            <h6 class="card1h6 mb-1">Earning Stage</h6>
                                            <h5 class="card1h5 mb-0">0(s)</h5>
                                        </div>
                                    </div>
                                    <div class="card_img ms-auto">
                                        <img src="{{ asset('assets/images/icon3.png') }}" height="40px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-7 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Discounted Product Sales</h6>
                            <select class="form-select ms-auto" name="month" id="month">
                                <option value="" selected disabled>Select Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div id="chart1" class="mt-2"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-5 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Category</h6>
                            <select class="form-select ms-auto" name="month" id="month">
                                <option value="" selected disabled>Select Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div id="chart2" class="mt-2"></div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-xl-6 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Profit</h6>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-2">Fast Moving Product</h6>
                        </div>
                        <div class="cardcard">
                            <div class="card2card mb-3">
                                <div class="card2cardimg">
                                    <img src="{{ asset('assets/images/product_img_1.png') }}" height="100%" width="100%"
                                        alt="">
                                </div>
                                <div class="card2cardct">
                                    <h5 class="card1h5">Surf Excel</h5>
                                    <div class="progress-container">
                                        <div class="linear-progress">
                                            <div class="progress-bar" id="progress-bar-1"></div>
                                        </div>
                                        <div class="progress-value" id="progress-value-1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card2card mb-3">
                                <div class="card2cardimg">
                                    <img src="{{ asset('assets/images/product_img.png') }}" height="100%" width="100%"
                                        alt="">
                                </div>
                                <div class="card2cardct">
                                    <h5 class="card1h5">Park Avenue</h5>
                                    <div class="progress-container">
                                        <div class="linear-progress">
                                            <div class="progress-bar" id="progress-bar-2"></div>
                                        </div>
                                        <div class="progress-value" id="progress-value-2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card2card mb-3">
                                <div class="card2cardimg">
                                    <img src="{{ asset('assets/images/product_img_2.png') }}" height="100%" width="100%"
                                        alt="">
                                </div>
                                <div class="card2cardct">
                                    <h5 class="card1h5">Good Day</h5>
                                    <div class="progress-container">
                                        <div class="linear-progress">
                                            <div class="progress-bar" id="progress-bar-3"></div>
                                        </div>
                                        <div class="progress-value" id="progress-value-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card2card mb-3">
                                <div class="card2cardimg">
                                    <img src="{{ asset('assets/images/product_img.png') }}" height="100%" width="100%"
                                        alt="">
                                </div>
                                <div class="card2cardct">
                                    <h5 class="card1h5">Park Avenue</h5>
                                    <div class="progress-container">
                                        <div class="linear-progress">
                                            <div class="progress-bar" id="progress-bar-4"></div>
                                        </div>
                                        <div class="progress-value" id="progress-value-4"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card2card mb-3">
                                <div class="card2cardimg">
                                    <img src="{{ asset('assets/images/product_img_1.png') }}" height="100%" width="100%"
                                        alt="">
                                </div>
                                <div class="card2cardct">
                                    <h5 class="card1h5">Surf Excel</h5>
                                    <div class="progress-container">
                                        <div class="linear-progress">
                                            <div class="progress-bar" id="progress-bar-5"></div>
                                        </div>
                                        <div class="progress-value" id="progress-value-5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5 col-xl-5 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Hub</h6>
                        </div>
                        <div id="chart4"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-xl-7 pe-0 mb-3 cards">
                    <div class="cardsdiv">
                        <div class="cardshead">
                            <h6 class="card1h6 mb-0">Hub Sale Reports</h6>
                            <h6 class="card1h6 mb-0 text-end">Last 7 Days</h6>
                        </div>
                        <div id="chart5"></div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>


    <!-- Scripts -->
    <!-- Apex Charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Chart 1 -->
    <script>
        var options = {
            series: [{
                data: [20, 50, 80, 10, 100, 30, 90, 60, 100, 75, 85, 30]
            }],
            chart: {
                height: 280,
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                    },
                },
            },
            colors: ['#0427B9'],
            plotOptions: {
                bar: {
                    columnWidth: '30%',
                    distributed: true,
                    borderRadius: 5,
                },
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                labels: {
                    style: {
                        fontSize: '7px',
                        fontWeight: 500,
                    },
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
    </script>

    <!-- Chart 2 -->
    <script>
        var options = {
            series: [50, 110, 90],
            labels: ['Healthcare', 'Drinks', 'Snacks'],
            colors: ['#0427B9', '#435DCA', '#8192DB', '#9AA8E2', '#C0C8ED'],
            chart: {
                type: 'donut',
                height: 275,
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 300,
                options: {
                    chart: {
                        height: 320,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
    </script>

    <!-- Chart 3 -->
    <script>
        var months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        var data1 = [];
        var data2 = [];

        function generateMonthlyData(data, yrange) {
            for (var i = 0; i < months.length; i++) {
                var newVal = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                data.push(newVal);
            }
        }
        generateMonthlyData(data1, { min: 10, max: 100 });
        generateMonthlyData(data2, { min: 20, max: 100 });
        var options = {
            series: [
                {
                    name: 'Last Year',
                    data: data1
                },
                {
                    name: 'This Year',
                    data: data2
                }
            ],
            chart: {
                id: 'monthly_chart',
                height: 300,
                type: 'line',
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: [2, 2],
                dashArray: [0, 5]
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: months,
                labels: {
                    style: {
                        fontSize: '7px',
                        fontWeight: 500,
                    },
                },
            },
            yaxis: {
                max: 100
            },
            colors: ['#4679F9', '#628DFA'],
            legend: {
                show: false
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
    </script>

    <!-- Chart 4 -->
    <script>
        var options = {
            series: [50, 110, 90, 80],
            labels: ['Hub 1', 'Hub 2', 'Hub 3', 'Hub 4'],
            colors: ['#991F17', '#B04238', '#C86558', '#B3BFD1', '#D7E1EE'],
            chart: {
                type: 'donut',
                height: 275,
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: false
            },
            responsive: [{
                breakpoint: 300,
                options: {
                    chart: {
                        height: 320,
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chart4"), options);
        chart.render();
    </script>

    <!-- Chart 5 -->
    <script>
        var months = ['MON', 'TUES', 'WED', 'THUR', 'FRI', 'SAT', 'SUN'];
        var data1 = [];
        var data2 = [];
        var data3 = [];

        function generateMonthlyData(data, yrange) {
            for (var i = 0; i < months.length; i++) {
                var newVal = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                data.push(newVal);
            }
        }
        generateMonthlyData(data1, { min: 10, max: 100 });
        generateMonthlyData(data2, { min: 20, max: 100 });
        generateMonthlyData(data3, { min: 20, max: 100 });
        var options = {
            series: [
                {
                    name: 'Hub 1',
                    data: data1
                },
                {
                    name: 'Hub 2',
                    data: data2
                },
                {
                    name: 'Hub 3',
                    data: data3
                }
            ],
            chart: {
                id: 'monthly_chart',
                height: 300,
                type: 'line',
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: [2, 2],
                dashArray: [0, 5]
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: months,
                labels: {
                    style: {
                        fontSize: '10px',
                        fontWeight: 500,
                    },
                },
            },
            yaxis: {
                max: 100
            },
            colors: ['#4679F9', '#628DFA'],
            legend: {
                show: false
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart5"), options);
        chart.render();
    </script>

    <!-- Datatable -->
    <script>
        // DataTables List
        $(document).ready(function () {
            var table = $(".example").DataTable({
                paging: false,
                searching: true,
                ordering: true,
                bDestroy: true,
                info: false,
                responsive: true,
                pageLength: 10,
                dom: '<"top"f>rt<"bottom"lp><"clear">',
            });

            $("#customSearch").on("keyup", function () {
                table.search(this.value).draw();
            });
        });
    </script>

    <!-- Progress Bar -->
    <script>
        function updateProgress(progressBarId, progressValueId, targetPercentage) {
            let progressBar = document.querySelector(`#${progressBarId}`);
            let progressValue = document.querySelector(`#${progressValueId}`);
            let progressStartValue = 0;
            let speed = 50;
            function update() {
                progressValue.textContent = `${progressStartValue}%`;
                progressBar.style.width = `${progressStartValue}%`;
                if (progressStartValue < targetPercentage) {
                    progressStartValue++;
                }
            }
            update();
            setInterval(update, speed);
        }
        updateProgress("progress-bar-1", "progress-value-1", 80);
        updateProgress("progress-bar-2", "progress-value-2", 100);
        updateProgress("progress-bar-3", "progress-value-3", 50);
        updateProgress("progress-bar-4", "progress-value-4", 25);
    </script>

@endsection