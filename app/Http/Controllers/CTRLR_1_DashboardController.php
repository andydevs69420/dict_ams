<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class CTRLR_1_DashboardController extends Controller
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
}
