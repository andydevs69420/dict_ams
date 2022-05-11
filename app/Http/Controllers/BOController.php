<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationDetails;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class BOController extends Controller
{
    public function index(){
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.BO');
    }


    public function edit(){
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.edit-ors');
    }


}