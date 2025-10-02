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
                                <h5 class="mb-0 text-end">
                                    <td>{{ \Carbon\Carbon::parse($odr_cdetails->order_date)->format('d/m/Y') }}</td>
                                </h5>
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
                                  @if($odr_cdetails->transport_name)
                                   <button type="submit" class="modalbtn" data-bs-toggle="modal" 
                                     data-bs-target="#addbrand">Process</button>
                                  @else
                                  <button type="submit" class="edit_button modalbtn" data-bs-toggle="modal" 
                                    >Process</button>
                                    @endif
                                @elseif($odr_cdetails->odr_status == 'process')
                                <button type="submit" class="edit_button modalbtn">Delivered</button>
                                @endif

                            </div>
                            <!-- <div class="col-sm-12 col-md-12 col-xl-12 mb-3">data-bs-target="#addbrand"

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

        <!--popup for lrn no-->

        <!--end popup-->


        <!-- Right Content -->
        <div class="contentright">
            <div class="proftabs">
                @include ('order.order_profile')
            </div>
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
                <h4 class="modal-title mb-2" id="addbrandLabel">LRN No</h4>
                <form action="{{ route('order.update-lrn') }}" method="POST" id="lrnForm" enctype="multipart/form-data">

                    @csrf
                    <div class="row">
                        <input type="hidden" name="status" value="Received">
                        <input type="hidden" name="order_id" id="order_id" value="{{$odr_cdetails->order_id}}">
                        <input type="hidden" name="order_status" id="order_status" value="process">
                        <!--<label for="productname">Item Code</label>-->
                        <div class="col-sm-12 mb-2">
                            <label for="lrn_no">LRN No</label>
                            <input type="text" class="form-control" name="lrn_no" id="lrn_no" value="">
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="categorytitle">Lrn Image</label>
                            <input type="file" class="form-control" name="lrn_image" id="lrn_image" accept="image/*,.pdf">
                        </div>
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

<!-- Datatables List -->
<script>
    $(document).ready(function() {
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
            $(tableId + ' thead th').each(function(index) {
                var headerText = $(this).text();
                if (headerText != "" && headerText.toLowerCase() != "action" && headerText.toLowerCase() != "image") {
                    $(dropdownId).append('<option value="' + index + '">' + headerText + '</option>');
                }
            });
            $(filterInputId).on('keyup', function() {
                var selectedColumn = $(dropdownId).val();
                if (selectedColumn !== 'All') {
                    table.column(selectedColumn).search($(this).val()).draw();
                } else {
                    table.search($(this).val()).draw();
                }
            });
            $(dropdownId).on('change', function() {
                $(filterInputId).val('');
                table.search('').columns().search('').draw();
            });
            $(filterInputId).on('keyup', function() {
                table.search($(this).val()).draw();
            });
        }
        initTable('#table1', '#headerDropdown1', '#filterInput1');
    });
</script>

<script>
    $(document).ready(function() {
        $(".edit_button").on("click", function() {
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
                success: function(response) {

                    if (response.status === 'delivered') {
                        // Page reload if the status is 'delivered'
                        location.reload();
                    }
                     if (response.status === 'process') {
                        // Page reload if the status is 'delivered'
                        location.reload();
                     }

                    // Remove this if you want dynamic update only
                    //location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#lrnForm').on('submit', function(e) {
            e.preventDefault();

            let form = document.getElementById('lrnForm');
            let formData = new FormData(form); // ✅ Automatically gets all fields including the image

            $.ajax({
                url: "{{ route('order.update-lrn') }}",
                type: "POST",
                data: formData,
                contentType: false, // ✅ Let the browser set this
                processData: false, // ✅ Prevent jQuery from turning it into a query string
                success: function(response) {
                    location.reload(); // Reload or show success message
                },
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>
<!--
<script>
    $(document).ready(function () {
        $('.modalbtn').on('click', function (e) {
            e.preventDefault(); // prevent form submission if button is inside form

            const transportName = $(this).data('transport');

            if (transportName) {
                // Set the transport name input in the modal
                $('#transportInput').val(transportName);

                // Show the modal using Bootstrap's JS API
                var myModal = new bootstrap.Modal(document.getElementById('addbrand'));
                myModal.show();
            }
            // } else {
            //     alert("Transport name is missing. Cannot proceed.");
            //     // Or just do nothing to block modal opening
            // }
        });
    });
</script>-->






@endsection