<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserVerificationDetails;
use App\Models\UserProfileImages;
use App\Models\Designation;
use App\Models\ItemList;
use App\Models\FormRequiredPersonel;
use App\Models\Form;
use App\Models\PrForm;



/**
 * 
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
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
            return redirect()->to("/dashboard");

        return view("app.new-purchase-request.new-purchase-request");
    }
    /* purchase request subdir ----> */

                /**
                 * Upload pr form
                 * uses: "POST" request
                 * @param Request $request request
                 * @return View
                 **/
                function uploadPRForm(Request $request) {

                    if  (!Auth::check())
                        return redirect()->to("/login");
                    
                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");

                    if (hasNull($request, [
                        "stock"   , "unit"     , "description"    , 
                        "qty"     , "unitcost" , "totalcost"      , 
                        "purpose" , "requester", "budget-officer" , 
                        "recommending-approval"
                    ]))
                        return back()->with(["info" => "Missing required parameter(s)."]);
                    
                    // =========== ITEMS   ===========
                    $num_of_rows = count($request->input("stock"));
                    $stck_col = $request->input("stock");
                    $unit_col = $request->input("unit");
                    $desc_col = $request->input("description");
                    $qnty_col = $request->input("qty");
                    $unitc_cost_col = $request->input("unitcost");
                    $total_cost_col = $request->input("totalcost");
                    //  =========== OTHERS ===========
                    $purpose = $request->input("purpose");
                    $requester = $request->input("requester");
                    $budget_officer = $request->input("budget-officer");
                    $recommending_approval = $request->input("recommending-approval");

                    # step 1 save required personel
                    $frp_id  = FormRequiredPersonel::create([
                        "requisitioner_id" => $requester,
                        "budgetofficer_id" => $budget_officer,
                        "recommendingapprover_id" => $recommending_approval
                    ])->id;

                    # step 2 insert form
                    $form_id = Form::create([
                        "prnumber"  => "TO BE GENERATED LAST",
                        "sainumber" => "",
                        "purpose"   => $purpose,
                        "formrequiredpersonel_id" => $frp_id
                    ])->id;

                    # step 3 insert items to pr form
                    for ($idx = 0; $idx < $num_of_rows; $idx++)
                    {
                        PrForm::create([
                            "form_id"   => $form_id,
                            "stockno"   => $stck_col[$idx],
                            "unit"      => $unit_col[$idx],
                            "item"      => $desc_col[$idx],
                            "quantity"  => $qnty_col[$idx],
                            "unitcost"  => $unitc_cost_col[$idx],
                            "totalcost" => $qnty_col[$idx]
                        ]);
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
                    if  (!Auth::check())
                        return redirect()->to("/login");

                    if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
                        return redirect()->to("/dashboard");
                    
                    if (hasNull($request, ["items", "purpose", "requester", "budget-officer", "recommending-approval"]))
                        return abort(403);
                    
                    $items = json_decode($request->input("items"),true);

                    $requisitioner = UserVerificationDetails::getUserByID($request->input("requester"));
                    $budgetofficer = UserVerificationDetails::getUserByID($request->input("budget-officer"));
                    $recommending  = UserVerificationDetails::getUserByID($request->input("recommending-approval"));
                    
                    if (!($requisitioner || $budgetofficer || $recommending))
                        return abort(403);

                    $data = [
                        "items" => $items,
                        "purpose" => $request->input("purpose"),
                        "requester_name" => $requisitioner->lastname.", ".$requisitioner->firstname." ".$requisitioner->middleinitial,
                        "requester_designation" => Designation::getDesignationByID($requisitioner->designation_id),
                        "budget_officer_name" => $budgetofficer->lastname.", ".$budgetofficer->firstname." ".$budgetofficer->middleinitial,
                        "budget_officer_designation" => Designation::getDesignationByID($budgetofficer->designation_id),
                        "recommending_approval_name" => $recommending->lastname.", ".$recommending->firstname." ".$recommending->middleinitial,
                        "recommending_approval_designation" => Designation::getDesignationByID($recommending->designation_id),
                    ];

                    return view("app.new-purchase-request.view-pr-form", $data);
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
        if  (!Auth::check())
            return redirect()->to("/login");

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
            'JoFormData' => json_decode($request->input('data'),true)
        ];

        return view('app/new-job-order/view-jo-form', $data);
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
        if  (!Auth::check())
            return redirect()->to("/login");

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
                    if  (!Auth::check())
                        return redirect()->to("/login");

                    if (!$request->has("user"))
                        return redirect()->intended("/dashboard");

                    $decrypt = null;
                    
                    try
                    { $decrypt = (int) Crypt::decrypt($request->input("user")); }
                    catch (\Illuminate\Contracts\Encryption\DecryptException $e)
                    { return redirect()->intended("/dashboard"); }

                    $user = UserVerificationDetails::isVerified($decrypt);
                    if (!$user)
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
                    if (!Auth::check() || !($request->hasFile("user-image-upload")) || !request("user-image-upload")->isValid())
                        return abort(403);
                    

                    $file = $request->file("user-image-upload");
                    
                    // filename
                    $filename = Auth::user()->user_id."-".time().".".$file->getClientOriginalExtension();
                    $truepath = "storage/user-images/".$filename;
                    $path     = $file->storeAs("public/user-images", $filename);

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
                 * @param Request $request request
                 * @return View
                 **/ 
                public function user__edit_profile(Request $request)
                {
                    if (!Auth::check())
                        return abort(403);
                    
                    $validator = Validator::make($request->all(), [
                        'username' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 
                            (strcmp(Auth::user()->email, $request->input("email")) === 0)?
                                'exists:user,email'
                                :
                                'unique:user'
                        ],
                        'password'  => ['required', 'string', 'min:8', 'confirmed'],
                        'firstname' => ['required', 'string', 'min:2', 'max:25'   ],
                        'lastname'  => ['required', 'string', 'min:2', 'max:25'   ],
                        'middleinitial' => ['required', 'string', 'min:1', 'max:1'],
                        'designation'   => ['required', 'string'],
                        'accesslevel'   => ['required', 'string'],
                    ]);

                    if  ($validator->fails())
                        // return response()->json(["errors" => $validator->errors()]);
                        return redirect()->back()->withErrors($validator)->withInput();

                    
                    $update = [
                        "username"       => $request->input("username"),
                        "email"          => $request->input("email"),
                        "firstname"      => $request->input("firstname"),
                        "lastname"       => $request->input("lastname"),
                        "middleinitial"  => $request->input("middleinitial"),
                        "designation_id" => $request->input("designation"),
                        "accesslevel_id" => $request->input("accesslevel"),
                    ];
                    
                    if (
                        strcmp($request->input("password"), "********") !== 0 

                    )
                        $update["password"] = Hash::make($request->input("password"));
                        
                    $updated = User::where("user_id", "=", Auth::user()->user_id)
                        ->update($update);
                    
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
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return false;

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
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return false;

                    $userid = $request->input("user_id");
                    $signal = UserVerificationDetails::where("user_id", "=", $userid)
                            ->delete();
                    return (bool) !(!$signal);
                }


    /**
     * Item List -> index
     * @param Request $request request
     * @return View
     *
     **/
    public function itemlist(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        return view("app.item-list.item-list");
    }

    /* item list subdir ----> */
                /**
                 * Add item -> itemlist/additem
                 * @param Request $request request
                 * @return view
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 *
                 **/
                public function itemlist__additem(Request $request)
                {
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return response()->json(["errors" => "Invalid access!"]);

                    $validator = Validator::make($request->all(),[
                        'itemnumber'       => 'required|unique:item_list|integer|digits:8',
                        'itemname'         => 'required|string|min:4|max:100',
                        'itemdescription'  => 'required|string|min:4|max:100',
                    ],["itemnumber.unique" => "An Item with the same item number already exists."]);

                    if  ($validator->fails())
                        return response()->json(["errors" => $validator->errors()]);

                    $item = new ItemList();

                    $item->itemnumber      = $request->input("itemnumber");
                    $item->itemname        = $request->input("itemname");
                    $item->itemdescription = $request->input("itemdescription");
                    $signal = $item->save();

                    if  (!$signal)
                        // debug
                        return response()->json(["message" => "Item addition failed!", "successful" => false]);

                    // TODO: Fix this
                    return response()->json([
                        "message"     => "Item added successfully!",
                        "successful"  => true,
                        "itemlist_id" => $item->id]);
                }


                /**
                 * Update item -> itemlist/updateitem
                 * @param Request $request request
                 * @return view
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 *
                 **/
                public function itemlist__updateItem(Request $request)
                {
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return response()->json(["errors" => "Invalid access!"]);

                    $validator = Validator::make($request->all(),[
                        'itemnumber'       => 'required|unique:item_list|integer|digits:8',
                        'itemname'         => 'required|string|min:4|max:100',
                        'itemdescription'  => 'required|string|min:4|max:100',
                    ],["itemnumber.unique" => "An Item with the same item number already exists."]);

                    if  ($validator->fails())
                        return response()->json(["errors" => $validator->errors()]);

                    $signal = ItemList::where("itemlist_id", "=", $request->input("itemlist_id"))
                        ->update([
                            "itemnumber" => $request->input("itemnumber"),
                            "itemname"   => $request->input("itemname"),
                            "itemdescription" => $request->input("itemdescription"),
                        ]);

                    if  (!$signal)
                        // debug
                        return response()->json(["message" => "Update failed!", "successful" => false]);

                    return response()->json([
                        "message"    => "Item was updated successfully!",
                        "successful" => true
                    ]);
                }


                /**
                 * Delete item -> itemlist/deleteitem
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/
                public function itemlist__deleteItem(Request $request)
                {
                    if (!Auth::check() || !isValidAccess(Auth::user()->accesslevel_id, ["14"]))
                        return false;

                    $itemlist_id = $request->input("itemlist_id");
                    $signal      = ItemList::where("itemlist_id", "=", $itemlist_id)
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
