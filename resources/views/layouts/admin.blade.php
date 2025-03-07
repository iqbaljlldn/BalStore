<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" type="text/css" rel="stylesheet" />
    <link href="/style/main.css" type="text/css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.css" rel="stylesheet">
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <a href="{{ route('admin-dashboard') }}">
                        <img src="/images/admin.png" alt="" class="my-4" style="max-height: 100px">
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('product.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/product') ? 'active' : '' }}">Products</a>
                    <a href="{{ route('product-gallery.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/product-gallery*') ? 'active' : '' }}">Galleries</a>
                    <a href="{{ route('category.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">Categories</a>
                    <a href="{{ route('dashboard-products') }}"
                        class="list-group-item list-group-item-action">Transactions</a>
                    <a href="{{ route('user.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">Users</a>
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Sign Out</a>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="/images/icon-user.png" alt=""
                                            class="rounded-circle mr-2 profile-picture">
                                        Hi, Iqbal
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                        <a href="{{ dashboard-settings-account }}" class="dropdown-item">Settings</a>
                                        <div class="dropdown-divider"> </div>
                                        <a href="/" class="dropdown-item">Logout</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                        <img src="/images/icon-cart-filled.svg" alt="">
                                        <div class="card-badge">3</div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Hi, Iqbal
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                                        Cart
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->

    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $('#menu-toggle').click(function(e) {
            e.preventDefault()
            $('#wrapper').toggleClass("toggled")
        })
    </script>
    @stack('addon-script')
</body>

</html>
