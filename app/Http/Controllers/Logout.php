<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logout extends Controller
{
    //
    function index(Request $request)
    {
        
        return redirect('/login');
    } 
}
