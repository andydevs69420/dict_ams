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
            case 4: // PO
            case 5: // FOCAL
                $valid_approval = [
                    12 // Accesslevel id sa Chief TOD
                ];
                break;
            case 13: // STAFF,
                $valid_approval = [
                    4 // Accesslevel id sa PO
                ];
                break;
        }
        
        $search = (!$search)? '' : $search;
        $result = getUsersByName(
            $search,
            /**
             * Mao ni sila ang access level na pwede maka approve 
             */
            $valid_approval
        );
    
        return $result;
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
            13 := Staff
        */

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5', '13']))
            return redirect('/logout');

        return view('new-purchase-request/new-purchase-request', $data);
    }

    function saveForm(Request $request)
    {

    }

    // ========================== JO ==========================
    function jobOrder(Request $request)
    {
        // TODO: e restrict pag dili rquisitioner |  e redirect sa logout
    }

    function viewPRForm(Request $request)
    {
        $data = [
            'PrFormData' => json_decode($request->input('data'),true)
        ];

        return view('new-purchase-request/view-pr-form', $data);
    }

}
