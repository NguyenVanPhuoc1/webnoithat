<?php

namespace App\Services;
use PayOS\PayOS;
class PayOsService 
{
    protected PayOS $payOS;

    // Constructor nhận vào các tham số từ .env hoặc đối số truyền vào
    public function __construct()
    {
        $this->payOS = new PayOS(
            env("PAYOS_CLIENT_ID"),
            env("PAYOS_API_KEY"),
            env("PAYOS_CHECKSUM_KEY")
        );
        // dd($this->payOS);

    }

    public function handleException(\Throwable $th)
    {
        return response()->json([
            "error" => $th->getCode(),
            "message" => $th->getMessage(),
            "data" => null
        ]);
    }

    public function createPaymentLink(array $data)
    {
        // Giả sử PayOS có một phương thức gọi là createPaymentLink()
        return $this->payOS->createPaymentLink($data);
    }

    public function verifyPaymentWebhookData(array $body){
        return $this->payOS->verifyPaymentWebhookData($body);
    }
}