@extends('frontend.layout.master')

@section('title', 'Giới Thiệu')

@section('body')
<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="#">
                    <span>{{trans('frontend.Home')}}</span>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a class="text-decoration-none" href="#">
                    <span>{{trans('frontend.gioithieu')}}</span>
                </a>
            </li>

        </ol>
    </div>
</div>
<div class="wrap-main w-clear">
    <div class="title-main">
        <span>{{trans('frontend.gioithieu')}}</span>
    </div>
    <div class="content-main w-clear">
        {!! __('frontend.intro') !!}
        <p><strong>XƯỞNG SẢN XUẤT NỘI THẤT GỖ B</strong></p>
        <p style="line-height:1;">Địa chỉ: New York, NY 10012, US</p>
        <p style="line-height:1;">Email: info@gmail.com</p>
        <p style="line-height:1;">Phone: + 01 234 567 88</p>
        <p style="line-height:1;"></p>
    </div>
</div>

@endsection