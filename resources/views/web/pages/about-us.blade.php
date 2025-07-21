@extends('web.layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/web/css/about-us.css') }}">

    <div class="aboutbanner">
        <img src="{{ asset('assets/web/images/About-Us-Banner.png') }}" alt="">
        <div class="aboutbannercntnt">
            <h3>About Magarandham Mart</h3>
            <h6>Making grocery shopping easier, faster, and more affordable daily.</h6>
        </div>
    </div>

    <!-- About Us Content -->
    <div class="aboutuscontent">
        <div class="aboutuscontentdiv">
            <div class="aboutuscntnt mb-4">
                <h4>What We Offer</h4>
                <h6>
                    From daily essentials like rice, dals, and snacks, beverages, dairy, bakery, and household
                    products—Magarantham Mart offers a wide variety of items carefully selected to meet your everyday needs.
                    We work directly with farmers, local vendors, and trusted suppliers to ensure quality and freshness.
                </h6>
            </div>
            <div class="aboutuscntnt mb-4">
                <h4>Our Mission</h4>
                <h6>
                    Our mission is to provide affordable, fresh, and high-quality groceries while saving your time and
                    effort. We believe that everyone deserves access to quality food and everyday essentials without the
                    stress of traditional shopping.
                </h6>
            </div>
            <div class="aboutuscntnt mb-4">
                <h4>Our Vision</h4>
                <h6>
                    We envision a future where grocery shopping is effortless, digital, and delightful—and we're proud to be
                    part of that transformation. With Magarantham Mart, you're not just buying groceries—you're joining a
                    community that values quality, convenience, and trust.
                </h6>
            </div>
            <div class="aboutuscntnt">
                <h4>Why Choose Us?</h4>
                <ul>
                    <li class="mb-1">
                        Wide Range of Products: From local staples to popular brands, find everything you need in one place.
                    </li>
                    <li class="mb-1">
                        Freshness Guaranteed: We prioritize freshness and quality in every item we deliver.
                    </li>
                    <li class="mb-1">
                        Quick Delivery: Your time is valuable—get your groceries delivered fast and on time.
                    </li>
                    <li class="mb-1">
                        User-Friendly Experience: Shop easily through our app or website, designed to give you a smooth and
                        hassle-free experience.
                    </li>
                    <li class="mb-1">
                        Secure Payments: Multiple payment options with secure checkout.
                    </li>
                </ul>
            </div>
        </div>
    </div>


@endsection