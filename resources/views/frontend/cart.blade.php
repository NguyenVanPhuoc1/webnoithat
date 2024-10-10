@extends('frontend.layout.master')

@section('title', 'Giỏ Hàng')

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
                    <span>Giỏ Hàng</span>
                </a>
            </li>
        </ol>
    </div>
</div>
<div class="shopping-cart">
    <div class="wrap-content py-5">
        <form method="POST" action="{{route('vnpay.payment')}}" class="form-cart validation" id="paymentForm" enctype="multipart/form-data">
        @csrf
        @if($cartItems -> Count() > 0)
            <div class="row wrap-shoping-cart">
                <div class="col-12 col-md-12 col-lg-8 ">
                    <div class="cart-list">
                        <div class="cart-title">
                            <p class="title">
                                GIỎ HÀNG CỦA BẠN:
                            </p>
                        </div>
                        <div class="list-procart">
                            <div class="table-responsive border">
                                <table class="table">
                                    <thead class="border-bottom">
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 ">Hình Ảnh</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 ">Tên Sản Phẩm</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light ">
                                                <div class="py-2 px-4">Số Lượng</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 ">Thành Tiền</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="procart-list">
                                        @foreach($cartItems as $item)
                                            <tr data-row-id="{{ $item->rowId }}">
                                                <td class="p-4">
                                                    <div class="media align-items-center">
                                                        <img src="{{ asset('front/public/image/'. $item->options->image) }}"
                                                            class="d-block ui-w-40 ui-bordered mr-4" alt="" style="width:85px; height:85px;">
                                                    </div>
                                                    <div class="delete-product ">
                                                        <a href="#" class="text-pro delete-product-item"  data-row-id="{{ $item->rowId }}" onClick="deleteProduct(event)">
                                                            <i class="fa-regular fa-circle-xmark mr-3"></i> Xóa 
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-pro font-weight-bold align-middle p-4">{{ $item->name }}</td>
                                                <td class="align-middle p-4 m-0-auto">
                                                    <div class="quantity-pro-detail">
                                                        <span class="quantity-minus-pro-detail">-</span>
                                                        <input type="number" class="qty-pro" id="qty-pro" min="1" value="{{ $item->qty }}" readonly=""  >
                                                        <span class="quantity-plus-pro-detail">+</span>
                                                    </div>
                                                </td>
                                                <td class="text-pro font-weight-semibold align-middle p-4 text-price">{{ number_format( $item->qty * $item->price) }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- total money -->
                        <div class=" bg-light my-4">
                            <div class="title-total-price p-3">
                                <div class=" text-pro total-name">Tổng Tiền</div>
                                <div class="text-pro total-price text-danger"><strong class="totalPrice" id="totalPrice">{{ number_format(floatval($subtotal))}} đ</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 payment-list">
                    <div class="payment-title">
                        <div class="cart-title">
                            <p class="title">
                                PHƯƠNG THỨC THANH TOÁN:
                            </p>
                        </div>
                        <input type="hidden" name="user_id" value="{{session('id_admin')->id}}">
                        <div class="payment-method">
                            <div class="check-payment-method-online mb-3">
                                <input type="radio" id="check-payment-online" name="checked-payment"
                                    value="tt-truc-tuyen">
                                <label class="bg-light p-2 rounded border" for="check-payment-online">Thanh Toán Trực
                                    Tuyến(Ngân Hàng)</label><br>
                            </div>
                            <div class="check-payment-method-facetoface mb-3">
                                <input type="radio" id="check-payment-facetoface" name="checked-payment"
                                    value="tt-truc-tiep">
                                <label class="bg-light p-2 rounded border" for="check-payment-facetoface">Thanh Toán
                                    Trực Tiếp</label><br>
                            </div>
                            @error('checked-payment')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="info-delivery my-3">
                        <div class="cart-title">
                            <p class="title">
                                ĐỊA CHỈ NHẬN HÀNG:
                            </p>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-md-6 form-group">
                                <label for="fullname" class="col-form-label">Tên</label>
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" value="{{session('id_admin')->name}}" readonly>
                                @error('fullname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone" class="col-form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" >
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="address" class="col-form-label">Địa Chỉ</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" >
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="content" class="col-form-label">Nội Dung</label>
                                <textarea class="form-control" placeholder="Không Bắt Buộc" name="content" id="content"
                                    cols="20" rows="7" required>
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="Thanh Toán" id="thanhtoan"
                                    class="w-100 btn btn-primary rounded-2 py-2 px-4 mt-2">
                                <span class="submitting"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="nocart text-center">
                    <img src="{{ asset('front/public/image/no_cart.png') }}" alt="" srcset="" style="width: auto">
                    <span class="mt-10 d-block text-align-center title-nocart">Giỏ hàng trống</span>
                </div>
            @endif
        </form>
    </div>
</div>

@if(session('success'))
    <div class="modal show" id="successModal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">{{session('success')}}</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="confirmDelete" type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="closeModal()">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="modal show" id="errorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">{{session('error')}}</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="confirmDelete" type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="closeModalError()">OK</button>
                </div>
            </div>
        </div>
    </div>
@endif
<script> 
var url = window.location.href;
document.addEventListener("DOMContentLoaded", function() {
    // Mã JavaScript của bạn ở đây
    if(url.includes('gio-hang') === true){
        document.querySelector('.cart').style = 'display : none;';
    }
});
function closeModal() {
    document.getElementById("successModal").classList.remove('show');
}
function closeModalError() {
    document.getElementById("errorModal").classList.remove('show');
}

var data_totalPrice = {{ floatval($subtotal) }};
</script>

@endsection