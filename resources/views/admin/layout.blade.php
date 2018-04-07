<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset_admin('vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset_admin('vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Fontastic Custom icon font-->
        <link rel="stylesheet" href="{{ asset_admin('css/fontastic.css') }}">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <!-- jQuery Circle-->
        <link rel="stylesheet" href="{{ asset_admin('css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
        <!-- Custom Scrollbar-->
        <link rel="stylesheet" href="{{ asset_admin('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset_admin('css/style.default.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset_admin('css/custom.css') }}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset_admin('img/favicon.ico') }}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body>
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <div class="side-navbar-wrapper">
                <!-- Sidebar Header    -->
                <div class="sidenav-header d-flex align-items-center justify-content-center">
                    <!-- User Info-->
                    <div class="sidenav-header-inner text-center">
                        <img src="{{ asset_admin('img/avatar-1.jpg') }}" alt="person" class="img-fluid rounded-circle">
                        <h2 class="h5">Administrator</h2>
                        <span>Web Developer</span>
                    </div>
                    <!-- Small Brand information, appears on minimized sidebar-->
                    <div class="sidenav-header-logo">
                        <a href="#" class="brand-small text-center">
                            <strong>T</strong>
                            <strong class="text-primary">P</strong>
                        </a>
                    </div>
                </div>
                <!-- Sidebar Navigation Menus-->
                <div class="main-menu">
                    <h5 class="sidenav-heading">Main</h5>
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li>
                            <a href="#">
                                <i class="icon-list"></i>Bài viết
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="page">
            <!-- navbar-->
            <header class="header">
                <nav class="navbar">
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between">
                            <div class="navbar-header">
                                <a id="toggle-btn" href="#" class="menu-btn">
                                    <i class="icon-bars"> </i>
                                </a>
                                <a href="#" class="navbar-brand">
                                    <div class="brand-text d-none d-md-inline-block">
                                        <span>Toanphatcorp </span>
                                        <strong class="text-primary">Dashboard</strong>
                                    </div>
                                </a>
                            </div>
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                <li class="nav-item">
                                    <a href="{{ route('admin.logout') }}" class="nav-link logout">
                                        Logout<i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            @yield('content')
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Copyright © 2016 - Toàn Phát - All Right Reserved</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
                            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Javascript files-->
        <script src="{{ asset_admin('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset_admin('vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset_admin('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset_admin('js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
        <script src="{{ asset_admin('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset_admin('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset_admin('js/charts-home.js') }}"></script>
        <!-- Main File-->
        <script src="{{ asset_admin('js/common.js') }}"></script>

        <script>
        // Add token when use ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>

        @yield('footer_script')
    </body>
</html>
