<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationDetails extends Model
{
    use HasFactory;
    protected $table = "user_verification_details";

    public $timestamps = false;
    
    protected $fillable = [
        "user_id",
        "verificationstatus_id",
    ];

    
    /**
     * Counts the user which is already verified by the admin
     * @return String
     * @example
     *     verification_status table
     *         1 := PENDING
     *         2 := ACCEPTED
     *         3 := DECLINED
     *     UserVerificationDetails::countVerifiedUsers();
     **/
    public static function countVerifiedUsers()
    { return countTruncate(count(self::all()->where("verificationstatus_id", "=", "2"))); }


    /**
     * Counts user based on verificationtatus_id
     * @param Int $statusid verificationstatus_id
     * @return String
     * @example
     *     verification_status table
     *         1 := PENDING
     *         2 := ACCEPTED
     *         3 := DECLINED
     *     UserVerificationDetails::countUserByVerificationStatusId("69" | 69);
     */ 
    public static function countUserByVerificationStatusId(Int $statusid)
    {
        return countTruncate(count(
            self::where("verificationstatus_id", "=", $statusid)
            ->get()
        ));
    }


    /**
     * Counts all user which is also requisitioner
     * @return String
     * @example
     *     accesslevel table
     *          4 := PO
     *          5 := FOCAL
     *         13 := STAFF
     *     UserVerificationDetails::countRequisitioner();
     */
    public static function countRequisitioner()
    { return countTruncate(count(self::getAllRequisitioner())); }


    /**
     * Gets all user
     * @return Array
     * @example
     *     UserVerificationDetails::getALlUsers();
     * 
     **/ 
    public static function getAllUsers()
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->orderBy("user_verification_details.verificationstatus_id", "desc")
        ->get();
    }


    /**
     * Gets all user which is also requisitioner
     * @return Array
     * @example
     *      UserVerificationDetails::getAllRequisitioner();
     * 
     **/ 
    public static function getAllRequisitioner()
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->whereIn("user.accesslevel_id", ["4", "5", "13"])
        ->orderBy("user_verification_details.verificationstatus_id", "desc")
        ->get();
    }

    public static function isVerified(Int $userid)
    {
        return self::where("user_id", "=", $userid)
        ->where("verificationstatus_id", "=", "2")
        ->exists();
    }
}
