<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\News;

class NewsTranslation extends Model
{
    use HasFactory,HasUuids;
    
    protected $table = 'news_translations';
    protected $guarded = ['id'];
    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
