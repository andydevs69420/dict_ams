<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CanvController extends Controller
{
/**
     * Price Quotation -> index
     * @param Request $request request
     * @return View
     * @example
     *     Only "Canvasser" has access to this page
     *          Accesslevel table
     *              9 := Canvasser
     **/
    function purchaserequest(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["9"]))
            return redirect()->to("/logout");

        return view("Canvasser.canvasser");
    }

    function editpurchaserequest(Request $request)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!isValidAccess(Auth::user()->accesslevel_id, ["9"]))
            return redirect()->to("/logout");

        return view("Canvasser.edit-Canvasser");
    }
}