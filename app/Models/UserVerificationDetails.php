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
     * Check if user is verified by id
     * @param Int $userId current user's id
     * @return Array[Array] 
     * @example
     *     UserVerificationDetails::isVerified(69);
     **/
    public static function isVerified(Int $userid)
    {
        return self::where("user_id", "=", $userid)
        ->where("verificationstatus_id", "=", "2")
        ->exists();
    }
    
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
     * Counts all user (verified) which is also requisitioner
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
     * Get user by user_id
     * @param Request $request request
     * @return Array
     * @example
     *    UserVerificationDetails::getUserByUserId(69);
     **/
    public static function getUserByID(Int $userid)
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->where("user.user_id", "=", $userid)
        ->first();
    }

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
     * Gets all user (verified) which is also requisitioner
     * @return Array
     * @example
     *     accesslevel table
     *          4 := PO
     *          5 := FOCAL
     *         13 := STAFF
     *     UserVerificationDetails::getAllRequisitioner();
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


    /**
     * Gets all user (verified) which is also a budget officer
     * @return Array
     * @example
     *     accesslevel table
     *          11 := BUDGET OFFICER
     *     UserVerificationDetails::getAllBudgetOfficer();
     * 
     **/ 
    public static function getAllBudgetOfficer()
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->where("user.accesslevel_id", "=", "11")
        ->where("verification_status.verificationstatus_id", "=", "2")
        ->get();
    }



    /**
     * Gets all user (verified) which is also a budget officer
     * @return Array
     * @example
     *     accesslevel table
     *          11 := BUDGET OFFICER
     *     UserVerificationDetails::getAllBudgetOfficer();
     * 
     **/ 
    public static function getAllCanvasser()
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->where("user.accesslevel_id", "=", "9")
        ->where("verification_status.verificationstatus_id", "=", "2")
        ->get();
    }

    /**
     * Gets all user (verified) which is also a recommending approver
     * @return Array
     * @example
     *     accesslevel table
     *          if current user's accesslevel id is 13(STAFF)
     *              hes/her recommending approver is PO(4)
     *         if current user's accesslevel id is 5(FOCAL) or 4(PO)
     *             hes/her recommending approver is CHEIF TOD(12)
     *     UserVerificationDetails::getAllRecommendingApprovalByAccesslevelId(69);
     * 
     **/ 
    public static function getAllRecommendingApprovalByAccesslevelId(Int $userAccesslevelId)
    {
        return self::join(
            "user", "user_verification_details.user_id", "=", "user.user_id",
        )
        ->join(
            "verification_status", "user_verification_details.verificationstatus_id", "=", "verification_status.verificationstatus_id"
        )
        ->where("user.accesslevel_id", "=", ($userAccesslevelId === 13)? "4" : "12")
        ->where("verification_status.verificationstatus_id", "=", "2")
        ->get();
    }
}
