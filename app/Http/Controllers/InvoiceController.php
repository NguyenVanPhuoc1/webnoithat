<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\User;
use App\Models\Shopper;
use App\Models\Logo;

class InvoiceController extends Controller
{
    //

    public function download($order_id)
    {
        // Giả sử bạn lấy dữ liệu đơn hàng từ cơ sở dữ liệu biến
        $user = session('id_admin');
        $shopper_info = Shopper::where('user_id','=',$user->id)->first();
        $order = Order::where('shopper_id','=', $user->id)
        ->where('id', intval($order_id))
        ->first();
        // dd($order);die();
        if($order != null){
            if ($order) {
                $orderItem = $order->hasManyOrderItem()->orderBy('created_at', 'desc')->get();
                // dd($orderItem);die();
            }else{
                $orderItem = 'Lỗi - Không Tồn Tại Hóa Đơn Cần Xem!';
            }
        }else{
            $orderItem = 'Đơn Hàng Không Tồn Tại!';
        }
        // $logo = Logo::first(); 
        // $data = [
        //     [
        //         'quantity' => 1,
        //         'description' => '1 Year Subscription',
        //         'price' => '129.00'
        //     ]
        // ];
        Pdf::setOption(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        $pdf = Pdf::loadView('frontend.orderpdf', compact('user','order','orderItem','shopper_info'));
        return $pdf->download('invoice_chitiethoadon.pdf');
    }
}
