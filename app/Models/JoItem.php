<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoItem extends Model
{
    use HasFactory;
    protected $table = 'jo_item';
    
    protected $fillable = [
        'form_id',
        'itemno',
        'unit',
        'description',
        'quantity',
        'unitcost',
        'amount',
    ];

   
    /**
     * Counts number of rows
     * @return String
     * @example
     *     JoForm::countRows();
     * 
     **/
    public static function countRows()
    { return countTruncate(count(self::all())); }


    /**
     * Gets all items
     * @param Int $formid form id
     * @return Array
     * @example
     *     JoForm::getItemsByFormId();
     **/
    public static function getItemsByFormId(Int $formid)
    {
        return self::where("form_id", "=", $formid)->get();
    }
}
