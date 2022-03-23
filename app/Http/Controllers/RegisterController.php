<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    function index()
    {
        return view('register/register');   
    }


    function store(Request $request)
    {
        // validate requests
        $this->validate(request(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstname' => ['required', 'string', 'max:25'],
            'lastname' => ['required', 'string', 'max:25'],
            'middleinitial' => ['required', 'string', 'max:1'],
            'designation' => ['required', 'string'],
            'accesslevel' => ['required', 'string'],
        ]);


        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middleinitial = $request->middleinitial;
        $user->designation = $request->designation;
        $user->accesslevel = $request->accesslevel;
        $save = $user->save();
       
        if($save){
            return redirect()->to('/login');
            // or success message
        }else{
            return back();
            // or fail message
        }
    }
}
