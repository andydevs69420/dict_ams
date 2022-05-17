<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrAndJoTracker extends Model
{
    use HasFactory;
    protected $table = "pr_and_jo_tracker";

    public $timestamps = false;
    
    protected $fillable = [
        "form_id",
        "requester_status_id",
        "budget_officer_status_id",
        "recommending_approval_status_id",
    ];
}
