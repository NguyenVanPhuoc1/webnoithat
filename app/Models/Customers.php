<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    // người nhận tin
    protected $table = 'customer';
    protected $primaryKey ='id';
    protected $guarded =[];
}
