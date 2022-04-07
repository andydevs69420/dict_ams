<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;


// e usa lang ang generate pr ug jo nga form

/*
    Makita si "getUserById" , "getUsersByName"  sa "app/Helpers/DatabaseHelpers"
*/

class GenerateFormController extends Controller
{   
    // ======================== GLOBAL ========================
    function searchForApproval(Request $request)
    {
        $valid_approval = [];

        $reqrid = $request->input('requisitionerid');
        $search = $request->input('search');

        switch ((Int) $reqrid)
        {
            case 4:
            case 5:
                $valid_approval = [
                    12 // ID sa Chief TOD
                ];
                break;
        }
        
        $search = (!$search)? '' : $search;

        error_log("searchForApproval: ====================> " . $reqrid);

        $result = getUsersByName(
            $search,
            /**
             * Mao ni sila ang access level na pwede maka approve 
             */
            $valid_approval
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
        $data = ['LoggedUserInfo' => getUserById(session('LoggedUser'))];

        /*
            REFER to accesslevels table for id
            | Mao rani sila requisitioner
            ;

            4 := Project Officer
            5 := Focal
        */

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5']))
            return redirect('/logout');

        return view('new-purchase-request/new-purchase-request', $data);
    }

    function viewPRForm(Request $request)
    {
        $data = [
            'PrFormData' => json_decode($request->input('data'),true)
        ];

        return view('new-purchase-request/view-pr-form', $data);
    }

}
