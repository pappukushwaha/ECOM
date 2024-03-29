<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('tittle')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_login/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_login/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin_login/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_login/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_login/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{asset('admin_login/images/icon/logo.png')}}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_selected')">
                            <a href="{{url('dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('order_selected')">
                            <a href="{{url('order')}}">
                                <i class="fas fa-tachometer-alt"></i>Order</a>
                        </li>
                        <li class="@yield('product_review_selected')">
                            <a href="{{url('product_review')}}">
                                <i class="fas fa-tachometer-alt"></i>Product Review</a>
                        </li>
                        <li class="@yield('category_selected')">
                            <a href="{{url('category')}}">
                                <i class="fas fa-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon_selected')">
                            <a href="{{url('coupon')}}">
                                <i class="fas fa-tag"></i>Coupon</a>
                        </li>
                        <li class="@yield('homeBanner_selected')">
                            <a href="{{url('homeBanner')}}">
                                <i class="fas fa-home"></i>Home Banner</a>
                        </li>

                        <li class="@yield('size_selected')">
                            <a href="{{url('size')}}">
                                <i class="fas fa-sitemap"></i>Size</a>
                        </li>
                        <li class="@yield('tax_selected')">
                            <a href="{{url('tax')}}">
                                <i class="fas fa-shopping-basket"></i>Tax</a>
                        </li>
                        <li class="@yield('color_selected')">
                            <a href="{{url('color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand_selected')">
                            <a href="{{url('brand')}}">
                                <i class="fa fa-snowflake-o"></i>Brand</a>
                        </li>
                        <li class="@yield('product_selected')">
                            <a href="{{url('product')}}">
                                <i class="fas fa-shopping-basket"></i>Product</a>
                        </li>
                        <li class="@yield('customer_selected')">
                            <a href="{{url('customer')}}">
                                <i class="fas fa-user"></i>Customer</a>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin_login/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <ul class="navbar-mobile__list list-unstyled">
                            <li class="@yield('dashboard_selected')">
                                <a href="{{url('dashboard')}}">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li class="@yield('order_selected')">
                                <a href="{{url('order')}}">
                                    <i class="fas fa-tachometer-alt"></i>Order</a>
                            </li>
                            <li class="@yield('product_review_selected')">
                                <a href="{{url('product_review')}}">
                                    <i class="fas fa-tachometer-alt"></i>Product Review</a>
                            </li>
                            <li class="@yield('category_selected')">
                                <a href="{{url('category')}}"> <i class="fas fa-list"></i>Category</a>
                            </li>
                            <li class="@yield('coupon_selected')">
                                <a href="{{url('coupon')}}">
                                    <i class="fas fa-tag"></i>Coupon</a>
                            </li>
                            <li class="@yield('homeBanner_selected')">
                                <a href="{{url('homeBanner')}}">
                                    <i class="fas fa-home"></i>Home Banner</a>
                            </li>
                            <li class="@yield('size_selected')">
                                <a href="{{url('size')}}">
                                    <i class="fas fa-sitemap"></i>Size</a>
                            </li>
                            <li class="@yield('color_selected')">
                                <a href="{{url('color')}}">
                                    <i class="fas fa-paint-brush"></i>Color</a>
                            </li>
                            <li class="@yield('tax_selected')">
                                <a href="{{url('tax')}}">
                                    <i class="fas fa-shopping-basket"></i>Tax</a>
                            </li>
                            <li class="@yield('brand_selected')">
                                <a href="{{url('brand')}}">
                                    <i class="fa fa-snowflake-o"></i>Brand</a>
                            </li>
                            <li class="@yield('product_selected')">
                                <a href="{{url('product')}}">
                                    <i class="fas fa-shopping-basket"></i>Product</a>
                            </li>
                            <li class="@yield('customer_selected')">
                                <a href="{{url('customer')}}">
                                    <i class="fas fa-user"></i>Customer</a>
                            </li>
                        </ul>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                {{-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> --}}
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#"><i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__footer">
                                                    <a href="/logout"><i class="zmdi zmdi-power"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                       @yield('content')
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin_login/vendor/jquery-3.2.1.min.js')}}"></script>

    <!-- Bootstrap JS-->
    <script src="{{asset('admin_login/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <!-- Vendor JS       -->
    <script src="{{asset('admin_login/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/counter-up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_login/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin_login/vendor/select2/select2.min.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('admin_login/js/main.js')}}"></script>
</body>
</html>
<!-- end document-->
