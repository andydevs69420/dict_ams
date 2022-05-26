<?php

namespace App\Http\Controllers;

use App\Models\UserVerificationDetails;
use Illuminate\Http\Request;
use App\Models\User;

use Auth;

class BOController extends Controller
{
    public function index() {
        // $form = PrForm::all();

        // if  (!Auth::check())
        //     return redirect()->to("/login");

        // if (!Auth::user()->isBudgetOfficer())
        //     return redirect()->to("/dashboard");

        // return view('Budgetofficer.BO', compact('form'));
        return view('Budgetofficer.BO');
    }


    public function edit() {
        
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.edit-ors');
    }

    public function JoIndex(){
        $form = JoForm::all();

        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.BO-Joborder', compact('form'));
    }

    public function JoEdit(){
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["11"]))
            return redirect()->to("/logout");

        return view('Budgetofficer.edit-Joborder');
    }

}