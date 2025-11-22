@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <style>
    /* Category Table Header Color */
    .table thead th {
        background-color: var(--theadbg) !important;
    }

    /* Add left-right spacing to Subcategory & Item sections */
    #subcategoryContainer,
    #itemContainer {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    /* Ensure tables take full width inside the padding */
    #subcategoryContainer table,
    #itemContainer table {
        width: 100% !important;
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
                            <th style="width: 250px">Category Title</th>
                            <th>Image</th>
                            <th>Subcategory Count</th>
                            <th>Subcategories</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($category_list as $category)

                       <tr>
                         <td> {{$loop->iteration}} </td>
                         <td>{{ $category->product->p_name}}</p>
                         <td>{{ $category->c_name }}</td>
                         <td>
                         <div>
                         <img src="{{ asset('image/catimage/' . $category->c_logo) }}" height="40px" alt="category Logo">
                         </div>
                         </td>
                         <td>{{ count($category->subcategories ?? []) }}</td>
                         <td>
                            @if(count($category->subcategories ?? []) > 0)
                                <a href="#" class="view_subcategories" data-category="{{ $category->id }}">
                                    {{-- {{ count($category->subcategories) }} Subcategories --}}
                                   List

                                </a>
                            @else
                                No Subcategories
                            @endif
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

                             {{-- <a data-bs-toggle="modal" data-bs-target="#editcategory"><i
                                        class="fas fa-trash-alt edit_button" data-id="{{ $category->id }}"></i></a> --}}

                            <form action="{{ route('delete_category', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" 
                                        style="background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <i class="fas fa-trash-alt" style="color: black;"></i>
                                </button>
                            </form>
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
                            <label for="categorytitle" class="col-form-label">Category Image</label>
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
                            <label for="categorylogo" class="col-form-label">Category Image</label>
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
   
   <!--ist of subcategoryies-->

  <!-- Subcategory Table Container (Hidden by default) -->
<div id="subcategoryContainer" style="display:none; margin-top:20px;">
    <button id="backToCategories" class="btn btn-secondary mb-3">Back to Categories</button>
    <h5>Subcategories</h5>
    <table class="table table-bordered" id="subcategoryTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Price A</th>
                <th>Price B</th>
                <th>Price C</th>
                <th>Image</th>
                <th>Item Count</th>  
                <th>List</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="subcategoryBody">
            <!-- Loaded dynamically -->
        </tbody>
    </table> <!-- ✅ Subcategory table closed -->
</div> <!-- ✅ Subcategory container div closed -->

<!-- Item Table Container (Hidden by default) -->
<div id="itemContainer" style="display:none; margin-top:20px;">
    <button id="backToSubcategories" class="btn btn-secondary mb-3">Back to Subcategories</button>
    <h5>Items</h5>
    <table class="table table-bordered" id="itemTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Select</th>
                <th>Subcategory</th>
                <th>Code</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="itemBody">
            <!-- AJAX Loaded Items -->
        </tbody>
    </table>
     <!-- ✅ Item table closed -->
    <div class="mb-3">
   <button id="deleteSelectedItems" class="btn btn-danger" disabled>Delete</button>
</div>


</div> <!-- ✅ Item container div closed -->





    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Datatable -->
    <script>
        // DataTables List
       $(document).ready(function () {
    // Category table
    var categoryTable = $(".example").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: false,
        responsive: true,
        pageLength: 10,
        dom: '<"top"f>rt<"bottom"lp><"clear">',
    });

    // Subcategory table
    var subcategoryTable = $("#subcategoryTable").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: false,
        responsive: true,
        pageLength: 10,
        dom: '<"top"f>rt<"bottom"lp><"clear">',
    });

    // Item table
    var itemTable = $("#itemContainer table").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: false,
        responsive: true,
        pageLength: 10,
        dom: '<"top"f>rt<"bottom"lp><"clear">',
    });

    // Search input (works depending on visible table)
    $(".filterInput").on("keyup", function () {
        var val = $(this).val();
        if ($("#subcategoryContainer").is(":visible")) {
            subcategoryTable.search(val).draw();
        } else if ($("#itemContainer").is(":visible")) {
            itemTable.search(val).draw();
        } else {
            categoryTable.search(val).draw();
        }
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
    
    <script>

        $(document).ready(function() {
        // Click on category subcategories
        $(document).on('click', '.view_subcategories', function(e) {
            e.preventDefault();
            var categoryId = $(this).data('category');

            // Hide main table
            $('.table-wrapper').hide();

            // Fetch subcategories via AJAX
            $.ajax({
                url: '/category/' + categoryId + '/subcategories', // Create this route
                type: 'GET',
                success: function(response) {
                    $('#subcategoryBody').html(response); // response is table rows
                    $('#subcategoryContainer').show();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Back button
        $('#backToCategories').click(function() {
            $('#subcategoryContainer').hide();
            $('.table-wrapper').show();
        });
    });

    </script>

    <script>
    $(document).on('click', '.delete-subcategory-btn', function () {
    let id = $(this).data('id');
    let row = $(this).closest('tr');

    if(!confirm("Are you sure you want to delete this subcategory?")) return;

    $.ajax({
        url: "/delete_subcategory_details/" + id,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function () {
            row.remove();  // remove only the row
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });
});

</script>
<script>
    $(document).ready(function () {
        $(document).on("click", ".edit_sub_button", function () {
            let id = $(this).data("id");

            $.ajax({
                url: "{{ route('edit.subcategory-profile') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    console.log(response.id);

                    $('#subcategory_name').val(response.subcategory_name);
                    $('#subcategory_id').val(response.id);
                    $('#subcat_logo').attr('src', '{{ asset("image/subcatimage") }}/' + response.sc_logo);
                    $('#catprice_a').val(response.cat_a);
                    $('#catprice_b').val(response.cat_b);
                    $('#catprice_c').val(response.cat_c);
                    $('#catprice_d').val(response.cat_d);
                    $('#catprice_e').val(response.cat_e);
                

                    const select = $('#sub_product_drop');
                    const text = response.product_name;
                    const value = response.product_id;

                    select.find(`option[value="${value}"]`).remove();

                    // Add the new option at the beginning
                    select.prepend(`<option value="${value}" selected>${text}</option>`);

                    const catselect = $('#sub_cat_drop');
                    const cattext = response.category_name;
                    const catvalue = response.category_id;

                    catselect.find(`option[value="${catvalue}"]`).remove();
                    catselect.prepend(`<option value="${catvalue}" selected>${cattext}</option>`);catprice_a


                    // Remove existing option with the same value if present
                    
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>



<script>
$(document).ready(function () {
    $('#sub_product_drop').on('change', function () {
        let productId = $(this).val();
        //alert(productId);
        
        $.ajax({
            url: "{{ route('create.getCategories') }}",

            type: "POST",
            data: {
                product_id: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // response should be an array of categories
                const categorySelect = $('#sub_cat_drop');
                categorySelect.empty(); // clear current options
                categorySelect.append('<option selected disabled>Select Category</option>');

                $.each(response, function (index, category) {
                    categorySelect.append(
                        `<option value="${category.id}">${category.c_name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });
});
</script>

<script>
$(document).ready(function () {

    // Click on subcategory to see items
    $(document).on('click', '.view_subitems', function (e) {
        e.preventDefault();

        var subcategoryId = $(this).data('subcategory');

        // Hide Subcategory Table
        $('#subcategoryContainer').hide();

        // Load items
        $.ajax({
            url: '/subcategory/' + subcategoryId + '/items',
            type: 'GET',
            success: function (response) {

                // Insert rows into the item table body
                $('#itemBody').html(response);

                // Show items container
                $('#itemContainer').show();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    // Back from item list to subcategory list
    $('#backToSubcategories').click(function () {
        $('#itemContainer').hide();
        $('#subcategoryContainer').show();
    });

});
</script>

<script>
$(document).ready(function() {

    // Enable/disable Delete button whenever any checkbox changes
    $(document).on('change', '.select_item', function() {
        // Check if any checkboxes are selected
        let anyChecked = $('.select_item:checked').length > 0;
        $('#deleteSelectedItems').prop('disabled', !anyChecked);
    });

    // Delete selected items
    $('#deleteSelectedItems').on('click', function() {
        let selectedIds = $('.select_item:checked').map(function() {
            return $(this).val();
        }).get();

        if(selectedIds.length === 0) return; // just in case

        if(!confirm('Are you sure you want to delete selected items?')) return;

        $.ajax({
            url: "{{ route('subitem_deleteMultiple') }}", // make sure this route exists
            type: 'POST',
            data: {
                ids: selectedIds,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Remove deleted rows
                $('.select_item:checked').closest('tr').remove();

                // Disable button again
                $('#deleteSelectedItems').prop('disabled', true);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});

</script>




@endsection