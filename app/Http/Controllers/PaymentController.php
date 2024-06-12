<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopperController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Order_ItemController;
use Gloudemans\Shoppingcart\Facades\Cart ;
use App\Models\Product;
use App\Models\Shopper;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function vnpay_payment($order_id, $total_price){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "UZKN51V4";//Mã website tại VNPAY 
        $vnp_HashSecret = "8GJN1KPZQFFKYF4FTL3RMZ4K6PZI37KG"; //Chuỗi bí mật
        
        $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh Toan Hoa Don";
        $vnp_OrderType = "100000";
        $vnp_Amount = $total_price * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        // var_dump($inputData);die();
        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $hashdata = ltrim($hashdata, '&');
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;
        
        return redirect($vnp_Url);
    }

    // thanh toán
    public function payment(PaymentRequest $request){
        $pay_type = $request->input('checked-payment');
        $priceString = $request->input('totalPrice');
        $total_price = floatval($priceString);
        
        $user_id = $request->input('user_id');
        $fullname = $request->input('fullname');
        $phone_number = $request->input('phone');
        $address = $request->input('address');
        $note = $request->input('content') ?? 'Đang cập nhật';
        
        $shopper = Shopper::where('user_id', $user_id)->first();
        if (!$shopper) {
            $shopper = ShopperController::addShopper(intval($user_id), $fullname, $phone_number, $address, $note);
        }
    
        DB::transaction(function () use ($shopper, $pay_type, $total_price, $request) {
            // Thêm đơn hàng
            $orders = OrderController::addOrder(intval($shopper->user_id), $pay_type, $total_price);
    
            // Thêm chi tiết từng đơn hàng
            $cartItems = Cart::content();
            foreach ($cartItems as $item) {
                Order_ItemController::addOrder_Item(intval($orders->id), $item->name, $item->qty, $item->price);
            }
    
            if ($request->input('checked-payment') === 'tt-truc-tuyen') {
                return $this->vnpay_payment(intval($orders->id), $total_price);
            }
        });
    
        return redirect()->back()->with('success', 'Chúng tôi đã nhận được thông báo và sẽ liên hệ đến bạn sớm nhất!');
    }
    

    public function handleVnpayReturn(Request $request)
    {
        $order_id = $request->query('vnp_TxnRef');
        $vnp_HashSecret = "8GJN1KPZQFFKYF4FTL3RMZ4K6PZI37KG"; // Secret key của bạn

        // Lấy dữ liệu từ URL
        $vnp_SecureHash = $request->query('vnp_SecureHash');
        $inputData = array();
        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->query('vnp_ResponseCode') == '00') {
                // cập nhật trạng thái đơn hàng
                OrderController::updateOrderStatus($order_id);
                // hủy giỏ hàng
                Cart::destroy();
                // Giao dịch thành công

                return redirect()->route('cart.index')->with('success', 'Giao dịch thành công.');
            } else {
                // Giao dịch không thành công
                return redirect()->route('cart.index')->with('error', 'Giao dịch không thành công.');
            }
        } else {
            // Chữ ký không hợp lệ
            return redirect()->route('cart.index')->with('error', 'Chữ ký không hợp lệ.');
        }
    }
}
