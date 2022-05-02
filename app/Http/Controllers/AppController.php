<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerificationDetails;
use App\Models\Designation;
use App\Models\ItemList;
use Auth;

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
            return redirect()->to("/logout");

        return view("app.new-purchase-request.new-purchase-request");
    }


    /**
     * View pr form -> index
     * @param Request $request request
     * @return View
     **/
    function viewPrForm(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["4", "5", "13"]))
            return redirect()->to("/logout");
        
        if 
        (
            !$request->has("items")          ||
            !$request->has("purpose")        ||
            !$request->has("requester")      ||
            !$request->has("budget-officer") ||
            !$request->has("recommending-approval")
        )
            return abort(403);
        
        $items = json_decode($request->input("items"),true);

        for ($i = 0; $i < count($items); $i++)
        {   
            $items[$i][2] = ItemList::getItemByID($items[$i][2])->itemname;
        }

        error_log("RESULT: ".json_encode($items));

        $requisitioner = UserVerificationDetails::getUserByID($request->input("requester"));
        
        $data = [
            "items"   => $items,
            "purpose" => $request->input("purpose"),
            "requester_name" => $requisitioner->lastname.", ".$requisitioner->firstname." ".$requisitioner->middleinitial,
            "requester_designation" => Designation::getDesignationByID($requisitioner->designation_id),
            "recommending_approval_name" => $requisitioner->lastname.", ".$requisitioner->firstname." ".$requisitioner->middleinitial,
            "recommending_approval_designation" => Designation::getDesignationByID($requisitioner->designation_id),
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
            return redirect()->to("/logout");

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
            return redirect()->to("/logout");

        return view("app.users.users");
    }

    /* user subdir ----> */

                /**
                 * Update new users verification status -> users/updateverificationstatus
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
                 * Delete verified user -> users/deleteuser
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
