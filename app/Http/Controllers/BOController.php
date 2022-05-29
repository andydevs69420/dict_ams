<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\PrItem;
use App\Models\JoItem;
use App\Models\FormRequiredPersonel;

class BOController extends Controller
{
    public function PrIndex() {

        if (!Auth::check())
            return redirect()->to("/login");
        
        if (!Auth::user()->isBudgetOfficer())
            return redirect()->to("/dashboard");

        return view("Budgetofficer.budget-officer-purchase-request");
    }


    public function Predit(String $prformid) 
    {
        
        if (!Auth::check())
            return redirect()->to("/login");

        if (!Auth::user()->isBudgetOfficer())
            return redirect()->to("/dashboard");
        
        $form_id = $prformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try 
        { $form_id = (Int) Crypt::decrypt($form_id); } 
        catch(\Illuminate\Contracts\Encryption\DecryptException $e) 
        { return redirect()->to("/dashboard"); }

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
        
        return view("Budgetofficer.edit-purchase-request", $data);
    }

    public function JoIndex() 
    {

        if (!Auth::check())
            return redirect()->to("/login");

        if (!Auth::user()->isBudgetOfficer())
            return redirect()->to("/dashboard");

        return view("Budgetofficer.budget-officer-job-order");
    }

    public function JoEdit(String $joformid)
    {
        if  (!Auth::check())
            return redirect()->to("/login");

        if (!Auth::user()->isBudgetOfficer())
            return redirect()->to("/dashboard");
        
        $form_id = $joformid;

        #==============================
        # Decypt form id. If invalid, =
        # redirect to dashboard.      =
        #==============================
        try 
        { $form_id = (Int) Crypt::decrypt($form_id); } 
        catch(\Illuminate\Contracts\Encryption\DecryptException $e) 
        { return redirect()->to("/dashboard"); }

        $data = FormRequiredPersonel::getFormByFormAndUserID($form_id, Auth::user()->user_id)->toArray();

        $data["jo_items"] = JoItem::getItemsByFormId($form_id)->toArray();
        $frp = FormRequiredPersonel::getRequiredPersonelsByFormID($form_id);
        
        $data["requester_data"]    = $frp[0]->toArray();
        $data["authofficial_data"] = $frp[1]->toArray();

        return view("app.job-order.job-order-form-info", $data);

        return view("Budgetofficer.edit-job-order");
    }

}