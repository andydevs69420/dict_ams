<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerificationDetails extends Model
{
    use HasFactory;
    protected $table = 'user_verification_details';

    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'verificationstatus_id',
    ];

    /**
     *  E count lang niya ang user na verified ni admin

     *      verification_status table
     *           1 := PENDING
     *           2 := ACCEPTED
     *           3 := DECLINED
     */
    public static function countVerifiedUsers()
    { return countTruncate(count(self::all()->where('verificationstatus_id', '=', '2'))); }

    /**
     * E count lang niya ang user na pwede requisitioner
     *
     *   accesslevel table
     *        4 := PO
     *        5 := FOCAL
     *       13 := STAFF
     */
    public static function countRequisitioner()
    {
        return countTruncate(
            count(
                self::join(
                    'user', 'user_verification_details.user_id', '=', 'user.user_id'
                )
                ->whereIn('user.accesslevel_id', ['4', '5', '13'])
                ->get()
            )
        );
    }

    /**
     *  Kuhaon lang niya tanan user
     */ 
    public static function getAllUsers()
    {
        return self::join(
            'user', 'user_verification_details.user_id', '=', 'user.user_id',
        )
        ->join(
            'verification_status', 'user_verification_details.verificationstatus_id', '=', 'verification_status.verificationstatus_id'
        )
        ->orderBy('user_verification_details.verificationstatus_id', 'desc')
        ->get();
    }

    /**
     *  Kuhaon lang niya tanan user
     */ 
    public static function getAllRequisitioner()
    {
        return self::join(
            'user', 'user_verification_details.user_id', '=', 'user.user_id',
        )
        ->join(
            'verification_status', 'user_verification_details.verificationstatus_id', '=', 'verification_status.verificationstatus_id'
        )
        ->whereIn('user.accesslevel_id', ['4', '5', '13'])
        ->orderBy('user_verification_details.verificationstatus_id', 'desc')
        ->get();
    }

    /**
     * E count lang niya pila ka user base sa ge pass na verification status id
     */ 
    public static function countUserByVerificationStatusId(Int $statusid)
    {
        return countTruncate(count(
            self::where('verificationstatus_id', '=', $statusid)
            ->get()
        ));
    }

}
