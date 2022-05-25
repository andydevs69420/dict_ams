<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FormRequiredPersonelComment extends Model
{
    use HasFactory;

    protected $table = "form_required_personel_comment";

    public $timestamps = true;
    
    protected $fillable = [
        "formrequiredpersonel_id",
        "comment",
    ];

    public static function getAllCommentsByFormID(Int $formid)
    {
        return self::join(
            DB::raw("
                    (
                        SELECT
                            uvd.*,
                            form_required_personel.formrequiredpersonel_id,
                            form_required_personel.personelstatus_id,
                            form_required_personel.updatedat,
                            form.form_id,
                            form.formtype_id,
                            form.createdat,
                            form.prnumber,
                            form.sainumber,
                            form.purpose,
                            fileembedded
                        FROM ((form_required_personel 
                        INNER JOIN (
                            SELECT 
                                userverificationdetails_id,
                                verificationstatus_id,
                                user.*
                            FROM user_verification_details 
                            INNER JOIN user ON user_verification_details.user_id = user.user_id
                        ) as uvd ON form_required_personel.userverificationdetails_id = uvd.userverificationdetails_id)
                        INNER JOIN form ON form_required_personel.form_id = form.form_id)
                    ) as frp
            "), "form_required_personel_comment.formrequiredpersonel_id", "=", "frp.formrequiredpersonel_id"
        )
        ->where("frp.form_id", "=", $formid)
        ->get();
    }

}
