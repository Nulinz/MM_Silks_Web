@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <style>
        .table thead th {
            background-color: var(--theadbg) !important;
        }
    </style>

    <div class="sidebodydiv px-4 py-1">
        <!--
            <div class="sidebodyhead">
            <h4 class="m-0">Subcategory List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addbrand"><button class="listbtn">Add</button></a>
        </div>-->
        <!-- <div>
        @if(session()->has('message'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Message',
                            text: '{{ session("message") }}',
                            icon: 'success',

                            confirmButtonText: 'OK',
                            customClass: {
                        popup: 'custom-swal-popup'
                    }
                        });
                    });
                </script>
                <style>
            /* Reduce SweetAlert popup size */
            .custom-swal-popup {
                width: 230px !important; /* default is ~500px *
                padding: 1rem !important;        /* 👈 Less padding = less height */
                font-size: 0.9rem;
                border-radius: 10px;
                background-color: black;
              
            }
        </style>
            @endif
        </div> -->

        <div class="container-fluid px-0 mt-4 listtable">
            <div class="filter-container row mb-3">
                <div class="custom-search-container col-sm-12 col-md-8">
                    <select class="headerDropdown form-select filter-option">
                        <option value="All" selected>All</option>
                    </select>
                    <input type="text" id="customSearch" class="form-control filterInput" placeholder=" Search">
                </div>

                <div class="select1 col-sm-12 col-md-4 mx-auto">
                    <div class="d-flex gap-3">
                        <a href="" id="pdfLink"><img src="{{ asset('assets/images/printer.png') }}" id="print" alt=""
                                height="28px" data-bs-toggle="tooltip" data-bs-title="Print"></a>
                        <a href="" id="excelLink"><img src="{{ asset('assets/images/excel.png') }}" id="excel" alt=""
                                height="30px" data-bs-toggle="tooltip" data-bs-title="Excel"></a>
                    </div>
                </div>
            </div>

                <div class="col-sm-12 col-md-12 mb-1">
                       
                            <label for="category" class="col-form-label">Customer</label>
                            <select class="form-control" name="customer_id" id="customer_id">
                                  <option value="">-- Choose a Customer --</option>
                                 @foreach($customer_droplist as $customer)
                                  <option value="{{ $customer->id }}">{{ $customer->c_name }}</option>
                                 @endforeach
                                </select>
                        
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




<script>

$(document).on("change", "#customer_id", function() {
    let id = $(this).val();
    if (id) {
        window.location.href = "{{ route('customer.customer_details_list') }}?id=" + id;
    }
});
</script>



  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
@endsection