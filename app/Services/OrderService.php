<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService extends AbstractCrud
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    //create new order

    public function createOrder($data){
        $order = Order::create([
            'user_id' => $data['user_id'],
            'pay_type' => $data['pay_type'],
            'bank_name' => $data['bank'],
            'status' => $data['status'],
            'total' => $data['total_price'],
        ]);
        return $order;
    }

    // update static order
    public function updatePaymentStatus($orderId, $status)
    {
        // Tìm đơn hàng theo ID và user_id
        $order = $this->model->where('id', $orderId)
                            ->first();

        // Nếu không tìm thấy đơn hàng phù hợp
        if (!$order) {
            throw new \Exception("Order not found or you're not authorized to update this order");
        }

        // Cập nhật trạng thái thanh toán
        $order->update([
            'status' => $status,
        ]);

        return $order;
    }

}