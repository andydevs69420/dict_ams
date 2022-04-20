<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVerificationDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
       $userInfo = UserVerificationDetails::join(
                        'user', 
                        'user_verification_details.user_id', 
                        '=', 
                        'user.user_id'
                    )
                    ->join(
                        'verification_status', 
                        'user_verification_details.verificationstatus_id', 
                        '=', 
                        'verification_status.verificationstatus_id'
                    )
                    ->where('user.username', '=', $request->input('username'))
                    ->first();

        if(!$userInfo){
            return back()->withErrors(['error'=> sprintf('User %s does not exist.', $request->username)]);
            // or with error message
        }else{
                if(Hash::check($request->password, $userInfo->password)){
                    // IF verificationstatus_id == 2 THEN user is verified
                    if (strcmp($userInfo->verificationstatus_id, '2') === 0)
                    {
                        $request->session()->put('LoggedUser', $userInfo->user_id);
                        return redirect('/dashboard');
                    }
                    return back()->withErrors(['error'=> sprintf('User %s is not yet verified.', $request->username)]);
                }else{
                    // or with error message
                    return back()->withErrors(['error'=> 'Invalid username or password.']);
                }
        }
        
    }
    

}
