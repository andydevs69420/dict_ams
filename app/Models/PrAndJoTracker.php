<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;  

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


    public static function getFormInfoByFormID(Int $formid)
    {
        return self::select(
            "form_query.*",
            "rQ.prandjotrackerstatus AS rQ_STATUS",
            "bO.prandjotrackerstatus AS bO_STATUS",
            "rA.prandjotrackerstatus AS rA_STATUS",
        )
        ->join(
            DB::raw("
            (
                SELECT 
                    form.form_id, 
                	form.formtype_id, 
                	form.createdat, 
                	form.prnumber, 
                	form.sainumber, 
                	form.purpose, 
                	form.formrequiredpersonel_id, 
                    form.fileembedded,
                	form_required_personel.requisitioner_id, 
                	form_required_personel.budgetofficer_id, 
                	form_required_personel.recommendingapprover_id 
                FROM form INNER JOIN form_required_personel ON 
                form.formrequiredpersonel_id = form_required_personel.formrequiredpersonel_id
            ) AS form_query
            ")
            , "pr_and_jo_tracker.form_id", "=", "form_query.form_id"
        )
        ->leftJoin(
            "pr_and_jo_tracker_status as rQ", "pr_and_jo_tracker.requesterstatus_id", "=", "rQ.prandjotrackerstatus_id"
        )
        ->leftJoin(
            "pr_and_jo_tracker_status as bO", "pr_and_jo_tracker.budgetofficerstatus_id", "=", "bO.prandjotrackerstatus_id"
        )
        ->leftJoin(
            "pr_and_jo_tracker_status as rA", "pr_and_jo_tracker.recommendingapprovalstatus_id", "=", "rA.prandjotrackerstatus_id"
        )
        ->where("form_query.form_id", "=", $formid)
        ->first();
    }
}
