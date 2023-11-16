<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>


            <!-- Right navbar links -->

        </nav>


        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('dashboard')}}" class="nav-link @yield('dashboard')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('poi.index')}}" class="nav-link @yield('point_of_interest')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Point of interests</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('transportation.index')}}" class="nav-link @yield('transportation')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transportations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('accomodations.index')}}" class="nav-link @yield('accomodation')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Accomodations</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('account.index')}}" class="nav-link @yield('users')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('account.admin')}}" class="nav-link @yield('admins')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admins</p>
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

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-success mr-3 float-right">Logout</button>
                         
            </form>
            <div class="float-right d-none d-sm-inline mr-5">
                <a href="{{route('user.index')}}" class="btn btn-primary mb-2">View Website</a>
             </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Data Table-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @yield('script')


    <script>
        $(document).ready(function() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            @if(session('create'))
            Toast.fire({
                icon: 'success',
                title: 'Created successfully!'
            })
            @endif
            @if(session('update'))
            Toast.fire({
                icon: 'success',
                title: 'Updated successfully!'
            })
            @endif
            @if(session('delete'))
            Toast.fire({
                icon: 'success',
                title: 'Deleted successfully!'
            })
            @endif
            @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: 'Promoted Successfully'
            })
                
            @endif
        });
      </script>
</body>

</html>
