<?php

namespace App\Http\Controllers\PurchaseProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    protected $vnpayPayment;
    protected $qrPayment;

    public function __construct(VnpayPaymentController $vnpayPayment, VietQrPaymentController $qrPayment)
    {
        $this->vnpayPayment = $vnpayPayment;
        $this->qrPayment = $qrPayment;
    }
    public function getDataPurChase(PaymentRequest $request){
        $pay_type = $request->input('checked-payment'); // Phương thức thanh toán
        $total_price = floatval(CartController::getTotalPrice()); // Tổng tiền
        $bank = $request->input('bank') != null ? $request->input('bank') : "No"; // Ngân hàng (chỉ cho thanh toán online)
        $user_id = $request->input('user_id');
        $fullname = $request->input('fullname');
        $phone_number = $request->input('phone');
        $address = $request->input('address');
        $note = $request->input('content') ?? 'Đang cập nhật';
        // Tạo một biến data chứa các giá trị đã lấy từ request
        $data = [
            'pay_type' => $pay_type,
            'total_price' => $total_price,
            'bank' => $bank,
            'status' => 'Chưa Thanh Toán',
            'user_id' => $user_id,
            'fullname' => $fullname,
            'phone_number' => $phone_number,
            'address' => $address,
            'note' => $note,
        ];

        return $data;
    }
    //check kết quả kiểm tra thanh toán vnpay
    public function handleVnpayResult(Request $request){
        return $this->vnpayPayment->handleVnpayReturn($request);
    }
    public function payment(PaymentRequest $request)
    {
        $data = $this->getDataPurChase($request);
        
        // Lưu thông tin người nhận hàng vào session
        session([
            'info_user_payment' => [
                'user_id' => $data['user_id'],
                'fullname' => $data['fullname'],
                'phone' => $data['phone_number'],
                'address' => $data['address'],
                'note' => $data['note'] ?? 'Đang cập nhật'
            ]
        ]);
        // dd($data['pay_type'] === 'tt-truc-tuyen');
        if ($data['pay_type'] === 'tt-truc-tuyen') {
            //vnpay
            return $this->vnpayPayment->handleVnpayPayment($data);
        }else if($data['pay_type'] === 'tt-qr-payos'){
            //pay os
            // dd($data);
            return $this->qrPayment->createPaymentLink($data);
        }
    }
    

}
