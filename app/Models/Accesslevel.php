<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesslevel extends Model
{
    use HasFactory;
    protected $table = "accesslevel";


    public $timestamps = false;
    
    protected $fillable = [
        "accesslevel"
    ];

    /**
     * Returns accesslevel name using $id parameter
     * @param Int $id accesslevel_id
     * @return String
     * @example
     *     Accesslevel::getAccesslevelById("69" | 69);
     * 
     **/ 
    public static function getAccesslevelById(Int $id)
    {
        return self::select("accesslevel")
                    ->where("accesslevel_id", "=", $id)
                    ->first()["accesslevel"];
    }


}
