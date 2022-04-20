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

    public static function getDesignationById(Int $id)
    {
        return self::select('designation')
                    ->where('designation_id', '=', $id)
                    ->first()['designation'];
    }
}
