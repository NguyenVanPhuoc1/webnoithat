<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('front/public/image/' . $logo->file_name) }}" type="image/x-icon">
    <title> Admin | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css')}}"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="../admin/plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css')}}"> -->
    <!-- char js -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- ckeditor.js: Thư viện soạn thảo văn bản --> 
    <script src="{{ asset('admin/dist/js/ckeditor.js')}}"></script>
    <script src="https://apis.google.com/js/client.js"></script>

    <!-- thêm album ảnh -->
    <!-- Styles -->
	<link href="{{ asset('admin/dist/css/filterjs/jquery-filer.css')}}" rel="stylesheet" >
	<link href="{{ asset('admin/dist/css/filterjs/jquery.filer-dragdropbox-theme.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/filterjs/jquery.filer.css')}}">

    <style>
        .pagination {
            float: right;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        .store-pagination {
            display: flex;

        }

        .store-filter {
            display: flex;
            justify-content: space-between;
        }

        .store-pagination li {
            padding-left: 10px;
            padding-right: 10px;
            list-style-type: none;
        }

        .add-product-form .card-body {
            background: url(/front/img/product_banner.jpg);
            background-attachment: fixed;
            background-repeat: no-repeat;
            /* background-size: cover; */
            background-position: center;
        }

        .photoUpload-zone .photoUpload-file {
            cursor: pointer;
            background-color: #F5F5F5;
            outline: 2px dashed #CDCDCD;
            outline-offset: 0px;
            padding: 2rem 0.75rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            font-weight: normal!important;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            -webkit-transition: outline-offset .15s ease-in-out,background-color .15s linear;
            transition: outline-offset .15s ease-in-out,background-color .15s linear;
        }
        .photoUpload-zone .photoUpload-file input {
            display: none;
        }
        .photoUpload-zone .photoUpload-file i {
            color: #6C7D8F;
            font-size: 55px;
            margin-bottom: 0.75rem;
        }
        .scale {
            transform: scale(0.8); /* Scale lên 5% */
        }
        .rounded{
            width: 265px;
            height: 265px;
        }
        .jFiler {
            font-size: 14px;
            color: #494949;
        }
        .jFiler-input-dragDrop {
            width: 100%;
            display: block;
            /* width: 343px; */
            margin: 0 auto 25px;
            padding: 25px;
            color: #97A1A8;
            background: #F9FBFE;
            border: 2px dashed #C8CBCE;
            text-align: center;
            -webkit-transition: box-shadow 0.3s,border-color .3s;
            -moz-transition: box-shadow 0.3s,border-color .3s;
            transition: box-shadow 0.3s,border-color .3s;
        }
        .jFiler-input-dragDrop .jFiler-input-icon {
            font-size: 48px;
            margin-top: -10px;
            -webkit-transition: all .3s ease;
            -moz-transition: all .3s ease;
            transition: all .3s ease;
        }
        .jFiler-input-choose-btn.blue {
            color: #48A0DC;
            border: 1px solid #48A0DC;
            margin: 15px;
            padding: 10px;
            border-radius: 10px;
        }
        .ck-file-dialog-button {
            display: none;
        }
    </style>

    @yield('style')
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('admin/trang-chu')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('signout')}}" class="nav-link">Đăng xuất</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Reply Main Layout -->
            <li class="nav-item">
                <a href="{{url('/')}}" target="_blank" class="nav-link">
                    <i class="fas fa-reply"></i>
                    Trang chủ
                </a>
            </li>
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fas fa-cogs"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Thông tin admin -->
                        <div class="media">
                            <i class="fas fa-user-cog mr-3"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Thông tin admin
                                </h3>
                                
                            </div>
                        </div>
                        <!-- Thông tin admin -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{url('/admin/changepassword')}}" class="dropdown-item">
                        <!-- Đổi mật khẩu -->
                        <div class="media">
                            <i class="fas fa-key mr-3"></i>
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Đổi mật khẩu
                                </h3>
                            </div>
                        </div>
                        <!-- Đổi mật khẩu -->
                    </a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge" id="admin-notification">{{$totalCus}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{url('admin/quanlinhantin')}}" class="dropdown-item" >
                        <i class="fas fa-envelope mr-2"></i> {{$totalCus}} Liên Hệ
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 text-center">
                <div class="image">
                    <img class="lazy loaded"  data-src="{{ asset('front/public/image/' . $logo->file_name) }}" alt="Nhóm 12"
                    src="{{ asset('front/public/image/' . $logo->file_name) }}" data-was-processed="true" style="width: 80px; height: 80px;">
                </div>
            </div>
        
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                    <li class="nav-item ">
                        <a href="{{url('admin/trang-chu')}}" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Bảng Điều Khiển
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Quản lí sản phẩm
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ request()->is('admin/quanlisanpham*') ? 'd-block' : '' }}">
                            <li class="nav-item">
                                <a href="{{url('admin/quanlidanhmuc')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh mục cấp 1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/quanlisanpham')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sản Phẩm</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">

                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Quản lí bài viết
                                <i class="right fas fa-angle-left right"></i>
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ request()->is('admin/quanlibaiviet*') ? 'd-block' : '' }}">
                            <li class="nav-item">
                                <a href="{{url('admin/quanlibaiviet/tintuc')}}" class="nav-link {{ request()->is('admin/quanlibaiviet/tintuc*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tin Tức</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/quanlibaiviet/chinhsach')}}" class="nav-link {{ request()->is('admin/quanlichinhsach/chinhsach*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Chính Sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('admin/quanlinhantin')}}" class="nav-link {{ request()->is('admin/quanlinhantin*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Quản lí nhận tin
                                <!-- <i class="fas fa-angle-left right" ></i> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Quản lí trang tĩnh
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ request()->is('admin/quanlitrangtinh*') ? 'd-block' : '' }}">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Giới Thiệu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Footer</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Quản lí hình ảnh Video
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview {{ request()->is('admin/quanlihinhanh*') ? 'd-block' : '' }}">
                            <li class="nav-item">
                                <a href="/admin/logo" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Logo</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/favicon" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Favicon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Slideshow</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ request()->is('admin/quanlithongtin') ? 'active' : '' }}">
                        <i class="fas fa-cogs"></i>
                            <p>
                                Quản lí thông tin
                                <!-- <i class="fas fa-angle-left right" ></i> -->
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!--  -->

    <!-- difference here -->
    @yield('body')
    <!-- difference here -->

    <!-- jQuery -->
<!-- <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script> -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- <script src="{{ asset('resources/js/bootstrap.js') }}"></script>
<script>
// Trong resources/js/admin.js hoặc tương tự
window.Echo.channel('admin-notification-channel')
    .listen('AdminNotification', (event) => {
        // Hiển thị thông báo trong địa điểm đã định
        // document.getElementById('admin-notification').innerHTML = event.message;
        document.getElementById('admin-notification').text = "10";
    });
</script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Sparkline -->
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../admin/dist/js/pages/dashboard.js"></script> -->
<script src="{{ asset('admin/dist/js/filterjs/jquery.filer.min.js')}}" type="text/javascript"></script>
<!-- <script src="{{ asset('admin/dist/js/filterjs/custom.js')}}" type="text/javascript"></script> -->

<script src="{{ asset('js/app.js') }}"></script>
<!-- difference here -->
@yield('javascript')
<!-- difference here -->
</body>
</html>
