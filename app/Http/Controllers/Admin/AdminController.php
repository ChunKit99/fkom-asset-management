<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import model to connect db
use App\Models\User;

class AdminController extends Controller
{
    //index is all data print
    public function index()
    {
        $Admin = User::all();
        
        return view ('Admin.UserAccount.index')->with('admins',$Admin);
    }

    // form kosong so no need call variable
    public function create()
    {
        return view('Admin.UserAccount.addUser');
    }

    //keep data request from form then go back to index
    public function store(Request $request){
        $input = $request->all();
        User::create($input);
        return redirect('admin')->with('flash_message','New User Added');
    }

    //view one data only show function cannot edit/delete
    public function show($id){
        $Admin = User::find($id);
        return view ('Admin.UserAccount.showUserInfo')->with('admins',$Admin);   
    }

    //edit function 
    public function edit($id){
        $Admin = User::find($id);
        return view('Admin.UserAccount.editUser')->with('admins', $Admin);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $Admin = User::find($id);
        $input = $request->all();
        $Admin->update($input);
        return redirect('admin')->with('flash_message', 'User Info Updated');
    }

    //delete destroy
    public function destroy($id){
        User::destroy($id);
        return redirect('admin')->with('flash_message', 'User Account deleted');
    }
}
