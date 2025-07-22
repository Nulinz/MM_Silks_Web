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
            <h4 class="m-0">Category List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addcategory"><button class="listbtn">Add Category</button></a>
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
                            <th>Product Name</th>
                            <th style="width: 450px">Category Title</th>
                            <th>logo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($category_list as $category)

                       <tr>
                         <td> {{$loop->iteration}} </td>
                         <td>{{ $category->product->p_name   }}</p>
                         <td>{{ $category->c_name }}</td>
                         <td>
                         <div>
                         <img src="{{ asset('image/catimage/' . $category->c_logo) }}" height="40px" alt="category Logo">
                         </div>
                         </td>
                      
                        <td>{{ $category->status }}</td>
                        <td> 
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($category->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $category->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $category->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#editcategory"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $category->id }}"></i></a>
                                        </div>
                           
                         </td>
                    </tr>  
                    @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="addcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="{{ asset('assets/images/icon_category.png') }}" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="addcategoryLabel">Add Category</h4>
                    <form action="{{ route('category_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Produt</label>
                            <select class="form-control" name="p_id" id="p_id">
                                  <option value="">-- Choose a product --</option>
                                 @foreach($product_list as $product)
                                  <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                 @endforeach
                                </select>
                        </div>
                        {{-- <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">Category Title</label>
                            <input type="text" class="form-control" name="" id="">
                        </div> --}}
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorydescp" class="col-form-label">Category Title</label>
                            <input type="text" class="form-control" name="c_name" id="c_name"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">Category Logo</label>
                            <input type="file" name="c_logo" class="form-control">
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
    <div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="editcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="editcategoryLabel">Edit Category</h4>
                    <form action="{{ route('category_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category">
                        </div>-->
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">Product</label>
                            <select class="form-control" name="product_drop" id="product_drop">
                                  <option value="">-- Choose a product --</option>
                                 @foreach($product_list as $product)
                                  <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                 @endforeach
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorydescp" class="col-form-label">Category</label>
                            <input type="text" class="form-control" name="category_name" id="category_name">
                            <input type="hidden" name="category_id" id="category_id">
                           
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorylogo" class="col-form-label">Category Logo</label>
                            <input type="file" class="form-control" name="category_logo" id="category_logo">
                            <img class="d-block mx-auto mt-2" src="" height="50px" alt="" id="cat_logo">
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
                console.log(response.id);

                $('#category').val(response.c_name);
                $('#categorydescp').val(response.c_desc);
                $('#category_id').val(response.id);
                $('#cat_logo').attr('src', '{{ asset("storage/catimage") }}/' + response.b_logo);

                //$('#categorytitle').val(response.c_desc);
                //$('#categorydescp').attr('src', '{{ asset("assets/brandimage") }}/' + response.b_logo);
               // $('#brand_id').val(response.id);
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
                url: "{{ route('create.catstatus-update') }}",
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

                $.ajax({
                    url: "{{ route('edit.category-profile') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.id);

                        $('#category_name').val(response.c_name);
                        $('#category_id').val(response.id);
                        $('#cat_logo').attr('src', '{{ asset("image/catimage") }}/' + response.c_logo);
                        const select = $('#product_drop');

                            const text = response.product_name;
                            const value = response.product_id;
                            console.log(text,value);
                        select.prepend(`<option value="${value}" selected>${text}</option>`);
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



@endsection