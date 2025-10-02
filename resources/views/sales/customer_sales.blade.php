@extends('layouts.app')

 @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>  
@endif 

<!-- @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif -->



@section('content')
<style>
#response-container {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
    padding: 10px;
    margin-top: 10px;
    display: none; 
}
</style>
<div id="response-container" style="margin-top: 20px; padding: 10px;"></div>


    <div class="sidebodydiv px-4 py-1 mb-3">
        <div class="sidebodyhead mb-4">
        <h4 class="m-0">Add Items</h4>
        </div>

        <form action="{{ route('check.barcode') }}" method="POST" enctype="multipart/form-data">
            @csrf

            
            <div class="container-fluid p-1 maindiv">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-xl-6 mb-3 inputs">
                        <!--subcategory name-->
                        <label for="empcode">Customer Name</label>
                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="{{ $customer->c_name }}" readonly>
                        <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{ $customer->id }}" readonly>
                        <!--types-->
                        <!--
                        <label for="empname" class="col-form-label">Types</label><br>
                        <label for="contact">ready</label>
                        <input type="radio" id="vehicle" name="types" value="ready">
                        <label for="altcontact">Not Finished</label>
                        <input type="radio" id="vehicle1" name="types" value="not_finished"><br>-->
                        <!--colors-->
                        <!--
                        <label for="color" class="col-form-label">Colors</label>
                        <select class="form-control" name="color" id="color">
                                <option value="" disabled selected>-- Choose a color --</option>
                                @foreach($color_list as $color)
                                    <option value="{{ $color->id }}">{{ $color->co_name }}</option>
                                @endforeach
                        </select>-->
                        <!--barcode-->
                        <label for="barcode_value">Scanned Barcode</label>
                        <input type="text" class="form-control" name="i_code" id="i_code">
                    </div>
                    <!--

                    <div id="my_camera" class="col-sm-12 col-md-3 col-xl-6 mb-3 inputs"></div>

                        <br/>

                        <input type=button value="Take Snapshot" onClick="take_snapshot()">

                        <input type="hidden" name="i_logo" class="image-tag">
                        
                   </div>-->
               </div>
                    
                <div id="results" class="col-sm-6 col-md-3 col-xl-3 mb-3 inputs"></div>
                   
        
          </div>  
          
          <div class="container mt-4" id="cart-section" style="display: none;">
            <h5>Existing Items</h5>
            <table class="table table-bordered" id="item-table">
                <thead>
                    <tr>
                        <th>ItemCode</th>
                        <th style="display: none;">Item ID</th>
                        <th>Image</th>
                        <th>Qty</th>
                        <th style="display: none;">SubID</th>
                        <th style="display: none;">Customer ID</th>
                        <th>Price</th>
                        
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div class="text-right mt-3">
                <button type="button" class="btn btn-primary" id="submitCart">Cart Add</button>
            </div>
         </div>


        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
<script>
$(document).ready(function () {
    let typingTimer;
    const doneTypingInterval = 500;
    const $barcodeInput = $('#i_code');
    const $customer_id = $('#customer_id');

    const $form = $barcodeInput.closest('form');
    const $responseContainer = $('#response-container');  // Container to display messages

    let scannedItems = [];

    $barcodeInput.on('input', function () {
        clearTimeout(typingTimer);
        const value = $barcodeInput.val().trim();

        if (value !== '') {
            typingTimer = setTimeout(() => {
                checkBarcodeInDatabase(value);
            }, doneTypingInterval);
        }
    });

    function checkBarcodeInDatabase(barcode) {
        $.ajax({
            url: "{{ route('check.barcode') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                barcode: barcode,
                customer_id: $customer_id.val()
            },
            success: function (response) {
                if (response.exists) {
                    addItemToTable(response.item);
                    $barcodeInput.val('').focus();
                    $responseContainer.empty().hide();  // Clear previous message and hide container
                } else {
                    // Show error message on the same page
                    $responseContainer.text(response.message).addClass('alert alert-info').show();
                    // Hide the message after 5 seconds
                    setTimeout(function() {
                        $responseContainer.fadeOut(500);  // Fade out the error message
                    }, 5000); // 5000ms = 5 seconds
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    function addItemToTable(item) {
        const $table = $('#item-table');
        const $tbody = $table.find('tbody');

        scannedItems.push(item);
        //console.log("Item object:", item);

        const imagePath = "{{ asset('image/itemimage') }}" + `/${item.item_logo}`;
        //console.log(imagePath); // See what the final image URL looks like



        const row = `
            <tr>
                <td>${item.i_code}</td>
                <td>
                  <img src="${imagePath}" height="30px" alt="item Logo">
                </td>
                <td style="display: none;">${item.item_id}</td>
                <td style="display: none;">${item.subcategory_id}</td>
                <td style="display: none;">${item.customer_id}</td>
                <td>1</td>
                 <td>${item.price}</td>
            </tr>
        `;

        $tbody.append(row);
        $('#cart-section').show();
    }

    $('#submitCart').on('click', function () {
    const items = [];

    $('#item-table tbody tr').each(function () {
        const $tds = $(this).find('td');

        const item = {
            item_id: $tds.eq(2).text(),
            item_subcategoryid: $tds.eq(3).text(),
            item_customerid: $tds.eq(4).text(),
            item_qty: parseInt($tds.eq(5).text()),
            item_price: parseFloat($tds.eq(6).text())
        };

        items.push(item);
    });

    const customer_id = $('#customer_id').val();

    // Send AJAX POST with the collected items and customer id
    $.ajax({
        url: "{{ route('submit.cart') }}",  // Define this route to handle submission
        type: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            customer_id: customer_id,
            items: items
        },
        success: function(response) {
            alert(response.message || 'Cart submitted successfully!');
            // Optionally clear the table and hide the cart section
            $('#item-table tbody').empty();
            $('#cart-section').hide();
        },
        error: function(xhr) {
            alert('Failed to submit cart.');
        }
    });
});

});

</script>

@endsection