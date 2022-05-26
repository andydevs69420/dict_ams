<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PqsItem extends Model
{
    use HasFactory;
    protected $table = 'pqs_item';
    
    protected $fillable = [
        'form_id',
    ];

   
    /**
     * Counts number of rows
     * @return String
     * @example
     *     PQSForm::countRows();
     * 
     **/
    public static function countRows()
    { return countTruncate(count(self::all())); }
    

    /**
     * Gets all item in table
     * @return Array[Array]
     * @example
     *     FormList::getAllPQSForms();
     **/
    public static function getAllPQSForms()
    { return self::all(); }

}
