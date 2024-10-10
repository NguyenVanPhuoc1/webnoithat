<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopper;

class ShopperController extends Controller
{
    //thêm thông tin người mua
    public static function addShopper($user_id,$fullname,$phone_number,$address,$note){
        $shopper = Shopper::create([
            'user_id' => $user_id,
            'full_name' => $fullname,
            'phone_number' => $phone_number,
            'address' => $address,
            'note' => $note,
        ]);
        return $shopper;
    }
}
