<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;  

class FormRequiredPersonel extends Model
{
    use HasFactory;
    protected $table = "form_required_personel";

    public $timestamps = false;
    
    protected $fillable = [
        "form_id",
        "userverificationdetails_id",
        "personelstatus_id",
        "updatedat"
    ];

    public static function getFormByUser(Int $userid)
    {
        return self::select(
            "form.*",
            "uvd.*",
            "personel_status.*"
        )
        ->join(
            "form", "form_required_personel.form_id", "=", "form.form_id"
        )
        ->join(
            DB::raw("
                (
                    SELECT 
                        user_verification_details.userverificationdetails_id,
                        user_verification_details.verificationstatus_id,
                        user.*
                    FROM
                        user_verification_details 
                        INNER JOIN user ON user_verification_details.user_id = user.user_id
                ) AS uvd
            "), "form_required_personel.userverificationdetails_id", "=", "uvd.userverificationdetails_id"
        )
        ->join(
            "personel_status", "form_required_personel.personelstatus_id", "=", "personel_status.personelstatus_id"
        )
        ->where("user_id", "=", $userid)
        ->groupBy("form.form_id")
        ->orderBy("form.form_id", "desc")
        ->get();
    }

    public static function getFormByFormID(Int $formid)
    {
        return self::select(
            "form_required_personel.*",
            "form.*",
            "uvd.*",
            "personel_status.*"
        )
        ->join(
            "form", "form_required_personel.form_id", "=", "form.form_id"
        )
        ->join(
            DB::raw("
                (
                    SELECT 
                        user_verification_details.userverificationdetails_id,
                        user_verification_details.verificationstatus_id,
                        user.*
                    FROM
                        user_verification_details 
                        INNER JOIN user ON user_verification_details.user_id = user.user_id
                ) AS uvd
            "), "form_required_personel.userverificationdetails_id", "=", "uvd.userverificationdetails_id"
        )
        ->join(
            "personel_status", "form_required_personel.personelstatus_id", "=", "personel_status.personelstatus_id"
        )
        ->where("form.form_id", "=", $formid)
        ->get();
    }

    public static function getRequiredPersonelsByFormID($formid)
    {
        return self::select(
            "form_required_personel.*",
            "uvd.*",
            "personel_status.*"
        )
        ->join(
            DB::raw("
                (
                    SELECT 
                        user_verification_details.userverificationdetails_id,
                        user_verification_details.verificationstatus_id,
                        user.*
                    FROM
                        user_verification_details 
                        INNER JOIN user ON user_verification_details.user_id = user.user_id
                ) AS uvd
            "), "form_required_personel.userverificationdetails_id", "=", "uvd.userverificationdetails_id"
        )
        ->join(
            "personel_status", "form_required_personel.personelstatus_id", "=", "personel_status.personelstatus_id"
        )
        ->where("form_id", "=", $formid)
        ->orderBy("formrequiredpersonel_id", "asc")
        ->get();
    }

}
