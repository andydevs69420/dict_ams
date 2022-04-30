<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequiredPersonel extends Model
{
    use HasFactory;
    protected $table = "form_required_personel";

    public $timestamps = true;
    
    protected $fillable = [
        "budgetofficer_id",
        "requisitioner_id",
        "recommendingapprover_id",
    ];
}
