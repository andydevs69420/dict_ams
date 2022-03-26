<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateFormController extends Controller
{
    //
    function index(Request $request)
    {
        // temporary data handler
        $data = ['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];
        return view('create-form/create-form',$data);
    }
}
