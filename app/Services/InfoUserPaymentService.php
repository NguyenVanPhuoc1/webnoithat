<?php

namespace App\Services;

use App\Models\Info_User_Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;

class InfoUserPaymentService extends AbstractCrud
{
    public function __construct(Info_User_Payment $model)
    {
        parent::__construct($model);
    }

    //create new order

    public function createInfoUserPayment($user_id,$order_id,$data){
        $order_item = Info_User_Payment::create([
            'user_id' => $user_id,
            'order_id' => $order_id,
            'name' => $data['fullname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'note' => $data['note'],
        ]);
        return $order_item;
    }

}