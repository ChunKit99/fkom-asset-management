<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//import model to connect db
use App\Models\User;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    //index is all data print
    public function index()
    {
        $UserDetail = UserDetail::all();
        $User = User::all();

        $join = UserDetail :: join ('users','users.name', '=', 'profiles.name')
        ->select('profiles.id','profiles.fullname','users.name as username','profiles.contact','profiles.position','profiles.department','profiles.location')
        ->where('role_as','=','0')
        ->get();
        return view ('Admin.ManageUserDetail.index')->with('user',$join);
    }

    // form kosong so no need call variable
    public function create()
    {
        $UserDetail = UserDetail::all();
        $User = User::all();

        $join = User::select('id','name','role_as')
        ->where('role_as','=','0')
        ->get();

        return view('Admin.ManageUserDetail.addUserInfo')->with(['user' => $UserDetail, 'users' => $join]);
    }

    //keep data request from form then go back to index
    public function store(Request $request){
        $request->validate([
            'fullname' => 'required',
        ]);
        $input = $request->all();
        UserDetail::create($input);
        return redirect('Admin/ManageUserDetail')->with('flash_message','New User Information Added');
    }

    //view one data only show function cannot edit/delete
    public function show($id){
        $UserDetail = UserDetail::find($id);
        return view ('Admin.ManageUserDetail.showUserInfo')->with('user',$UserDetail);   
    }

    //edit function 
    public function edit($id){
        $UserDetail = UserDetail::find($id);
        return view('Admin.ManageUserDetail.editUserInfo')->with('user', $UserDetail);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $UserDetail = UserDetail::find($id);
        $input = $request->all();
        $UserDetail->update($input);
        return redirect('Admin/ManageUserDetail')->with('flash_message', 'User Info Updated');
    }

    //delete destroy
    public function destroy($id){
        UserDetail::destroy($id);
        return redirect('Admin/ManageUserDetail')->with('flash_message', 'User Info deleted');
    }
}