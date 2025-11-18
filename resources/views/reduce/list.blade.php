@extends('layouts.app')

@section('content')
<div id="alertContainer" class="d-flex justify-content-center mt-3" style="width: 300px; margin: 0 auto;"></div>

@if(session('success'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="max-width: 500px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" style="max-width: 500px;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif


<style>
    .table thead th {
        background-color: var(--theadbg) !important;
    }
</style>

<div class="d-flex justify-content-start align-items-start" style="padding-left: 20px; padding-top: 50px;">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">
            <h5 class="card-title mb-3">Upload CSV File</h5>
            
            <form id="csvUploadForm" action="{{ route('create.reduce_items') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-3">
                @csrf
                <input type="file" name="csv_file" accept=".csv" required class="form-control">
                <button type="submit" class="btn btn-success w-100">Upload CSV</button>
                
            </form>
        </div>
    </div>
</div>

<!-- Add spacing below the card -->
<div id="matchedTableContainer" class="mt-5 px-4"></div>

<div id="submitContainer" class="mt-4 text-end px-4" style="display:none;">
    <button class="btn btn-primary" style="width:150px;">Submit</button>
</div>





    <!--
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
        </div>-->

        {{-- <div class="table-wrapper">
            <table class="example table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Location</th>
                        <th>C Category Type</th>
                        <th>Permission Type</th>
                        <th>Permission Date</th>
                        <!--<th>By</th>-->
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer_list as $customer)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $customer->c_name  }}</td>
                        <td>{{ $customer->c_contact  }}</td>
                        <td>{{ $customer->c_location  }}</td>
                        <td>{{ $customer->c_type  }}</td>
                        <td>{{ $customer->permission_type  }}</td>
                        <td>{{ $customer->permission_time  }}</td>
                        <!--<td>{{ $customer->cby  }}</td>-->
                        <td>{{ $customer->status  }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">

                                @if ($customer->status === 'Active')
                                <button class="btn btn-sm btn-danger status_button" data-id="{{ $customer->id }}" data-status_button="{{ $customer->status }}">Inactive</button>
                                @else
                                <button class="btn btn-sm btn-success status_button" data-id="{{ $customer->id }}" data-status_button="{{ $customer->status }}">Active </button>
                                @endif

                                <a href="{{ route('customer.edit-basic',$customer->id)}}" data-bs-toggle="tooltip"
                                data-bs-title="Edit Basic Details"><i class="fas fa-pen-to-square"></i></a> 
                                
                                <a href="{{ route('delete_customer',$customer->id)}}" data-bs-toggle="tooltip"
                                data-bs-title="Delete Customer"><i class="fas fa-trash-alt"></i></a> 
                                 <!--<a href="{{ route('customer.customer-profile',['id'=>$customer->id]) }}" data-bs-toggle="tooltip"
                                    data-bs-title="Profile"><i class="fas fa-arrow-up-right-from-square"></i></a> -->

                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    


<!-- Scripts -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Datatable -->
<script>
    // DataTables List
    $(document).ready(function() {
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
    $(document).ready(function() {
        var table = $(".example").DataTable();
        $(".example thead th").each(function(index) {
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
        $(".filterInput").on("keyup", function() {
            var selectedColumn = $(".headerDropdown").val();
            if (selectedColumn !== "All") {
                table.column(selectedColumn).search($(this).val()).draw();
            } else {
                table.search($(this).val()).draw();
            }
        });
        $(".headerDropdown").on("change", function() {
            $(".filterInput").val("");
            table.search("").columns().search("").draw();
        });
    });
</script>





<!--
<script>
$(document).ready(function() {
    $('#csvUploadForm').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission

        let fileInput = $('#csvUploadForm input[name="csv_file"]')[0].files[0];
        if (!fileInput) {
            alert("Please select a CSV file.");
            return;
        }

        let formData = new FormData();
        formData.append('csv_file', fileInput);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('get.reduce_items') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
           success: function(response) {
    $('#matchedTableContainer').html(response);

    // Initialize DataTable on new table if present
    if ($('.example').length) {
        $('.example').DataTable({
            paging: false,
            searching: true,
            ordering: true,
            info: false,
            scrollY: "400px",
            scrollCollapse: true,
            responsive: true
        });
    }

    alert("CSV uploaded and data fetched successfully!");
}

            error: function(xhr) {
                alert('Error fetching matched data: ' + xhr.responseText);
            }
        });
    });
});
</script>-->
<script>
$(document).ready(function() {
    $('#csvUploadForm').on('submit', function(e) {
        e.preventDefault(); // stop full page refresh

        let fileInput = $('#csvUploadForm input[name="csv_file"]')[0].files[0];
        if (!fileInput) {
            alert("Please select a CSV file.");
            return;
        }

        let formData = new FormData();
        formData.append('csv_file', fileInput);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('get.reduce_items') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                 if (response.includes("<table")) {
                    $('#submitContainer').show();
                } else {
                    $('#submitContainer').hide();
                }
                $('#matchedTableContainer').html(response);

                if ($('.example').length) {
                    $('.example').DataTable({
                        paging: false,         // no pagination
                        searching: true,
                        ordering: true,
                        info: false,
                        scrollY: "400px",      // scroll
                        scrollCollapse: true,
                        responsive: true
                    });
                }
            },
            error: function(xhr) {
                alert('Error fetching matched data: ' + xhr.responseText);
            }
        });
    });
});
</script>


@endsection