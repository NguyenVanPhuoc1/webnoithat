<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Category extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'category';
    protected $guarded = ['id'];

    // quan hệ 1-n t dùng hasMany
    public function products(){
        return $this-> hasMany(Product::class,'cate_id','id');
    }
}
