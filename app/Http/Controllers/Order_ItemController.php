<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order_Item;

class Order_ItemController extends Controller
{
    //
    public static function addOrder_Item($order_id,$product_name,$product_quantity,$product_price){
        $order_item = Order_Item::create([
            'order_id' => $order_id,
            'product_name' => $product_name,
            'quantity' => $product_quantity,
            'price' => $product_price,
        ]);
        return $order_item;
    }
}
