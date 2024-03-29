<?php

namespace App\Models;

use Carbon\Carbon;

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


    /**
     * Gets form by user id and formtypid
     * @param Int $userid user's id
     * @param Int formtype
     * @return FormRequiredPersonel
     * @example
     *     FormRequiredPersonel::getFormByUserAndFormType(Auth::user()->iser_id, $formtype_id);
     **/
    public static function getFormByUserAndFormType(Int $userid, Int $formtype)
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
        ->where("formtype_id", "=", $formtype)
        ->groupBy("form.form_id")
        ->orderBy("form.form_id", "desc")
        ->get();
    }

    /**
     * Gets form by form and user's id
     * @param Int $formid
     * @param Int $userid user's id
     * @return FormRequiredPersonel
     * @example
     *     FormRequiredPersonel::getFormByFormAndUserID($form_id, Auth::user()->user_id);
     **/
    public static function getFormByFormAndUserID(Int $formid, $userid)
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
        ->where("user_id", "=", $userid)
        ->first();
    }

    /**
     * Gets form by form id
     * @param Int $formid form_id
     * @return FormRequiredPersonel
     * @example
     *      FormRequiredPersonel::getFormByFormID(1)
     **/
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
        ->orderBy("form_required_personel.formrequiredpersonel_id")
        ->get();
    }

    /**
     * Gets form's required personel by formid per/ form ex: (Requisitioner, budget officer, recoomending approval)
     * @param Int $formid
     * @return Arrray[user] array of required personel
     * @example
     *     FormRequiredPersonel::getRequiredPersonelsByFormID(1);
     **/
    public static function getRequiredPersonelsByFormID(Int $formid)
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


    public static function isFormHasStatusFor(Int $formid, Int $statusid, Array $accesslevels)
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
        ->where("personel_status.personelstatus_id", "=", $statusid)
        ->whereIn("uvd.accesslevel_id", $accesslevels)
        ->exists();
    }

    /**
     * Check's if requisitioner has required action
     * @param Int $formid form's id
     * @return bool
     **/
    public static function isFormHasActionForRequisitioner(Int $formid)
    {
        return (
            self::isFormHasStatusFor($formid, 1, config("global.VALID_REQUISITIONER")) &&
            self::isFormHasStatusFor($formid, 2, [ config("global.BUDGET_OFFICER") ])
        );
    }

    /**
     * Check's if budget officer has required action
     * @param Int $formid form's id
     * @return bool
     **/
    public static function isFormHasActionForBO(Int $formid)
    {
        return (
            self::isFormHasStatusFor($formid, 1, config("global.VALID_REQUISITIONER")) &&
            self::isFormHasStatusFor($formid, 2, [ config("global.BUDGET_OFFICER") ])
        );
    }

    /**
     * Check's if recommending apporoval has required action
     * @param Int $formid form's id
     * @return bool
     **/
    public static function isFormHasActionForRA(Int $formid)
    {
        return (
            self::isFormHasStatusFor($formid, 1, config("global.VALID_VALID_BUDGET_OFFICER")) &&
            self::isFormHasStatusFor($formid, 2, [ config("global.BUDGET_OFFICER") ])
        );
    }

    public static function updatePersonelStatus(Int $formid, Int $userid, Int $status)
    {
        return self::join(
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
        ->where("user_id", "=", $userid)
        ->update([ "form_required_personel.personelstatus_id" => $status, "updatedat" => Carbon::now() ]);
    }

}
