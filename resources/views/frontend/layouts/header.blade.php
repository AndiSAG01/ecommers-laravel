<header class="sticky-header border-btm-black header-1">
    <div class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-4">
                    <div class="header-logo">
                        <a href="{{ route('front.index') }}" class="logo-main">
                            <img src="{{ asset('frontend/img/logo.png') }}" loading="lazy" alt="bisum">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none">
                    <nav class="site-navigation">
                        <ul class="main-menu list-unstyled justify-content-center">
                            <li class="menu-list-item nav-item">
                                <a href="{{ route('front.index') }}" class="nav-link">Beranda</a>
                            </li>
                            <li class="menu-list-item nav-item has-megamenu">
                                <div class="mega-menu-header">
                                    <a class="nav-link" href="collection-left-sidebar.html">
                                        Kategori
                                    </a>
                                    <span class="open-submenu">
                                        <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </div>
                                <div class="submenu-transform submenu-transform-desktop">
                                    <div class="container">
                                        <ul class="submenu megamenu-container list-unstyled">
                                            <li class="menu-list-item nav-item-sub">
                                                <div class="mega-menu-header">
                                                    <p class="nav-link-sub nav-text-sub megamenu-heading">
                                                        POD MOD
                                                    </p>
                                                </div>
                                                <div class="submenu-transform megamenu-transform">
                                                    <ul class="megamenu list-unstyled">
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a href="{{ url('product/category/pod-mod') }}" class="nav-link-sub nav-text-sub">All Pod Mod</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="menu-list-item nav-item-sub">
                                                <div class="mega-menu-header d-flex align-items-center justify-content-between">
                                                    <p class="nav-link-sub nav-text-sub megamenu-heading">
                                                        LIQUID
                                                    </p>
                                                </div>
                                                <div class="submenu-transform megamenu-transform">
                                                    <ul class="megamenu list-unstyled">
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a href="{{ url('product/category/saltnic') }}" class="nav-link-sub nav-text-sub">Saltnic</a>
                                                        </li>
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a href="{{ url('product/category/freebase') }}" class="nav-link-sub nav-text-sub">Freebase</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="menu-list-item nav-item-sub">
                                                <div class="mega-menu-header d-flex align-items-center justify-content-between">
                                                    <p class="nav-link-sub nav-text-sub megamenu-heading">
                                                        ATOMIZER
                                                    </p>
                                                </div>
                                                <div class="submenu-transform megamenu-transform">
                                                    <ul class="megamenu list-unstyled">
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a href="{{ url('product/category/atomizer') }}" class="nav-link-sub nav-text-sub">All Atomizer</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="menu-list-item nav-item-sub">
                                                <div class="mega-menu-header d-flex align-items-center justify-content-between">
                                                    <p class="nav-link-sub nav-text-sub megamenu-heading">
                                                        ACCESSORIES
                                                    </p>
                                                </div>
                                                <div class="submenu-transform megamenu-transform">
                                                    <ul class="megamenu list-unstyled">
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a href="{{ url('product/category/accessories') }}" class="nav-link-sub nav-text-sub">All Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-8 col-8">
                    <div class="header-action d-flex align-items-center justify-content-end">
                        <a href="javascript:void(0)" class="header-action-item header-search">
                            <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z" fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-cart ms-4" href="#drawer-cart" data-bs-toggle="offcanvas">
                            <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z" fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-hamburger ms-4 d-lg-none" href="#drawer-menu" data-bs-toggle="offcanvas">
                            <svg class="icon icon-hamburger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                        @if (auth()->guard('customer')->check())
                            <button type="button" class="currency-btn btn-reset ms-4 text-white" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="icon icon-user" width="24" height="24" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z" fill="#000"></path>
                                </svg>
                                <span>
                                    <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                        stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </span>
                            </button>
                            <ul class="currency-list dropdown-menu dropdown-menu-end px-2">
                                <li class="currency-list-item mb-2 mt-2 px-3">
                                    <a href="{{ route('customer.account') }}" class="currency-list-option">
                                        <span>Akun Saya</span>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li class="currency-list-item mb-2 px-3">
                                    <a href="{{ route('customer.logout') }}" class="currency-list-option">
                                        <span>Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('customer.login') }}" class="header-action-item header-wishlist ms-4 d-none d-lg-block">
                                <svg class="icon icon-user" width="24" height="24" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z" fill="#000"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="search-wrapper">
            <div class="container">
                <form action="{{ route('front.product_search') }}" method="get" class="search-form d-flex align-items-center">
                    <button type="submit" class="search-submit bg-transparent pl-0 text-start">
                        <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z" fill="black" />
                        </svg>
                    </button>
                    <div class="search-input mr-4">
                        <input type="text" name="q" placeholder="Cari produk" autocomplete="off">
                    </div>
                    <div class="search-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
