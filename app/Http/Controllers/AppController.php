<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserVerificationDetails;
use App\Models\UserProfileImages;
use App\Models\Designation;
use App\Models\ItemList;
use App\Models\FormRequiredPersonel;
use App\Models\Form;
use App\Models\PrItem;


/**
 * Formats lastname
 * @param  $arr user info
 * @return String
 **/
function formatName($arr) 
{ return $arr->lastname . ", " . $arr->firstname . " " . $arr->middleinitial; }


/**
 * Checks if request has required parameter
 * @param  Request $request request
 * @param Array $array array of required parameters
 * @return boolean
 **/
function hasNull(Request $request, Array $arr) {
    foreach ($arr as $ar)
        if(!$request->has($ar))
            return true;
    return false;
}

class AppController extends Controller
{
    /**
     * Dashboard -> index
     * @param Request $request request
     * @return View
     *
     **/
    public function dashboard(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        return view("app.dashboard.dashboard");
    }


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
        if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
            return redirect()->to("/dashboard");

        return view("app.purchase-request.new-purchase-request");
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
                    
                    #============================
                    # Only requisitioner can    =
                    # view pr form list.        =
                    #============================
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");
                    
                    return view("app.purchase-request.purchase-request-list");
                }

                function viewPRFormInfo(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if (!Auth::check())
                        return redirect()->to("/login");
                    
                    #============================
                    # Only requisitioner can    =
                    # view pr form.             =
                    #============================
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");

                    return view("app.purchase-request.purchase-request-form-info");
                }

                /**
                 * Upload pr form
                 * uses: "POST" request
                 * @param Request $request request
                 * @return View
                 **/
                function uploadPRForm(Request $request) {

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
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");

                    #============================
                    # Go back to page if        =
                    # any field has null value. =
                    #============================
                    if (hasNull($request, ["stock", "unit", "description", "qty", "unitcost", "totalcost", "purpose" , "requester" , "budget-officer", "recommending-approval"]))
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

                    #=================================
                    # step 1 save required personel  =
                    #=================================
                    $step1_data = [];
                    $step1_data[ "requisitioner_id"        ] = $rQ_id;
                    $step1_data[ "budgetofficer_id"        ] = $bO_id;
                    $step1_data[ "recommendingapprover_id" ] = $rA_id;
                    $frp_id = FormRequiredPersonel::create($step1_data)->id;
                    
                    #=================================
                    # step 2 insert form             =
                    #=================================
                    $step2_data = [];
                    $step2_data[ "formtype_id"             ] = 1; # PR := 1
                    $step2_data[ "createdat"               ] = Carbon::now();
                    $step2_data[ "prnumber"                ] = "";
                    $step2_data[ "sainumber"               ] = "";
                    $step2_data[ "purpose"                 ] = $purpose;
                    $step2_data[ "formrequiredpersonel_id" ] = $frp_id;
                    $form_id = Form::create($step2_data)->id;
                    
                    #=================================
                    # step 3 insert items to pr form =
                    #=================================
                    for ($idx = 0; $idx < $num_of_rows; $idx++)
                    {
                        $step3_data = [];
                        $step3_data[ "form_id"   ] = $form_id;
                        $step3_data[ "stockno"   ] = $stck_col[$idx];
                        $step3_data[ "unit"      ] = $unit_col[$idx];
                        $step3_data[ "item"      ] = $desc_col[$idx];
                        $step3_data[ "quantity"  ] = $qnty_col[$idx];
                        $step3_data[ "unitcost"  ] = $unitc_cost_col[$idx];
                        $step3_data[ "totalcost" ] = $qnty_col[$idx];
                        PrItem::create($step3_data);
                    }

                    return redirect()->intended("/dashboard");
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
                    
                    #============================
                    # Only requisitioner can    =
                    # view pr form.             =
                    #============================
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");

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
                    if (!($requisitioner || $budgetofficer || $recommending))
                        return abort(403);

                    #============================
                    # Arranged data             =
                    #============================
                    $data = [];
                    $data[               "items"               ] = $items;
                    $data[              "purpose"              ] = request->input("purpose");
                    $data[           "requester_name"          ] = formatName($rQ);
                    $data[       "requester_designation"       ] = Designation::getDesignationByID($rQ->designation_id);
                    $data[        "budget_officer_name"        ] = formatName($bO);
                    $data[    "budget_officer_designation"     ] = Designation::getDesignationByID($bO->designation_id);
                    $data[    "recommending_approval_name"     ] = formatName($rA);
                    $data[ "recommending_approval_designation" ] = Designation::getDesignationByID($rA->designation_id);
                    return view("app.purchase-request.view-purchase-request-form", $data);
                }


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
        if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
            return redirect()->to("/dashboard");

        return view("app.new-job-order.new-job-order");
    }


    /**
     * View jo form -> index
     * @param Request $request request
     * @return View
     **/
    function viewJOForm(Request $request)
    {
        $data = [
            "JoFormData" => json_decode($request->input("data"),true)
        ];

        return view("app/new-job-order/view-jo-form", $data);
    }

    
    /**
     * Users -> index
     * @param Request $request request
     * @return View
     * @example
     *     Only "admin" has access to this page
     *          Accesslevel table
     *             14 := admin
     **/
    public function users(Request $request)
    {
        #============================
        # Redirect to login if not  =
        # login or expired.         =
        #============================
        if  (!Auth::check())
            return redirect()->to("/login");

        #============================
        # Only admin can view user  =
        # list                      =
        #============================
        if (!isValidAccess(Auth::user()->accesslevel_id, ["14"]))
            return redirect()->to("/dashboard");

        return view("app.users.users");
    }

    /* user subdir ----> */

                /**
                 * View user profile -> user/userid
                 **/
                public function user__user_profile(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if  (!Auth::check())
                        return redirect()->to("/login");

                    #============================
                    # Redirect to dashboard if  =
                    # user parameter is not     =
                    # present.                  =
                    #============================
                    if (!$request->has("user"))
                        return redirect()->intended("/dashboard");

                    #=================================================
                    # Decrypt hashed user id.                        =
                    # If invalid hashed value, redirect to dashboard =
                    #=================================================
                    $decrypt = null;
                    try
                    { $decrypt = (int) Crypt::decrypt($request->input("user")); }
                    catch (\Illuminate\Contracts\Encryption\DecryptException $e)
                    { return redirect()->intended("/dashboard"); }

                    #=====================================
                    # Check if user is already verified. =
                    #=====================================
                    if (!(UserVerificationDetails::isVerified($decrypt)))
                        return redirect()->intended("/dashboard");

                    return view("app.users.user-profile", ["user" => UserVerificationDetails::getUserByID($decrypt)]);
                }
                
                /**
                 * Uploads image -> user/uploadprofilepicture
                 * @param Request $request request
                 * @return View
                 **/
                public function user__user_profile_update(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if (!Auth::check())
                        return redirect()->to("/login");
                    
                    #=================================
                    # Return 403 if no images found. =
                    #=================================
                    if (!($request->hasFile("user-image-upload")) || !request("user-image-upload")->isValid())
                        return abort(403);
                    
                    #================================
                    # Get uploaded file if success. =
                    #================================
                    $file = $request->file("user-image-upload");
                    
                    #============================================
                    # Sets filename.                            =
                    # fmt: user_id + '-' + time_delta.extension =
                    #============================================
                    $filename = Auth::user()->user_id."-".time().".".$file->getClientOriginalExtension();
                    #============================================
                    # Save truepath.                            =
                    # truepath is used by the system to restore =
                    # image path.                               =
                    #============================================
                    $truepath = "storage/user-images/".$filename;
                    #============================================
                    # Save path.                                =
                    # path is used by the system to store the   =
                    # exact image path from symlink.            =
                    #============================================
                    $path = $file->storeAs("public/user-images", $filename);

                    #==============================================
                    # Return information about updating profile,  =
                    # ex: success | failure                       =
                    #==============================================
                    $info = "";
                    if (!$path)
                        $info = "Something went wrong while uploading your image. 0";
                    else
                    {
                        if (!(UserProfileImages::updatePath(Auth::user()->user_id, $truepath)))
                            $info = "Something went wrong while updating your profile.";
                        else
                            $info = "Profile updated successfully.";
                    }

                    return back()->with("info", $info);
                }

                /**
                 * Edit user profile -> user/editprofile
                 * uses: "POST" request
                 * @param Request $request request
                 * @return View
                 **/ 
                public function user__edit_profile(Request $request)
                {
                    #============================
                    # Redirect to login if not  =
                    # login or expired.         =
                    #============================
                    if (!Auth::check())
                        return redirect()->to("/login");
                    

                    #============================
                    # Validation rules.         =
                    #============================
                    $validator_data = [];
                    $validator_data[      "username"   ] = "required|string|max:50";
                    $validator_data[         "email"   ] = (strcmp(Auth::user()->email, $request->input("email")) === 0)? "required|string|email|max:100|exists:user,email" : "required|string|email|max:100|unique:user";
                    $validator_data[      "password"   ] = (strcmp($request->input("password"), "********") !== 0)? "required|string|regex:/^([_A-Z].*\d+.*)$/|min:8|confirmed" : "required|string|min:8|confirmed";
                    $validator_data[     "firstname"   ] = "required|string|regex:/^([A-Z]\w*(\s?[A-Z]\w*)*)$/|min:2|max:25";
                    $validator_data[      "lastname"   ] = "required|string|regex:/^([A-Z][a-z]*)$/|min:2|max:25";
                    $validator_data[ "middleinitial"   ] = "required|string|regex:/^([A-Z])$/|min:1|max:1";
                    $validator_data[   "designation"   ] = "required|string";
                    $validator_data[   "accesslevel"   ] = "required|string";
                    $validator = Validator::make($request->all(), $validator_data);


                    #===================================
                    # Go back to page if not validate. =
                    #===================================
                    if  ($validator->fails())
                        return redirect()->back()->withErrors($validator)->withInput();

                    #=========================
                    # Update data.           =
                    #=========================
                    $update_data = [];
                    $update_data[ "username"       ] = $request->input("username");
                    $update_data[ "email"          ] = $request->input("email");
                    $update_data[ "firstname"      ] = $request->input("firstname");
                    $update_data[ "lastname"       ] = $request->input("lastname");
                    $update_data[ "middleinitial"  ] = $request->input("middleinitial");
                    $update_data[ "designation_id" ] = $request->input("designation_id");
                    $update_data[ "accesslevel_id" ] = $request->input("accesslevel_id");
                    
                    
                    #===================================
                    # Include password if field value  =
                    # is not "********".               =
                    #===================================
                    if (strcmp($request->input("password"), "********") !== 0)
                    $update_data["password"] = Hash::make($request->input("password"));
                    
                    #================================
                    # Update info based on user_id. =
                    #================================
                    $updated = User::where("user_id", "=", Auth::user()->user_id)
                    ->update($update_data);
                    
                    #==================================
                    # Return information about update =
                    # ex: success | failure           =
                    #==================================
                    $info = "";
                    if ($updated)
                        $info = "User profile updated successfully!";
                    else
                        $info = "User profile update failed!";

                    return back()->with("info", $info);
                }

                /**
                 * Update new users verification status -> user/updateverificationstatus
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/
                public function user__updateVerificationStatus(Request $request)
                {
                    #=========================================
                    # Return false if not loggedin as admin. =
                    #=========================================
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return false;

                    #===============================
                    # Update verificationstatus_id =
                    #===============================
                    $user_id   = $request->input("user_id");
                    $status_id = $request->input("status_id");
                    $signal = UserVerificationDetails::where("user_id", "=", $user_id)
                            ->update(["verificationstatus_id" => $status_id]);

                    return (bool) !(!$signal);
                }


                /**
                 * Delete verified user -> user/deleteuser
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/
                public function user__deleteUser(Request $request)
                {
                    #=========================================
                    # Return false if not loggedin as admin. =
                    #=========================================
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return false;

                    #=========================================
                    # Delete user by user_id.                =
                    #=========================================
                    $userid = $request->input("user_id");
                    $signal = UserVerificationDetails::where("user_id", "=", $userid)
                            ->delete();

                    return (bool) !(!$signal);
                }

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
}
