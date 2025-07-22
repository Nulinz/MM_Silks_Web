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
            <h4 class="m-0">User List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addsubcategory"><button class="listbtn">Add User</button></a>
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
                            <th>Name</th>
                            <th>Contact</th>             
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($admin_list as $admin)
                      <tr>
                        <td>{{$loop->iteration}} </td>
                        <td>{{ $admin->name  }}</td>
                        <td>{{ $admin->contact  }}</td>  
                        <td>{{ $admin->role  }}</td>  
                        <td>{{ $admin->status  }}</td>  
                        <td>                      
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($admin->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $admin->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $admin->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#editsubscript"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $admin->id }}"></i></a>
                                        </div>
                           
                         </td>
                        <!--
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="" data-bs-toggle="tooltip" data-bs-title="Active"><i
                                        class="fas fa-circle-check text-success"></i></a>
                                <a href="" data-bs-toggle="tooltip"
                                    data-bs-title="Profile"><i class="fas fa-arrow-up-right-from-square"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#editsubcategory" class="edit_button" data-id="" ><i
                                class="fas fa-pen-to-square"></i></a>
                            </div>
                        </td>-->
                    </tr>   
                    @endforeach     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addsubcategory" tabindex="-1" aria-labelledby="addsubcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_subcategory.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="addsubcategoryLabel">Add User Details</h4>
                    <form  action="{{ route('admin_store') }}" method="post">
                     @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Mobile No</label>
                            <input type="text" class="form-control" name="contact" id="contact"  maxlength="10">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategory" class="col-form-label">Passwrod</label>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">role</label>
                            <select class="form-select" name="role" id="role">
                                <option value="" selected disabled>Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>    
                            </select>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                            <button type="submit" class="modalbtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editsubcategory" tabindex="-1" aria-labelledby="editsubcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_subcategory.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="editsubcategoryLabel">Edit Sub Category</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category</label>
                            <select class="form-select" name="category_drop" id="category_drop">
                                                                         
                                <option value=""></option>           
                               
                            </select>
                        </div>
                        <!--
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategory" class="col-form-label">Sub Category</label>
                            <input type="text" class="form-control" name="subcategory" id="subcategory">
                        </div>-->
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategorytitle" class="col-form-label">Sub Category Title</label>
                            <input type="text" class="form-control" name="subcategory_name" id="subcategory_name">
                            <input type="hidden" name="subcategory_id" id="subcategory_id">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategorydescp" class="col-form-label">Sub Category Description</label>
                            <textarea rows="2" class="form-control" name="subcategory_descp"
                                id="subcategory_descp"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">Brand Logo</label>
                            <input type="file" class="form-control" name="subcategory_logo" id="subcategory_logo">
                            <img class="d-block mx-auto mt-2" src="" height="50px" alt="" id="subcat_logo">
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
    <script>
        $(document).ready(function() {
            $(document).on("click", ".edit_button", function() {
        let id = $(this).data("id");

        //alert(id);

        $.ajax({
            url: "",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);

                  $('#subcategory_name').val(response.sc_name);
                  $('#subcategory_descp').val(response.sc_desc);
                  $('#subcat_logo').attr('src', '{{ asset("storage/subcatimage") }}/' + response.sc_logo);
                  $('#subcategory_id').val(response. subcategory_id);
               
               
                const select = $('#category_drop');

               const text = response.category_name;
               const value = response.category_id;
               //console.log(text,value);

               
               select.prepend(`<option value="${value}" selected>${text}</option>`);

              
            //select.append(<option value="${value}">"${text}</option>);
            
             
            },
            error: function(xhr) {
                console.error("Error Response:", xhr.responseText); // see HTML or JSON
            }
        });
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
                url: "{{ route('create.admin-status-update') }}",
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