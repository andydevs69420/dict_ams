<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVerificationDetails;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{

    public function __contruct()
    {
        $this->middleware("guest")->except("logout");
        $this->middleware("guest:user")->except("logout");
    }

    /**
     * Login -> index
     * @param Request $request request
     * @retrun View
     * @example
     *     if authenticated redirect to dashboard page
     * 
     **/
    public function login(Request $request)
    {
        if  (Auth::check()) 
            return redirect()->intended("/dashboard"); 

        return view("login/login");  
    }


    /**
     * Login -> check
     * @param Request $request request
     * @retrun View
     * @example
     *     proceed to dashboard page if valid credential
     * 
     **/
    public function check(Request $request)
    {
        $this->validate($request, [
            "username" => "required|string|max:255",
            "password" => "required|min:8"
        ]);

        $username = $request->input("username");
        $password = $request->input("password");
        $remember = (strcmp($request->remember, "on") === 0)? true : false;

        if  (!(Auth::attempt(["username" => $username, "password" => $request->password], $remember)))
            return back()->withErrors(["error" => "Invalid username or password"])->withInput();
        
        if  (!(UserVerificationDetails::isVerified(Auth::user()->user_id)))
        {
            Auth::logout();
            return back()->withErrors(["error"=> sprintf("User %s is not yet verified.", $request->username)]);
        }
        
        return redirect()->to("/dashboard");
    }
    

    /**
     * Logout -> index
     * @param Request $request request
     * @retrun View
     * @example
     *     redirect to login page
     * 
     **/
    public function logout(Request $request)
    {
        if  (Auth::check())
            Auth::logout();

        return redirect()->to("/login");
    } 

}
