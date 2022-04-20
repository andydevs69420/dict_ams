<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesslevel extends Model
{
    use HasFactory;
    protected $table = 'accesslevel';


    public $timestamps = false;
    
    protected $fillable = [
        'accesslevel'
    ];

    /*
        E return lang niya ang accesslevel name base sa id na ge pass
    */ 
    public static function getAccesslevelById(Int $id)
    {
        return self::select('accesslevel')
                    ->where('accesslevel_id', '=', $id)
                    ->first()['accesslevel'];
    }


}
