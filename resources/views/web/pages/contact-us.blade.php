@extends('web.layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/web/css/contact-us.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/inputs.css') }}">

    <div class="contactbanner">
        <img src="{{ asset('assets/web/images/Contact-Us-Banner.png') }}" alt="">
        <div class="contactbannercntnt">
            <h3>Contact Us</h3>
            <h6>Questions about groceries or delivery? Contact us anytime.</h6>
        </div>
    </div>

    <!-- Contact Us Content -->
    <div class="contactuscontent">
        <div class="contactuscontentdiv">
            <div class="contactuscntnt mb-4">
                <h4>Contact Us</h4>
                <h6>
                    At Magarantham Mart, we care about our customers and believe in building strong relationships through
                    clear communication and prompt service. Whether you need help with an order, have a suggestion, or
                    simply want to say hello - wecontactusre here for you.
                </h6>
            </div>
        </div>
    </div>

    <!-- Contact Us Form -->
    <div class="contactusform">
        <div class="contactusformdiv">
            <div class="contactusformleft">
                <h2>Get in touch with us. <br> We're here to assist you.</h2>
            </div>
            <div class="contactusformright">
                <form action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" name="" placeholder="First Name">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" name="" placeholder="Last Name">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="number" class="form-control ctct" name="" onclick="validate_contact(this)"
                                min="6000000000" max="9999999999" placeholder="Contact Number">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" name="" placeholder="Email ID">
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <textarea rows="3" class="form-control" name="" placeholder="Message"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <button class="contactusbtn">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection