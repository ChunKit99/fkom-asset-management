<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//import model to connect db
use App\Models\User;
use App\Models\UserDetail;

class UserProfileController extends Controller
{
    //index is all data print
    public function index()
    {
        $UserDetail = UserDetail::all();
        $User = User::all();

        $join = UserDetail :: join ('users','users.name', '=', 'profiles.name')
        ->select('profiles.id','profiles.fullname','users.name as username','users.email as useremail','users.password as userpassword', 'profiles.contact','profiles.position','profiles.department','profiles.location')
        ->where('role_as','=','0')
        ->where('users.name','=', Auth::user()->name)
        ->get();
        
        return view ('User.ManageUserProfile.index')->with('user',$join);
    }

    //edit Password function 
    public function editPassword($id){
        $User = User::find($id);
        return view('User.ManageUserProfile.editUserAccount')->with('user', $User);
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
        return redirect('/ManageUserProfile')->with('flash_message', 'User Account Updated');
    }

    //edit function 
    public function edit($id){
        $UserDetail = UserDetail::find($id);
        return view('User.ManageUserProfile.editUserProfile')->with('user', $UserDetail);
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
        return redirect('/ManageUserProfile')->with('flash_message', 'User Info Updated');
    }
}
