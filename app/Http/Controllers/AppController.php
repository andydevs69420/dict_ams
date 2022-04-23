<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserVerificationDetails;
use App\Models\ItemList;

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
        $data = [
            'LoggedUserInfo' => getVerifiedUserById(session('LoggedUser')),
        ];
        return view('app.dashboard.dashboard', $data);
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
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5', '13']))
            return redirect('/logout');

        return view('app.new-purchase-request.new-purchase-request', $data);
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
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5', '13']))
            return redirect('/logout');

        return view('app.new-job-order.new-job-order', $data);
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
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
            return redirect('/logout');

        return view('app.users.users', $data);
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
                    $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

                    if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
                        return redirect('/logout');
                    
                    $user_id   = $request->input('user_id');
                    $status_id = $request->input('status_id');
                        
                    $signal = UserVerificationDetails::where('user_id', '=', $user_id)
                            ->update(['verificationstatus_id' => $status_id]);
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
                public function deleteUser(Request $request)
                {
                    $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

                    if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
                        return redirect('/logout');

                    $user_id = $request->input('user_id');
                    
                    $signal = UserVerificationDetails::where('user_id', '=', $user_id)
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
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
            return redirect('/logout');
        
        return view('app.item-list.item-list', $data);
    }

    /* item list subdir ----> */

                /**
                 * Delete item -> itemlist/deleteitem
                 * @param Request $request request
                 * @return bool
                 * @example
                 *     Only "admin" has access to this page
                 *         Accesslevel table
                 *             14 := admin
                 **/ 
                public function deleteItem(Request $request)
                {
                    $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];

                    if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
                        return redirect('/logout');

                    $itemlist_id = $request->input('itemlist_id');
                    
                    $signal = ItemList::where('itemlist_id', '=', $itemlist_id)
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
        $data = [
            'LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))
        ];
        return view('app.requisitioner.requisitioner', $data);
    }
}
