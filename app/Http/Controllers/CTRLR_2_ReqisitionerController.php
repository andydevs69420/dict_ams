<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

// =========== USER DEPS ===========
use Auth;
use App\Models\Designation;
use App\Models\Accesslevel;
use App\Models\UserVerificationDetails;

// =========== FORM DEPS ===========
use App\Models\Form;
use App\Models\PrItem;
use App\Models\JoItem;
use App\Models\FormRequiredPersonel;
use App\Models\FormRequiredPersonelComment;

class CTRLR_2_ReqisitionerController extends Controller
{
    // ========================================= PURCHASE REQUEST ========================================
    /**
     * Purchase Request -> index
     * @param Request $request request
     * @return View
     * @example
     *     Only "requisitioner" has access to this page
     *          Accesslevel table
     *              4 := Project Officer
     *              5 := Focal
     *             13 := Staff
     **/
    function purchaseRequest(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        #============================
        # Only requisitioner can    =
        # create pr form.           =
        #============================
        if (!Auth::user()->isRequisitioner())
            return redirect()->to("/dashboard");

        return view("app.role__requisitioner.purchase-request.new-purchase-request");
    }
    /* purchase request subdir ----> */

    function viewPRFormList(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if (!Auth::check())
            return redirect()->to("/login");

        #===============================
        # Only requisitioner can view  =
        # pr form list.                =
        #===============================
        if (!Auth::user()->isRequisitioner())
            return redirect()->to("/dashboard");

        return view("app.role__requisitioner.purchase-request.purchase-request-list");
    }

    /**
     * View pr form.
     * @param String $prformid pr form id
     * @return View
     **/
    function viewPRFormInfo(String $prformid)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if (!Auth::check())
            return redirect()->to("/login");

        #==============================
        # Only requisitioner can view =
        # pr form.                    =
        #==============================
        if (!Auth::user()->isRequisitioner())
            return redirect()->to("/dashboard");

        $form_id = $prformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try
        {
            $form_id = (Int) Crypt::decrypt($form_id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
            return redirect()->to("/dashboard");
        }

        $data = FormRequiredPersonel::getFormByFormAndUserID($form_id, Auth::user()->user_id)->toArray();
        #=========================
        # Get items.             =
        #=========================
        $data["pr_items"] = PrItem::getItemsByFormId($form_id)->toArray();

        #=========================
        # Get required personel. =
        #=========================
        $frp = FormRequiredPersonel::getRequiredPersonelsByFormID($form_id);
        $data["rQ_data"] = $frp[0]->toArray();
        $data["bO_data"] = $frp[1]->toArray();
        $data["rA_data"] = $frp[2]->toArray();

        return response(view("app.role__requisitioner.purchase-request.purchase-request-form-info", $data));
    }

    /**
     * Cancel pr form.
     * @param String $prformid pr form id
     * @return View
     **/
    public function cancelPRForm(String $prformid)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if (!Auth::check())
            return redirect()->to("/login");

        #==============================
        # Only requisitioner can view =
        # pr form.                    =
        #==============================
        if (!Auth::user()->isRequisitioner())
            return redirect()->to("/dashboard");

        $form_id = $prformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try
        {
            $form_id = (Int) Crypt::decrypt($form_id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
            return redirect()->to("/dashboard");
        }

        #==================================
        # If form is already canceled     =
        # or BO has taken his/her action  =
        # for the form, MARK as NO ACTION =
        # REQUIRED.                       =
        #==================================
        if (!FormRequiredPersonel::isFormHasActionForRequisitioner($form_id))
            return back()->with(["info" => "Form has no required action!"]);

        if (!FormRequiredPersonel::updatePersonelStatus($form_id, Auth::user()->user_id, 3))
            return back()->with(["info" => "Something went wrong while cancellation!"]);

        return back()->with(["info" => "Form was canceled!"]);

    }
  // pr subroutine ----->

    /**
     * Loads comment dynamically
     * @param Request $request request
     * access: AJAX|POST
     **/
    function loadPrFormInfoComment(String $hashid)
    {
        #============================
        # Return false if not       =
        # login or expired.         =
        #============================
        if (!Auth::check())
            return false;

        #==============================
        # Only requisitioner can view =
        # his/her form comments.      =
        #==============================
        if (!Auth::user()->isRequisitioner())
            return false;

        $form_id = $hashid;

        #===============================
        # Decrypt form_id. If invalid, =
        # return false                 =
        #===============================
        try
        {
            $form_id = (Int) Crypt::decrypt($form_id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
            return false;
        }

        $data = FormRequiredPersonelComment::getAllCommentsByFormID($form_id);

        #======================
        # Return view.        =
        #======================
        foreach($data as $comment_data)
            echo view("components.comment-bubble", $comment_data);
    }

    /**
     * Adds comment dynamically
     * @param Request $request request
     * @return boolean
     * access: AJAX|POST
     **/
    function addPrFormInfoComment(Request $request)
    {
        #============================
        # Return false if not       =
        # login or expired.         =
        #============================
        if (!Auth::check())
            return false;

        #==============================
        # Only requisitioner can add  =
        # his/her form comments.      =
        #==============================
        if (!Auth::user()->isRequisitioner())
            return false;

        #==============================
        # Return false if any of      =
        # these field has null value. =
        #==============================
        if (hasNull($request, ["frp", "comment"]))
            return false;

        $form_required_personel = $request->input("frp");
        $comment                = $request->input("comment");

        #==============================
        # Decypt frp_id. If invalid,  =
        # return false                =
        #==============================
        try
        {
            $form_required_personel = (Int) Crypt::decrypt($form_required_personel);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
            return false;
        }

        $signal = FormRequiredPersonelComment::create([
            "formrequiredpersonel_id" => $form_required_personel,
            "comment"                 => $comment
        ]);

        return (bool) $signal;
    }

    /**
     * Upload pr form
     * uses: "POST" request
     * @param Request $request request
     * @return View
     **/
    function uploadPRForm(Request $request)
    {

        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        #============================
        # Only requisitioner can    =
        # upload pr form.           =
        #============================
        if (!Auth::user()->isRequisitioner())
            return redirect()->to("/dashboard");

        #============================
        # Go back to page if        =
        # any field has null value. =
        #============================
        if (hasNull($request, ["stock", "unit", "description", "qty", "unitcost", "totalcost", "purpose" , "requester" , "budget-officer", "recommending-approval", "file-upload"]) || !request("file-upload")->isValid())
            return back()->with(["info" => "Missing required parameter(s)."]);

        #=======================
        # Item fields          =
        #=======================
        $num_of_rows    = count($request->input("stock"));
        $stck_col       = $request->input("stock");
        $unit_col       = $request->input("unit");
        $desc_col       = $request->input("description");
        $qnty_col       = $request->input("qty");
        $unitc_cost_col = $request->input("unitcost");
        $total_cost_col = $request->input("totalcost");


        #=======================
        # Other fields         =
        #=======================
        $purpose = $request->input("purpose");
        $rQ_id   = $request->input("requester");
        $bO_id   = $request->input("budget-officer");
        $rA_id   = $request->input("recommending-approval");
        $file    = $request->file("file-upload");


        #============================================
        # Store file first to prevent errors.       =
        #============================================
        $filename = Carbon::now()->toDateString()."-".$file->getClientOriginalName();
        $truepath = "storage/form-files/".$filename;
        $filepath = $file->storeAs("public/form-files", $filename);
        if (!$filepath)
            return back()->with(["info" => "Something went wrong while uploading file!"]);

        #=================================
        # step 1 insert form             =
        #=================================
        $step1_data = [];
        $step1_data[ "formtype_id"             ] = 1; # PR := 1
        $step1_data[ "createdat"               ] = Carbon::now();
        $step1_data[ "prnumber"                ] = "";
        $step1_data[ "sainumber"               ] = "";
        $step1_data[ "purpose"                 ] = $purpose;
        $step1_data[ "fileembedded"            ] = $filepath;
        $form_id = Form::create($step1_data)->id;

        #=================================
        # step 2 insert items to pr form =
        #=================================
        for ($idx = 0; $idx < $num_of_rows; $idx++)
        {
            $step2_data = [];
            $step2_data[ "form_id"   ] = $form_id;
            $step2_data[ "stockno"   ] = $stck_col[$idx];
            $step2_data[ "unit"      ] = $unit_col[$idx];
            $step2_data[ "item"      ] = $desc_col[$idx];
            $step2_data[ "quantity"  ] = $qnty_col[$idx];
            $step2_data[ "unitcost"  ] = $unitc_cost_col[$idx];
            $step2_data[ "totalcost" ] = $total_cost_col[$idx];
            PrItem::create($step2_data);
        }

        #=================================
        # step 3 save required personel  =
        #=================================
        // requisitioner
        FormRequiredPersonel::create([
            "form_id"                    => $form_id,
            "userverificationdetails_id" => $rQ_id,
            "personelstatus_id"          => 1,
            "updatedat"                  => Carbon::now()
        ]);
        // budget officer
        FormRequiredPersonel::create([
            "form_id"                    => $form_id,
            "userverificationdetails_id" => $bO_id,
            "personelstatus_id"          => 2,
            "updatedat"                  => null
        ]);
        // recommending approval
        FormRequiredPersonel::create([
            "form_id"                    => $form_id,
            "userverificationdetails_id" => $rA_id,
            "personelstatus_id"          => 2,
            "updatedat"                  => null
        ]);

        return redirect()->to("/requisitioner/purchaserequest/viewprforminfo/" . Crypt::encrypt($form_id) . "/view");
    }

    /**
     * View pr form -> index
     * uses: "GET" request
     * @param Request $request request
     * @return View
     **/
    function viewPrForm(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # yes login or expired.     =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        #==============================
        # Return 404 if any of these  =
        # fields is null.             =
        #==============================
        if (hasNull($request, ["items", "purpose", "requester", "budget-officer", "recommending-approval"]))
            return abort(403);

        #============================
        # convert items to json     =
        #============================
        $items = json_decode($request->input("items"),true);


        $rQ = UserVerificationDetails::getUserByID($request->input("requester"));
        $bO = UserVerificationDetails::getUserByID($request->input("budget-officer"));
        $rA = UserVerificationDetails::getUserByID($request->input("recommending-approval"));

        #============================
        # Return 403 if fields      =
        # (requisitioner,           =
        # budget-officer,           =
        # recommending-approval) is =
        # null                      =
        #============================
        if (!($rQ || $bO || $rA))
            return abort(403);

        #============================
        # Arranged data             =
        #============================
        $data = [];
        $data[               "items"               ] = $items;
        $data[              "purpose"              ] = $request->input("purpose");
        $data[           "requester_name"          ] = formatName($rQ);
        $data[       "requester_designation"       ] = Designation::getDesignationByID($rQ->designation_id);
        $data[        "budget_officer_name"        ] = formatName($bO);
        $data[    "budget_officer_designation"     ] = Designation::getDesignationByID($bO->designation_id);
        $data[    "recommending_approval_name"     ] = formatName($rA);
        $data[ "recommending_approval_designation" ] = Designation::getDesignationByID($rA->designation_id);
        return view("app.role__requisitioner.purchase-request.view-purchase-request-form", $data);
    }

    // ========================================= JOB ORDER ===============================================
    /**
    * Job Order -> index
    * @param Request $request request
    * @return View
    * @example
    *     Only "requisitioner" has access to this page
    *          Accesslevel table
    *              4 := Project Officer
    *              5 := Focal
    *             13 := Staff
    **/
    function jobOrder(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
        return redirect()->to("/login");

        #============================
        # Only requisitioner can    =
        # create jo form.           =
        #============================
        if (!Auth::user()->isRequisitioner())
        return redirect()->to("/dashboard");

        return view("app.role__requisitioner.job-order.new-job-order");
        }
        /* job order subdir ----> */
        function viewJOFormList()
        {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if (!Auth::check())
          return redirect()->to("/login");

        #===============================
        # Only requisitioner can view  =
        # pr form list.                =
        #===============================
        if (!Auth::user()->isRequisitioner())
          return redirect()->to("/dashboard");

        return view("app.role__requisitioner.job-order.job-order-list");
    }

    /**
    * View jo form inf
    * @param Request $request request
    * @return View
    **/
    function viewJOFormInfo(String $joformid)
    {

        if (!Auth::check())
          return redirect()->to("/login");

        # Verification
        if (!Auth::user()->isRequisitioner())
          return redirect()->to("/dashboard");

        $form_id = $joformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try
        {
          $form_id = (Int) Crypt::decrypt($form_id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
          return redirect()->to("/dashboard");
        }

        $data = FormRequiredPersonel::getFormByFormAndUserID($form_id, Auth::user()->user_id)->toArray();

        $data["jo_items"] = JoItem::getItemsByFormId($form_id)->toArray();
        $frp = FormRequiredPersonel::getRequiredPersonelsByFormID($form_id);

        $data["requester_data"]    = $frp[0]->toArray();
        $data["authofficial_data"] = $frp[1]->toArray();

        return view("app.role__requisitioner.job-order.job-order-form-info", $data);
    }


    /**
    * Upload jo form
    * uses: "POST" request
    * @param Request $request request
    * @return View
    **/
    function uploadJOForm(Request $request)
    {

        # Verification
        if (!Auth::check())
          return redirect()->to("/login");

        if (!Auth::user()->isRequisitioner())
          return redirect()->to("/dashboard");

        if (hasNull($request, ["stock", "unit", "description", "qty", "unitcost", "amount", "requester-name", "authofficial-name"]))
          return back()->with(["info" => "Missing required parameter(s)."]);


        # Get Field Values
        $num_of_rows      = count($request->input("stock"));
        $stock_col        = $request->input("stock");
        $unit_col         = $request->input("unit");
        $desc_col         = $request->input("description");
        $qnty_col         = $request->input("qty");
        $unitc_cost_col   = $request->input("unitcost");
        $total_cost_col   = $request->input("amount");

        $requester_id     = $request->input("requester-name");
        $authorizedoff_id = $request->input("authofficial-name");
        $file = $request->file("file-upload");


        # Get File (PDF)
        $filename = Carbon::now()->toDateString().".".$file->getClientOriginalExtension();
        $truepath = "storage/form-files/".$filename;
        $filepath = $file->storeAs("public/form-files", $filename);
        if (!$filepath)
          return back()->with(["info" => "Something went wrong while uploading file!"]);


        # Create Form (insert)
        $form_data = [];
        $form_data["formtype_id"]       = 2; # JO := 2
        $form_data["createdat"]         = Carbon::now();
        $form_data["prnumber"]          = "";
        $form_data["sainumber"]         = "";
        $form_data["purpose"]           = "";
        $form_data["fileembedded"]      = $filepath;
        $form_id = Form::create($form_data)->id;


        # Create JoItem (insert)
        for ($idx = 0; $idx < $num_of_rows; $idx++)
        {
          $joitemdata = [];
          $joitemdata["form_id"]     = $form_id;
          $joitemdata["itemno"]      = $stock_col[$idx];
          $joitemdata["unit"]        = $unit_col[$idx];
          $joitemdata["description"] = $desc_col[$idx];
          $joitemdata["quantity"]    = $qnty_col[$idx];
          $joitemdata["unitcost"]    = $unitc_cost_col[$idx];
          $joitemdata["amount"]      = $total_cost_col[$idx];
          JoItem::create($joitemdata);
        }

        # Save in FormRequiredPersonel
        // requisitioner
        FormRequiredPersonel::create([
          "form_id"                    => $form_id,
          "userverificationdetails_id" => $requester_id,
          "personelstatus_id"          => 1,
          "updatedat"                  => Carbon::now()
        ]);

        // bo
        FormRequiredPersonel::create([
          "form_id"                    => $form_id,
          "userverificationdetails_id" => 3,
          "personelstatus_id"          => 2,
          "updatedat"                  => null
        ]);

        // authorized official
        FormRequiredPersonel::create([
          "form_id"                    => $form_id,
          "userverificationdetails_id" => $authorizedoff_id,
          "personelstatus_id"          => 2,
          "updatedat"                  => null
        ]);

        return redirect()->to("/requisitioner/joborder/viewjoforminfo/" . Crypt::encrypt($form_id) . "/view");
    }

    /**
    * Cancel pr form.
    * @param String $prformid pr form id
    * @return View
    **/
    public function cancelJOForm(String $joformid)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if (!Auth::check())
          return redirect()->to("/login");

        #==============================
        # Only requisitioner can view =
        # pr form.                    =
        #==============================
        if (!Auth::user()->isRequisitioner())
          return redirect()->to("/dashboard");

        $form_id = $joformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try
        {
          $form_id = (Int) Crypt::decrypt($form_id);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
          return redirect()->to("/dashboard");
        }

        #==================================
        # If form is already cancelled    =
        # or BO has taken his/her action  =
        # for the form, MARK as NO ACTION =
        # REQUIRED.                       =
        #==================================
        if (!FormRequiredPersonel::isFormHasActionForBO($form_id))
          return back()->with(["info" => "Form has no required action!"]);

        if (!FormRequiredPersonel::updatePersonelStatus($form_id, Auth::user()->user_id, 3))
          return back()->with(["info" => "Something went wrong while cancellation!"]);

        return back()->with(["info" => "Form was canceled!"]);
    }

    // jo subroutine
    public static function loadJoFormInfoComment(String $hashid)
    {
        #============================
        # Return false if not       =
        # login or expired.         =
        #============================
        if (!Auth::check())
          return false;

        $formid = $hashid;

        #===============================
        # Decrypt form_id. If invalid, =
        # return false                 =
        #===============================
        try
        {
          $formid = (Int) Crypt::decrypt($formid);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
          return false;
        }

        $data = FormRequiredPersonelComment::getAllCommentsByFormID($formid);

        #======================
        # Return view.        =
        #======================
        foreach($data as $comment_data)
          echo view("components.comment-bubble", $comment_data);
        }

        public function addJoFormInfoComment(Request $request)
        {
        #============================
        # Return false if not       =
        # login or expired.         =
        #============================
        if (!Auth::check())
          return false;

        #==============================
        # Return false if any of      =
        # these field has null value. =
        #==============================
        if (hasNull($request, ["frp", "comment"]))
          return false;

        $form_required_personel = $request->input("frp");
        $comment                = $request->input("comment");

        #==============================
        # Decypt frp_id. If invalid,  =
        # return false                =
        #==============================
        try
        {
          $form_required_personel = (Int) Crypt::decrypt($form_required_personel);
        }
        catch(\Illuminate\Contracts\Encryption\DecryptException $e)
        {
          return false;
        }

        $signal = FormRequiredPersonelComment::create([
          "formrequiredpersonel_id" => $form_required_personel,
          "comment"                 => $comment
        ]);

        return (bool) $signal;
    }
    /**
    * View jo form -> index
    * @param Request $request request
    * @return View
    **/
    function viewJOForm(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # yes login or expired.     =
        #============================
        if  (!Auth::check())
        return redirect()->to("/login");

        #==============================
        # Return 404 if any of these  =
        # fields is null.             =
        #==============================
        // if (hasNull($request, ["items", "purpose", "requester", "budget-officer", "recommending-approval"]))
        //     return abort(403);

        $data = [
          "JoFormData" => json_decode($request->input("data"),true)
        ];

        return view("app.role__requisitioner.job-order.view-jo-form", $data);
    }
}
