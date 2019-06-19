<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ID Creator</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/app.css">
    <!-- <link rel="stylesheet" href="css/print.css" media="print"> -->
</head>

<body id="bodysidebar" class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard" class="nav-link">Dashboard</a>
                </li> -->
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link">
                <img src="img/png/logo1.png" alt="PMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light text-center">ID Creator</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <!-- <div class="user-panel mt-3 mb-3 pb-3 d-flex">
                    <div class="image">
                        
                    </div>
                    <div class="info p-0 ml-3">
                        <a href="/profile" class="d-block">ID Creator</a>
                        
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link to="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>
                        <!-- <li class="nav-item">
                            <router-link to="/createId" class="nav-link">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>
                                    Create ID
                                </p>
                            </router-link>
                        </li> -->
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-4">

            <!-- Main content -->
            <div class="content mt-5">
                <div class="container-fluid">
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.0-alpha
            </div>
            <strong>Copyright &copy; 2019 <a href="https://www.pierreandpaulsolinc.com">Pierre And Paul Solutions Inc.</a>.</strong> All rights
            reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <script src="js/app.js"></script>
</body>

</html>