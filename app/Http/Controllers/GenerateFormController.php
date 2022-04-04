<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


// e usa lang ang generate pr ug jo nga form

/*
    Makita si "getUserInfoById" , "findUserByName"  sa "app/Helpers/DatabaseHelpers"
*/

class GenerateFormController extends Controller
{   
    // ======================== GLOBAL ========================
    function searchForApproval(Request $request)
    {
        
        $search = $request->input('search');
        $search = (!$search)? '' : $search;

        $result = findUserByName(
            $search,
            [
                /**
                 * Mao ni sila ang access level na pwede maka approve 
                 */
                11, // Budget Officer
            ]
        );
    
        return $result;
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

        return view('newpurchaserequest/new-purchase-request', $data);
    }

    function viewPRForm(Request $request)
    {
        $data = [
            'PrFormData' => json_decode($request->input('data'),true)
        ];

        return view('newpurchaserequest/view-pr-form', $data);
    }

}
