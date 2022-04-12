<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrForm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'form',
        'stockno',
        'unit',
        'itemdescription',
        'quantity',
        'unitprice',
        'totalcost',
    ];
}
