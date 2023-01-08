<?php

namespace App\Http\Controllers\maintenanceController;
namespace App\Http\Controllers;
use App\Models\Maintenances;
use App\Models\assets;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class maintenanceController extends Controller
{
    public function filter(Request $request)
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        // Initialize the assets variable with all assets
        $query = Maintenances::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name');

            $criteria = $request->input('filter_category');
                switch ($criteria) {
                    case 'apply_all':
                        $location_id = $request->input('location_id');
                        $category = $request->input('category');
                        $category = $request->input('category');
                        $vendor = $request->input('vendor_id');
                        $user = $request->input('user_id');
                        $query->where('assets.location_id', '=', $location_id)
                        ->where('assets.category', '=', $category)
                        ->where('vendors.id', '=', $vendor)
                        ->where('users.id', '=', $user);
                        break;
                    case 'location':
                        $location_id = $request->input('location_id');
                        $query->where('assets.location_id', '=', $location_id);
                        break;
                    case 'category':
                        $category = $request->input('category');
                        $query->where('assets.category', '=', $category);
                        break;
                    case 'vendor':
                        $vendor = $request->input('vendor_id');
                        $query->where('vendors.id', '=', $vendor);
                        break;
                    case 'user':
                        $user = $request->input('user_id');
                        $query->where('users.id', '=', $user);
                        break;
                }
        $assets = $query->orderBy('assets.id', 'ASC')->get();
        // Return the view with the assets variable
        return view('MaintenanceManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    public function sort(Request $request)
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $category = $request->input('sort_category');
        $assets = Maintenances::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy($category, 'ASC')
            ->get();
        return view('MaintenanceManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    // Generate PDF
    public function createPDF()
    {
        // retreive all records from db
        $data = Maintenances::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy('assets.id', 'ASC')
            ->get();
        // share data to view
        // view()->share('pdfview',$data);
        $pdf = PDF::loadView(('MaintenanceManagement.pdfview'), array('maintenance' =>  $data))
            ->setPaper('a4', 'portrait');
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function search(Request $request)
    {
        $serial_number = $request->input('serial_number');
        $maintenance = Maintenances::where('serial_number', $serial_number)->first();
        // return the item or redirect to a index with warning if the item is not found
        if ($maintenance) {
            $vendor = Vendor::find($maintenance->vendor_id);
            $user = User::find($maintenance->user_id);
            $location = Location::find($maintenance->location_id);
            return view('MaintenanceManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'locations' => $location]);
        } else {
            return redirect('Asset')->with('warning', 'No record found!');
        }
    }

    public function view()
    {
        $assets = assets::all();
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $maintenance = Maintenances::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy('assets.id', 'ASC')
            ->get();
        return view ('MaintenanceManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }
    
    public function index()
    {
        $maintenance = Maintenances::all();
        return view ('MaintenanceManagement.index')->with('maintenances', $maintenance);
    }

    public function create()
    {
        $assets = assets::all();
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $maintenance = Maintenances::join('assets', 'maintenances.serial_number','=','assets.serial_number')
        ->join('users', 'users.id','=','assets.user_id')
        ->join('location', 'location.id','=','assets.location_id')
        ->join('vendors', 'vendors.id','=','assets.vendor_id')
        ->select('users.name', 'assets.id', 'assets.serial_number', 'assets.category', 'assets.budget', 'location.name as location', 'vendors.name as vendor')
        ->where('assets.id', '=', 'b3lfe820J0')
        ->get();
        
        // $assets = assets::join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'assets.id', 'assets.budget')
        // ->get();
        // $vendor = Vendor::join('assets','assets.vendor_id','=','vendors.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'vendors.name', 'vendors.contact', 'vendors.email')
        // ->get();
        // $user = User::join('assets','assets.user_id','=','users.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'users.name', 'users.email')
        // ->get();
        // $locations = Location::join('assets','assets.location_id','=','location.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'location.name')
        // ->get();
        return view ('MaintenanceManagement.addMaintenance')->with(['maintenances', $maintenance, 'assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    public function list(Request $request)
    {
        // $user = Auth::id();
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $assets = assets::join('users', 'users.id','=','assets.user_id')
        ->join('location', 'location.id','=','assets.location_id')
        ->join('vendors', 'vendors.id','=','assets.vendor_id')
        ->select('users.name', 'assets.id', 'assets.serial_number', 'assets.category', 'assets.budget', 'location.name as location', 'vendors.name as vendor')
        ->where('users.id', '=', '2')
        ->get();
        return view ('MaintenanceManagement.list')->with('assets', $assets);
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
        $assets = assets::find($maintenance->id);
        // $vendor = Vendor::find($maintenance->id);
        // $vendor = Vendor::find($maintenance->contact);
        // $vendor = Vendor::find($maintenance->email);
        // $user = User::find($maintenance->name);
        // $user = User::find($maintenance->email);
        // $locations = Location::find($maintenance->name);
        // $assets = assets::join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'assets.id')
        // ->get();
        // $vendor = Vendor::join('assets','assets.vendor_id','=','vendors.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'vendors.name', 'vendors.contact', 'vendors.email')
        // ->get();
        // $user = User::join('assets','assets.user_id','=','users.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'users.name', 'users.email')
        // ->get();
        // $locations = Location::join('assets','assets.location_id','=','location.id')
        // ->join('maintenances', 'maintenances.serial_number','=','assets.serial_number')
        // ->select('maintenances.serial_number', 'location.name')
        // ->get();
        return view('MaintenanceManagement.viewMaintenance')->with(['maintenances' => $maintenance, 'assets' => $assets]);
    }

    public function edit($id)
    {
        $maintenance = Maintenances::find($id);
        $asset = assets::find($id);
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        return view('MaintenanceManagement.editMaintenance')->with('maintenances', $maintenance)->with('asset', $asset)->with('users', $users)->with('vendors', $vendors)->with('locations', $locations);
    }

    public function destroy($id)
    {
        Maintenances::destroy($id);
        return redirect('MaintenanceManagement')->with('success', 'Maintenance Request Deleted!');
    }
}