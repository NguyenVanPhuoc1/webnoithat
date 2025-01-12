<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\ProductTranslation;
use App\Models\ProductImage;
use App\Models\Category;

class Product extends Model
{
    use HasFactory,HasUuids;
    
    protected $table = 'products';
    protected $guarded = ['id'];
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    public function translation($languageCode)
    {
        return $this->hasOne(ProductTranslation::class)->where('language_code', $languageCode);
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }
}
