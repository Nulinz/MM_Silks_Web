@extends('web.layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('assets/web/css/home.css') }}">

    <!-- Home Banner -->
    <div class="home-banner mt-3">
        <div id="carousel1" class="splide w-100 mb-4">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide splide1 w-100">
                        <div class="carousel-content">
                            <h1>Don't miss our Kurkure Brand offer.</h1>
                            <h6>Save up to 20%</h6>
                            <a href="">
                                <button class="homebannerbtn">Shop Now <i class="fas fa-arrow-right ps-1"></i></button>
                            </a>
                        </div>
                        <div class="carousel-img">
                            <img src="{{ asset('assets/web/images//home/ban1.png') }}" width="100%" class="d-flex mx-auto"
                                alt="">
                        </div>
                    </li>
                    <li class="splide__slide splide2 w-100">
                        <div class="carousel-content">
                            <h1>Shop More, <br> Save More!</h1>
                            <h6>Save up to 20%</h6>
                            <a href="">
                                <button class="homebannerbtn">Shop Now <i class="fas fa-arrow-right ps-1"></i></button>
                            </a>
                        </div>
                        <div class="carousel-img">
                            <img src="{{ asset('assets/web/images//home/ban2.png') }}" width="90%" class="d-flex mx-auto"
                                alt="">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Brands -->
    <div class="brands">
        <div class="brandsdiv">
            <div id="carousel2" class="splide">
                <div class="brandshead">
                    <h3>Explore Brands</h3>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                       
                            <li class="splide__slide">
                                <a href="">
                                    <div class="brand-content">
                                       
                                        <div class="carousel-img">
                                            
                                            <img src="{{ asset('assets/web/images//home/ban3.png') }}"

                                                     height="100px" width="100px" class="d-flex mx-auto" alt="phto">
                                            
                                        </div>
                                        
                                        <div class="carousel-content">
                                            <h5>ss</h5>
                                            <h6> Items</h6>
                                        </div>

                                    </div>
                                </a>
                            </li>
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="products">
        <div class="productsdiv">
            <div id="carousel3" class="splide">
                <div class="productshead">
                    <h3>Featured Products</h3>
                    <div class="filterdiv">
                        <a>
                            <h6 class="m-0">All</h6>
                        </a>
                        <a>
                            <h6 class="m-0">Groceries</h6>
                        </a>
                        <a>
                            <h6 class="m-0">Snacks</h6>
                        </a>
                        <a>
                            <h6 class="m-0 active">LifeStyle</h6>
                        </a>
                    </div>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                       
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                 img
                                                <img src="{{ asset('assets/web/images//home/ban1.png') }}" 
                                                     height="100px" width="100px" class="d-flex mx-auto" alt="">
                                           
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    {{-- <a href="{{ route('wishlist.add', ['item_id' => $item->id, 'customer_id' => $customer->id]) }}"> --}}
                                    {{-- @foreach($item as $item) 
                                        <a href="{{ route('wishlist.add', ['item_id' => $item->id, 'customer_id' => $customer->id]) }}">
                                            <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                        </a>
                                    @endforeach --}}

                                   

                                    
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>hi</h5>
                                    <h6><span class="originalamt">₹10</span> <span class="ps-2 discountamt">₹20</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Offer Cards -->
    <div class="offercard">
        <div class="offercarddiv">
            <div class="offercard1">
                <div class="offercardleft">
                    <h5>50% Off</h5>
                    <h3>Category Offer</h3>
                    <h6>"Up to 50% Off on Snacks & Beverages - Don't Miss Out!"</h6>
                    <a href=""><button class="homebannerbtn">Shop Now <i class="fas fa-arrow-right ps-1"></i></button></a>
                </div>
                <div class="offercardright">
                    <img src="{{ asset('assets/web/images//home/banner_3.png') }}" width="90%" class="d-flex ms-auto" alt="">
                </div>
            </div>
            <div class="offercard2">
                <div class="offercardleft">
                    <h5>60% Off</h5>
                    <h3>Product Discount</h3>
                    <h6>"Up to 50% Off on Snacks & Beverages - Don't Miss Out!"</h6>
                    <a href=""><button class="homebannerbtn">Order Now <i class="fas fa-arrow-right ps-1"></i></button></a>
                </div>
                <div class="offercardright">
                    <img src="{{ asset('assets/web/images//home/banner_4.png') }}" width="80%" class="d-flex ms-auto" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Offer End Sales -->
    <div class="products">
        <div class="productsdiv">
            <div id="carousel4">
                <div class="productshead">
                    <h3>Offer End Sales</h3>
                    <div class="filterdiv">
                        <h5 class="m-0">Expires In: 10 : 56 : 21</h5>
                    </div>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="{{ asset('assets/web/images//home/shampoo1.png') }}" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Clear Men Deep Cleanse Shampoo (150ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://m.media-amazon.com/images/I/51LmmOtr0WL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Clinic Plus Strong & long Egg White Shampoo (250ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://www.bigbasket.com/media/uploads/p/xxl/40246846-2_2-meera-strong-healthy-shampoo-with-kunkudukai-badam-reduces-hair-fall-cleanses-scalp.jpg"
                                        width="90%" class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Meera Strong & Healthy Shampoo (150ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content outofstock">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <h6 class="m-0 outstock">Sold Out</h6>
                                    <img src="https://veelabeauty.com/image/cache/catalog/IMG/Nivea/Nivea-Hair-Milk-All-Round-Care-Shampoo-400ml-300x300.jpg.webp"
                                        width="90%" class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Nivea Haarmilch Shampoo (100ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://m.media-amazon.com/images/I/61f0n2D85yL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Himalaya Gentle Baby Shampoo (150ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content outofstock">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <h6 class="m-0 outstock">Sold Out</h6>
                                    <img src="https://m.media-amazon.com/images/I/510c+wDdsuL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Sunsilk Black Shampoo (200ml)</h5>
                                    <h6><span class="originalamt">₹ 172</span> <span class="ps-2 discountamt">₹188</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Explore Category -->
    <div class="brands">
        <div class="brandsdiv">
            <div id="carousel5" class="splide">
                <div class="brandshead">
                    <h3>Explore Category</h3>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                       
                        <li class="splide__slide">
                            <a href="">
                                <div class="brand-content">
                                    <div class="carousel-img">
                                     
                                                <img src="{{ asset('assets/web/images//home/ban4.png') }}" 
                                                     height="100px" width="100px" class="d-flex mx-auto" alt="">
                                           
                                    </div>
                                    <div class="carousel-content">
                                        <h5>hi</h5>
                                        <h6>hi Items</h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Snacks -->
    <div class="products">
        <div class="productsdiv">
            <div id="carousel6" class="splide">
                <div class="productshead">
                    <h3>Snacks</h3>
                    <div class="filterdiv">
                        <a>
                            <h6 class="m-0">All</h6>
                        </a>
                        <a>
                            <h6 class="m-0">Chips</h6>
                        </a>
                        <a>
                            <h6 class="m-0 active">Biscuits</h6>
                        </a>
                        <a>
                            <h6 class="m-0">Crackers</h6>
                        </a>
                        <a>
                            <h6 class="m-0">Protein Bars</h6>
                        </a>
                    </div>
                </div>
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="{{ asset('assets/web/images//home/snack_1.png') }}" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Cadbury Oreo Vanilla Flavour Biscuit (41.75 g)</h5>
                                    <h6><span class="originalamt">₹ 9</span> <span class="ps-2 discountamt">₹10</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://www.unibicfoods.com/wp-content/uploads/2022/12/cashew-badam.png"
                                        width="90%" class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>UNIBIC Cashew Badam Cookies Biscuit (270 g)</h5>
                                    <h6><span class="originalamt">₹ 19</span> <span class="ps-2 discountamt">₹25</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://m.media-amazon.com/images/I/61zzgxY+OzL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 coldsale"><i class="fas fa-snowflake pe-1"></i> Cold Sale</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>BRITANNIA Jim Pops Jam Biscuit (350 g)</h5>
                                    <h6><span class="originalamt">₹ 19</span> <span class="ps-2 discountamt">₹25</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://cdn.shopify.com/s/files/1/0523/9934/1736/products/102761-2_7-kurkure-namkeen-masala-munch.jpg?v=1633507330"
                                        width="90%" class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 tastydeal"><i class="fas fa-face-grin-tongue-squint pe-1"></i> Tasty
                                        Deals</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>KURKURE Masala Munch (mixture) (75 g)</h5>
                                    <h6><span class="originalamt">₹ 21</span> <span class="ps-2 discountamt">₹25</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://m.media-amazon.com/images/I/71Af8qfZQUL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 tastydeal"><i class="fas fa-face-grin-tongue-squint pe-1"></i> Tasty
                                        Deals</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>Lay's Spaish Tomato Tango Chips Chips (82 g)</h5>
                                    <h6><span class="originalamt">₹ 47</span> <span class="ps-2 discountamt">₹50</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide">
                            <div class="product-content">
                                <div class="carousel-img">
                                    <h6 class="m-0 saveoff">Save 10%</h6>
                                    <img src="https://m.media-amazon.com/images/I/71KM4OL2AgL.jpg" width="90%"
                                        class="d-flex mx-auto" alt="">
                                    <h6 class="m-0 wish"><i class="fa-regular fa-heart"></i></h6>
                                    <h6 class="m-0 tastydeal"><i class="fas fa-face-grin-tongue-squint pe-1"></i> Tasty
                                        Deals</h6>
                                </div>
                                <div class="carousel-content">
                                    <h5>BRITANNIA Little Hearts Sweet & Salty Biscuit (70 g)</h5>
                                    <h6><span class="originalamt">₹ 45</span> <span class="ps-2 discountamt">₹50</span>
                                    </h6>
                                </div>
                                <div class="cardbutton">
                                    <a href="">
                                        <button class="cartbtn">
                                            <span class="iconcontainer">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"
                                                    class="cart">
                                                    <path
                                                        d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <p class="text m-0">Add to Cart</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- App -->
    <div class="app">
        <div class="appdiv">
            <div class="appleft">
                <h1>Shop Faster With Maharandam Mart App</h1>
                <a href="">
                    <img src="{{ asset('assets/web/images//home/playstore.png') }}" height="60px" alt="">
                </a>
            </div>
            <div class="appright">
                <img src="{{ asset('assets/web/images//home/appImage.png') }}" width="90%" class="d-flex mx-auto" alt="">
            </div>
        </div>
    </div>

    <script>
        // Home-Banner Carousel
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#carousel1', {
                type: 'fade',
                perPage: 1,
                rewind: true,
                autoplay: true,
                interval: 2000,
            }).mount();
        });
    </script>

    <script>
        // Brands / Category / Snacks Carousel
        document.addEventListener('DOMContentLoaded', function () {
            var carousels = ['#carousel2', '#carousel5', '#carousel6'];
            carousels.forEach(function (selector) {
                var el = document.querySelector(selector);
                if (el) {
                    new Splide(el, {
                        type: 'loop',
                        perPage: 6,
                        perMove: 1,
                        rewind: true,
                        autoplay: true,
                        interval: 3000,
                        breakpoints: {
                            1098: {
                                perPage: 4,
                            },
                            768: {
                                perPage: 3,
                            },
                            480: {
                                perPage: 2,
                            },
                            300: {
                                perPage: 1
                            }
                        }
                    }).mount();
                }
            });
        });
    </script>

    <script>
        // Products Carousel
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#carousel3', {
                type: 'loop',
                perPage: 6,
                perMove: 1,
                rewind: true,
                autoplay: false,
                // interval: 5000,
                breakpoints: {
                    1098: {
                        perPage: 4,
                    },
                    768: {
                        perPage: 3,
                    },
                    600: {
                        perPage: 2,
                    },
                    300: {
                        perPage: 1
                    }
                }
            }).mount();
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".wish").click(function () {
                $(this).toggleClass("active");
                $(this).find("i").toggleClass("fa-regular fa-heart fas fa-heart");
            });
        });
    </script>

@endsection