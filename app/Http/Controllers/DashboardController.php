<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function index()
    {
        // E add gyud dapat ang access_level_id or e store sa session

        return view('dashboard/dashboard',['access_level_id' => 1]);
    }
}
