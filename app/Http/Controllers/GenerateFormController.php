<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


// e usa lang ang generate pr ug jo nga form

class GenerateFormController extends Controller
{   
    // ======================== GLOBAL ========================
    function searchForApproval(Request $request)
    {
        
        /*
            mao ni sila ang access level na pwede maka approve
        */
        $valid_access_levels = [
            11, // BO
        ];

        $search = $request->input('search');

        $result = User::where(
            User::raw("CONCAT(lastname, ',', ' ', firstname, ' ', middleinitial)"),
            'like',
            '%'.$search.'%'
        )
        ->whereIn(
            'accesslevel',
            $valid_access_levels
        )->get();
    
        return json_encode($result);
    }

    // ========================== JO ==========================
    function jobOrder(Request $request)
    {
        // TODO: e restrict pag dili rquisitioner |  e redirect sa login
    }

    // ========================== PR ==========================

    function purchaseRequest(Request $request)
    {
        // TODO: e restrict pag dili rquisitioner |  e redirect sa login
        // temporary data handler
        $data = [
            'LoggedUserInfo'=>User::where('id', '=', session('LoggedUser'))->first()
        ];
        return view('newpurchaserequest/newpurchaserequest',$data);
    }

}
