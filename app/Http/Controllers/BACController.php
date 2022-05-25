<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationDetails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PrForm;
use App\Models\JoForm;

use Auth;

class BACController extends Controller
{
    public function BACindex(){
        $form = PrForm::all();
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["8"]))
            return redirect()->to("/logout");

        return view('BACchairman.pqs-forms', compact('form'));
    }

}