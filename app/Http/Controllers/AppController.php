<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $data = [
            'LoggedUserInfo' => getVerifiedUserById(session('LoggedUser')),
        ];
        return view('app.dashboard.dashboard', $data);
    }

    // PURCHASE REQUEST
    function purchaseRequest(Request $request)
    {
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];
        /*
            | Mao rani sila requisitioner
            ;

             4 := Project Officer
             5 := Focal
            13 := Staff
        */

        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['4', '5', '13']))
            return redirect('/logout');

        return view('app.new-purchase-request.new-purchase-request', $data);
    }

    // JOB ORDER
    function jobOrder(Request $request)
    {
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];
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

        return view('app.new-job-order.new-job-order', $data);
    }

    // USERS
    public function users()
    {
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];
        /*
            REFER to accesslevels table for id
            | Mao rani and admin
            ;

            14 := admin
        */
        if (!isValidAccess($data['LoggedUserInfo']['accesslevel_id'], ['14']))
            return redirect('/logout');

        return view('app.users.users', $data);
    }
}
