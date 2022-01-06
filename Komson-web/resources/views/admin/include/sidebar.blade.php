<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{url('admin/dashboard')}}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item @yield('product_manu')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt "></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/product')}}" class="nav-link @yield('product_select')">
                                <i class="far fa-users nav-icon"></i>
                                <p>View Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/product/manage_product')}}"
                                class="nav-link  @yield('product_select_add')">
                                <i class="far fa-users nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('doctor_manu')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user "></i>
                        <p>
                            Doctor
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/doctor')}}" class="nav-link @yield('doctor_select')">
                                <i class="far fa-users nav-icon"></i>
                                <p>View Doctor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/doctor/manage_doctor')}}"
                                class="nav-link @yield('doctor_select_add')">
                                <i class="far fa-users nav-icon"></i>
                                <p>Add Doctor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('distributor_manu')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user "></i>
                        <p>
                            Distributor
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/distributor')}}" class="nav-link @yield('distributor_select')">
                                <i class="far fa-users nav-icon"></i>
                                <p>View Distributor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/distributor/manage_distributor')}}"
                                class="nav-link @yield('distributor_select_add')">
                                <i class="far fa-users nav-icon"></i>
                                <p>Add Distributor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('sale_manu')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-arrow-down "></i>
                        <p>
                            Sale

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/sale')}}" class="nav-link  @yield('sale_select')">
                                <i class="far fa-users nav-icon"></i>
                                <p>View Sale</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/sale/manage_sale')}}" class="nav-link  @yield('sale_select_add')">
                                <i class="far fa-users nav-icon"></i>
                                <p>Add Sale</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>