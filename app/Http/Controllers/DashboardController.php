<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    function index(Request $request)
    {
        // E add gyud dapat ang access_level_id or e store sa session
        
        // temporary
        $access__level = $request->input('username');
        $access__level__id = 1;

        if (strcmp($access__level,'admin') === 0)
            $access__level__id = 1;
        else if (strcmp($access__level,'so') === 0)
            $access__level__id = 2;
        
        $data = Array(
            'access_level_id'    => $access__level__id, 
            'access_level_title' => $access__level
        );

        return view('dashboard/dashboard', $data);
    }
}
