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
            <h4 class="m-0">Sub Category List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addsubcategory"><button class="listbtn">Add Sub Category</button></a>
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
                            <th>Produt</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Price A</th>
                            <th>Price B</th>
                            <th>Price C</th>
                            <th>Price D</th>
                            <th>Price E</th>
                            <th>logo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($subcategory_list as $subcategory)

                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $subcategory->product->p_name  }}</td>
                        <td>{{ $subcategory->category->c_name  }}</td>   
                        <td>{{ $subcategory->sc_name  }}</td>
                        <td>{{ $subcategory->cat_a  }}</td>
                        <td>{{ $subcategory->cat_b  }}</td>
                        <td>{{ $subcategory->cat_c  }}</td>
                        <td>{{ $subcategory->cat_d  }}</td>
                        <td>{{ $subcategory->cat_e  }}</td>
                        
                        <td> <img src="{{ asset('image/subcatimage/' . $subcategory->sc_logo) }}" height="40px" alt="subcategory Logo">
                        
                        </td>
                        <td>{{ $subcategory->status  }}</td>
                        <td> 
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($subcategory->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $subcategory->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $subcategory->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#editsubcategory"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $subcategory->id }}"></i></a>
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
                    <h4 class="modal-title mb-2" id="addsubcategoryLabel">Add Sub Category</h4>
                    <form  action="{{ route('subcategory_store') }}" method="post" enctype="multipart/form-data">
                     @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Product</label>
                                <select class="form-control edit_drop" name="p_id" id="p_id">
                                <option value="" selected disabled>Select Product</option>
                                    @foreach($product_list as $product)
                                    <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                    @endforeach
                                    </select> 
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category</label>
                            <select class="form-select" name="c_id" id="c_id">
                                <option value="" selected disabled>Select Category</option>
                                    @foreach($category_list as $category)
                                    <option value="{{ $category->id }}">{{ $category->c_name }}</option>
                                    @endforeach
                                   
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategory" class="col-form-label">Sub Category</label>
                            <input type="text" class="form-control" name="sc_name" id="sc_name">
                        </div>
                     
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category A</label>
                            <input type="text" class="form-control" name="cat_a" id="cat_price">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category B</label>
                            <input type="text" class="form-control" name="cat_b" id="cat_price">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category C</label>
                            <input type="text" class="form-control" name="cat_c" id="cat_price">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category D</label>
                            <input type="text" class="form-control" name="cat_d" id="cat_price">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category E</label>
                            <input type="text" class="form-control" name="cat_e" id="cat_price">
                        </div>

                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">subcategory Logo</label>
                            <input type="file" name="sc_logo" class="form-control">
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
                    <form action="{{ route('subcategory_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Product</label>
                            <select class="form-control" name="product_drop" id="product_drop">
                                <option value="" selected disabled>Select Product</option>
                                    @foreach($product_list as $product)
                                    <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                    @endforeach
                                    </select> 
                                </select>
                        </div>
                        <!--
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategory" class="col-form-label">Sub Category</label>
                            <input type="text" class="form-control" name="subcategory" id="subcategory">
                        </div>-->
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategorytitle" class="col-form-label">Category</label>
                            <select class="form-select" name="cat_drop" id="cat_drop">
                                <option value="" selected disabled>Select Category</option>
                                    @foreach($category_list as $category)
                                    <option value="{{ $category->id }}">{{ $category->c_name }}</option>
                                    @endforeach
                                   
                            </select>
                        
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="subcategorydescp" class="col-form-label">Sub Category </label>
                            <input type="text" class="form-control" name="subcategory_name" id="subcategory_name">
                            <input type="hidden" class="form-control" name="subcategory_id" id="subcategory_id">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category A</label>
                            <input type="text" class="form-control" name="catprice_a" id="catprice_a">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category B</label>
                            <input type="text" class="form-control" name="catprice_b" id="catprice_b">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category C</label>
                            <input type="text" class="form-control" name="catprice_c" id="catprice_c">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category D</label>
                            <input type="text" class="form-control" name="catprice_d" id="catprice_d">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category E</label>
                            <input type="text" class="form-control" name="catprice_e" id="catprice_e">
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
                url: "{{ route('create.substatus-update') }}",
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

 
<!--overall fetch subcategory list details-->
<script>
    $(document).ready(function () {
        $(document).on("click", ".edit_button", function () {
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




                

                    const select = $('#product_drop');
                    const text = response.product_name;
                    const value = response.product_id;

                    select.find(`option[value="${value}"]`).remove();

                    // Add the new option at the beginning
                    select.prepend(`<option value="${value}" selected>${text}</option>`);

                    const catselect = $('#cat_drop');
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

<!--insert dropdown--product based category list-->
<script>
$(document).ready(function () {
    $('#p_id').on('change', function () {
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
                const catSelect = $('#c_id');
                catSelect.empty(); // clear current options
                catSelect.append('<option selected disabled>Select Category</option>');

                $.each(response, function (index, category) {
                    catSelect.append(
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


<!--edit dropdown--product based dropdown list-->

<script>
$(document).ready(function () {
    $('#product_drop').on('change', function () {
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
                const categorySelect = $('#cat_drop');
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






@endsection