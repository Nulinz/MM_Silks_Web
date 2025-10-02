<nav class="navbar navbar-expand-lg" aria-label="Thirteenth navbar example">
    <div class="container-fluid w-100">
        <div class="responsive-button">
            <div>
                <a href="{{ route('pages.index') }}"><img src="{{ asset('assets/images/logo.png') }}" height="50px"
                        title="" alt=""></a>
            </div>
            <div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarcontent" aria-controls="navbarcontent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars toggler-icon"></i>
                </button>
            </div>
        </div>

        <div class="navbar-collapse d-lg-flex justify-content-between align-items-center collapse" id="navbarcontent">
            <div class="navbar-brand col-lg-2 me-0">
                <a href="{{ route('pages.index') }}"><img src="{{ asset('image/logo/mmtexlogo.png') }}" height="50px"
                        title="" alt=""></a>
            </div>
            <div class="col-lg-4">
                <!--
                <div class="search-container">
                    <div class="searchdiv col-sm-12 col-md-12">
                        <select class="headerDropdown form-select border-0 rounded-0">
                            <option value="All Categories" selected>All Categories</option>
                        </select>
                        <input type="text" id="customSearch" class="form-control border-0 rounded-0"
                            placeholder=" Search for items">
                    </div>
                    <div class="searchbox mx-auto">
                        <button><i class="fas fa-search text-center"></i></button>
                    </div>
                </div>-->
            </div>
            <ul class="navbar-nav col-lg-6 align-items-lg-center justify-content-lg-evenly" id="navbarNav">
                <li class="nav-item" id="home">
                    <a class="nav-link d-flex align-items-center {{ Request::routeIs('pages.index') ? 'active' : '' }}"
                        href="{{ route('pages.index') }}"><i class="bx bx-home pe-2 fs-5"></i> <span>Home</span></a>
                </li>
                <li class="nav-item" id="offers">
                    <a class="nav-link d-flex align-items-center {{ Request::routeIs('footer.contact') ? 'active' : '' }}"
                        href="{{ route('footer.contact') }}"></i> Contact</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="m-0">Edit Profile</h4>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="" id="name">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="contact" class="col-form-label">Contact Number</label>
                            <input type="number" class="form-control" name="" id="contact"
                                oninput="validate_contact(this)" min="6000000000" max="9999999999" readonly>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="email" class="col-form-label">Email ID</label>
                            <input type="email" class="form-control" name="" id="email">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-1">
                            <label for="address" class="col-form-label">Address</label>
                            <textarea rows="1" class="form-control" name="" id="address"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-1">
                            <label for="city" class="col-form-label">City</label>
                            <input type="text" class="form-control" name="" id="city">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-1">
                            <label for="pincode" class="col-form-label">Pincode</label>
                            <input type="number" class="form-control ctct" name="" id="pincode"
                                oninput="validate_pincode(this)" min="000000" max="999999">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center gap-2 mx-auto mt-3">
                        <button type="submit" class="modalbtn w-50">Save</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#addressModal"
                            class="modalbtn_1 w-50">Cancel</button>
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