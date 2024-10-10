@extends('frontend.layout.master')

@section('title')
    Sản phẩm
@endsection

@section('body')
    <div class="breadCrumbs">
        <div class="wrap-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ url('/') }}">
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none active" href="{{ url('/san-pham') }}">
                        <span>Sản phẩm</span>
                    </a>
                </li>

            </ol>
        </div>
    </div>
    <main>
        <div class="title-main">
            <span>Sản Phẩm</span>
        </div>
        <div class="product-list">
            <div class="container">
                <div class="row">
                    @if (!is_string($products))
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-3 col-xl-3">
                                <div class="product-item">
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}">
                                        <div class="scale-img product-image">
                                            @if ($product->images->isNotEmpty())
                                                <img width="100%"
                                                    src="{{ asset('front/public/image/' . $product->images->first()->file_name) }}"
                                                    alt="Ảnh sản phẩm">
                                            @endif

                                            <a class="product-price btn btn-primary" href="{{ route('cart.add', ['id' => $product->id]) }}">Thêm vào giỏ hàng</a>
                                        </div>
                                        <div class="product-content">
                                            <div class="product-name">{{ $product->name }}</div>
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

                        <!-- thanh phân trang  -->
                        <div class="pagination justify-content-center">
                            {{$products->appends(request()->query())->links('pagination::bootstrap-4')}}
                        </div>
                    @else
                        <div class="alert alert-warning w-100 text-center" role="alert">
                            <strong>{{ $products }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </main>

@endsection

@section('script')
    <script>
        // Sử dụng JavaScript để điều chỉnh thuộc tính display của thẻ nav cuối cùng
        document.addEventListener("DOMContentLoaded", function() {
            const navElements = document.querySelectorAll("nav");
            if (navElements.length > 0) {
                const lastNavElement = navElements[navElements.length - 1];
                lastNavElement.style.display = "unset";
            }
        });
        var isUserLoggedIn = @json(session()->has('id_admin'));
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product-price').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    if (!isUserLoggedIn) {
                        event.preventDefault();
                        alert('Bạn phải đăng nhập để mua hàng.');
                    }
                });
            });
        });
    </script>
@endsection
