<nav class="navbar px-4">
    <div class="icons login col-sm-12 col-md-12">
        <button class="border-0 m-0 p-0 responsive_button" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span id="navigation-icon" style=" font-size:25px;cursor:pointer"><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="navlogo">
            <a href="./index.php" class="mx-auto">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" height="40px" class="mx-auto lightLogo">
            </a>
        </div>
        <div class="user" id="user">
            @include('layouts.user')
            <div class="maindropdown">
                <div class="dropdowndiv">
                    <div class="dropdownimg">
                        <!--<img src="{{ asset('assets/images/avatar.png') }}" height="60px" alt="">-->
                        <div>
                            
                            <h5>{{ Auth::guard('web')->user()->name }}
                            </h5>
                            <h6 class="m-0 border-0">Admin</h6>
                        </div>
                    </div>
                    <ul class="p-0">
                        <li class="mb-3">
                            <a class="d-flex align-items-center gap-3" data-bs-toggle="modal"
                                data-bs-target="#password">
                                <i class="fa-solid fa-unlock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <form method="POST" action="{{ route('user.logout') }}">
                         @csrf
                        <li>
                            <button type="submit" class="d-flex align-items-center gap-3" style="background: none; border: none;">
                             <i class="fa-solid fa-right-from-bracket" style="color: red;"></i>
                             <span>Logout</span>
                           </button>
                            <!--
                            <a href="" class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-right-from-bracket" style="color: red;"></i>
                                <span>Logout</span>
                            </a>-->
                        </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Change Password Modal -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="passwordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h4 class="m-0">Change Password</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="col-sm-12 col-md-12 mb-2">
                        <label for="oldpassword">Old Password</label>
                        <div class="inpflex">
                            <input type="password" class="form-control border-0" name="oldpassword" id="password_1">
                            <i class="fa-solid fa-eye-slash" id="passHide_1"
                                onclick="togglePasswordVisibility('password_1', 'passShow_1', 'passHide_1')"
                                style="display:none; cursor:pointer;"></i>
                            <i class="fa-solid fa-eye" id="passShow_1"
                                onclick="togglePasswordVisibility('password_1', 'passShow_1', 'passHide_1')"
                                style="cursor:pointer;"></i>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-2">
                        <label for="newpassword">New Password</label>
                        <div class="inpflex">
                            <input type="password" class="form-control border-0" name="newpassword" id="password_2">
                            <i class="fa-solid fa-eye-slash" id="passHide_2"
                                onclick="togglePasswordVisibility('password_2', 'passShow_2', 'passHide_2')"
                                style="display:none; cursor:pointer;"></i>
                            <i class="fa-solid fa-eye" id="passShow_2"
                                onclick="togglePasswordVisibility('password_2', 'passShow_2', 'passHide_2')"
                                style="cursor:pointer;"></i>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-2">
                        <label for="confirmpassword">Confirm Password</label>
                        <div class="inpflex">
                            <input type="password" class="form-control border-0" name="confirmpassword" id="password_3">
                            <i class="fa-solid fa-eye-slash" id="passHide_3"
                                onclick="togglePasswordVisibility('password_3', 'passShow_3', 'passHide_3')"
                                style="display:none; cursor:pointer;"></i>
                            <i class="fa-solid fa-eye" id="passShow_3"
                                onclick="togglePasswordVisibility('password_3', 'passShow_3', 'passHide_3')"
                                style="cursor:pointer;"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mx-auto mt-3">
                        <button type="submit" class="modalbtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        $("#user").click(function (event) {
            event.stopPropagation();
            $(".maindropdown").fadeIn();
        });
        $(document).click(function () {
            $(".maindropdown").fadeOut();
        });
        $(".maindropdown").click(function (event) {
            event.stopPropagation();
        });
    })
</script>