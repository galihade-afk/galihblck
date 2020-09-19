<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://http://code.ionicframework.com/1.3.3/css/ionic.min.css"> -->
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/sweetalert2/sweetalert2.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet')}}">
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/admin')}}" class="nav-link">Home</a>
                </li>
            </ul>         
            <!-- Right navbar links -->
    
            <ul class="navbar-nav ml-auto text-capitalize">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                      <i class="far fa-bell"></i>
                      <span class="badge badge-warning navbar-badge valuenotif"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <span class="dropdown-item dropdown-header notification">No Notifications</span>
                      <div class="dropdown-divider"></div>
                      <div class="notif"></div>
                    </div>
                  </li>
                <li class="nav-item dropdown open" style="padding-left: 10px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('storage/user/'.auth()->user()->img)}}" class="img-circle" width="30px">&nbsp {{auth()->user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#ModalEdit">
                            Profile
                        </button>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }} &nbsp<i class="fas fa-sign-out-alt"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>                
            </ul>
            <div style="padding-left: 20px;"></div>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('storage/user/'.auth()->user()->img)}}" class="img-circle elevation-3">
                    </div>
                    <div class="info">
                        <a href="{{url('/admin')}}" class="d-block text-capitalize">{{auth()->user()->name}}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">    
                            <a href="{{url('/admin')}}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('profile')}}" class="nav-link {{ (request()->is('profile')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('todo')}}" class="nav-link {{ (request()->is('admin/todo')) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-code"></i>
                                <p>ToDo List</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">            
            <!-- Main content -->

            @yield('content')
            
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.2
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="{{asset('assets/admin/plugins/sweetalert2/sweetalert2.all.js')}}"></script>

@yield('script')

<script>
function checkNotif()
{
    // var currentDate         = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    currentDate             = new Date();
    // currentDate             = split(currentDate);
    
    var day                 = new Date().getDate();
    var month               = new Date().getMonth()+1;
    var year                = new Date().getFullYear();
    var totalDay            = new Date(year, month, 0).getDate();
    var tomorrow            = year+"-"+month+"-"+day;
    var code               = '{{ csrf_token() }}';
    var user_id             = {{auth()->user()->id}};

    $.post('{{route("reminder.alert")}}', {currentDate:currentDate, day:day, month:month,year:year , totalDay:totalDay, _token:code, id:user_id }, 
    function(reminder)
    {
        $('.notification').html(reminder.length+' Notification');
        $('.valuenotif').html(reminder.length);
        $('.notif').html('');
        $.each(reminder, function(ind,val)
        {
            $('.notif').append('<a href="{{route('todo')}}" class="dropdown-item ">Reminder '+val.title+' on '+val.date+'</a>');
        })
    }
    )


}

checkNotif();

</script>

</body>

</html>