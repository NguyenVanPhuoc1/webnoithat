@extends('frontend.layout.master')

@section('title', 'Khu Vực Khách Hàng - Hóa Đơn')

@section('body')
<!-- Body -->
<div class="breadCrumbs">
    <div class="wrap-content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="#">
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a class="text-decoration-none active">
                    <span>Chi Tiết Hóa Đơn</span>
                </a>
            </li>
        </ol>
    </div>
</div>
<div class="shopping-cart">
    <div class="wrap-content py-5 " id="printViewInvoice">
        <div class="title-main">
            <span>Chi Tiết Hóa Đơn</span>
        </div>
        <!-- show order -->
        @if (!is_string($orderItem))
            <div class="show_orderItem my-4 wrap-shoping-cart">
                <!-- title Hóa Đơn -->
                <div class="order-detailTitle">
                    <div class="d-flex justify-content-between ">
                        <!-- Logo + name Shop -->
                        <div class="">
                            <div class="d-flex align-items-center mx-3">
                                <div class="logo">
                                    <img src="{{ asset('front/public/image/' . $logo->file_name) }}" alt="LoGo Shop"
                                        style=" width: 100px; height:100px;">
                                </div>
                                <div class="name-shop mx-3">
                                    <h4><b>Shop Nội Thất</b></h4>
                                </div>
                            </div>
                        </div>
                        <div class=" float-end mx-3">
                            <div class="order_title_name align-items-center ">
                                <h5 class="d-flex"><p class="text-warning fw-3">Hóa Đơn: </p> # <span>{{$order->id}}</span></h5>
                                <div class="created_date">{{ substr($order->created_at, 0, 10) }}</div>
                            </div>
                            <div class="d-flex btn-orderInvoice justify-content-between">
                                <div class="btn border-primary btn-print mr-3" onclick="printDiv('printViewInvoice')"><i class="fa-solid fa-print fa-fw"></i> In Hóa Đơn</div>
                                <div class="btn border-primary btn-download mx-3"><a href="{{route('download.pdf',['id' => $order->id])}}"><i class="fa-solid fa-download fa-fw"></i> Tải Hóa Đơn</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <!-- Khách Hàng -->
                    <div class="col-md-6 col-lg-6 col-12 py-3 border-top border-bottom border-end">
                        <div class="text-pro fw-bold align-middle my-3">Khách Hàng</div>
                        <div class="text-pro align-middle "><span>Họ Và Tên: </span>{{$user->name}}</div>
                        <div class="text-pro align-middle "><span>Điện Thoại: </span>{{$shopper_info->phone_number}}</div>
                        <div class="text-pro align-middle "><span>Email: <a
                                    href="mailto:{{$user->email}}">{{$user->email}}</a></span></div>
                        <div class="text-pro align-middle "><span>Địa Chỉ: </span>{{$shopper_info->address}}</div>
                    </div>
                    <!-- Nhà Cung Cấp -->
                    <div class="col-md-6 col-lg-6 col-12 py-3 border-top border-bottom">
                        <div class="text-pro fw-bold align-middle my-3">Shop</div>
                        <div class="text-pro align-middle "><span>Họ Và Tên: </span>Shop Nội Thất</div>
                        <div class="text-pro align-middle "><span>Điện Thoại: </span>0123456789</div>
                        <div class="text-pro align-middle "><span>Email: <a
                                    href="mailto:nhombtdc@gmail.com">nhombtdc@gmail.com</a></span></div>
                        <div class="text-pro align-middle "><span>Địa Chỉ: </span>TP. Hồ Chí Minh</div>
                    </div>
                </div>

                <div class="row my-3">
                    <!-- Hóa Đơn -->
                    <div class="col-md-6 col-lg-6 col-12 py-3 border-top border-bottom border-end">
                        <div class="text-pro fw-bold align-middle my-3">Hóa Đơn</div>
                        <div class="text-pro align-middle "><span>Mã Hóa Đơn: </span>{{$order->id}}</div>
                        <div class="text-pro align-middle "><span>Ngày Tạo: </span>{{ substr($order->created_at, 0, 10) }}
                        </div>
                        <div class="text-pro align-middle "><span>Hạn Thanh Toán:
                                {{ substr($order->updated_at, 0, 10) }}</span></div>
                        @if($order->status == 'Đã Thanh Toán')
                            <div class="text-pro align-middle "><span>Đã Thanh Toán: </span>{{number_format($order->total)}} VND
                            </div>
                        @else
                            <div class="text-pro align-middle "><span>Đã Thanh Toán: </span>0 VND</div>
                            <div class="text-pro align-middle "><span>Cần Thanh Toán: </span>{{number_format($order->total)}}
                                VND</div>
                        @endif
                        <div class="text-pro align-middle "><span>Tổng Tiền: </span><span
                                class="text-warning">{{number_format($order->total)}} VND</span></div>
                    </div>
                    <!-- Trạng Thái - Phương Thức Thanh Toán -->
                    <div class="col-md-6 col-lg-6 col-12 py-3 border-top border-bottom">
                        <div class="text-pro fw-bold align-middle my-3">Trạng Thái - Phương Thức Thanh Toán</div>
                        @if($order->status == 'Đã Thanh Toán')
                            <div class="text-pro text-success align-middle "><span>Trạng Thái: </span>{{$order->status}}</div>
                        @else
                            <div class="text-pro text-danger align-middle "><span>Trạng Thái: </span>{{$order->status}}</div>
                        @endif
                        @if($order->pay_type == 'tt-truc-tuyen')
                            <div class="text-pro align-middle "><span>Phương Thức Thanh Toán: </span>Thanh Toán Trưc Tuyến(Ngân
                                Hàng)</div>
                        @elseif(($order->pay_type == 'tt-truc-tuyen'))
                            <div class="text-pro align-middle "><span>Phương Thức Thanh Toán: </span>Tiền Mặt</div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- show orderItem -->
            <!-- Chi Tiết Hóa Đơn -->
            <div class="order_item">
                <div class="text-pro fw-bold align-middle my-3">Chi Tiết Hóa Đơn</div>
                <div class="table-responsive border">
                    <table class="table">
                        <thead class="border-bottom">
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 ">#</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 ">Tên</div>
                                </th>
                                <th scope="col" class="border-0 bg-light ">
                                    <div class="py-2 px-3">Số Lượng</div>
                                </th>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="py-2 px-3">Giá</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="procart-list">
                            @foreach($orderItem as $item)
                                <tr>
                                    <td class="p-4">
                                        <div class="text-pro fw-bold align-middle p-4">
                                            {{ $loop->index + 1 }}
                                        </div>
                                    </td>
                                    <td class="text-pro fw-bold align-middle p-4">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="align-middle fw-bold p-4 m-0-auto">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-pro fw-bold align-middle p-4 text-price">
                                        {{ number_format($item->price * $item->quantity) }} VND
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-danger w-100 text-center" role="alert">
                <strong>{{ $orderItem }}</strong>
            </div>
        @endif
    </div>
</div>
<script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;
            // console.log(originalContents);

            document.body.innerHTML = printContents;
            // Ẩn các phần tử không cần thiết khi in
            document.querySelectorAll(".btn").forEach(button => button.style.display = "none");

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection