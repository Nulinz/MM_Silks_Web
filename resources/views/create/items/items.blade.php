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
            <h4 class="m-0">Items List</h4>
            <a data-bs-toggle="modal" data-bs-target="#addcategory"><button class="listbtn">Add Items</button></a>
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
                            <th>Subcategory</th>
                            <th>Code</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($item_list as $item)
                       <tr>
                       <td>{{$loop->iteration}}</td>
                       <td>{{ $item->subcategory->sc_name  }}</td>
                       <td>{{ $item->code  }}</td>
                        <td>
                        <div>
                        <img src="{{ asset('image/itemimage/' . $item->i_logo) }}" height="30px" alt="item Logo">
                        </div>
                        </td>
                      
                        <td>{{ $item->status  }}</span></td>
                        <td> 
                          <div class="d-flex align-items-center gap-2">
                                                 
                            @if ($item->status === 'Active')
                                    <button class="btn btn-sm btn-danger status_button" data-status_button="{{ $item->status }}">Inactive</button>
                                @else
                                    <button class="btn btn-sm btn-success status_button" data-status_button="{{ $item->status }}">Active</button>
                            @endif
                             
                            <a data-bs-toggle="modal" data-bs-target="#edititems"><i
                                        class="fas fa-pen-to-square edit_button" data-id="{{ $item->id }}"></i></a>
                                        </div>
                           
                         </td>
                        <!--
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="" data-bs-toggle="tooltip" data-bs-title="Active"><i
                                        class="fas fa-circle-check text-success"></i></a>

                                        
                                <a href="" data-bs-toggle="tooltip"
                                    data-bs-title="Profile"><i class="fas fa-arrow-up-right-from-square"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#editcategory"><i
                                        class="fas fa-pen-to-square edit_button" data-id=""></i></a>
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
                    <h4 class="modal-title mb-2" id="addcategoryLabel">Add Items</h4>
                    <form action="{{ route('items_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Subcategory</label>
                            <select class="form-control" name="sub_id" id="sub_id">
                                 <option value="">-- Choose a Subcategory --</option>
                                 @foreach($subcategory_list as $subcategory)
                                  <option value="{{ $subcategory->id }}">{{ $subcategory->sc_name }}</option>
                                 @endforeach
                                <!--<option value="lehengas">Banaras Cotton</option>-->
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Colors</label>
                            <select class="form-control" name="color" id="color">
                                 <option value="">-- Choose a Colors --</option>
                                 @foreach($color_list as $color)
                                  <option value="{{ $color->id }}">{{ $color->co_name }}</option>
                                 @endforeach
                                <!--<option value="lehengas">Banaras Cotton</option>-->
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorydescp" class="col-form-label">Code</label>
                            <input type="text" class="form-control" name="i_code" id="i_code"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                             <!-- <label for="empname" class="col-form-label">Types</label><br> -->
                           
                            <input type="radio" id="vehicle1" name="types" value="finished">
                            <label for="contact">Finished</label>
                            <input type="radio" id="vehicle1" name="types" value="not_finished">
                            <label for="altcontact">Not Finished</label>
                        </div>
                  
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorytitle" class="col-form-label">Items Image</label>
                            <input type="file" name="i_logo" class="form-control">
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
    <div class="modal fade" id="edititems" tabindex="-1" aria-labelledby="editcategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="usericon">
                        <img src="" height="100%" alt="">
                    </div>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title mb-2" id="editcategoryLabel">Edit Items</h4>
                    <form action="{{ route('items_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Category</label>
                            <input type="text" class="form-control" name="category" id="category">
                        </div>-->
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Subcategory</label>
                            <select class="form-control" name="subcat_drop" id="subcat_drop">
                                 <option value="">-- Choose a Subcategory --</option>
                                 @foreach($subcategory_list as $subcategory)
                                  <option value="{{ $subcategory->id }}">{{ $subcategory->sc_name }}</option>
                                 @endforeach
                                </select>
                                <!--<option value="lehengas">Banaras Cotton</option>-->
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="category" class="col-form-label">Colors</label>
                            <select class="form-control" name="item_color" id="item_color">
                                 <option value="">-- Choose a Colors --</option>
                                 @foreach($color_list as $color)
                                  <option value="{{ $color->id }}">{{ $color->co_name }}</option>
                                 @endforeach
                                <!--<option value="lehengas">Banaras Cotton</option>-->
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorydescp" class="col-form-label">Code</label>
                            <input type="text" class="form-control" name="item_code" id="item_code">
                            <input type="hidden" class="form-control" name="item_id" id="item_id">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                             <!-- <label for="empname" class="col-form-label">Types</label><br> -->
                           
                            <input type="radio" id="finished" name="item_types" value="finished">
                            <label for="contact">Finished</label>
                            <input type="radio" id="not_finished" name="item_types" value="not_finished">
                            <label for="altcontact">Not Finished</label>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="categorylogo" class="col-form-label">Item Image</label>
                            <input type="file" class="form-control" name="item_logo" id="item_logo">
                            <img class="d-block mx-auto mt-2" src="" height="50px" alt="" id="ex_logo">
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
                url: "{{ route('create.item-status-update') }}",
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
    $(document).ready(function () {
        $(document).on("click", ".edit_button", function () {
            let id = $(this).data("id");

            $('#item_code').val('');
           $('#ex_logo').attr('src', '');
           $('#subcat_drop').val('');

            $.ajax({
                url: "{{ route('edit.items-profile') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    console.log(response.subcategory_name);

                    $('#item_code').val(response.code);
                    $('#item_id').val(response.item_id);

                    $('#item_types').val(response.types);
                    
                  
                

                    const select = $('#subcat_drop');
                    const text = response.subcategory_name;
                    const value = response.subcategory_id;

                    select.find(`option[value="${value}"]`).remove();

                    // Add the new option at the beginning
                    select.prepend(`<option value="${value}" selected>${text}</option>`);

                    //color
                    const colorselect = $('#item_color');
                    const colortext = response.color_name;   // e.g., "Red"
                    const colorvalue = response.color_id;    // e.g., 5

                    // Remove existing option if it exists
                    colorselect.find(`option[value="${colorvalue}"]`).remove();

                    // Add the new option at the top and select it
                    colorselect.prepend(`<option value="${colorvalue}" selected>${colortext}</option>`);

                    $('input[name="item_types"][value="' + response.types + '"]').prop('checked', true);



                    $('#ex_logo').attr('src', '{{ asset("image/itemimage") }}/' + response.i_logo);

                   

                    // Remove existing option with the same value if present
                    
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>



@endsection