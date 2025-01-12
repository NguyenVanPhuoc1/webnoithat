<?php

namespace App\Http\Controllers\PurchaseProcess;

use App\Http\Controllers\Controller;
use App\Services\InfoUserPaymentService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\OrderItemService;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\PurchaseProcess\CartController;
use Illuminate\Support\Facades\Auth;


class VnpayPaymentController extends Controller
{
    protected $orderService;
    protected $orderItemService;
    protected $infoUserPaymentService;

    public function __construct(OrderService $orderService, OrderItemService $orderItemService,InfoUserPaymentService $infoUserPaymentService)
    {
        $this->orderService = $orderService;
        $this->orderItemService = $orderItemService;
        $this->infoUserPaymentService = $infoUserPaymentService;
    }   
    
    //khởi tạo url thanh toán
    public function vnpay_payment($order_id, $total_price, $bank){
        $vnp_Url = env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
        $vnp_TmnCode = env('VNPAY_TMN_CODE', 'UZKN51V4');
        $vnp_HashSecret = env('VNPAY_HASHSECRET', '8GJN1KPZQFFKYF4FTL3RMZ4K6PZI37KG');
        $vnp_Returnurl = route('vnpay.return');
        
        $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh Toan Hoa Don";
        $vnp_OrderType = "100000";
        $vnp_Amount = $total_price * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = $bank;
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
        
        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
    
        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $hashdata = ltrim($hashdata, '&');
        // dd($hashdata);die();
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;
    
        // dd($vnp_Url); // Kiểm tra URL
        // return redirect($vnp_Url);
        return $vnp_Url;
    }

    //trả về kết quả thanh toán
    public function handleVnpayReturn(Request $request)
    {
        $order_id = $request->query('vnp_TxnRef');
        $vnp_SecureHash = $request->query('vnp_SecureHash');

        $vnp_HashSecret = env('VNPAY_HASHSECRET','8GJN1KPZQFFKYF4FTL3RMZ4K6PZI37KG'); // Secret key của bạn
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
                // Cập nhật trạng thái thanh toán của đơn hàng thành "paid"
                $this->orderService->updatePaymentStatus($order_id, "Thanh Toán Thành Công");
                
                // Thêm thông tin chi tiết đơn hàng và người nhận
                $this->orderItemService->saveOrderItems($order_id);
                $data = session('info_user_payment');
                $this->infoUserPaymentService->createInfoUserPayment(Auth::user()->id,$order_id,$data);
                //hủy giỏ hàng
                Cartcontroller::destroyCart();

                return redirect()->route('cart.index')->with('success', 'Giao dịch thành công.');
            } else {
                // Giao dịch không thành công
                $this->orderService->updatePaymentStatus($order_id, "Thanh Toán Đã Bị Hủy");

                return redirect()->route('cart.index')->with('error', 'Giao dịch không thành công.');
            }
        } else {
            // Chữ ký không hợp lệ
            return redirect()->route('cart.index')->with('error', 'Chữ ký không hợp lệ.');
        }
    }
    /**
     * Xử lý thanh toán trực tuyến tạo url thanh toán vnpay
     */
    public function handleVnpayPayment($data)
    {
        try {
            // Tạo URL thanh toán
            $orderId = null;

            DB::transaction(function () use ($data, &$orderId) {
        
                // Lưu đơn hàng với trạng thái "Chưa thanh toán"
                $order = $this->orderService->createOrder($data);
                
                // Gán ID của đơn hàng cho biến bên ngoài
                $orderId = $order->id;
            });
        
            // Sau khi transaction hoàn tất, xử lý URL thanh toán bên ngoài
            if ($orderId) {
                $url_pay = $this->vnpay_payment($orderId, $data['total_price'], $data['bank']);
                if ($url_pay) {
                    // Chuyển hướng người dùng tới trang thanh toán
                    return redirect()->to($url_pay);
                } else {
                    return redirect()->back()->with('error', 'Không thể khởi tạo giao dịch thanh toán. Vui lòng thử lại sau!');
                }
            } else {
                return redirect()->back()->with('error', 'Không thể lưu đơn hàng. Vui lòng thử lại sau!');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hệ thống thanh toán đang gặp sự cố. Vui lòng chọn phương thức khác.');
        }
    }

}
