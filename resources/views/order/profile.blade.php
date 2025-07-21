@extends ('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">

    <style>
        .table thead th {
            background-color: var(--theadbg) !important;
        }
    </style>

    <div class="sidebodydiv px-4 py-1">
        <div class="sidebodyhead mb-2">
            <h4 class="m-0">Order Profile</h4>
        </div>

        <div class="mainbdy">

            <!-- Left Content -->
            <div class="contentleft">
                <div class="cards">
                    <div class="basicdetails mb-2">
                        <div class="maincard leftcard row">
                            <div class="cardshead">
                                <div class="col-12 cardsh5">
                                    <h5 class="mb-0">Order Details</h5>
                                </div>
                            </div>
                            <div
                                class="col-sm-12 col-md-12 col-xl-12 mb-3 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/images/avatar.png') }}" width="125px" height="125px" alt=""
                                    class="profileimg">
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Name</h6>
                                    <h5 class="mb-0 text-end">{{$odr_cdetails->c_name}}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Contact</h6>
                                    <h5 class="mb-0 text-end">{{$odr_cdetails->c_contact}}</h5>
                                </div>
                
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Order ID</h6>
                                    <h5 class="mb-0 text-end">{{$odr_cdetails->order_id}}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Order Date</h6>
                                    <h5 class="mb-0 text-end"><td>{{ \Carbon\Carbon::parse($odr_cdetails->order_date)->format('d/m/Y') }}</td></h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Total Amount</h6>
                                    <h5 class="mb-0 text-end">{{$odr_cdetails->amount}}</h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Status</h6>
                                    <h5 class="mb-0 text-end">{{$odr_cdetails->status}}</h5>
                                </div>
                                <!--
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Order Status</h6>
                                    <h5 class="mb-0 text-end" id="current_status"></h5>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">date</h6>
                                    <h5 class="mb-0 text-end"></h5>
                                   
                                </div>-->
                                <!--
                                <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                    <h6 class="mb-0 text-start">Order Status</h6>
                                    <select class="form-select" id="orderStatus" name="order_status" style="width: 140px; height: 40px;">
                                        <option value="confirmed">Confirmed</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="receive">Recived</option>
                                        <option value="receive">out of delivery</option>
                                        
                                    </select>-->
                                <!--</div>-->
                                <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                                    <input type="hidden" name="order_status" id="order_status" value="{{ $odr_cdetails->odr_status }}">
                                    <input type="hidden" name="order_primaryid" id="order_primaryid" value="{{ $odr_cdetails->odr_primaryid}}">
                                    <input type="hidden" name="order_id" id="order_id" value="{{ $odr_cdetails->order_id}}">
                                <!-- <button  class="modalbtn edit_button">-->
                                    @if($odr_cdetails->odr_status == 'confirmed')
                                    <button type="submit" class="edit_button modalbtn">Process</button>
                                    @elseif($odr_cdetails->odr_status == 'process')
                                        <button type="submit"class="edit_button modalbtn">Delivered</button>
                                    @endif 

                               </div>
                                <!-- <div class="col-sm-12 col-md-12 col-xl-12 mb-3">
                                  <h6 class="mb-0 text-start">Update Status</h6>
                                  <select class="mb-0 text-end" name="offer_type" id="offer_type">
                                     <option value="" selected disabled>Select Offer Type</option>
                                     <option value="confirmed">Rupees</option>
                                     <option value="shippid">Percentage</option>
                                 </select>-->
                                    
                                  <!-- <button type="button" data-bs-target="#updateorder"
                                            class="modalbtn">update</button> -->
                                
                                <!--
                                <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                                 <button type="submit" class="modalbtn">Update</button>
                               </div>-->
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!-- Right Content -->
            <div class="contentright">
                <div class="proftabs">
                @include ('order.order_profile')
                 
                </div>
            </div>


        </div>
    </div>
    
    <!-- Scripts -->
    <!-- jQuery --> 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Datatables List -->
    <script>
        $(document).ready(function () {
            function initTable(tableId, dropdownId, filterInputId) {
                var table = $(tableId).DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "order": [0, "asc"],
                    "bDestroy": true,
                    "info": false,
                    "responsive": true,
                    "pageLength": 30,
                    "dom": '<"top"f>rt<"bottom"ilp><"clear">',
                });
                $(tableId + ' thead th').each(function (index) {
                    var headerText = $(this).text();
                    if (headerText != "" && headerText.toLowerCase() != "action" && headerText.toLowerCase() != "image") {
                        $(dropdownId).append('<option value="' + index + '">' + headerText + '</option>');
                    }
                });
                $(filterInputId).on('keyup', function () {
                    var selectedColumn = $(dropdownId).val();
                    if (selectedColumn !== 'All') {
                        table.column(selectedColumn).search($(this).val()).draw();
                    } else {
                        table.search($(this).val()).draw();
                    }
                });
                $(dropdownId).on('change', function () {
                    $(filterInputId).val('');
                    table.search('').columns().search('').draw();
                });
                $(filterInputId).on('keyup', function () {
                    table.search($(this).val()).draw();
                });
            }
            initTable('#table1', '#headerDropdown1', '#filterInput1');
        });
    </script>

<script>
$(document).ready(function () {
    $(".edit_button").on("click", function () {
        let odr_status = $('#order_status').val(); 
        let odr_primaryid = $('#order_primaryid').val();
        let odr_id = $('#order_id').val();
        //alert(odr_status);

        if (odr_status === 'confirmed') {
            odr_status = 'process'; 
        } else if (odr_status === 'process') {
            odr_status = 'delivered'; 
        }
       // alert(odr_status);
       //alert(odr_id);


        // update hidden field
        $('#order_status').val(odr_status); 

        $.ajax({
            url: "{{ route('order-status-update') }}",
            type: "POST",
            data: {
                odr_primaryid: odr_primaryid,
                odr_status: odr_status,
                odr_id: odr_id,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // Update status and date
                /*
                $('#track_status').text(response.status);
                $('#track_date').text(response.customer_order_date);
                */

                // Update button dynamically
                if (response.status === 'confirmed') {
                    $('.edit_button').text('Shipped');
                    $('#order_status').val('confirmed');
                } else if (response.status === 'shipped') {
                    $('.edit_button').hide();
                    $('#order_status').val('shipped');
                }

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