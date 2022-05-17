<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequiredPersonel extends Model
{
    use HasFactory;
    protected $table = "form_required_personel";

    public $timestamps = false;
    
    protected $fillable = [
        "requisitioner_id",
        "budgetofficer_id",
        "recommendingapprover_id",
    ];


}
