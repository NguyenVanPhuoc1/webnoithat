<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Info_User_Payment extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'info_user_payment';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    //1-n
    public function hasManyOrder(){
        return $this->hasMany(Order::class,'order_id','id');
    }
}
