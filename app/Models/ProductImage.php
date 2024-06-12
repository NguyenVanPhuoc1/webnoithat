<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey ='id';
    protected $guarded =[];

    // quan hệ 1-1 t dùng belongTo
    public function productÍmage(){
        return $this->belongsTo(Product::class);
    }
}
