<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormType extends Model
{
    use HasFactory;
    protected $table = "form_type";


    public $timestamps = false;
    
    protected $fillable = [
        "formtype",
    ];
}
