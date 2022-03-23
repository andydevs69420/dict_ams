<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NewPurchaseRequestController extends Controller
{
    //
    function index(Request $request)
    {
        // temporary data handler
        $data = ['LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()];

        return view('new-purchase-request/new-purchase-request',$data);
    }
}
