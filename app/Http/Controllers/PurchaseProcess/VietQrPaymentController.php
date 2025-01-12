<?php

namespace App\Http\Controllers\PurchaseProcess;

use App\Http\Controllers\Controller;
use App\Services\PayOsService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use App\Services\InfoUserPaymentService;
use App\Services\OrderItemService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\PurchaseProcess\CartController;
use Illuminate\Support\Facades\Log;

class VietQrPaymentController extends Controller
{
    protected $payOsService;
    protected $orderService;
    protected $orderItemService;
    protected $infoUserPaymentService;


    public function __construct(PayOsService $payOsService, OrderService $orderService, OrderItemService $orderItemService,InfoUserPaymentService $infoUserPaymentService)
    {
        $this->payOsService = $payOsService;
        $this->orderService = $orderService;
        $this->orderItemService = $orderItemService;
        $this->infoUserPaymentService = $infoUserPaymentService;
    }
    //taọ mã qr thanh toán
    public function generateQRCode(Request $request)
    {
        // $apiUrl = 'https://api.vietqr.io/v2/generate';
        // $apiKey = env('VIETQR_API_KEY');
        // $client_id = env('VIETQR_CLIENT_ID');
        $apiUrl = 'https://api-merchant.payos.vn/v2/payment-requests/460170'; // Thêm id trực tiếp vào URL
        $clientId = env("PAYOS_CLIENT_ID"); // Client ID
        $apiKey = env("PAYOS_API_KEY");    // API Key

        try {
            // Gửi yêu cầu đến API
            $response = Http::withHeaders([
                'x-client-id' => $clientId, // Sử dụng đúng header
                'x-api-key' => $apiKey,
            ])->get($apiUrl);

            if ($response->successful()) {
                dd($response->json());
                // $qrCodeUrl = $response->json()['data']['qrDataURL']; // URL mã QR trả về
                // $orderId = 'ORDER' . Str::random(6);
                // return view('frontend.qrcode',compact('qrCodeUrl','orderId'));
            } else {
                return back()->withErrors(['message' => $response->json()['message'] ?? 'Có lỗi xảy ra']);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    //tạo link thanh toán với payos khi cần thanh toán ngay lập tức

    public function createPaymentLink($dataOrder)
    {
        // tạo đơn hàng
        $order =  $this->orderService->createOrder($dataOrder);
        // Lấy tất cả các sản phẩm trong giỏ hàng
        $cartItems = Cart::content();

        // Tạo mảng items từ giỏ hàng
        $items = $cartItems->map(function($item) {
            return [
                'name' => $item->name,  // Tên sản phẩm
                'price' => $item->price, // Giá sản phẩm
                'quantity' => $item->qty, // Số lượng
            ];
        })->values()->toArray();
        // dd($items);
        $data = [
            "orderCode" => intval($order->id),
            "amount" => intval($order->total),
            "description" => "Thanh toán đơn hàng",
            "items" => $items,
            "returnUrl" => route('success.payment'),
            "cancelUrl" => route('cancle.payment'),
        ];
        error_log($data['orderCode']);

        try {
            $response = $this->payOsService->createPaymentLink($data);
            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $this->payOsService->handleException($th);
        }
    }

    //view page success
    public function viewPageSuccessPayment(Request $request){
        $orderCode = $request->query('orderCode');
        $order_id = str_pad($orderCode, 6, '0', STR_PAD_LEFT);
        if($this->getPaymentStatus($order_id) == 'PAID'){
            $order = $this->orderService->getById($order_id);
            if ($order->status !== 'Thanh Toán Thành Công') {
                $this->orderService->updatePaymentStatus($order_id, "Thanh Toán Thành Công");
                // Thêm thông tin chi tiết đơn hàng và người nhận
                $this->orderItemService->saveOrderItems($order_id);
                $data = session('info_user_payment');
                $this->infoUserPaymentService->createInfoUserPayment(Auth::user()->id,$order_id,$data);
                //hủy giỏ hàng
                Cartcontroller::destroyCart();
            }
            else{
                abort(404);
            }
        }
        return view('payos.success');
    }

    
    //view page cancle
    public function viewPageCanclePayment(Request $request){
        $orderCode = $request->query('orderCode');
        $order_id = str_pad($orderCode, 6, '0', STR_PAD_LEFT);
        $order = $this->orderService->getById($order_id);
        if($this->getPaymentStatus($order_id) == 'CANCELLED'){
            if ($order->status !== 'Thanh Toán Thành Công') {
                $this->orderService->updatePaymentStatus($order_id, "Thanh Toán Đã Bị Hủy");
            }
        }else{
            abort(404);
        }
        return view('payos.cancle');
    }
    
    //getdetail đơn hàng từ payos

    public static function getPaymentStatus($orderId)
    {
        $apiUrl = "https://api-merchant.payos.vn/v2/payment-requests/{$orderId}"; // Thêm ID vào URL
        $clientId = env("PAYOS_CLIENT_ID"); // Client ID
        $apiKey = env("PAYOS_API_KEY");    // API Key

        try {
            // Gửi yêu cầu đến API
            $response = Http::withHeaders([
                'x-client-id' => $clientId,
                'x-api-key' => $apiKey,
            ])->get($apiUrl);

            if ($response->successful()) {
                $status = $response->json()['data']['status'];

                // Kiểm tra và trả về status nếu có
                return $status;
            }

            // Nếu không thành công
            return 'Failed: ' . $response->status();

        } catch (\Exception $e) {
            // Xử lý lỗi
            return 'Error: ' . $e->getMessage();
        }
    }

    //return webhook
    public function handlePayOSWebhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);
        Log::info('Webhook received:', ['body' => $body]);
        // dd($body);die();
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                "error" => 1,
                "message" => "Invalid JSON payload"
            ], 400);
        }

        // Handle webhook test
        if (in_array($body["data"]["description"], ["Ma giao dich thu nghiem", "VQRIO123"])) {
            return response()->json([
                "error" => 0,
                "message" => "Ok",
                "data" => $body["data"]
            ]);
        }

        try {
            $this->payOsService->verifyPaymentWebhookData($body);
        } catch (\Exception $e) {
            return response()->json([
                "error" => 1,
                "message" => "Invalid webhook data",
                "details" => $e->getMessage()
            ], 400);
        }

        // Process webhook data
        
        return response()->json([
            "error" => 0,
            "message" => "Ok",
            "data" => $body["data"]
        ]);
    }
}
