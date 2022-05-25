<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileImages extends Model
{
    use HasFactory;
    protected $table = 'user_profile_images';
    
    protected $fillable = [
        'user_verification_details_id',
        'path',
    ];

    public $timestamps = false;

    /**
     * Get profile image path by user id
     * @param Int $userId current user's id
     * @return String path
     **/
    public static function getProfileImagePathByUserId(Int $userid)
    {
        $verified_user_id = UserVerificationDetails::getUserByID($userid)->userverificationdetails_id;
        $path = self::where("user_verification_details_id", "=", $verified_user_id)
        ->first();

        if ($path)
            return $path->path;
        
        return "images/no-image.png";
    }

    public static function updatePath(Int $userid, String $path)
    {
        $verified_user_id = UserVerificationDetails::getUserByID($userid)->userverificationdetails_id;
        return self::where("user_verification_details_id", "=", $verified_user_id)
        ->update(["path" => $path]);
    }

    public static function deleteUserProfileImageByUserID(Int $userid)
    {
        return self::join(
            "user_verification_details", "user_profile_images.user_verification_details_id", "=", "user_verification_details.userverificationdetails_id"
        )
        ->where("user_verification_details.user_id", "=", $userid)
        ->update(["path" => "images/no-image.png"]);
    }

}
