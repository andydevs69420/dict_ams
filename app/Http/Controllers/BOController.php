<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationDetails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PrItem;
use App\Models\JoItem;

use Auth;

class BOController extends Controller
{
    public function index(){
        $form = PrItem::all();

        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.BO',compact('form'));
    }

    public function JoIndex(){
        $form = JoItem::all();

        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.BO-Joborder', compact('form'));
    }

}