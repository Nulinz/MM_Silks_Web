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
           
            <div class="col-sm-12 col-md-3 col-xl-3 pe-0 mb-3 cards">
                <div class="cardsdiv">
                <a href="{{route('customer.customer_list')}}">
                    <div class="cardshead_1">
                        <h6 class="card1h6">Customers</h6>
                    </div>
                    <div class="cardscntnt">
                        <h5 class="card1h5 mb-0">{{$count_customers}}</h5>
                        <!-- <h6 class="card2h6 mb-0 text-end">Last 30 days <br> 2568</h6>-->
                    </div>
                </div>
                </a>
            </div>
          
            <div class="col-sm-12 col-md-3 col-xl-3 pe-0 mb-3 cards">
                <div class="cardsdiv">
                    <a href="{{ route('create.product-list') }}">
                    <div class="cardshead_1">
                        <h6 class="card1h6">Product</h6>

                    </div>
                    <div class="cardscntnt">
                        <h5 class="card1h5 mb-0"> {{$total_product}}</h5>
                        <!--<h6 class="card2h6 mb-0 text-end">+15.03% <i class="fas fa-arrow-trend-up"></i></h6>-->
                    </div>
                  </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xl-3 pe-0 mb-3 cards">
                <div class="cardsdiv">
                    <a href="{{ route('create.item_list')}}">
                    <div class="cardshead_1">
                        <h6 class="card1h6">Items</h6>
                    </div>
                    <div class="cardscntnt">
                        <h5 class="card1h5 mb-0">{{$total_items}}</h5>
                        <!--<h6 class="card2h6 mb-0 text-end">Last 30 days <br> 2568</h6>-->
                    </div>
                   </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-xl-3 pe-0 mb-3 cards">
                <div class="cardsdiv">
                  <a href="{{ route('order.order-list') }}">
                    <div class="cardshead_1">
                        <h6 class="card1h6">Orders</h6>
                    </div>
                    <div class="cardscntnt">
                        <h5 class="card1h5 mb-0">{{$total_orders}}</h5>
                        <!--<h6 class="card2h6 mb-0 text-end">-0.36% <i class="fas fa-arrow-trend-down"></i></h6>-->
                    </div>
                   </a>
                </div>
            </div>



            <!-- Middle Div -->
            <div class="col-sm-12 col-md-6 col-xl-6 pe-0 mb-3 cards">
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
                                @foreach ($recent_order as $order)

                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{$order->customer_name}}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ $order->no_of_products }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <!--<span class="text-primary">{{ $order->status }}</span>-->
                                    <td>
                                        
                                    <a href="{{ route('order.order-profile', ['id' => $order->id]) }}"
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-title="Profile">
                                        <i class=""></i>{{ $order->status }}
                                        </a>
                                        </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!--second row-->
            <div class="col-sm-12 col-md-6 col-xl-6 pe-0 mb-3 cards">
                <div class="cardsdiv">
                    <div class="cardshead">
                        <h6 class="card1h6 mb-0">Return Orders</h6>
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
                                    <th>file</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_return as $return)

                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{$return->customer_name}}</td>
                                    <td>{{ $return->order_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($return->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ asset('image/return_file/' . $return->return_image) }}" download>
                                            Download
                                        </a>
                                    </td>
                                    <td><span class="text-primary">{{ $return->status }}</span></td>
                                </tr>
                                @endforeach

                            </tbody>    
                        </table>
                    </div>
                </div>
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
                    click: function(chart, w, e) {},
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
        generateMonthlyData(data1, {
            min: 10,
            max: 100
        });
        generateMonthlyData(data2, {
            min: 20,
            max: 100
        });
        var options = {
            series: [{
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
        generateMonthlyData(data1, {
            min: 10,
            max: 100
        });
        generateMonthlyData(data2, {
            min: 20,
            max: 100
        });
        generateMonthlyData(data3, {
            min: 20,
            max: 100
        });
        var options = {
            series: [{
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
        $(document).ready(function() {
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

            $("#customSearch").on("keyup", function() {
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