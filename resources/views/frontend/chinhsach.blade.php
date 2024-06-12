@extends('frontend.layout.master')

@section('title', 'Chính sách')

@section('body')
<!-- Body -->
<div class="breadCrumbs">
                <div class="wrap-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="{{url('/')}}">
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="breadcrumb-item ">
                            <a class="text-decoration-none active" href="{{url('/chinh-sach')}}">
                                <span>Chính sách</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrap-info wrap-content mt-5 mb-5">
                <div class="container">
                    <div class="title-main">
                        <span>Chính sách</span>
                    </div>
                    <div class="row">
                        @foreach($policy as $item)
                            <div class=" col-12 col-lg-6 ">
                                <!-- item news -->
                                <div class="item_news d-flex slick-slider">
                                    <a href="{{route('policy_detail',['id' => $item->id])}}" class="hover_sang2 d-block col-4">
                                        <img src="{{ asset('front/public/image/'.$item -> poli_image)}}" alt="{{$item -> poli_image}}">
                                    </a>
                                    <div class="content_news_index col-8">
                                        <div class="name_news_index" >
                                            <p class="text-split">{{$item -> poli_name}}</p>
                                        </div>
                                        <div class="desc_news_index">
                                            <p class="text-split">{!! $item -> poli_desc !!}</p>
                                        </div>
                                        <div class="btn_more_index">
                                            <a href="{{route('policy_detail',['id' => $item->id])}}" class="text-decoration-none chinhsach-xemthem">XEM THÊM</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- item news -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
@endsection