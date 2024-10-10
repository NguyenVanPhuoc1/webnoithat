<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="www.frebsite.nl" />
    <meta name="viewport" content="width=device-width minimum-scale=1.0 maximum-scale=1.0 user-scalable=no" />
    <title>Nhóm 12 | @yield('title') </title>
    <link rel="icon" href="{{ asset('front/public/image/' . $logo->file_name) }}" type="image/x-icon">
    {{-- <link rel="shortcut icon" href="./Public/image/logo-3016.png" type="image/x-icon"> --}}

    <!-- Add the Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/gioithieu.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/styles.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/mmenu.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/sanpham.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Liên kết đến tệp CSS của Slick Carousel qua CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('front/public/css/HoldOn.min.css')}}" rel="stylesheet">
    <script src="{{ asset('front/public/js/HoldOn.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('front/public/css/magiczoomplus.css')}}">
    <script src="{{ asset('front/public/js/magiczoomplus.js')}}"></script>
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HKZMS27N37"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-HKZMS27N37');
    </script>

    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Các thẻ meta chung -->
    @yield('meta')

    <style>
    /* Hiển thị dropdown menu khi di chuột qua */
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .modal-backdrop {
            z-index: 1040 !important;
        }
        .modal {
            z-index: 1050 !important;
        }
    </style>
</head>

<body>
    <!-- menu -->
    <nav class="menu" id="menu">
        <ul>
            <li><a href="{{ url('/') }}">{{trans('frontend.Home')}}</a></li>
            <li><a href="{{ url('/gioi-thieu') }}">{{trans('frontend.gioithieu')}}</a></li>
            <>
                <a href="{{ url('/san-pham') }}">{{trans('frontend.sanpham')}}</a>
            </li>
            <li><a href="{{ url('/chinh-sach') }}">{{trans('frontend.chinhsach')}}</a></li>
            <li><a href="{{ url('/tin-tuc') }}">{{trans('frontend.tintuc')}}</a></li>
            <li><a href="{{ url('/lien-he') }}">{{trans('frontend.lienhe')}}</a></li>
            <!-- đăng nhập - đăng xuất -->
            <li>
                <span><i class="text-warning fa-regular fa-user fa-1x me-2"></i>{{trans('frontend.account')}}</span>
                <ul>
                    <!-- đăng nhập - đăng xuất -->
                    @if(session()->has('id_admin')  && session('id_admin')-> role != 1)
                        <!-- Hiện Name -->
                        <li >
                            <a class="text-center" href="#">
                                Xin Chào: 
                                <br>
                                <b>{{session('id_admin')->name}}</b>
                            </a>
                        </li>
                        <!-- Sửa mật Khẩu -->
                        <li><a class="lichsugiaodich" href="{{route('order.index')}}">{{trans('frontend.lichsugiaodich')}}</a></li>
                        <!-- Sản phẩm yêu thích -->
                        <li><a class=" wishlist" href="#">{{trans('frontend.wishlist')}}</a></li>
                        <!-- đăng xuât -->
                        <li><a class="signout" href="{{route('signout')}}">{{trans('frontend.signout')}}</a></li>
                    @else
                    <li><a class="login" href="{{route('login')}}">{{trans('frontend.signin')}}</a></li>                        
                    @endif
                </ul>
            </li>
        </ul>
    </nav>
    <!--Content -->
    <div class="page">
        <div class="wrap-header-menu-logo ">
            <div class="wrap-content d-flex align-items-center">
                <div class="wrap-logo">
                    <a class="logo-header" href="{{ url('/') }}">
                        <img class="lazy loaded" src="{{ asset('front/public/image/' . $logo->file_name) }}"
                            data-was-processed="true" style="width: 120px; height: 120px;">
                    </a>
                </div>
                <div class="wrap-header-menu">
                    <div class="header d-flex justify-content-between align-items-center"
                        style="border-bottom: 1px solid white;">
                        <div class="hotline_account d-flex">
                            <!-- hotline -->
                            <p class="info-header mx-3">Hotline: <span>0123 456 789</span></p>
                            <!-- Account -->
                            <div class="dropdown account_user  mx-3">
                                <!-- Button trigger dropdown -->
                                @if(session()->has('id_admin') )
                                <a class="btn text-white dropdown-toggle" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i> {{session('id_admin')->name}}
                                </a>
                                @else
                                <a class="btn text-white dropdown-toggle" href="#" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i> {{trans('frontend.account')}}
                                </a>
                                @endif
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- đăng nhập - đăng xuất -->
                                    @if(session()->has('id_admin')  && session('id_admin')-> role != 1)
                                        <!-- Sửa mật Khẩu -->
                                        <a class="dropdown-item lichsugiaodich" href="{{route('order.index')}}">{{trans('frontend.lichsugiaodich')}}</a>
                                        <!-- Sản phẩm yêu thích -->
                                        <a class="dropdown-item wishlist" href="#">{{trans('frontend.wishlist')}}</a>
                                        <!-- đăng xuât -->
                                        <a class="dropdown-item signout" href="{{route('signout')}}">{{trans('frontend.signout')}}</a>
                                    @else
                                        <a class="dropdown-item login" href="{{route('login')}}">{{trans('frontend.signin')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- sp yêu thích -->

                        <!-- tìm kiếm -->
                        <div class="box-info__header d-flex align-items-center">
                            <div class="search ">
                                <form action="{{ route('search') }}" method="GET" id="searchForm1">
                                    @csrf
                                    <input type="text" name="searchProduct" id="keyword1" placeholder="Tìm Kiếm"
                                        required>
                                    <p id="searchIcon" onclick="performSearch('searchForm1', 'keyword1')">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </p>
                                    <span id="searchError1" class="d-none alert alert-danger"
                                        style="position:absolute;"></span>
                                    @if ($errors->has('searchProduct'))
                                        <span id="searchError" class="d-block alert alert-danger"
                                            style="position:absolute;">{{ $errors->first('searchProduct') }}</span>
                                    @endif
                                </form>
                            </div>
                            <div class="lang-header d-flex">
                                <a href="{{ LaravelLocalization::getLocalizedURL('vi') }}" class="transition">
                                    <img src="{{ asset('front/public/image/ic-vi.png') }}" alt="vi">
                                </a>
                                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="transition">
                                    <img src="{{ asset('front/public/image/ic-en.png') }}" alt="en">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="fixed menu">
                        <div class="wrap-content ">
                            <ul class="d-flex align-items-center justify-content-between">
                                <li><a class="{{ request()->is('/') ? 'active' : '' }} transition"
                                        href="{{ url('/') }}" title="Trang chủ">{{trans('frontend.Home')}}</a></li>
                                <li class="line"></li>
                                <li><a class="{{ request()->is('gioi-thieu') ? 'active' : '' }} transition"
                                        href="{{ url('/gioi-thieu') }}" title="Giới thiệu">{{trans('frontend.gioithieu')}}</a></li>
                                <li class="line"></li>
                                <li><a class="{{ request()->is('chinh-sach*') ? 'active' : '' }} transition"
                                        href="{{ url('/chinh-sach') }}" title="Chính Sách">{{trans('frontend.chinhsach')}}</a></li>
                                <!-- <li class="line"></li> -->
                                <!-- <li><a class="transition" href="#" title="Dự án">Dự án</a></li> -->
                                <li class="line"></li>
                                <li>
                                    <a class="{{ request()->is('san-pham*') ? 'active' : '' }} transition"
                                        href="{{ url('/san-pham') }}" title="Sản phẩm">{{trans('frontend.sanpham')}}</a>
                                </li>
                                <li class="line"></li>
                                <li><a class="{{ request()->is('tin-tuc*') ? 'active' : '' }} transition"
                                        href="{{ url('/tin-tuc') }}" title="Tin tức">{{trans('frontend.tintuc')}}</a></li>
                                <li class="line"></li>
                                <li><a class="{{ request()->is('lien-he') ? 'active' : '' }} transition"
                                        href="{{ url('/lien-he') }}" title="Liên hệ">{{trans('frontend.lienhe')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu-respo -->
        <div class="menu-res">
            <div class="menu-bar-res">
                <a id="hamburger" href="#menu" title="Menu"><span></span></a>
                <div class="box-flex flex-center align-items-center">
                    <div class="search">
                        <form action="{{ route('search') }}" method="GET" id="searchForm2">
                            @csrf
                            <input type="text" name="searchProduct" id="keyword2" placeholder="Tìm Kiếm"
                                required>
                            <p id="searchIcon" onclick="performSearch('searchForm2', 'keyword2')">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </p>
                        </form>
                    </div>
                    <div class="lang-header">
                        <a class="transition" href="{{ LaravelLocalization::getLocalizedURL('vi') }}"><img src="{{ asset('front/public/image/ic-vi.png') }}"
                                alt="vi"></a>
                        <a class="transition" href="{{ LaravelLocalization::getLocalizedURL('en') }}"><img src="{{ asset('front/public/image/ic-en.png') }}"
                                alt="en"></a>
                    </div>
                    @if(session()->has('id_admin')  && session('id_admin')-> role != 1)
                    <!-- <div class="account-user">
                        <a class="user-respo transition" href="{{ url('/gio-hang') }}" title="Tài Khoản"><i class="text-light fa-regular fa-user fa-2x mx-2"></i></a>
                    </div> -->
                    <div class="shopping-cart">
                        <a class="cart-respo transition" href="{{ url('/gio-hang') }}" title="Giỏ hàng"><i class="text-light fa-solid fa-bag-shopping fa-2x mx-2"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- menu-respo -->

        <!-- difference here -->
        @yield('body')
        <!-- difference here -->

        <!-- Footer -->
        <footer class="text-center text-lg-start text-white" style="background-color: black">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Nhóm 12
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer
                            content. Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.
                        </p>
                    </div>
                    <!-- Grid column -->
        
                    <hr class="w-100 clearfix d-md-none" />
        
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Tin Tức</h6>
                        @foreach ($listNews as $item)
                        <p>
                            <a class="text-white" href="{{ route('news_detail', ['id' => $item->id]) }}">{{ $item->news_name
                                }}</a>
                        </p>
                        @endforeach
                    </div>
                    <!-- Grid column -->
        
                    <hr class="w-100 clearfix d-md-none" />
        
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Chính Sách
                        </h6>
                        @foreach ($listPoli as $item)
                        <p>
                            <a class="text-white" href="{{route('policy_detail',['id' => $item->id])}}">{{ $item->poli_name
                                }}</a>
                        </p>
                        @endforeach
                    </div>
        
                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none" />
        
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                        <p><i class="fas fa-home mr-3"></i> 53 Võ Văn Ngân, Linh Chiểu, Thành Phố Thủ Đức,VN</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i> 0123 456 789</p>
                        <p><i class="fas fa-print mr-3"></i> 0123 456 789</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!--Grid row-->
                <hr class="my-3">
        
                <div class="text-center justify-content-between ">
                    <div class="footer-copyright text-warning">© Copyright © 2024 . All rights reserved. Design by Nhom 12
                        TDC</div>
                </div>
            </div>
            <!-- Grid container -->
        
        </footer>
        <!-- Footer -->
        <!-- difference here -->
        @yield('ggmap')
        <!-- difference here -->


        <!-- Tool bar -->
        <div class="toolbar">
            <ul>
                <li>
                    <a id="goidien" href="tel:0707958117" title="title">
                        <img src="{{ asset('front/public/image/phone.svg') }}" alt="images"><br>
                    </a>
                </li>
                <li>
                    <a target="_blank" href="https://zalo.me/0707958117" title="zalo">
                        <img src="{{ asset('front/public/image/zl.png') }}" alt="images"><br>
                    </a>
                </li>
                <li>
                    <a id="chatfb" href="#" title="title">
                        <i class="fab fa-facebook-messenger "></i>
                    </a>
                </li>
                <li>
                    <a id="chatfb" href="" title="title">
                        <i class="fas fa-map-marked-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
                <!-- btn-message -->
        <!-- scroll to top -->
        <div class="scrollToTop ">
            <img src="{{ asset('front/public/image/top.png') }}" alt="Go Top">
        </div>
        <div class="messege-facebook" id="messege-facebook">
            <!-- Chat messege -->
            <div class="messeges"></div>
            <!-- zalo -->
            <a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/0707958117">
                <div class="animate__animated animate__infinite animate__zoomIn kenit-alo-circle"></div>
                <div class="animate__animated animate__infinite animate__pulse kenit-alo-circle-fill"></div>
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px">
                        <path fill="#2962ff"
                            d="M15,36V6.827l-1.211-0.811C8.64,8.083,5,13.112,5,19v10c0,7.732,6.268,14,14,14h10	c4.722,0,8.883-2.348,11.417-5.931V36H15z" />
                        <path fill="#eee"
                            d="M29,5H19c-1.845,0-3.601,0.366-5.214,1.014C10.453,9.25,8,14.528,8,19	c0,6.771,0.936,10.735,3.712,14.607c0.216,0.301,0.357,0.653,0.376,1.022c0.043,0.835-0.129,2.365-1.634,3.742	c-0.162,0.148-0.059,0.419,0.16,0.428c0.942,0.041,2.843-0.014,4.797-0.877c0.557-0.246,1.191-0.203,1.729,0.083	C20.453,39.764,24.333,40,28,40c4.676,0,9.339-1.04,12.417-2.916C42.038,34.799,43,32.014,43,29V19C43,11.268,36.732,5,29,5z" />
                        <path fill="#2962ff"
                            d="M36.75,27C34.683,27,33,25.317,33,23.25s1.683-3.75,3.75-3.75s3.75,1.683,3.75,3.75	S38.817,27,36.75,27z M36.75,21c-1.24,0-2.25,1.01-2.25,2.25s1.01,2.25,2.25,2.25S39,24.49,39,23.25S37.99,21,36.75,21z" />
                        <path fill="#2962ff" d="M31.5,27h-1c-0.276,0-0.5-0.224-0.5-0.5V18h1.5V27z" />
                        <path fill="#2962ff"
                            d="M27,19.75v0.519c-0.629-0.476-1.403-0.769-2.25-0.769c-2.067,0-3.75,1.683-3.75,3.75	S22.683,27,24.75,27c0.847,0,1.621-0.293,2.25-0.769V26.5c0,0.276,0.224,0.5,0.5,0.5h1v-7.25H27z M24.75,25.5	c-1.24,0-2.25-1.01-2.25-2.25S23.51,21,24.75,21S27,22.01,27,23.25S25.99,25.5,24.75,25.5z" />
                        <path fill="#2962ff"
                            d="M21.25,18h-8v1.5h5.321L13,26h0.026c-0.163,0.211-0.276,0.463-0.276,0.75V27h7.5	c0.276,0,0.5-0.224,0.5-0.5v-1h-5.321L21,19h-0.026c0.163-0.211,0.276-0.463,0.276-0.75V18z" />
                    </svg>
                </i>
            </a>
        </div>
        <!-- cart -->
        <div class="cart cart-desktop text-center">
            <a class="cart-fixed text-decoration-none text-white"
                href="{{ url('/gio-hang') }}" title="Giỏ hàng">
                <i class="fa-solid fa-cart-shopping mx-2 "></i>
                    <span class="count-cart text-white">{{ $cartCount }}</span>
                        <!-- Cart -->
            </a>
        </div>
    </div>
            <!-- mmenu scripts -->
            <div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1609405829857841&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


    <script src="{{ asset('front/public/js/mmenu.js') }}"></script>
    <!-- Liên kết đến tệp JavaScript của Slick Carousel qua CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Liên kết đến tệp -->
    <script src="{{ asset('front/public/js/index.js') }}"></script>
    <script src="{{ asset('front/public/js/gioithieu.js') }}"></script>
    <script src="{{ asset('front/public/js/cart.js') }}"></script>

    @yield('script')
</body>

</html>
