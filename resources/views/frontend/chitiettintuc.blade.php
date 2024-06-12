@extends('frontend.layout.master')

@section('title', 'Chi Tiết Tin Tức')

@section('body')

<div class="breadCrumbs">
        <div class="wrap-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{url('/')}}">
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="breadcrumb-item ">
                    <a class="text-decoration-none" href="{{url('/tin-tuc')}}">
                        <span>Tin Tức</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" >
                        <span>{{$news->news_name}}</span>
                    </a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrap-main w-clear">
        <div class="title-main">
            <span>{{$news->news_name}}</span>
        </div>
        <div class="time-main">
            <i class="fas fa-calendar-week"></i>
            <span>Ngày đăng: 03/01/2023 11:24 PM</span>
        </div>
        @if($news->news_desc)
            <div class="alert w-100" role="alert">
                <p>{!!$news->news_desc!!}</p>
            </div>
        @else
        <div class="alert alert-warning w-100" role="alert">
            <strong>Nội dung đang cập nhật</strong>
        </div>
        @endif
        <div class="share othernews mb-3">
            <b>Chính sách khác :</b>
            <ul class="list-news-other">
                @foreach($relatedNews as $item)
                <li><a class="text-decoration-none" href="{{route('news_detail',['id' => $item->id])}}">{{$item ->news_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection