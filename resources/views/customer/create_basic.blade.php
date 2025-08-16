@extends('layouts.app')

@section('content')

    <div class="sidebodydiv px-4 py-1 mb-3">
        <div class="sidebodyhead mb-4">
        <h4 class="m-0">Add Customer</h4>
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
                        <input type="text" class="form-control" name="c_name" id="c_name">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="empname">Location</label>
                        <input type="text" class="form-control" name="c_location" id="c_location">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="contact">Contact Number</label>
                        <input type="number" class="form-control" name="c_contact" id="c_contact"
                             maxlength="10"  oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">
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
                        <select class="form-select" name="c_type" id="c_type">
                          <option value="" selected disabled>Select Category</option>                         
                             <option value="A">A</option>
                             <option value="B">B</option>
                             <option value="C">C</option>
                             <option value="D">D</option>
                          <option value="E">E</option>                  
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
                        <select class="form-select" name="c_permission_type" id="c_permission_type">
                          <option value="" selected disabled>Select Category</option>                         
                             <option value="fullaccess">Full Allow</option>
                             <option value="limitedaccess">On Time</option>
                        </select>
                    
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Permission Time</label>
                        <?php $today = date('Y-m-d'); ?>
                        <input type="date" class="form-control" name="c_permission_time" id="c_permission_time" min="<?php echo $today; ?>">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="joindate">Joining Date</label>
                        <input type="date" class="form-control" name="c_join_date" id="c_join_date">
                    </div>
                    <div class="col-sm-12 col-md-3 col-xl-3 mb-3 inputs">
                        <label for="salary">Created By</label>
                        <input type="text" class="form-control" name="created_by" id="created_by">
                    </div>
                </div>
            </div>

            
            </div>
            
            <div class="col-sm-12 col-md-12 col-xl-12 mt-3 d-flex justify-content-center align-items-center">
                            <button type="submit" class="formbtn">Save</button>
                   
            </div>
        </form>
    </div>

@endsection