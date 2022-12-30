<?php

namespace App\Http\Controllers\maintenanceController;
namespace App\Http\Controllers;
use App\Models\Maintenances;
use App\Models\assets;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;

class maintenanceController extends Controller
{
    public function view()
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $maintenance = Maintenances::join('');
        return view ('MaintenanceManagement.index')->with('maintenances', $maintenance);
    }
    
    public function index()
    {
        $maintenance = Maintenances::all();
        return view ('MaintenanceManagement.index')->with('maintenances', $maintenance);
    }

    public function create()
    {
        return view ('MaintenanceManagement.addMaintenance');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Maintenances::create($input);
        return redirect('MaintenanceManagement')->with('success', 'New Maintenance Request Added!');
    }

    public function show($id)
    {
        $maintenance = Maintenances::find($id);
        return view('MaintenanceManagement.viewMaintenance')->with('maintenances', $maintenance);
    }

    public function destroy($id)
    {
        Maintenances::destroy($id);
        return redirect('MaintenanceManagement')->with('success', 'Maintenance Request Deleted!');
    }
}
