<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoItem extends Model
{
    use HasFactory;
    protected $table = 'jo_form';
    
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

}
