<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li
                    class="nav-item has-treeview {{ request()->is('admin/settings*') || request()->is('admin/treasuries*') ? 'menu-open' : '' }}     ">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/setting*') || request()->is('admin/treasuries*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            الضبط العام
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.index') }}"
                                class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                                <p>الضبط العام</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.treasuries.index') }}"
                                class="nav-link {{ request()->is('admin/treasuries*') ? 'active' : '' }}">
                                <p>بيانات الخزن</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ request()->is('admin/account-types*') || request()->is('admin/accounts*') || request()->is('admin/customers*') ? 'menu-open' : '' }} ">
                <a href="#"
                    class="nav-link {{ request()->is('admin/account-types*') || request()->is('admin/accounts*') || request()->is('admin/customers*')  ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        الحسابات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.account-types.index') }}"
                            class="nav-link {{ request()->is('admin/account-types*') ? 'active' : '' }}">
                            <p> انواع الحسابات المالية</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.accounts.index') }}"
                            class="nav-link {{ request()->is('admin/accounts*') ? 'active' : '' }}">
                            <p>  الحسابات المالية</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customers.index') }}"
                            class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                            <p>   العملاء</p>
                        </a>
                    </li>
                   
                </ul>
            </li>



                <li class="nav-item has-treeview {{ request()->is('admin/sales-material-types*') || request()->is('admin/stores*') || request()->is('admin/uoms*') || request()->is('admin/item-card-categories*') || request()->is('admin/item-cards*')  ? 'menu-open' : '' }}     ">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/sales-material-types*') || request()->is('admin/stores*') || request()->is('admin/uoms*') || request()->is('admin/item-card-categories*') || request()->is('admin/item-cards*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            ضبط المخازن
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sales-material-types.index') }}"
                                class="nav-link {{ request()->is('admin/sales-material-types*') ? 'active' : '' }}">
                                *
                                <p>
                                    بيانات فئات الفواتير
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stores.index') }}"
                                class="nav-link {{ request()->is('admin/stores*') ? 'active' : '' }}">
                                *
                                <p>
                                    بيانات المخازن
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.uoms.index') }}"
                                class="nav-link {{ request()->is('admin/uoms*') ? 'active' : '' }}">
                                *
                                <p>
                                    بيانات الوحدات
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.item-card-categories.index') }}"
                                class="nav-link {{ request()->is('admin/item-card-categories*') ? 'active' : '' }}">
                                *
                                <p>
                                    فئات الاصناف
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.item-cards.index') }}"
                                class="nav-link {{ request()->is('admin/item-cards*') ? 'active' : '' }}">
                                *
                                <p>
                                    الاصناف
                                </p>
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
