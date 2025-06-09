<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Trang chủ</div>
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                {{-- Category --}}
                <div class="sb-sidenav-menu-heading">Danh mục</div>
                <a class="nav-link collapsed {{ Request::is('categories') ? 'active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý danh mục
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Danh sách
                            danh mục</a>
                    </nav>
                </div>
                {{-- Products --}}
                <div class="sb-sidenav-menu-heading">Sản phẩm</div>
                <a class="nav-link collapsed {{ Request::is('products') || Request::is('products?page=*') || Request::is('products/create') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false"
                    aria-controls="collapseLayouts1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý sản phẩm
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('products') || Request::is('products?page=*') ? 'active' : '' }}"
                            href="/products?page=1">
                            Danh sách sản phẩm
                        </a>
                        <a class="nav-link {{ Request::is('products/create') ? 'active' : '' }}"
                            href="/products/create">
                            Tạo sản phẩm
                        </a>
                    </nav>
                </div>
                {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> --}}

                {{-- Invoices --}}
                <div class="sb-sidenav-menu-heading">Hóa đơn</div>
                <a class="nav-link collapsed {{ Request::is('invoices') || Request::is('invoices/*') || Request::is('invoice/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false"
                    aria-controls="collapseLayouts2">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý hóa đơn
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('invoices') ? 'active' : '' }}" href="/invoices">
                            Hóa đơn
                        </a>
                        <a class="nav-link {{ Request::is('invoices/create') ? 'active' : '' }}"
                            href="/invoices/create">
                            Tạo hóa đơn
                        </a>
                    </nav>
                </div>

                {{-- Discounts --}}
                <div class="sb-sidenav-menu-heading">Phiếu giảm giá</div>
                <a class="nav-link collapsed {{ Request::is('discounts') || Request::is('discounts/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false"
                    aria-controls="collapseLayouts3">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý phiếu giảm giá
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('discounts') ? 'active' : '' }}" href="/discounts">
                            Phiếu giảm
                        </a>
                    </nav>
                </div>

                {{-- Events --}}
                <div class="sb-sidenav-menu-heading">Sự kiện</div>
                <a class="nav-link collapsed {{ Request::is('events') || Request::is('events/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false"
                    aria-controls="collapseLayouts4">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản ly sự kiện
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('events') ? 'active' : '' }}" href="/events">
                            Tất cả sự kiện
                        </a>
                        <a class="nav-link {{ Request::is('events/create') ? 'active' : '' }}" href="/events/create">
                            Thêm sự kiện
                        </a>
                    </nav>
                </div>

                {{-- Management users --}}
                <div class="sb-sidenav-menu-heading">Người dùng</div>
                <a class="nav-link collapsed {{ Request::is('users-management') || Request::is('users-management/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5"
                    aria-expanded="false" aria-controls="collapseLayouts5">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý người dùng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('users-management') ? 'active' : '' }}"
                            href="/users-management">
                            Danh sách người dùng
                        </a>
                    </nav>
                </div>

                {{-- Comment users --}}
                <div class="sb-sidenav-menu-heading">Đánh giá</div>
                <a class="nav-link collapsed {{ Request::is('comments') || Request::is('comments/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6"
                    aria-expanded="false" aria-controls="collapseLayouts6">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý đánh giá
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('comments') ? 'active' : '' }}" href="/comments">
                            Danh sách đánh giá
                        </a>
                    </nav>
                </div>

                {{-- Sizes, Colors --}}
                <div class="sb-sidenav-menu-heading">Phụ kiện sản phẩm</div>
                <a class="nav-link collapsed {{ Request::is('products/accessories') || Request::is('products/accessories/*') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4"
                    aria-expanded="false" aria-controls="collapseLayouts4">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Quản lý phụ kiện
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('products/accessories/colors') || Request::is('products/accessories/sizes') ? 'active' : '' }}"
                            href="/products/accessories/colors">
                            Phụ kiện sản phẩm
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
