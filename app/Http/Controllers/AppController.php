<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\UserProfileImages;
use App\Models\PqsItem;

class AppController extends Controller
{
    

    /**
     * Requisitioner -> index
     * @param Request $request request
     * @return View
     **/
    public function requisitioner(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        return view("app.requisitioner.requisitioner");
    }



    /**
     * Supply Officer Form List -> index
     * @param Request $request request
     * @return View
     *
     **/
    public function so_approvedforms(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["10"]))
            return redirect()->to("/logout");

        return view("supplyofficer.so-forms");
    }

    
    /* user subdir ----> */
                /**
                 * Add so-forms -> generatepqs
                 * @param Request $request request
                 * @return view
                 * @example
                 *     Only "supply officer" has access to this page, accesslevel = 10
                 *
                 **/
                public function so_approvedforms_generatepqs(Request $request)
                {   
                    $id = json_decode($request->input("data"),true);
                    $pritems = PrItem::getItemsByFormId($id["formid"])->toArray();
                    $joitems = JoItem::getItemsByFormId($id["formid"])->toArray();
                    $items = array_merge($pritems, $joitems);

                    $date =  $id["date"];
                    $canvasser = UserVerificationDetails::getUserByID($id["canvasserid"]);
                    $form = Form::getFormById($id["formid"]);
                    $data = [
                        "formdata" => $form,
                        "itemdata" => $items,
                        "canvasserdata" => $canvasser,
                        "date" => $date,
                    ];

                    return view("supplyofficer.view-price-quotation-sheet", $data);
                }



                /**
                 * Add so-forms -> viewform
                 * @param Request $request request
                 * @return view
                 * @example
                 *     Only "supply officer" has access to this page, accesslevel = 10
                 *
                 **/
                public function so_approvedforms_viewform(Request $request)
                {   

                    
                    $id = json_decode($request->input("data"),true);
                    $form = Form::getFormById($id["formid"]);


                    $data["pr_items"] = PrItem::getItemsByFormId($id["formid"])->toArray();
                    // $frp = FormRequiredPersonel::getRequiredPersonelsByFormID($id["formid"]);
                    
                    // $data["rQ_data"] = $frp[0]->toArray();
                    // $data["bO_data"] = $frp[1]->toArray();
                    // $data["rA_data"] = $frp[2]->toArray();
                    $formdata = [
                        "form" => $form,
                        "form_data" => $data,
                    ];
                    return view("supplyofficer.so-view-form", $formdata);
                }





                /**
                 * Add so-forms -> viewform
                 * @param Request $request request
                 * @return view
                 * @example
                 *     Only "supply officer" has access to this page, accesslevel = 10
                 *
                 **/
                public function so_approvedforms_uploadpqs(Request $request)
                {   
 
                    # Verification
                    if  (!Auth::check())
                        return redirect()->to("/login");
                    
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["10"]))
                        return redirect()->to("/dashboard");

                    if (hasNull($request, ["canvasser", "file-upload"]))
                        return back()->with(["info" => "Missing required parameter(s)."]);


                    # Get Field Values
                    $form_id      = $request->input("form-id");
                    $file    = $request->file("file-upload");


                    # Get File (PDF)
                    $filename = Carbon::now()->toDateString().".".$file->getClientOriginalExtension();
                    $truepath = "storage/form-files/".$filename;
                    $filepath = $file->storeAs("public/form-files", $filename);
                    if (!$filepath)
                        return back()->with(["info" => "Something went wrong while uploading file!"]);
                
                    
                    
                    # Create PqsItem (insert)

                    $pqsitemdata = [];
                    $pqsitemdata["form_id"]     = $form_id;
                    PqsItem::create($pqsitemdata);
                    

                    return view("supplyofficer.so-forms");
                    
                }


    /**
     * BAC Chair PQS List -> index
     * @param Request $request request
     * @return View
     *
     **/
    public function bac_chair_pqsforms(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["8"]))
            return redirect()->to("/logout");

        return view("bac-chairman.pqs-forms");
    }
}
