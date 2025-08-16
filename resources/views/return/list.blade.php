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
        <h4 class="m-0">Orders Return List</h4>
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
                        <th>Name</th>
                        <th>Order ID</th>
                        <th>Item Code</th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($odr_relist as $cus_value)
                    <tr>

                        <td> {{$loop->iteration}} </td>
                        <td>{{ $cus_value->customer_name }}</td>
                        <td>{{ $cus_value->order_id }}
                            <input type="hidden" class="order-input" value="{{ $cus_value->order_id }}">

                        </td>
                        <td>
                            @foreach ($cus_value->matched_items as $item)
                            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                <div style="margin-right: 10px;" class="item-code">{{ $item['final_code'] }}</div>
                                <div>
                                    <img src="{{ asset('image/itemimage/' . $item['final_image']) }}" width="100" alt="Item Image">
                                </div>
                            </div>
                            @endforeach
                        </td>
                        <td><button class="btn btn-sm btn-primary updateBtn" style="display:none;" data-return_data_id="{{ $cus_value->id }}">
                                Update
                            </button>
                        </td>


                        <td>
                            <div class="action-wrapper d-flex align-items-center gap-2">
                              
                                @if ($cus_value->status === 'Active')
                                <button class="btn btn-sm btn-danger status_button"
                                    data-return_id="{{ $cus_value->id }}"
                                    data-status_button="{{ $cus_value->status }}">
                                    Received
                                </button>
                                @elseif ($cus_value->status === 'Updated')
                                <a data-bs-toggle="modal" data-bs-target="#addbrand">
                                    <button class="btn btn-sm btn-success update_button"
                                        data-up_button="{{ $cus_value->status }}">Update</button>
                                </a>
                                @endif
                            </div>
                        </td>


                    </tr>

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
                <h4 class="modal-title mb-2" id="addbrandLabel">Return Items</h4>
                <form action="{{ route('return.code-update') }}" method="POST">

                    @csrf
                    <div class="col-sm-12 col-md-12 mb-1">
                        <input type="hidden" name="status" value="Received">
                        <input type="hidden" name="order_id" id="order_id" value="">
                        <label for="productname" class="col-form-label">Item Code</label>

                        @foreach ($code_drop as $item)
                        <div class="form-check">
                            <input class="form-check-input item-checkbox" {{-- Add class for JS --}}
                                type="checkbox"
                                name="item_code[]"
                                id="item_code{{ $loop->index }}"
                                value="{{ $item->code }}">
                            <label class="form-check-label" for="item_code{{ $loop->index }}">
                                {{ $item->code }}
                            </label>
                        </div>
                        @endforeach



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

<script>
    $(document).on('click', '.status_button', function(e) {
        e.preventDefault();
        let button = $(this);
        let return_id = button.data('return_id');
        let status = button.data('status_button');

        if (status === 'Active') {
            let updatedStatus = 'Updated'; // Use a new variable instead of changing original

            $.ajax({
                url: "{{ route('item_return.updateStatus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: updatedStatus,
                    return_id: return_id
                },
                success: function(response) {
                    console.log(response);

                    let actionWrapper = button.closest('.action-wrapper');

                    actionWrapper.html(`
        <a data-bs-toggle="modal" data-bs-target="#addbrand">
            <button class="btn btn-sm btn-success update_button" data-up_button="${updatedStatus}">
                Update
            </button>
        </a>
    `);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating status:', error);
                    alert('Failed to update status.');
                }
            });
        }
    });
</script>

<script>
    $(document).on('click', '.update_button', function(e) {
        e.preventDefault();
        let button = $(this);
        let row = button.closest('tr');
        // let status = button.data('up_button');
        //alert(status);
        let rowm = $(this).closest('tr');
        let order_id = rowm.find('.order-input').val();

        $('#order_id').val(order_id);
        //alert(order_id);

        let itemCodes = [];

        // Get item codes from current row
        row.find('.item-code').each(function() {
            itemCodes.push($(this).text().trim());
        });

        console.log("Item Codes in Row:", itemCodes);

        // Loop through all checkboxes
        $('.item-checkbox').each(function() {
            let checkbox = $(this);
            let parentDiv = checkbox.closest('.form-check'); // Assuming form-check is the wrapper div

            if (itemCodes.includes(checkbox.val())) {
                checkbox.prop('checked', false); // Uncheck by default, user will tick manually
                parentDiv.show(); // Show matching checkbox
            } else {
                checkbox.prop('checked', false); // Uncheck hidden ones too (just in case)
                parentDiv.hide(); // Hide non-matching checkbox
            }
        });

        // Optional: Scroll to checkbox section
        $('html, body').animate({
            scrollTop: $(".item-checkbox:visible").first().offset().top - 100
        }, 500);
    });
</script>




@endsection