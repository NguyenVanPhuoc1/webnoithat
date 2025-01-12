@extends('frontend.layout.master')

@section('title', 'Chi Tiết Sản Phẩm')

@section('style')
    <style>
        .carousel {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
        }

        .carousel-images {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-images img {
            width: 33%;
            height: auto;
            object-fit: cover;
            margin-right: 10px;
        }

        .prev-btn,
        .next-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 30%;
            border: none;
            cursor: pointer;
        }

        .prev-btn {
            left: 10px;
        }

        .next-btn {
            right: 10px;
        }
        figure img{
            min-width: 500px!important;
            min-height: 500px!important;
            object-fit: cover;
        }

        /* Set width and height for the thumbnail images */
        .thumb-image {
            width: 106px; /* Thumbnail width */
            height: 106px; /* Thumbnail height */
            object-fit: cover; /* Adjust fit, or use 'contain' if needed */
        }
    </style>
@endsection

@section('meta')
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="SHOPNOITHAT" />
    <meta property="og:title" content="{{ $languageCode == 'vi' ? $product->translate['vi']['name'] : $product->translate['en']['name']}}" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="{{$url}}" />
    <meta property="og:image" content="{{asset($product->images[0] )}}" />
    <meta property="og:image:alt" content="{{ $languageCode == 'vi' ? $product->translate['vi']['name'] : $product->translate['en']['name']}}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
@endsection

@section('body')
    <!-- Body -->
    <div class="breadCrumbs">
        <div class="wrap-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ url('/') }}">
                        <span>{{trans('frontend.Home')}}</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ url('/san-pham') }}">
                        <span>{{ trans('frontend.sanpham') }}</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" href="{{ route('product_detail', ['slug' => $product->slug]) }}">
                        <span>{{ $languageCode == 'vi' ? $product->translate['vi']['name'] : $product->translate['en']['name'] }}</span>
                    </a>
                </li>
            </ol>
        </div>
    </div>

    <main style="background-color: white">
        <div class="wrap-info wrap-content pt-5 pb-5">
            <div class="wrap-pro-detail">
                <div class="box-flex align-items-start">
                    <div class="row">
                        <div class="col-12 left-pro-detail col-lg-5 ">
                            <div class="pro-zoom col ">
                                <a href="{{ asset($product->images[0])}}" class="MagicZoom" id="sanpham" data-options="zoomMode: on; hint: on; rightClick: true; zoom-width:400px; zoom-height:400px;
                                    selectorTrigger: hover; expandCaption: false; history: false;">
                                    <img id="mainImage" src="{{ asset($product->images[0])}}" alt="Ảnh Sản Phẩm"  >
                                </a>
                            </div>
                            <div class="gallery-thumb-pro col">
                                <div class="owl-thumb-pro slick-slider">
                                    @foreach($product->images as $item)
                                    <a class="thumb-pro-detail slick-slide" data-zoom-id="sanpham" 
                                        href="{{ asset($item )}}" data-image="{{ asset($item )}}">
                                        <img src="{{ asset($item)}}" style="width: 106px; height: 106px" >
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="right-pro-detail col-lg-7 col-12">
                            <p class="title-pro-detail">{{$languageCode == 'vi' ? $product->translate['vi']['name'] : $product->translate['en']['name']}}</p>
                            <ul class="attr-pro-detail p-3">
                                <li>
                                    <div class="attr-content-pro-detail name_product_detail">
                                        <div class="d-flex align-items-center">
                                            <h5 class="m-0 pe-3"> <strong>Liên Hệ:</strong></h5>
                                            <p class="text-danger fw-bold m-0 ">0707958117</p> 
                                        </div>
                                        <div class="d-flex align-items-center my-2">
                                            <h5 class="m-0 pe-3"> <strong>Loại sản phẩm:</strong></h5>
                                            <p class="text-danger fw-bold m-0 ">{{ $product->category['cate_name'] }}</p> 
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="desc-pro-detail">
                                        <h3>Mô tả:</h3>
                                        @if($product->translate['vi']['description'] != "" || $product->translate['en']['description'] != "")
                                            <p>{!!$languageCode == 'vi' ? htmlspecialchars_decode($product->translate['vi']['description'], ENT_QUOTES) : htmlspecialchars_decode($product->translate['en']['description'], ENT_QUOTES)!!}</p>
                                        @else
                                        <div class="alert alert-warning w-100 text-center" role="alert">
                                            <strong>Nội dung đang được cập nhật</strong>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="share_facebook">
                                        <div class="fb-share-button" data-href="{{$url}}" data-layout="button_count">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- bình luận đánh giá sản phẩm -->
                <hr>
                <div class="pro-detail">
                    <div class="tabs-pro-detail" id="product-tab">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Chi Tiết Sản Phẩm</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Bình Luận</a>
                            </li>
                        </ul>
                        
                        <!-- Tab content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- Chi tiết sản phẩm -->
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="desc-pro-detail">
                                            <h3 class="title text-center text-danger">MÔ TẢ</h3>
                                            @if($product->translate['vi']['description'] != "" || $product->translate['en']['description'] != "")
                                                <p>{!!$languageCode == 'vi' ? htmlspecialchars_decode($product->translate['vi']['description'], ENT_QUOTES) : htmlspecialchars_decode($product->translate['en']['description'], ENT_QUOTES)!!}</p>
                                            @else
                                            <div class="alert alert-warning w-100 text-center" role="alert">
                                                <strong>Nội dung đang được cập nhật</strong>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bình luận -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="title text-center text-danger">BÌNH LUẬN</h3>
                                        <div id="reviews">
                                            <div class="fb-comments" data-href="{{ route('product_detail', ['slug' => $product->slug]) }}" data-width="100%" data-numposts="50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Sản phẩm liên quan -->
                    <div class="box_product_list_tab">
                        <div class="container">
                            <div class="title-main">
                                <span>SẢN PHẨM LIÊN QUAN</span>
                            </div>
                            <div class="page_sanpham">
                                <div class="container ">
                                    <div class="row">
                                        @foreach($relatedProduct as $product)
                                        <div class="col-6 col-md-4 col-lg-3 col-xl-3">
                                            <div class="product-item">
                                                <a href="{{ route('product_detail', ['slug' => $product->slug]) }}">
                                                    <div class="scale-img product-image">
                                                        <img width="100%"
                                                            src="{{ asset( $product->product_image) }}"
                                                            alt="Ảnh sản phẩm">
            
                                                        <a class="product-price btn btn-primary" href="{{ route('cart.add', ['id' => $product->id]) }}">Thêm vào giỏ hàng</a>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-name">{{ $product->product_name }}</div>
                                                        <span class="price-new">
                                                            {{ number_format($product->price * (intval(100 -  $product->discount_percent )/100)) }}đ
                                                        </span>
                                                        <span class="price-old">
                                                            {{ number_format($product->price) }}đ
                                                        </span>
                                                    </div>
                                                </a>
                                                <span class="price-per">
                                                    {{$product->discount_percent}}%
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    
@endsection
