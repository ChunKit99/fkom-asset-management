<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import model to connect db
use App\Models\User;

class UserController extends Controller
{
    //index is all data print
    public function index()
    {
        $User = User::all();
        
        return view ('admin.UserAccount.index')->with('user',$User);
    }

    // form kosong so no need call variable
    public function create()
    {
        return view('admin.UserAccount.addUser');
    }

    //keep data request from form then go back to index
    public function store(Request $request){
        $input = $request->all();
        User::create($input);
        return redirect('admin')->with('flash_message','New User Added');
    }

    //view one data only show function cannot edit/delete
    public function show($id){
        $User = User::find($id);
        return view ('admin.UserAccount.showUserInfo')->with('user',$User);   
    }

    //edit function 
    public function edit($id){
        $User = User::find($id);
        return view('admin.UserAccount.editUser')->with('user', $User);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $User = User::find($id);
        $input = $request->all();
        $User->update($input);
        return redirect('admin')->with('flash_message', 'User Info Updated');
    }

    //delete destroy
    public function destroy($id){
        User::destroy($id);
        return redirect('admin')->with('flash_message', 'User Account deleted');
    }
}