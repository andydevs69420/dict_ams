<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


/*
    Makita si "getUserById" sa "app/Helpers/DatabaseHelpers"
*/


class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
        // E add gyud dapat ang access_level_id or e store sa session

        // temporary
        $data = ['LoggedUserInfo' => getUserById(session('LoggedUser'))];

        return view('dashboard/dashboard', $data);
    }
}
