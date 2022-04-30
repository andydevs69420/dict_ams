<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BOController extends Controller
{
    public function index(){
        //table::ORS()->get();
        $data = ['LoggedUserInfo' => getUserInfoById(session('LoggedUser'))];
        return view('Budgetofficer.BO', $data);
    }

    public function edit(){
        //table::ORS()->get();
        $data = ['LoggedUserInfo' => getUserInfoById(session('LoggedUser'))];
        return view('Budgetofficer.edit-ors', $data);
    }


}

