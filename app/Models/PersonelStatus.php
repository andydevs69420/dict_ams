<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonelStatus extends Model
{
    use HasFactory;
    protected $table = "personel_status";

    public $timestamps = false;
    
    protected $fillable = [
        "personelstatus",
    ];
}
