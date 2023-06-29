<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #004343;">
    <div class="sidebar-sticky">

        <ul class="nav flex-column" id="menu">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Brand
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('brand.create') }}" class="nav-link active">
                            <span class="menu-collapsed">Add Brand</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('brand') }}" class="nav-link active">
                            <span class="menu-collapsed">Brand List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Product
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('product.create') }}" class="nav-link active">
                            <span class="menu-collapsed">Add Product</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('product') }}" class="nav-link active">
                            <span class="menu-collapsed">Product List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Type
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('type.create') }}" class="nav-link active">
                            <span class="menu-collapsed">Add Type</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('type') }}" class="nav-link active">
                            <span class="menu-collapsed">Type List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Purchase
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('purchase.create') }}" class="nav-link active">
                            <span class="menu-collapsed">Purchase Product</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('purchase') }}" class="nav-link active">
                            <span class="menu-collapsed">Purchase List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Sales
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('type.create') }}" class="nav-link active">
                            <span class="menu-collapsed">New Sales</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('type') }}" class="nav-link active">
                            <span class="menu-collapsed">Sales List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa-solid fa-prescription-bottle-medical mr-2"></i> Report
                </a>
                <ul class="list-unstyled ml-3">
                    <li class="list-item">
                        <a href="{{ route('type.create') }}" class="nav-link active">
                            <span class="menu-collapsed">Add Type</span>
                        </a>
                    </li>
                    <li class="list-item">
                        <a href="{{ route('type') }}" class="nav-link active">
                            <span class="menu-collapsed">Type List</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</nav>


