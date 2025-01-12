<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\PolicyTranslation;

class Policy extends Model
{
    use HasFactory,HasUuids;
    
    protected $table = 'policy';
    protected $guarded = ['id'];
    public function translations()
    {
        return $this->hasMany(PolicyTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(PolicyTranslation::class);
    }
}
