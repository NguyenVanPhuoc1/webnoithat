<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Shopper;

class OrderController extends Controller
{
    //thêm đơn hàng
    public static function addOrder($shopper_id,$pay_type,$total_price){
        $order = Order::create([
            'shopper_id' => $shopper_id,
            'pay_type' => $pay_type,
            'status' => 'Chưa Thanh Toán',
            'total' => $total_price,
        ]);
        return $order;
    }
    // update trạng thái hàng sau khi thanh toán thành công
    public static function updateOrderStatus($order_id){
        $order = Order::findOrFail($order_id)
        ->update([
            'status' => 'Đã Thanh Toán',
        ]);
    }
    // view order

    public function viewOrder(){
        $id = intval(session('id_admin')->id);
        $shopper = Shopper::where('user_id', '=' , $id)->first();
        if ($shopper === null) {
            $orders = "Không có đơn hàng";
        }else{
            $orders = $shopper->hasManyOrder()->orderBy('created_at', 'desc')->paginate(10); 
        }
        // dd($orders);die();
        return view('frontend.hoadongiaodich', compact('orders'));
    }
    // tìm kiếm đơn hàng
    public function searchOrder(Request $request){
        $request->validate([
            'order_name' => 'required|max:100',
        ]);
        $searchTerm = $request->input('order_name');
        $shopper_id = intval(session('id_admin')->id);
        if($searchTerm != ''){
            $orders = Order::where('id', 'LIKE', '%'.$searchTerm.'%')
            ->where('shopper_id','=', $shopper_id)
            ->paginate(10);
            if($orders->isEmpty()){
                // Nếu không tìm thấy sản phẩm, có thể chuyển thông báo hoặc thực hiện xử lý khác
                $orders = "Không tìm thấy Đơn Hàng";
            }
            
        }else{
            $orders = "Không tìm thấy Đơn Hàng";
        }
        // dd($products);die();
        return view('frontend.hoadongiaodich',compact('orders'));
    }
    // xem chi tiết đơn hàng
    public function viewOrderItem($order_id){
        $user = session('id_admin');
        $shopper_info = Shopper::where('user_id','=',$user->id)->first();
        $order = Order::where('shopper_id','=', $user->id)
        ->where('id', intval($order_id))
        ->first();
        // dd($order);die();
        if($order != null){
            if ($order) {
                $orderItem = $order->hasManyOrderItem()->orderBy('created_at', 'desc')->get();
            }else{
                $orderItem = 'Lỗi - Không Tồn Tại Hóa Đơn Cần Xem!';
            }
        }else{
            $orderItem = 'Đơn Hàng Không Tồn Tại!';
        }
        return view('frontend.chitiethoadon',compact('user','order','orderItem','shopper_info'));
    }
}
