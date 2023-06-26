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


            {{-- <li class="nav-item">
                <a class="nav-link active" href="#" >
                    <i class="fa-solid fa-scale-balanced"></i> Invoice
                </a>
                <ul class="list-unstyled ml-3">
                    <li>
                        <a href="{{ route('invoice/create') }}" class="nav-link active">
                            <span class="menu-collapsed">Add Invoice</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('invoice') }}" class="nav-link active">
                            <span class="menu-collapsed">Invoice List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="#" >
                    <i class="fa-regular fa-file-lines mr-1"></i> Reports
                </a>
                <ul class="list-unstyled ml-3">
                    <li>
                        <a href="{{ route('report/daily_report') }}" class="nav-link active">
                            <span class="menu-collapsed">Daily Sales</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report/sales_report') }}" class="nav-link active">
                            <span class="menu-collapsed">Sales Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('report/purchase_report') }}" class="nav-link active">
                            <span class="menu-collapsed">Purchase Report</span>
                        </a>
                    </li>
                </ul>
            </li> --}}

        </ul>

    </div>
</nav>


