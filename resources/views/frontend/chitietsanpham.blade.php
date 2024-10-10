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
    </style>
@endsection

@section('meta')
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="SHOPNOITHAT" />
    <meta property="og:title" content="{{$product->name}}" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="{{$url}}" />
    <meta property="og:image" content="{{asset('front/public/image/'.$product->images->first()->file_name )}}" />
    <meta property="og:image:alt" content="{{$product->name}}" />
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
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ url('/san-pham') }}">
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" href="{{ url('/chi-tiet-san-pham/' . $product->id) }}">
                        <span>{{ $product->name }}</span>
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
                                <a href="{{ asset('front/public/image/'.$product->images->first()->file_name )}}" class="MagicZoom" id="sanpham"
                                    data-options="zoomMode: on; hint: on; rightClick: true; selectorTrigger: hover; expandCaption: false; history: false;">
                                    <img id="mainImage" src="{{ asset('front/public/image/'.$product->images->first()->file_name )}}" alt=""
                                       width: 570px; height: 550px;>
                                </a>
                            </div>
                            <div class="gallery-thumb-pro col">
                                <div class="owl-thumb-pro slick-slider">
                                    @foreach($product->images as $item)
                                    <a class="thumb-pro-detail slick-slide" data-zoom-id="sanpham"
                                        href="{{ asset('front/public/image/'.$item->file_name )}}" data-image="{{ asset('front/public/image/'.$item->file_name )}}">
                                        <img src="{{ asset('front/public/image/'.$item->file_name )}}" style="width: 106px; height: 106px" >
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-6 right-pro-detail col-lg-7 col-12">
                            <p class="title-pro-detail">{{$product->name}}</p>
                            <ul class="attr-pro-detail p-3">
                                <li>
                                    <div class="attr-content-pro-detail name_product_detail">
                                        <h2> <span>Liên Hệ</span></h2>
                                    </div>
                                </li>
                                <li>
                                    <div class="desc-pro-detail">
                                        <h3>Mô tả:</h3>
                                        @if($product->description != "")
                                            <p>{{$product->description}}</p>
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
                        <!-- product tab content -->
                        <div class="tab-content">
                            <div class="row">
                                <!-- Reviews -->
                                <div class="col-md-12">
                                    <h3 class="title text-center text-danger">BÌNH LUẬN</h3>
                                    <div id="reviews">
                                        <div class="fb-comments" data-href="{{ route('products.show', ['id' => $product->id]) }}" data-width="100%" data-numposts="50"></div>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <!-- <div class="col-md-6">
                                    <div id="review-form ">
                                        <form class="review-form" method="post"
                                            action="#">
                                            @csrf
                                            <input class="input form-control" type="text" name="name" id="name"
                                                placeholder="Your Name">
                                            <input class="input form-control" type="email" name="email" id="email"
                                                placeholder="Your Email">
                                            <textarea class="input form-control" name="content" id="content" placeholder="Your Review"></textarea>
                                            <button type="submit" class="btn btn-primary" name="submit">Gửi bình
                                                luận</button>
                                        </form>
                                    </div>
                                </div> -->
                                <!-- /tab2  -->
                            </div>
                            <!-- /product tab content  -->
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
                                                <a href="{{ route('products.show', ['id' => $product->id]) }}">
                                                    <div class="scale-img product-image">
                                                        @if ($product->images->isNotEmpty())
                                                            <img width="100%"
                                                                src="{{ asset('front/public/image/' . $product->images->first()->file_name) }}"
                                                                alt="Ảnh sản phẩm">
                                                            <a class="product-price btn btn-primary" href="/lien-he">Liên hệ</a>
                                                        @endif
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-name">{{ $product->name }}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                                <div class="clearfix"> </div>
                                <!-- <div  aria-label="Page navigation example">
                                        <ul class="pagination flex-wrap justify-content-center mb-0" >
                                            <li class="page-item"><a class="page-link">Page 1 / 6</a></li>
                                            <li class="page-item"><a class="page-link" href="#">First</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                            <li class="page-item active"><a class="page-link">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Last</a></li>
                                        </ul>
                                    </div> -->
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
