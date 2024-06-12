@extends('frontend.layout.master')

@section('title', 'Tin Tức')

@section('body')
<!-- Body -->
<div class="breadCrumbs">
                <div class="wrap-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="{{url('/trang-chu')}}">
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="breadcrumb-item ">
                            <a class="text-decoration-none active" href="{{url('/tin-tuc')}}">
                                <span>Tin Tức</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrap-info wrap-content mt-5 mb-5">
                <div class="container">
                    <div class="title-main">
                        <span>Tin Tức</span>
                    </div>
                    <div class="row">
                        @foreach($tintuc as $item)
                            <div class=" col-12 col-lg-6 ">
                                <!-- item news -->
                                <div class="item_news d-flex slick-slider">
                                    <a href="" class="hover_sang2 d-block col-4">
                                        <img src="{{ asset('front/public/image/'.$item -> news_image)}}" alt="{{$item -> news_image}}">
                                    </a>
                                    <div class="content_news_index col-8">
                                        <div class="name_news_index">
                                            <p class="text-split">{{$item -> news_name}}</p>
                                        </div>
                                        <div class="desc_news_index">
                                            
                                            <p class="text-split">{!! $item -> news_desc !!}</p> 
                                        </div>
                                        <div class="btn_more_index">
                                            <a href="{{route('news_detail',['id' => $item->id])}}" class="text-decoration-none tintuc-xemthem">XEM THÊM</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- item news -->
                            </div>
                        @endforeach
                        <div class="pagination mx-auto">
                        {{$tintuc->appends(request()->query())->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>

@endsection