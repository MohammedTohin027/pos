@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
{{-- @dd($prefix) --}}
{{-- @dd($route) --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty(Auth::user()->image) ? url('upload/profile_images/' . Auth::user()->image) : url('upload/avater_1.png') }}"
                    style="width: 40px; height: 40px; border-redius: 50%" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="{{ route('profile.view') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview @yield('manage-user')">
                    <a href="#" class="nav-link @yield('manage-user')">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.view') }}" class="nav-link @yield('view-user')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- profile --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/profiles' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Profile Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.view') }}"
                                class="nav-link {{ $route == 'profile.view' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                            <a href="{{ route('change.password') }}"
                                class="nav-link {{ $route == 'change.password' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- suppliers --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/suppliers' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Suppliers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('supplier.view') }}" class="nav-link {{ ($route == 'supplier.view') || ($route == 'supplier.create') || ($route == 'supplier.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Suppliers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- customers --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/customers' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Customers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customer.view') }}" class="nav-link {{ ($route == 'customer.view') || ($route == 'customer.create') || ($route == 'customer.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.credit') }}" class="nav-link {{ ($route == 'customer.credit') || ($route == 'customer.credit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Credit Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.paid') }}" class="nav-link {{ ($route == 'customer.paid') || ($route == 'customer.paid') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paid Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.wise.report') }}" class="nav-link {{ ($route == 'customer.wise.report') || ($route == 'customer.wise.report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer Wise Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- units --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/units' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Unit
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('unit.view') }}" class="nav-link {{ ($route == 'unit.view') || ($route == 'unit.create') || ($route == 'unit.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Unit</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- categories --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/categories' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.view') }}" class="nav-link {{ ($route == 'category.view') || ($route == 'category.create') || ($route == 'category.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- products --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/products' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.view') }}" class="nav-link {{ ($route == 'product.view') || ($route == 'product.create') || ($route == 'product.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- purchase --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/purchases' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Purchase
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchase.view') }}" class="nav-link {{ ($route == 'purchase.view') || ($route == 'purchase.create') || ($route == 'purchase.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Purchase</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchase.pending.view') }}" class="nav-link {{ ($route == 'purchase.pending.view') || ($route == 'purchase.pending.view') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approval Purchase</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchase.report') }}" class="nav-link {{ ($route == 'purchase.report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Purchase Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- invoice --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/invoices' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Invoice
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('invoice.view') }}" class="nav-link {{ ($route == 'invoice.view') || ($route == 'invoice.create') || ($route == 'invoice.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoice.pending.view') }}" class="nav-link {{ ($route == 'invoice.pending.view') || ($route == 'invoice.approve') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approval Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoice.print.list') }}" class="nav-link {{ ($route == 'invoice.print.list') || ($route == 'invoice.print') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Print Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoice.daily.report') }}" class="nav-link {{ ($route == 'invoice.daily.report') || ($route == 'invoice.daily.report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- stock --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/stock' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manage Strock
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('stock.report') }}" class="nav-link {{ ($route == 'stock.report') || ($route == 'stock.report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock.report.supplier.product.wise') }}" class="nav-link {{ ($route == 'stock.report.supplier.product.wise') || ($route == 'stock.report.supplier.product.wise') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier / Product Wise</p>
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
