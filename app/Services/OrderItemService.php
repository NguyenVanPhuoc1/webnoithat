<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderItemService extends AbstractCrud
{
    public function __construct(Order_Item $model)
    {
        parent::__construct($model);
    }

    //create new order

    public function createOrderItem($order_id,$data){
        $order_item = Order_Item::create([
            'order_id' => $order_id,
            'product_name' => $data->name,
            'quantity' => $data->qty,
            'price' => $data->price,
        ]);
        return $order_item;
    }

    /**
     * Lưu chi tiết đơn hàng
     */
    public function saveOrderItems($order_id)
    {
        $cartItems = Cart::content();
        foreach ($cartItems as $item) {
            $this->createOrderItem($order_id, $item);
        }
    }
    

}