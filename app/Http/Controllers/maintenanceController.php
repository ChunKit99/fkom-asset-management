<?php

namespace App\Http\Controllers\maintenanceController;
namespace App\Http\Controllers;
use App\Models\Maintenances;
use App\Models\assets;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

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
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $maintenance = Maintenances::all();

        return view ('MaintenanceManagement.index')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function add($id)
    {
        $asset = assets::find($id);
        $vendor = Vendor::find($asset->vendor_id);
        $user = User::find($asset->user_id);
        $location = Location::find($asset->location_id);
        $nowTimeDate = Carbon::now();
        // Maintenances'request_time' => Carbon::now();
        $status = 'Under Review';

        // return view ('MaintenanceManagement.addMaintenance')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'location' => $location]);

        return view ('MaintenanceManagement.addMaintenance')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'location' => $location, 'nowTimeDate' => $nowTimeDate, 'status' => $status]);
    }

    public function create($id)
    {
        $assets = assets::find($id);

        return view ('MaintenanceManagement.addMaintenance')->with('assets',$assets);
    }

    public function list(Request $request)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $maintenance = Maintenances::all();

        // if(Maintenances::where('status', '=', 'completed')
        // ->orWhere('status', '=', 'cancelled'))
        // $maintenance = Maintenances::join('assets', 'maintenances.serial_number', '=', 'assets.serial_number')
        // ->select('maintenances.serial_number', 'maintenances.status')
        // ->get();
        if(Auth::check() && Auth::user()->role_as==0){
            $assets = assets::join('users', 'users.id','=','assets.user_id')
        ->join('location', 'location.id','=','assets.location_id')
        ->join('vendors', 'vendors.id','=','assets.vendor_id')
        ->select('users.name', 'assets.id', 'assets.serial_number', 'assets.category', 'assets.budget', 'location.name as location', 'vendors.name as vendor')
        ->where('users.id', '=', '14')
        ->get();
        }else{
            $layout = 'layouts.masteruser';
        }
        $assets = assets::join('users', 'users.id','=','assets.user_id')
        ->join('location', 'location.id','=','assets.location_id')
        ->join('vendors', 'vendors.id','=','assets.vendor_id')
        ->select('users.name', 'assets.id', 'assets.serial_number', 'assets.category', 'assets.budget', 'location.name as location', 'vendors.name as vendor')
        ->where('users.id', '=', '14')
        ->get();

        return view ('MaintenanceManagement.list')->with(['assets'=> $assets, 'maintenances' => $maintenance]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = 'Under Review';
        $input['request_time'] = Carbon::now();
        Maintenances::create($input);
        
        return redirect('MaintenanceManagement')->with('success', 'New Maintenance Request Added!');
    }

    public function show($id)
    {
        $maintenance = Maintenances::find($id);
        $assets = assets::find($maintenance->id);
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

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'serial_number' => 'required',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        // ]);
        // Retrieve the asset and the input values
        $maintenance = Maintenances::find($id);
        $input = $request->all();

        // if ($request->hasFile('image')) {
        //     if (File::exists(public_path($asset->image_path))) {
        //         // Delete file
        //         File::delete(public_path($asset->image_path));
        //     }
        //     // Store the image file
        //     $fileName = date('Y_m_d_His') . "_" . $request->file('image')->getClientOriginalName();
        //     $path = $request->file('image')->storeAs('images', $fileName, 'public');
        //     // Insert the image record
        //     $image_path = '/storage/' . $path;
        // } else {
        //     $image_path = $asset->image_path;
        // }

        // Update the asset record with the new image ID
        $maintenance->update([
            'status' => $input['status'],
        ]);

        return redirect('MaintenanceManagement')->with('success', 'Maintenance Info Updated!');
    }

    public function destroy($id)
    {
        Maintenances::destroy($id);
        return redirect('MaintenanceManagement')->with('success', 'Maintenance Request Deleted!');
    }
}