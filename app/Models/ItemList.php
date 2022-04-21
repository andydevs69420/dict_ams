<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;
    protected $table = 'item_list';

    public $timestamps = false;
    
    protected $fillable = [
        'itemname',
        'itemdescription',
    ];

    /**
     * E count lang niya pila ka rows ang table
     */
    public static function countRows()
    { return countTruncate(count(self::all())); }

    /**
     * Kuhaon lang niya tanan item sa table 
     */
    public static function getAllItems()
    { return self::all(); }

}
