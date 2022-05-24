<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrForm extends Model
{
    use HasFactory;
    protected $table = 'pr_form';
    
    protected $fillable = [
        'form_id',
        'stockno',
        'unit',
        'item_id',
        'quantity',
        'unitprice',
        'totalcost',
    ];

    
    /**
     * Counts number of rows
     * @return String
     * @example
     *     PrForm::countRows();
     * 
     **/
    public static function countRows()
    { return countTruncate(count(self::all())); }
}