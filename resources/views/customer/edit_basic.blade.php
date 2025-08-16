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
                             maxlength="10" value="{{$customer_data->c_contact}}">
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
                                    <option value="D" {{ ($customer_data->c_type ?? '') == 'D' ? 'selected' : '' }}>D</option>
                                    <option value="E" {{ ($customer_data->c_type ?? '') == 'E' ? 'selected' : '' }}>E</option>               
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

            <div class="sidebodyback">
                <div class="backhead">
                    <h6>Permission Details</h6>
                </div>
            </div>
            <div class="container-fluid p-1 maindiv">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="experience">Permission Type</label>
                        <select class="form-select" name="cus_permission_type" id="cus_permission_type">
                          <option value="" selected disabled>Select Category</option>                         
                             <option value="fullaccess" {{ ($customer_data->permission_type ?? '') == 'fullaccess' ? 'selected' : '' }}>Full Allow</option>
                             <option value="limitedaccess" {{ ($customer_data->permission_type ?? '') == 'limitedaccess' ? 'selected' : '' }}>On Time</option>
                        </select>
                    
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Permission Time</label>
                        <?php $today = date('Y-m-d'); ?>
                        <input type="date" class="form-control" name="cus_permission_time" id="cus_permission_time" value="{{ \Carbon\Carbon::parse($customer_data->permission_time)->format('Y-m-d') }}" min="<?php echo $today; ?>">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="joindate">Joining Date</label>
                        <input type="date" class="form-control" name="cus_join_date" id="cus_join_date" value="{{ \Carbon\Carbon::parse($customer_data->joindate)->format('Y-m-d') }}">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Created By</label>
                        <input type="text" class="form-control" name="cus_created_by" id="cus_created_by" value="{{$customer_data->cby}}">
                    </div>
                </div>
            </div>

            
            </div>
            
            <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                            <button type="submit" class="formbtn">Update</button>
                   
            </div>
        </form>
    </div>

@endsection