<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BOController extends Controller
{

    public function index() 
    {
        //if (permission::permitted('BO')=='fail'){ return redirect()->route('denied'); }
        //$empl = table::people()->get();
        $data = ['LoggedUserInfo' => getVerifiedUserById(session('LoggedUser'))];
        return view('Budgetofficer.BO', $data);
    }

    public function edit($id, Request $request) 
    {
        //if (permission::permitted('edit-ors')=='fail'){ return redirect()->route('denied'); }
        $l = table::ORS()->where('id', $id)->first();

        return view('Budgetofficer.edit-ors', $l);
    }

    public function update(Request $request)
    {
        //if (permission::permitted('edit-ors')=='fail'){ return redirect()->route('denied'); }

        $v = $request->validate([
            'id' => 'required|max:200',
            'status' => 'required|max:100',
            'comment' => 'max:255',
        ]);

        $id = Crypt::decryptString($request->id);
        $status = $request->status;
        $comment = mb_strtoupper($request->comment);

        table::ORS()
        ->where('id', $id)
        ->update([
                    'status' => $status,
                    'comment' => $comment
        ]);

        return redirect('/BO')->with('success', trans("ORS form has been updated!"));
    }

    public function delete($id, Request $request)
    {
        //if (permission::permitted('leaves-delete')=='fail'){ return redirect()->route('denied'); }

        table::ORS()->where('id', $id)->delete();

        return redirect('BO')->with('success', trans("Deleted!"));
    }
}