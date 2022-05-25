<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequiredPersonelComment extends Model
{
    use HasFactory;

    protected $table = "form_required_personel_comment";

    public $timestamps = true;
    
    protected $fillable = [
        "formrequiredpersonel_id",
        "comment",
    ];
}
