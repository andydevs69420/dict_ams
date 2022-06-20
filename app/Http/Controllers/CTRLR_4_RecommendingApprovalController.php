<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class CTRLR_4_RecommendingApprovalController extends Controller
{
    //

    function PrIndex(Request $request) {
        if (!Auth::check())
            return redirect()->to("/login");

        if (!Auth::user()->isRecommendingAPproval())
            return redirect()->to("/dashboard");

        return view("app.role__recommending-approval.purchase-request.purchase-request-approval-list");
    }

}
