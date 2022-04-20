<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designation';

    public $timestamps = false;
    
    protected $fillable = [
        'designation'
    ];

    /*
        E return lang niya ang designation name base sa id na ge pass
    */ 
    public static function getDesignationById(Int $id)
    {
        return self::select('designation')
                    ->where('designation_id', '=', $id)
                    ->first()['designation'];
    }
}
