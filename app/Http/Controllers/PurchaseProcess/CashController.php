<?php

namespace App\Http\Controllers\PurchaseProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashController extends Controller
{
    // private function handleCashPayment($data)
    // {
    //     DB::transaction(function () use ($data) {
    //         // Lưu đơn hàng
    //         $orders = $this->orderService->createOrder($data);

    //         // Lưu chi tiết đơn hàng
    //         $this->saveOrderItems($orders->id);

    //         // Xóa giỏ hàng
    //         // Cart::destroy();
    //     });

    //     return redirect()->back()->with('success', 'Đơn hàng của bạn đã được tạo thành công. Chúng tôi sẽ liên hệ sớm nhất!');
    // }
}
