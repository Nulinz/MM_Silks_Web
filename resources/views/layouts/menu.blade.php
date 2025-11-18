<li class="mb-1">
    <a href="{{ route('dashboard.index') }}">
        <button
            class="btn0 mx-auto btn-toggle collapsed {{ Request::routeIs('dashboard.index', 'dashboard.*') ? 'active' : '' }}"
            data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="bx bxs-dashboard"></i> &nbsp;Dashboard
            </div>
        </button>
    </a>
</li>
<li class="mb-1">
    <button class="btn0 mx-auto btn-toggle collapsed {{ Request::routeIs('create.*') ? 'active' : '' }}"
        data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false">
        <div class="righticon d-flex mx-auto">
            <i class="fa-solid fa-angle-right toggle-icon"></i>
        </div>
        <div class="btnname">
            <i class="fa-solid fa-id-badge"></i> &nbsp;Create
        </div>
    </button>
    <div class="collapse" id="collapse2">
        <ul class="btn-toggle-nav list-unstyled text-start ps-5 pe-0 pb-3">
            <li><a href="{{ route('create.product-list') }}"
                    class="d-inline-flex text-decoration-none rounded mt-2 {{ Request::routeIs('create.product-list') ? 'active' : '' }}">Product</a>
            </li>
            <li><a href="{{ route('create.category-list')}}"
                    class="d-inline-flex text-decoration-none rounded {{ Request::routeIs('create.category-list') ? 'active' : '' }}">Category</a>
            </li>
            <li><a href="{{ route('create.subcategory_list')}}"
                    class="d-inline-flex text-decoration-none rounded {{ Request::routeIs('create.subcategory_list') ? 'active' : '' }}">Sub
                    Category</a>
            </li>
            <li><a href="{{ route('create.item_list')}}"
                    class="d-inline-flex text-decoration-none rounded {{ Request::routeIs('create.item_list') ? 'active' : '' }}">
                    Items</a>
            </li>
            <li><a href="{{ route('create.color_list')}}"
                    class="d-inline-flex text-decoration-none rounded {{ Request::routeIs('create.color_list') ? 'active' : '' }}">
                    Colors</a>
            </li>
        </ul>
    </div>
</li>

<li class="mb-1">
    <a href="{{route('subcategory_wise_list')}}">
        <button class="btn0 mx-auto btn-toggle collapsed"
            data-bs-toggle="collapse {{ Request::routeIs('subcategory_wise_list.*') ? 'active' : '' }}" data-bs-target="#collapse3" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-user"></i> &nbsp;B/U Subcategory
            </div>
        </button>
    </a>
</li>
<li class="mb-1">
    <a href="{{ route('order.order-list') }}">
        <button class="btn0 mx-auto btn-toggle collapsed {{ Request::routeIs('order.order-list') ? 'active' : '' }}"
            data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-clipboard-check"></i> &nbsp;Orders
            </div>
        </button>
    </a>
</li>
<li class="mb-1">
    <a href="{{ route('order.return-list') }}">
        <button class="btn0 mx-auto btn-toggle collapsed {{ Request::routeIs('order.return-list') ? 'active' : '' }}"
            data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-clipboard-check"></i> &nbsp;Return
            </div>
        </button>
    </a>
</li>
<li class="mb-1">
    <a href="{{ route('customer_wise_list') }}">
        <button class="btn0 mx-auto btn-toggle collapsed"
            data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-clipboard-check"></i> &nbsp;B/Upload Sales
            </div>
        </button>
    </a>
</li>
<li class="mb-1">
    <a href="{{route('admin.admin-list')}}">
        <button class="btn0 mx-auto btn-toggle collapsed"
            data-bs-toggle="collapse {{ Request::routeIs('admin.admin-list.*') ? 'active' : '' }}" data-bs-target="#collapse7" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-user"></i> &nbsp;User
            </div>
        </button>
    </a>
</li>

<li class="mb-1">
    <a href="{{route('customer.customer_list')}}">
        <button class="btn0 mx-auto btn-toggle collapsed"
            data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-user"></i> &nbsp;Customer
            </div>
        </button>
    </a>
</li>

<li class="mb-1">
    <a href="{{route('create.reduce_list')}}">
        <button class="btn0 mx-auto btn-toggle collapsed"
            data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false">
            <div class="righticon d-flex mx-auto">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="btnname">
                <i class="fa-solid fa-user"></i> &nbsp;Reduce 
            </div>
        </button>
    </a>
</li>




