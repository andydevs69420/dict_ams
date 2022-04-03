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
        
        $search = $request->input('search');

        $result = User::where(
            User::raw("CONCAT(lastname, ',', ' ', firstname, ' ', middleinitial)"),
            'like',
            '%'.$search.'%'
        )
        ->whereIn(
            'accesslevel',
            [
                /**
                 * Mao ni sila ang access level na pwede maka approve 
                 */
                11, // Budget Officer
            ]
        )->get();
    
        return json_encode($result);
    }

    // ========================== JO ==========================
    function jobOrder(Request $request)
    {
        // TODO: e restrict pag dili rquisitioner |  e redirect sa logout
    }

    // ========================== PR ==========================

    function purchaseRequest(Request $request)
    {
        $data = ['LoggedUserInfo' => getUserInfoById(session('LoggedUser'))];

        /*
            REFER to accesslevels table for id
            | Mao rani sila requisitioner
            ;

            4 := Project Officer
            5 := Focal
        */

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5']))
            return redirect('/logout');

        return view('newpurchaserequest/newpurchaserequest', $data);
    }

}
