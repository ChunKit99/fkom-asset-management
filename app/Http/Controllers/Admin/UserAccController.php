<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import model to connect db
use App\Models\User;

class UserAccController extends Controller
{
    //index is all data print
    public function index()
    {
        $User = User::all();

        $join = User::select('id','name','email','role_as')
        ->where('role_as','=','0')
        ->get();
        return view ('Admin.ManageUserAccount.index')->with('user',$join);
    }

    // form kosong so no need call variable
    public function create()
    {
        return view('Admin.ManageUserAccount.addAcc');
    }

    //keep data request from form then go back to index
    public function store(Request $request){
        $input = $request->all();
        $input['password']=bcrypt($input['password'] );
        User::create($input);
        return redirect('Admin/ManageUserAccount')->with('flash_message','New User Added');
    }

    //view one data only show function cannot edit/delete
    public function show($id){
        $User = User::find($id);
        return view ('Admin.ManageUserAccount.showAcc')->with('user',$User);   
    }

    //edit function 
    public function edit($id){
        $User = User::find($id);
        return view('Admin.ManageUserAccount.editAcc')->with('user', $User);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $User = User::find($id);
        $input = $request->all();
        $input['password']=bcrypt($input['password']);
        $User->update($input);
        return redirect('Admin/ManageUserAccount')->with('flash_message', 'User Account Updated');
    }

    //delete destroy
    public function destroy($id){
        User::destroy($id);
        return redirect('Admin/ManageUserAccount')->with('flash_message', 'User Account deleted');
    }
}
