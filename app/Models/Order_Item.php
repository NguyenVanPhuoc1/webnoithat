<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order_Item extends Model
{
    use HasFactory ,HasUuids;

    protected $table = 'order_item';
    protected $primaryKey ='id';
    protected $guarded =['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function hasManyOrderProduct(){
        return $this->hasMany(Product::class, 'product_id', 'id');   
    }
}
