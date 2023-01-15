<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//import model to connect db
use App\Models\User;
use App\Models\UserDetail;

class AdminProfileController extends Controller
{
    //index is all data print
    public function index()
    {
        $UserDetail = UserDetail::all();
        $User = User::all();

        $join = UserDetail :: join ('users','users.name', '=', 'profiles.name')
        ->select('profiles.id','profiles.fullname','users.name as username','users.email as useremail','users.password as userpassword', 'profiles.contact','profiles.position','profiles.department','profiles.location')
        ->where('role_as','=','1')
        ->where('users.name','=', Auth::user()->name)
        ->get();
        
        return view ('Admin.ManageAdminProfile.index')->with('admin',$join);
    }

    //edit Password function 
    public function editPassword($name){
        $User = User::find($name);
        return view('Admin.manageAdminProfile.editAdminAccount')->with('user',$User);
    }

       //update request function b4 update confirm with id 
       public function updatePassword(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();

        $User = User::whereId($id)->update([
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);
        
        return redirect('Admin/ManageAdminProfile')->with('flash_message', 'User Info Updated');
    }

    //edit function 
    public function edit($id){
        $UserDetail = UserDetail::find($id);
        return view('Admin.ManageAdminProfile.editAdminProfile')->with('admin', $UserDetail);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $request->validate([
            'fullname' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'department' => 'required',
            'location' => 'required',
        ]);
        $UserDetail = UserDetail::find($id);
        $input = $request->all();
        $UserDetail->update($input);
        return redirect('Admin/ManageAdminProfile')->with('flash_message', 'User Info Updated');
    }
 
}