<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="pt-5 footercol">
            <div class="footerdiv">
                <div class="footeritems mb-3">
                    <div class="d-flex justify-content-start align-items-start flex-column" id="cmpnyinfo">
                        <div class="col footerlogo">
                            <img src="{{ asset('image/logo/mmtexlogo.png') }}" class="d-flex mx-auto" height="50px"
                                alt="">
                        </div><br>
                        <h5 class="d-flex align-items-center gap-2">
                            <i class="bx bx-map"></i>
                            <span><a href="https://www.google.com/maps/search/?api=1&query=No:+3,+L.M.+Complex,+Sathyanarayana+Street,+Alagapuran+Salem+-+636004"
                                    target="_blank" style="color: #676767;">No: 3, L.M. Complex, Sathyanarayana Street,
                                    Alagapuram, Salem - 636004</a></span>
                        </h5>
                        <h5 class="d-flex align-items-center gap-2">
                            <i class="bx bx-phone"></i>
                            <span><a href="tel:+918428819336" style="color: #676767;">+91 84288 19336</a></span>
                        </h5>
                        <h5 class="d-flex align-items-center gap-2">
                            <i class="bx bx-envelope"></i>
                            <span><a href="mailto:magaranthammartprivatelimited@gmail.com"
                                    style="color: #676767;">magaranthammartprivatelimited@gmail.com</a></span>
                        </h5>
                    </div>
                </div>

                <div class="footeritems mb-3 footer-headings">
                    <h5>Quick Links</h5><br>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{ route('pages.index') }}"
                                class="{{ Request::routeIs('pages.index') ? 'active' : '' }} p-0">Home</a></li>
                        <li class="nav-item mb-2"><a href=""
                                class=" p-0">Offers</a></li>
                        <li class="nav-item mb-2"><a href=""
                                class="p-0">Wishlist</a></li>
                        <li class="nav-item mb-2"><a href=""
                                class="p-0">My Cart</a></li>
                        <li class="nav-item mb-2"><a href=""
                                class="p-0">My Orders</a></li>
                    </ul>
                </div>

                <div class="footeritems mb-3 footer-headings">
                    <h5>Legal Information</h5><br>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{ route('pages.about-us') }}"
                                class="{{ Request::routeIs('pages.about-us') ? 'active' : '' }} p-0">About Us</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('pages.contact-us') }}"
                                class="{{ Request::routeIs('pages.contact-us') ? 'active' : '' }} p-0">Contact Us</a>
                        </li>
                        <li class="nav-item mb-2"><a href="{{ route('pages.terms-and-conditions') }}"
                                class="{{ Request::routeIs('pages.terms-and-conditions') ? 'active' : '' }} p-0">Terms
                                & Conditions</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('pages.privacy-policy') }}"
                                class="{{ Request::routeIs('pages.privacy-policy') ? 'active' : '' }} p-0">Privacy
                                Policy</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('pages.refund-policy') }}"
                                class="{{ Request::routeIs('pages.refund-policy') ? 'active' : '' }} p-0">Refund
                                Policy</a></li>
                    </ul>
                </div>

                <div class="footeritems mb-3 footer-headings">
                    <form>
                        <h5>Follow Us</h5><br>
                        <ul class="nav flex-column" style="display: grid; grid-template-columns: 30% 30%;" id="brands">
                            <li class="nav-item mb-3">
                                <a href="https://wa.me/918428819336" target="__blank" id="whatsapp"
                                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="WhatsApp">
                                    <div class="brandicons">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="" target="_blank" id="facebook" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="Facebook">
                                    <div class="brandicons">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="" target="_blank" id="instagram" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="Instagram">
                                    <div class="brandicons">
                                        <i class="fa-brands fa-instagram"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="" target="_blank" id="linkedin" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="LinkedIn">
                                    <div class="brandicons">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a href="" target="_blank" id="twitter" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="Twitter">
                                    <div class="brandicons">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <div>
                <hr>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h6>&copy; 2025 | All rights reserved</h6>
            </div>
        </div>
    </div>
</footer>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<!-- Splide JS -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<!-- Scripts -->
<script src="{{ asset('assets/web/js/script.js') }}"></script>

<!-- Tooltip -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>

<!-- Navbar Icon -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggler = document.querySelector(".navbar-toggler");
        const icon = toggler.querySelector(".toggler-icon");
        const navbar = document.querySelector(".navbar");

        toggler.addEventListener("click", function () {
            setTimeout(() => {
                if (toggler.getAttribute("aria-expanded") === "true") {
                    navbar.classList.add("solid");
                    icon.classList.replace("fa-bars", "fa-xmark");
                    icon.style.opacity = "1";
                } else {
                    navbar.classList.remove("solid");
                    icon.classList.replace("fa-xmark", "fa-bars");
                    icon.style.opacity = "1";
                }
            }, 100); // Wait for the fade-out effect
        });
    });
</script>

<!-- AOS -->
<!-- <script>
    AOS.init();
</script> -->

</body>

</html>