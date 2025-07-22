@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <style>
        .table thead th {
            background-color: var(--theadbg) !important;
        }
    </style>

    <div class="sidebodydiv px-4 py-1">
        <div class="sidebodyhead">
            <h4 class="m-0">Orders List</h4>
        </div>

        <div class="container-fluid px-0 mt-4 listtable">
            <div class="filter-container row mb-3">
                <div class="custom-search-container col-sm-12 col-md-8">
                    <select class="headerDropdown form-select filter-option">
                        <option value="All" selected>All</option>
                    </select>
                    <input type="text" id="customSearch" class="form-control filterInput" placeholder=" Search">
                </div>

                <div class="select1 col-sm-12 col-md-2 mx-auto">

                </div>
            </div>

            <div class="table-wrapper">
                <table class="example table">
                    <thead>
                        <tr>
                            <th>serial no</th>
                            <!--<th>Id</th>-->
                            <th>Name</th>
                            <th>Order ID</th>
                            <th>Phone</th>
                            <th>Products</th>
                            <!--<th>Date</th>-->
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($odr_clist as $cus_value)
                        <tr>
                            
                            <td> {{$loop->iteration}} </td>
                            <!--<td>{{ $cus_value->id }}</td>-->
                           <td>{{ $cus_value->c_name }}</td>
                           <td>{{ $cus_value->order_id }}</td>
                          <td>{{ $cus_value->c_contact }}</td>  
                          <td>{{ $cus_value->no_of_products }}</td>  
                          <td>{{ $cus_value->amount }}</td>
                          <td>{{ $cus_value->status }}</td>  
                          <!-- 
                        
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/images/avatar.png') }}" class="rounded-5" height="30px"
                                        alt="">
                                    
                            <td><span class="text-success">Deliverd</span></td>-->
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('order.order-profile',['id'=>$cus_value->id]) }}" data-bs-toggle="tooltip"
                                        data-bs-title="Profile"><i class="fas fa-arrow-up-right-from-square"></i></a>
                                    <!-- <a data-bs-toggle="modal" data-bs-target="#updateorder"><i
                                            class="fas fa-pen-to-square"></i></a> -->
                                </div>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Order Modal -->
    <div class="modal fade" id="updateorder" tabindex="-1" aria-labelledby="updateorderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_product.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="updateorderLabel">Update Order</h4>
                    <form>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input my-auto" type="checkbox" value="" id="ordercheckbox_1">
                                <label class="form-check-label" for="ordercheckbox_1">
                                    Order Confirmed
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input my-auto" type="checkbox" value="" id="ordercheckbox_2">
                                <label class="form-check-label" for="ordercheckbox_2">
                                    Shipped
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input my-auto" type="checkbox" value="" id="ordercheckbox_3">
                                <label class="form-check-label" for="ordercheckbox_3">
                                    Out For Delivery
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input my-auto" type="checkbox" value="" id="ordercheckbox_4">
                                <label class="form-check-label" for="ordercheckbox_4">
                                    Delivered
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                            <button type="button" class="modalbtn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Datatable -->
    <script>
        // DataTables List
        $(document).ready(function () {
            var table = $(".example").DataTable({
                paging: true,
                searching: true,
                ordering: true,
                bDestroy: true,
                info: false,
                responsive: true,
                pageLength: 10,
                dom: '<"top"f>rt<"bottom"lp><"clear">',
            });
        });

        // List Filter
        $(document).ready(function () {
            var table = $(".example").DataTable();
            $(".example thead th").each(function (index) {
                var headerText = $(this).text();
                if (
                    headerText != "" &&
                    headerText.toLowerCase() != "action" &&
                    headerText.toLowerCase() != "image"
                ) {
                    $(".headerDropdown").append(
                        '<option value="' + index + '">' + headerText + "</option>"
                    );
                }
            });
            $(".filterInput").on("keyup", function () {
                var selectedColumn = $(".headerDropdown").val();
                if (selectedColumn !== "All") {
                    table.column(selectedColumn).search($(this).val()).draw();
                } else {
                    table.search($(this).val()).draw();
                }
            });
            $(".headerDropdown").on("change", function () {
                $(".filterInput").val("");
                table.search("").columns().search("").draw();
            });
        });
    </script>

@endsection