<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequiredPersonel extends Model
{
    public $timestamps = true;
    
    protected $fillable = [
        'budgetofficer',
        'requisitioner',
        'recommendingapprover',
    ];
}
