<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // danh mục
    protected $table = 'category';
    protected $primaryKey ='id';
    protected $guarded =[];

    // quan hệ 1-n t dùng hasMany
    public function products(){
        return $this-> hasMany(Product::class, 'cate_id','id');
    }
}
