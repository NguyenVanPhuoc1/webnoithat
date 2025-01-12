@extends('frontend.layout.master')

@section('title', 'Trang Chủ')

@section('body')
    <div class="slideshow" id="slideshow">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active animate__animated animate__fadeInDown">
                    <img src="{{ asset('front/public/image/slide-25240.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item animate__animated animate__rollIn">
                    <img src="{{ asset('front/public/image/slide-2-37400.jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="wrap-main wrap-home w-clear">
        <div class="wrap-gioithieu">
            <div class="container">
                <div id="gioithieu" class=" justify-content-between align-items-center">
                    <div class="gioithieu_banner">
                        <a href="#">
                            <div class="scale-img">
                                <img class="lazy loaded" alt="Nhóm B Nội Thất"
                                    src="{{ asset('front/public/image/gioithieu-1981.jpg') }}" data-was-processed="true"
                                    loading="lazy">
                            </div>
                        </a>
                    </div>
                    <div class="wrap-gioithieu-info">
                        <div class="gioithieu-info">
                            <p class="gioithieu-lable">Về Chúng Tôi </p>
                            <p class="gioithieu-title">Nội Thất NVP</p>
                            <p class="gioithieu-desc text-split">
                                {{ trans('frontend.home_intro') }}
                            </p>
                            <a href="{{ url('/gioi-thieu') }}" class="text-decoration-none btn-gioithieu d-inline-block">XEM
                                CHI TIẾT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box_product_list_tab">
            <div class="container">
                <div class="title-main">
                    <span>SẢN PHẨM</span>
                </div>
                <p class="dichvu-slogan text-center text-white-50">Chất lượng đi đôi với giá cả</p>
                <div class="list_monnb list_sanpham">
                    @foreach ($category as $item)
                        <!-- {{ $loop->first ? 'active' : '' }} -->
                        <a class="d-block " role="button" data-id="{{ $item->id }}"
                            onclick="getProducts('{{ $item->id }}')"
                            id="category-{{ $item->id }}">{{ $item->cate_name }}</a>
                    @endforeach
                    <!-- <a class="d-block active" role="button" data-id="0">NỘI THẤT PHÒNG KHÁCH</a> -->
                </div>
                <div class="page_sanpham">
                    <div class="container ">
                        <div class="row show_product">

                        </div>
                    </div>
                    <div class="clearfix"> </div>

                </div>
            </div>
        </div>
        <div class="wrap-chinhsach">
            <div class="container">
                <div id="policy">
                    <div class="title-main">
                        <span>POLICY</span>
                    </div>
                    <div class="policy-list ">
                        @foreach ($listPoli as $item)
                            <!-- policy -->
                            <div class="item-policy slick-slider">
                                <a href="#" class="hover_sang2 scale-img">
                                    <img src="{{ asset($item->poli_image) }}" alt="{{ $item->poli_name }}">
                                </a>
                                <div class="name_policy"><a class="catchuoi1" href="#">{{ $item->poli_name }}</a>
                                </div>
                            </div>
                            <!-- policy -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="box_newsletter_news">
            <div class="container">
                <div class="row">
                    <div class="flex_newsletter_news ">
                        <div class="left_newsletter col-12 col-lg-12 mb-3">
                            <div class="title_newsletter">Sign up to get information</div>
                            <div class="slogan_newsletter">Please leave your support request</div>
                            <form action="{{ route('regis-customer') }}" id="form-newsletter" method="post"
                                class="validation-newsletter kiemtra-form" enctype="multipart/form-data">
                                @csrf
                                <div class="newsletter-input">
                                    <div class="form-group">
                                        <label for="fullname" class="col-form-label">Name</label>
                                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" >
                                        @error('fullname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="newsletter-input">
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" >
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="newsletter-input">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" >
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="newsletter-input">
                                    <div class=" form-group">
                                        <label for="content" class="col-form-label">Content</label>
                                        <textarea class="form-control" name="content" id="content" crequired></textarea>
                                    </div>
                                </div>
                                <div class="newsletter-button">
                                    <button type="submit" class="btn btn-sm btn-danger guimail" data-loai="newsletter" >Gửi Yêu Cầu </button>
                                </div>
                            </form>
                        </div>
                        <div class="right_newsletter col-12 col-lg-12">
                            <div class="title_news">
                                <span>News</span>
                            </div>
                            <div class="news_list">
                                @foreach ($listNews as $item)
                                    <!-- item news -->
                                    <div class="item_news d-flex slick-slider">
                                        <a href="{{ route('news_detail',['slug'=>$item->slug]) }}" class="hover_sang2 d-block col-4 position-relative overflow-hidden" style="height: 145px;">
                                            <img src="{{ asset($item->news_image) }}" alt="{{ $item->news_name }}" 
                                                class="img-fluid w-100 h-100" style="object-fit: cover;">
                                        </a>
                                        <div class="content_news_index col-8">
                                            <div class="name_news_index">
                                                <p class="text-split">{{ $item->news_name }}</p>
                                            </div>
                                            <div class="desc_news_index">
                                                <div class="text-split">{!! htmlspecialchars_decode($item->news_desc, ENT_QUOTES) !!} </div>
                                            </div>
                                            <div class="btn_more_index">
                                                <a href="{{ route('news_detail',['slug'=>$item->slug]) }}" class="text-decoration-none tintuc-xemthem">XEM THÊM</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- item news -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('ggmap')
    <!-- Footer map -->
    <div class="footer-map" id="footer-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3918.4749787803385!2d106.7580641!3d10.8514325!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752797e321f8e9%3A0xb3ff69197b10ec4f!2zVHLGsOG7nW5nIGNhbyDEkeG6s25nIEPDtG5nIG5naOG7hyBUaOG7pyDEkOG7qWM!5e0!3m2!1svi!2s!4v1691219936543!5m2!1svi!2s"
            width="600" height="450" style="border:0;width: 100vw;  " allowfullscreen="true" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endsection

@section('script')
    <script>
        const pathname = document.title;

        // Kiểm tra đường dẫn có chứa "gioi-thieu" hay không
        if (pathname.includes("Trang Chủ")) {
            // Xóa class body
            document.querySelector("body").classList.add("body");
        }

        // Xử lý khi click vào một thẻ <a>
        $(document).ready(function() {
            // Thêm class 'active' cho thẻ <a> đầu tiên khi trang load
            getProducts($('.list_sanpham a:first-child').data('id'));
            $('.list_sanpham a:first-child').addClass('active');
        });
        $('.list_sanpham a').on('click', function() {
            // Lấy data-id của thẻ <a> được click
            var categoryId = $(this).data('id');

            // Gọi hàm để lấy sản phẩm theo categoryId (sử dụng hàm getProducts đã được định nghĩa trước đó)
            getProducts(categoryId);

            // Hủy active cho tất cả các thẻ <a>
            $('.list_sanpham a').removeClass('active');

            // Active cho thẻ <a> được click
            $(this).addClass('active');
        });

        function getProducts(categoryId) {
            $.ajax({
                url: '/get-products/' + categoryId,
                type: 'GET',
                success: function(response) {
                    // Xử lý dữ liệu nhận được từ Laravel
                    // Lấy phần tử container
                    var productContainer = $('.show_product');
                    // console.log(response.products.data);
                    // Xóa nội dung hiện tại trong container (nếu cần)
                    productContainer.empty();
                    // Thêm HTML của sản phẩm vào container
                    $.each(response.products.data, function(index, product) {
                        if (product.slug) {
                            var imagePath =  product.product_image; // Lấy đường dẫn ảnh đầu tiên
                            var productUrl = "{{ route('product_detail', ['slug' => ':productSlug']) }}";
                            productUrl = productUrl.replace(':productSlug', product.slug);
                            var productHtml = `
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="item_product">
                                        <div class="container_product">
                                            <div class="img_product">
                                                <a class="scale-img" href="${productUrl}" title="${product.product_name}">
                                                    <img src="${imagePath}" alt="${product.product_name}">
                                                </a>
                                            </div>
                                            <div class="content_product"> 
                                                <h3 class="name_product">
                                                    <a class="catchuoi2" href="${productUrl}">${product.product_name}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            // Xử lý trường hợp không có ảnh
                            var productHtml = `
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="item_product">
                                        <div class="container_product">
                                            <div class="content_product"> 
                                                <h3 class="name_product">
                                                    <a class="catchuoi2" href="#">${product.name}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                                            // Thêm sản phẩm vào container
                        productContainer.append(productHtml);

                        // Hiển thị hoặc ẩn nút "Xem thêm" dựa trên số lượng sản phẩm
                    });
                    if (response.products.length > 8) {
                        var seeMoreHtml = `
                            <div class="seemore text-center">
                                <a href="{{url('/san-pham')}}" class="btn btn-secondary">Xem Thêm</a>
                            </div>
                        `;
                        productContainer.after(seeMoreHtml);
                    }
                },
                error: function(error) {
                    console.log("Lỗi không lấy được sản phẩm theo danh mục");
                }
            });
        }
    </script>
@endsection
