@extends('web.layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/web/css/terms.css') }}">

    <div class="body-main">
        <!-- Backgorund -->
        <div class="background">
            <div class="bgct">
                <h1>REFUND & CANCELLATION POLICY</h1>
                <span>Last updated March 30, 2025</span>
            </div>
        </div>

        <!-- Refund Content -->
        <div class="content">
            <div class="contenthead">
                <p>At Magarantham Mart, customer satisfaction is our top priority. We offer a “No Questions Asked Return at Delivery” policy to ensure a worry-free shopping experience for our customers in Salem, Tamil Nadu.</p>
            </div>

            <hr>

            <div class="contentlist">
                <ul>
                    <li>
                        <h5>1. Return at the Time of Delivery</h5>
                        <p>If for any reason you are not satisfied with the product delivered, you can return it immediately at the time of delivery – no questions asked. Our delivery executive will take back the returned product on the spot.</p>
                    </li>
                    <li>
                        <h5>2. Refund Process</h5>
                        <p class="mb-1">Once the product is returned at delivery:</p>
                        <p class="mb-1">A credit note equal to the value of the returned product will be issued.</p>
                        <p class="mb-1">This amount will be credited to your Magarantham Mart account.</p>
                        <p class="mb-1">You can use this credit for your future purchases with us.</p>
                    </li>
                    <li>
                        <h5>3. Please Note</h5>
                        <p class="mb-1">No cancellation or refund requests will be accepted after the delivery is completed.</p>
                        <p class="mb-1">This policy applies only at the time of delivery and is valid only for customers within Salem, Tamil Nadu</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection