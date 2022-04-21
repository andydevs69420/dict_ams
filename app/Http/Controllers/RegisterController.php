<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use App\Models\Accesslevel;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    function index(Request $request)
    {
        // akong ge edit part kay naay need naku sa akong task

        $params = [
            'designations' => Designation::all(),
            'accesslevels' => (strcmp($request->input('admin'), 'true') === 0)?
                                Accesslevel::all()
                                : // ang 14 kay accesslevel_id ni admin
                                Accesslevel::all()->where('accesslevel_id', '!=', '14')
        ];

        return view('register/register', $params);   
    }


    function store(Request $request)
    {
        // validate requests
        $this->validate(request(), [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
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
        $user->designation_id = $request->designation;
        $user->accesslevel_id = $request->accesslevel;
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
