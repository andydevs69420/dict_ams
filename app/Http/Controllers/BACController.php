<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationDetails;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class BACController extends Controller
{
    public function index(){
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["8"]))
            return redirect()->to("/logout");

        return view('BAC.BAC');
    }

    public function edit(){
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["8"]))
            return redirect()->to("/logout");

        return view('BAC.BAC');
    }


}