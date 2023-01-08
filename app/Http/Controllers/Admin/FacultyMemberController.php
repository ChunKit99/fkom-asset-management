<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import model to connect db
use App\Models\FacultyMemberCurd;
use App\Models\User;

class FacultyMemberController extends Controller
{
    ////index is all data print
    public function index()
    {
        $Member = FacultyMemberCurd::all();
        $User = User::all();

        $join = FacultyMemberCurd :: join('users','users.name', '=', 'members.username')
                ->select('members.id','members.name','users.name as username','members.contact','members.position','members.department','members.location')
                ->get();

        return view ('Admin.FacultyMember.index')->with('members',$Member);
    }

    // form kosong so no need call variable
    public function create()
    {
        $Member = FacultyMemberCurd::all();
        $User = User::all();
        return view('Admin.FacultyMember.addMember')->with(['members' => $Member, 'users' => $User]);
    }

    //keep data request from form then go back to index
    public function store(Request $request){
        $input = $request->all();
        FacultyMemberCurd::create($input);
        return redirect('FacultyMember')->with('flash_message','New User Added');
    }

    //view one data only show function cannot edit/delete
    public function show($id){
        $Member = FacultyMemberCurd::find($id);
        return view ('Admin.FacultyMember.showMember')->with('members',$Member);   
    }

    //edit function 
    public function edit($id){
        $Member = FacultyMemberCurd::find($id);
        return view('Admin.FacultyMember.editMember')->with('members', $Member);
    }

    //update request function b4 update confirm with id 
    public function update(Request $request, $id){
        $Member = FacultyMemberCurd::find($id);
        $input = $request->all();
        $Member->update($input);
        return redirect('FacultyMember')->with('flash_message', 'User Info Updated');
    }

    //delete destroy
    public function destroy($id){
        FacultyMemberCurd::destroy($id);
        return redirect('FacultyMember')->with('flash_message', 'User Account deleted');
    }
}
