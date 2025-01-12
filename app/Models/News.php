<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\NewsTranslation;


class News extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'news';
    protected $guarded = ['id'];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);
    }
    public function translation()
    {
        return $this->hasOne(NewsTranslation::class);
    }
}
