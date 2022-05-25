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
        // dungagi
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
     * Get's PrForm by id
     * @param Int $prformnumber form id
     * @return Array[Array]
     **/
    public static function getFormByID(Int $prformnumber)
    {
        return self::where("itemlist_id", "=", $prformnumber)
        ->first();
    }


    /**
     * Gets all item in table
     * @return Array[Array]
     * @example
     *     ItemList::getAllPrForms();
     **/
    public static function getAllPrForms()
    { return self::all(); }
}
