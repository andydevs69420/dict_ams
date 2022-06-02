<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = "form";
    protected $primaryKey = "form_id";


    public $timestamps = false;
    
    protected $fillable = [
        "formtype_id",
        "createdat",
        "prnumber",
        "sainumber",
        "purpose",
        "fileembedded",
    ];

    /**
     * Gets forms by requisitioner and formtype
     * @param Int $requisitionerid requisitioner's id
     * @param Int $formtypeid formtype id
     * @return Array
     **/
    public static function getForms(Int $requisitionerid, Int $formtypeid) 
    {
        return self::join(
            "form_type", "form.formtype_id", "=", "form_type.formtype_id"
        )
        ->join(
            "form_required_personel", "form.formrequiredpersonel_id", "=", "form_required_personel.formrequiredpersonel_id"
        )
        ->where("form_type.formtype_id", "=", $formtypeid)
        ->where("form_required_personel.requisitioner_id", "=", $requisitionerid)
        ->orderBy("form.form_id", "desc")
        ->orderBy("form.createdat", "desc")
        ->get();
    }

    /**
     * Gets forms by formtype
     * @param Int $formtypeid formtype id
     * @return Array
     **/
    public static function getAllFormsByFormType(Int $formtypeid) 
    {
        return self::join(
            "form_type", "form.formtype_id", "=", "form_type.formtype_id"
        )
        ->where("form_type.formtype_id", "=", $formtypeid)
        ->orderBy("form.form_id", "desc")
        ->orderBy("form.createdat", "desc")
        ->get();
    }

    /**
     * Gets forms by formtype
     * @param Int $formtypeid formtype id
     * @return Array
     **/
    public static function getAllApprovedForms() 
    {
        return self::join(
            "form_required_personel", "form.form_id", "=", "form_required_personel.form_id"
        )
        ->where("form_required_personel.personelstatus_id", "=", 1)
        ->orderBy("form.form_id", "asc")
        ->orderBy("form.createdat", "desc")
        ->get();
    }

    /**
     * Get for by id
     * @param Int $formid form id
     * @return Array
     **/
    public static function getFormById(Int $formid)
    {
        return self::join(
            "form_type", "form.formtype_id", "=", "form_type.formtype_id"
        )
        ->where("form.form_id", "=", $formid)
        ->first();
    }


    /**
     * Get pdf by id
     * @param Int $formid form id
     * @return Array
     **/
    public static function getPDFById(Int $formid)
    {   
        return self::select("fileembedded")->where("form_id", "=", $formid)->get();

    }

}
