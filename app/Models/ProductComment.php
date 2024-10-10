<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey ='id';
    protected $guarded =[];

    
     // quan hệ 1-1 t dùng belongTo
    public function products(){
        return $this-> belongsTo(Product::class, 'pro_id','id');
    }
}
