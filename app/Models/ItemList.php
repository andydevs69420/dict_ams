<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;
    protected $table = "item_list";

    public $timestamps = false;
    
    protected $fillable = [
        "itemnumber",
        "itemname",
        "itemdescription",
    ];

    /**
     * Counts all row in table
     * @return String
     * @example
     *     ItemList::countRows();
     **/
    public static function countRows()
    { return countTruncate(count(self::all())); }


    /**
     * Get's item by id
     * @param Int $itemnumber item id
     * @return Array[Array]
     **/
    public static function getItemByID(Int $itemnumber)
    {
        return self::where("itemlist_id", "=", $itemnumber)
        ->first();
    }

    /**
     * Gets all item in table
     * @return Array[Array]
     * @example
     *     ItemList::getAllItems();
     **/
    public static function getAllItems()
    { return self::all(); }

}
