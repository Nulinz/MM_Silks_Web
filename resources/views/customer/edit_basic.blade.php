@extends('layouts.app')

@section('content')

    <div class="sidebodydiv px-4 py-1 mb-3">
        <div class="sidebodyhead mb-4">
        <h4 class="m-0">Customer Detail Update
        </h4>
        </div>

        <form action="{{ route('customer_store') }}" method="POST" enctype="">
            @csrf

            <div class="sidebodyback">
                <div class="backhead">
                    <h6>Basic Details</h6>
                </div>
            </div>
            <div class="container-fluid p-1 maindiv">
                <div class="row">
                    <!-- <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="empcode">Employee Code</label>
                        <input type="text" class="form-control" name="e_id" id="empcode">
                    </div> -->
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="empname">Name</label>
                        <input type="text" class="form-control" name="cus_name" id="cus_name" value="{{$customer_data->c_name}}">
                        <input type="hidden" class="form-control" name="cus_id" id="cus_id" value="{{$customer_data->id}}">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="empname">Location</label>
                        <input type="text" class="form-control" name="cus_location" id="cusr_location" value="{{$customer_data->c_location}}">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="contact">Contact Number</label>
                        <input type="number" class="form-control" name="cus_contact" id="cus_contact"
                             min="6000000000"
                        max="9999999999" oninput="validate_contact(this)" onkeyup="checkPhone()" value="{{$customer_data->c_contact}}">
                         <small id="phone-error"></small>
                    </div>
                            <!--    
                            <i class="fas fa-eye-slash" id="passHide"
                                onclick="togglePasswordVisibility('password', 'passShow', 'passHide')"
                                style="display:none; cursor:pointer;"></i>
                            <i class="fas fa-eye" id="passShow"
                                onclick="togglePasswordVisibility('password', 'passShow', 'passHide')"
                                style="cursor:pointer;"></i>-->
                       
                     <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="designation">C Category Type</label>
                        <!-- <input type="text" class="form-control" name="c_type" id="c_type" oninput="validate(this)"
                            minlenght="10" maxlength="10">                      -->
                        <select class="form-select" name="cus_type" id="cus_type">                     {{$customer_data->c_type}}
                                    <option value="" disabled {{ ($customer_data->c_type ?? '') == '' ? 'selected' : '' }}>Select Category</option>
                                    <option value="A" {{ ($customer_data->c_type ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ ($customer_data->c_type ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ ($customer_data->c_type ?? '') == 'C' ? 'selected' : '' }}>C</option>               
                        </select>                     
                    </div> 
                    <!-- <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="altcontact">Alternate Contact Number</label>
                        <input type="number" class="form-control" name="e_cont2" id="altcontact" oninput="validate(this)"
                            minlenght="10" maxlength="10">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="email">Email ID</label>
                        <input type="email" class="form-control" name="e_mail" id="email">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="bloodgrp">Blood Group</label>
                        <input type="text" class="form-control" name="e_group" id="bloodgrp">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="profileimg">Profile Image</label>
                        <input type="file" class="form-control" name="e_img" id="profileimg">
                    </div> -->
                </div>
            </div>

            <!-- <div class="sidebodyback">
                <div class="backhead">
                    <h6>Permission Details</h6>
                </div>
            </div> -->
            <div class="container-fluid p-1 maindiv">
            <div class="row mb-3 align-items-end">
                <!-- Permission Type -->
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                    <label for="cus_permission_type" class="form-label">Permission Type</label>
                    <select class="form-select" name="cus_permission_type" id="cus_permission_type">
                        <option value="" selected disabled>Select Category</option>   
                        <option value="fullaccess" {{ ($customer_data->permission_type ?? '') == 'fullaccess' ? 'selected' : '' }}>Full Access</option>
                        <option value="onetime" {{ ($customer_data->permission_type ?? '') == 'onetime' ? 'selected' : '' }}>One Time</option>
                    </select>
                </div>

                <!-- Update button -->
                <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs d-flex align-items-end">
                    <button type="submit" class="formbtn">Update</button>
                </div>


                    <!--
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Permission Time</label>
                        <input type="date" class="form-control" name="cus_permission_time" id="cus_permission_time" value="{{ \Carbon\Carbon::parse($customer_data->permission_time)->format('Y-m-d') }}">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="joindate">Joining Date</label>
                        <input type="date" class="form-control" name="cus_join_date" id="cus_join_date" value="{{ \Carbon\Carbon::parse($customer_data->joindate)->format('Y-m-d') }}">
                    </div>-->
                    <!--
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Created By</label>
                        <input type="text" class="form-control" name="cus_created_by" id="cus_created_by" value="{{$customer_data->cby}}">
                    </div>-->
                </div>
            </div>
     
            
            </div>
            
        </form>
    </div>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    function checkPhone() {
        const phoneInput = document.getElementById('cus_contact');
        const phone = phoneInput.value.trim();
        const errorTag = document.getElementById('phone-error');
        const submitBtn = document.querySelector('.formbtn');
        //alert(phone);
         const customer_id = document.getElementById('cus_id').value;
         //alert(customer_id);
        errorTag.textContent = '';

        if (phone.length !== 10) {
            if (submitBtn) submitBtn.disabled = true;
            return;
        }

        if (!/^\d{10}$/.test(phone)) {
            errorTag.textContent = 'Please enter a valid 10-digit phone number.';
            if (submitBtn) submitBtn.disabled = true;
            return;
        }

        const phoneNumber = parseInt(phone, 10);
        if (phoneNumber < 6000000000) {
            errorTag.textContent = 'Please enter a valid phone number starting with 6 or above.';
            if (submitBtn) submitBtn.disabled = true;
            return;
        }

        console.log(phoneNumber)

        fetch('/edit-number', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCSRFToken()
                },
                body: JSON.stringify({
                    phone: phone,
                    id:  customer_id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (submitBtn) submitBtn.disabled = false;
                if (data.exists) {
                    errorTag.textContent = 'Contact Number already registered.';
                    if (submitBtn) submitBtn.disabled = true;
                }
            })
            .catch(error => {
                console.error('Phone check error:', error);
            });
    }
</script>


@endsection