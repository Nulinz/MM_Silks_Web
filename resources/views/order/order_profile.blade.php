<link rel="stylesheet" href="{{ asset('assets/css/order_porfile.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/order_timeline.css') }}">

<div class="ordermain">

    <!-- Order Head -->
    <div class="orderhead">
        <div class="orderdate">
            <h6 class="mb-0"><span>Order Id :{{$odr_cdetails->order_id}}</span></h6>
        </div>
        <div class="brdr">|</div>
        <div class="estdate">
            <h6 class="mb-0"><span><i class="fa-solid fa-indian-rupee-sign"></i> Total :{{$odr_cdetails->amount}}</span></h6>
        </div>
    </div>

    <!-- Order Timeline -->
    <div class="ordertimeline">

           
        <!--
        <ul class="timeline p-0 w-100" id="timeline">
            <li class="li complete">
                <div class="timestamp">
                   <p id="track_status"></p>
                </div>
                <div class="status">
                    <p id="track_date"></p>
                </div>
            </li>
            <li class="li">
                <div class="timestamp">
                    <span class="author">Shipped</span>
                </div>
                <div class="status">
                    <h4>Fri 3, Jan</h4>
                </div>
            </li>
            <li class="li">
                <div class="timestamp">
                    <span class="author">Out For Delivery</span>
                </div>
                <div class="status">
                    <h4>Mon 6, Jan</h4>
                </div>
            </li>
            <li class="li">
                <div class="timestamp">
                    <span class="author">Delivered</span>
                </div>
                <div class="status">
                    <h4>Expected by Fri 10, Jan</h4>
                </div>
            </li>
        </ul>-->
    </div>

    <!-- Order Products -->
    <div class="table-wrapper">
                <table class="example table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!--<th>Id</th>-->
                            <th>SubCat Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sum_qty = 0;
                            $total_amount = 0;
                        @endphp

                       @foreach($item_details as $item)
                        <tr>
                            
                           <td> {{$loop->iteration}} </td>
                           <td>{{ $item->subcategory_name }}</td>
                           <td>{{ $item->qty }}</td>
                           <td>{{ $item->amount }}</td>  
                           @php
                                $sum_qty += $item->qty;
                                $total_amount += $item->amount;
                            @endphp
                        </tr>
                        
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>{{ $sum_qty }}</strong></td>
                            <td><strong>{{ $total_amount }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    

    

    <!-- Order Payment
    <div class="orderpayment">
        <div class="payment">
            <h5 class="mb-2">Payment</h5>
            <div class="visa">
                <h6 class="mb-0">VISA ****0056</h6>
                <img src="{{ asset('assets/images/visa_logo.png') }}" height="10px" alt="">
            </div>
        </div>
        <div class="delivery">
            <h5 class="mb-2">Delivery</h5>
            <div class="address">
                <h6 class="mb-1">Address</h6>
                <h6 class="mb-1">Near Reliance Mall, 5 Roads, Salem - 636 009 </h6>
            </div>
        </div>
    </div>

    <hr> -->

    <!-- Order Summary
    <div class="ordersummary">
        <div class="summarytable">
            <div class="summaryhead">
                <h5 class="mb-1">Order Summary</h5>
                <h6 class="mb-2">Order No : <span class="text-success">#583942</span></h6>
            </div>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>2 x Park Avenue</td>
                        <th class="text-end">₹ 500</th>
                    </tr>
                    <tr>
                        <td>1 x MTR Gulab Jamun Mix</td>
                        <th class="text-end">₹ 1500</th>
                    </tr>
                    <tr>
                        <td>2 x Sunsilk Shampoo</td>
                        <th class="text-end">₹ 500</th>
                    </tr>
                    <tr>
                        <td>Delivery</td>
                        <th class="text-end">₹ 1000</th>
                    </tr>
                    <tr>
                        <th>Total incl. GST</th>
                        <th class="text-end">₹ 1500</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->

</div>