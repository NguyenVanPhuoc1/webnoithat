<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'order';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Tạo số ngẫu nhiên với 6 chữ số từ microtime
            $order->id = str_pad(
                intval(substr(strval(microtime(true) * 10000), -6)), 
                6, 
                '0', 
                STR_PAD_LEFT
            );
        });
    }

    //Mối quan hệ một-một được thiết lập bằng cách sử dụng phương thức hasOne và belongsTo.
    // One-to-Many (Mối quan hệ một-nhiều) Mối quan hệ một-nhiều được thiết lập bằng cách sử dụng phương thức hasMany và belongsTo.
    // Many-to-Many (Mối quan hệ nhiều-nhiều)   Mối quan hệ nhiều-nhiều được thiết lập bằng cách sử dụng phương thức belongsToMany
    // Has Many Through (Mối quan hệ qua nhiều) Mối quan hệ "has many through" được sử dụng khi bạn muốn thiết lập mối quan hệ giữa hai mô hình thông qua một mô hình trung gian

    // 1 đơn hàng có nhiều chi tiết đơn hàng
    public function hasManyOrderItem(){
        return $this->hasMany(Order_Item::class, 'order_id', 'id');   
    }

    //1-1
    public function getInfoUserPayment(){
        return $this->belongsTo(Info_User_Payment::class, 'order_id');
    }
}
