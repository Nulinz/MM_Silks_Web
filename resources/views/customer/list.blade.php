@extends('layouts.app')

@section('content')


    <style>
        .table thead th {
            background-color: var(--theadbg) !important;
        }
    </style>

    <div class="sidebodydiv px-4 py-1">
        <div class="sidebodyhead">
            <h4 class="m-0">Customer List</h4>
            <a href="{{ route('customer.create-basic') }}"><button class="listbtn">Add Customer</button></a>
        </div>

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

            <div class="table-wrapper">
                <table class="example table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Contact Number</th>
                            <th>Location</th>
                            <th>C Category Type</th>
                            <th>Permission Type</th>
                            <th>Permission Time</th>
                            <th>By</th>
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
                        <td>{{ $customer->cby  }}</td>
                        <td>{{ $customer->status  }}</td> 
                        <td>                      
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($customer->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $customer->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $customer->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#editsubscript"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $customer->id }}"></i></a>
                                        </div>
                           
                         </td>
                     </tr>
                     @endforeach
                    </tbody>
                </table>
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
   $(document).ready(function () {
       $(".status_button").on("click", function () {
          let status = $(this).data("status_button");
          //let id = $(".edit_button").data("id")
       
           // alert(status);
            let row = $(this).closest("tr"); // Get the current row
            let id = row.find(".edit_button").data("id")
            //alert(id);
       

          if (status === 'Active') {
                status = 'Inactive'; 
          } else if (status === 'Inactive') {
            status = 'Active'; 
          }
          //alert(status);

            $.ajax({
                url: "{{ route('customer-status-update') }}",
                type: "POST",
                data: {
                    status: status,
                    //odr_status: odr_status,
                    id:id,
                    status:status,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {

                    // Remove this if you want dynamic update only
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
       });
    });
</script>

@endsection
