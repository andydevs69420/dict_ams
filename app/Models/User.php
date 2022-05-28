<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';
    protected $guard = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'middleinitial',
        'designation_id',
        'accesslevel_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Checks if user is requisitioner
     * @return bool
     **/
    public static function isRequisitioner()
    { return in_array(Auth::user()->accesslevel_id, [4, 5, 13]); }

    /**
     * Checks if user is budget officer
     * @return bool
     **/
    public static function isBudgetOfficer()
    { return in_array(Auth::user()->accesslevel_id, [11]); }

    /**
     * Checks if user is admin
     * @return bool
     **/
    public static function isAdmin()
    { return in_array(Auth::user()->accesslevel_id, [14]); }

}
