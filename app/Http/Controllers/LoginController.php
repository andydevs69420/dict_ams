<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    function index()
    {
        return view('login/login');   
    }

    // temporary
    public function check(Request $request)
    {
       $userInfo = User::where('username', '=', $request->username)->first();

       if(!$userInfo){
           return back();
           // or with error message
       }else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('/dashboard');
            }else{
                return back();
                // or with error message
            }
       }
        
    }
    

}
