<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductTranslation extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'product_translations';
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
