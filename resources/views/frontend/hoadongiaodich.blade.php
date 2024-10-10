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
                    <span>Hóa Đơn</span>
                </a>
            </li>
        </ol>
    </div>
</div>
<div class="shopping-cart">
    <div class="wrap-content py-5">
        <div class="title-main">
            <span>Hóa Đơn</span>
        </div>
        <div class="filler_order row justify-content-between">
            <div class="selected_status-order dropdown col-12 col-md-3 col-lg-2 mb-3">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Trạng Thái Đơn Hàng
                </button>
                <div class="dropdown-menu order_checkmenu px-2" aria-labelledby="dropdownMenuButton1">
                    <ul class="list-group">
                        <!-- Show trạng thái đơn hàng -->
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="da-thanh-toan"
                                aria-label="Trạng Thái Đơn Hàng" />
                            Đã Thanh Toán
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="chua-thanh-toan"
                                aria-label="Trạng Thái Đơn Hàng" />
                            Chưa Thanh Toán
                        </li>
                        <!-- Thêm các trạng thái đơn hàng khác nếu cần -->
                    </ul>
                    <div class=" btn-check d-flex justify-content-between my-2 " style="position: relative">
                        <button class="btn btn-secondary" type="button">Cancel</button>
                        <button class="btn btn-primary btn-apply" type="button">Apply</button>
                    </div>
                </div>
            </div>
            <div class="search_order col-12 col-md-6 col-lg-3">
                <form action="{{route('order.search')}}" class="d-flex" id="search_order">
                    <input class="form-control me-2" name="order_name" id="order_name" type="search"
                        placeholder="Tìm kiếm hóa đơn .." aria-label="Search" required>
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- show order -->
        <div class="list-proorder my-4">
            <div class="table-responsive border">
                <table class="table">
                    @if (!is_string($orders))
                    <thead class="border-bottom">
                        <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 ">Hóa Đơn</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 ">Ngày tạo</div>
                            </th>
                            <th scope="col" class="border-0 bg-light ">
                                <div class="py-2 px-3">Hạn Thanh Toán</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 px-3">Tổng Cộng</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 px-3">Tình Trạng</div>
                            </th>
                            <th scope="col" class="border-0 bg-light">
                                <div class="py-2 px-3">Liên Kết Nhanh</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="procart-list">
                        @foreach($orders as $item)
                            <tr>
                                <td class="p-4">
                                    <div class="text-pro font-weight-bold align-middle p-4">
                                        {{$item->id}}
                                    </div>
                                </td>
                                <td class="text-pro font-weight-bold align-middle p-4">{{ substr($item->created_at, 0, 10) }}</td>
                                <td class="align-middle p-4 m-0-auto">
                                    {{ substr($item->updated_at, 0, 10) }}
                                </td>
                                <td class="text-pro font-weight-semibold align-middle p-4 text-price">
                                    {{ number_format($item->total) }} VND
                                </td>
                                @if($item->status == 'Đã Thanh Toán')
                                <td class="text-success font-weight-semibold align-middle p-4 text-price">
                                    {{ $item->status }}
                                </td>
                                @else
                                <td class="text-danger font-weight-semibold align-middle p-4 text-price">
                                    {{ $item->status }}
                                </td>
                                @endif
                                <td class="text-pro font-weight-semibold align-middle p-4 text-price">
                                    <a href="{{route('orderItem.index',['id' => $item->id])}}" class="btn border view_order_item">Xem Chi Tiết</a>
                                </td>
                            </tr>
                        @endforeach

                        <!-- thanh phân trang  -->
                        <div class="pagination justify-content-center">
                            {{$orders->appends(request()->query())->links('pagination::bootstrap-4')}}
                        </div>
                    </tbody>
                    @else
                        <div class="alert alert-warning w-100 text-center" role="alert">
                            <strong>{{ $orders }}</strong>
                        </div>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection