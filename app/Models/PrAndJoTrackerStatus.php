<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrAndJoTrackerStatus extends Model
{
    use HasFactory;
    protected $table = "pr_and_jo_tracker_status";

    public $timestamps = false;
    
    protected $fillable = [
        "prandjotrackerstatus",
    ];
}
