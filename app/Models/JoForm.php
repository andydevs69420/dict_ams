<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoForm extends Model
{
    use HasFactory;
    protected $table = 'jo_form';
    
    protected $fillable = [
        'form_id',
        // dungagi
    ];

    /*
        E count lang niya pila ka rows ang table
    */
    public static function countRows()
    { return countTruncate(count(self::all())); }

}
