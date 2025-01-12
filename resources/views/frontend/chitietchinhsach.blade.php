@extends('frontend.layout.master')

@section('title', 'Chi Tiết Chính Sách')

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
                        <span>Chính Sách</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" >
                        <span>{{$policy->poli_name}}</span>
                    </a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrap-main w-clear">
        <div class="title-main">
            <span>{{$policy->poli_name}}</span>
        </div>
        <div class="time-main">
            <i class="fas fa-calendar-week"></i>
            <span>Ngày đăng: {{ $policy->created_at ? $policy->created_at->format('d/m/Y h:i A') : 'Đang Cập Nhật' }}</span>
        </div>
        @if($policy->poli_desc)
            <div class="alert w-100" role="alert">
                <p>{!!htmlspecialchars_decode($policy->poli_desc, ENT_QUOTES)!!}</p>
            </div>
        @else
        <div class="alert alert-warning w-100" role="alert">
            <strong>Nội dung đang cập nhật</strong>
        </div>
        @endif
        <div class="share otherpolicy mb-3">
            <b>Chính sách khác :</b>
            <ul class="list-policy-other">
                @foreach($relatedPolicy as $item)
                <li><a class="text-decoration-none" href="{{route('policy_detail',['slug' => $item->slug])}}">{{$item ->poli_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection