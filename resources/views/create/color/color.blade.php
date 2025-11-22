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
            <h4 class="m-0">Colors List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addbrand"><button class="listbtn">Add color</button></a>
        </div>
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

            <div class="table-wrapper">
                <table class="example table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Color Name</th>
                            <th>Status</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($color_list as $color_value)
                      <tr>
                         <td> {{$loop->iteration}} </td>
                         <td>{{ $color_value->co_name }}</td>
                         <td>{{ $color_value->status }}</td> 
                         <td> 
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($color_value->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $color_value->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $color_value->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#editproduct"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $color_value->id }}"></i></a>

                             <form action="{{ route('delete_colors', $color_value->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" 
                                        style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <i class="fas fa-trash-alt" style="color: black;"></i>
                                </button>
                            </form>
                                        </div>
                           
                         </td>
                        </tr>
                        <!-- <tr>
                            <td>1</td>
                            <td>chudi</td>
                            <td>Active</td>
                        </tr> -->
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addbrand" tabindex="-1" aria-labelledby="addbrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_brand.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="addbrandLabel">Add Color</h4>
                    <form action="{{ route('colors_store') }}" method="POST">
                        
                        @csrf 
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="productname" class="col-form-label">Color Name</label>
                            <input type="text" class="form-control" name="co_name" id="co_name" value="">
                        </div>
                        <!-- <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorydescp" class="col-form-label">Status</label>
                            <textarea rows="2" class="form-control" name="b_desc" id="categorydescp"></textarea>
                        </div> -->
                        
                       
                            <!--<label class="custom-file-upload w-100 shadow-none" for="file_upload">
                                
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path
                                            d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z" />
                                    </svg>
                                </div>
                                <div class="text">
                                    <span id="file-text" class="text-center">Choose a file (JPEG, PNG, SVG formats upto
                                        50MB)</span>
                                </div>-->
                                
                      
                        <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                            <button type="submit" class="modalbtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    
    <div class="modal fade" id="editproduct" tabindex="-1" aria-labelledby="editbrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_brand.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="editbrandLabel">Edit Color</h4>
                    <form action ="{{ route('colors_store') }}" method="POST">
                        @csrf                  
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="brandname" class="col-form-label">Color Name</label>
                            <input type="text" class="form-control" name="color_name" id="color_name" value="">
                            <input type="hidden" name="color_id" id="color_id">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                            <button type="submit" class="modalbtn">Update</button>
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



<!--status changed-->
<script>
   $(document).ready(function () {
       $(".status_button").on("click", function () {
          let status = $(this).data("status_button");
          //let id = $(".edit_button").data("id")
       
            //alert(status);
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
                url: "{{ route('create.colorstatus-update') }}",
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


<script>
        $(document).ready(function() {
          $(document).on("click", ".edit_button", function() {

        let id = $(this).data("id");
        //alert(id);

        $('#color_name').val('');
       
        $('#color_id').val('');

        
        

        $.ajax({
            url: "{{ route('edit.color-profile') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response.id);
                //console.log(response.b_logo);


                $('#color_name').val(response.co_name);
                $('#color_id').val(response.id);
                // alert(response.message);
                // location.reload();
            },
            error: function(xhr, status, error) {
                // Optional: log for debugging
                console.error("AJAX Error:", xhr.responseText);

            }
        });
    });
});
    </script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
@endsection