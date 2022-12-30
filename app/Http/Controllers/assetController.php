<?php


namespace App\Http\Controllers\assetController;

namespace App\Http\Controllers;

use App\Models\assets;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;
use PDF;

class assetController extends Controller
{
    public function filter(Request $request)
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        // Initialize the assets variable with all assets
        $query = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
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
        session()->put('assets', $assets);
        session()->put('assetsAction', 'Filtered');
        // Return the view with the assets variable
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    public function sort(Request $request)
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $category = $request->input('sort_category');
        $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy($category, 'ASC')
            ->get();
            session()->put('assets', $assets);  
            session()->put('assetsAction', 'Sorted');
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    // Generate PDF
    public function createPDF(Request $request)
    {
        // retreive all records from db
        // $data = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
        //     ->join('users', 'users.id', '=', 'assets.user_id')
        //     ->join('location', 'location.id', '=', 'assets.location_id')
        //     ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
        //     ->orderBy('assets.id', 'ASC')
        //     ->get();
        $assets = session()->get('assets');
        // share data to view
        // view()->share('pdfview',$data);
        $pdf = PDF::loadView(('AssetManagement.pdfview'), array('assets' =>  $assets))
            ->setPaper('a4', 'portrait');
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function search(Request $request)
    {
        $serial_number = $request->input('serial_number');
        $asset = assets::where('serial_number', $serial_number)->first();
        // return the item or redirect to a index with warning if the item is not found
        if ($asset) {
            $vendor = Vendor::find($asset->vendor_id);
            $user = User::find($asset->user_id);
            $location = Location::find($asset->location_id);
            return view('AssetManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'locations' => $location]);
        } else {
            return redirect('Asset')->with('warning', 'No record found!');
        }
    }
    public function index()
    {
        // $assets = assets::with('vendors', 'user')->get();
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy('assets.id', 'ASC')
            ->get();
        session()->put('assets', $assets);
        session()->put('assetsAction', 'All');
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }

    public function create()
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        return view('AssetManagement.addAsset')->with(['vendors' => $vendors, 'users' => $users, 'locations' => $locations]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        assets::create($input);
        return redirect('Asset')->with('success', 'New Asset Added!');
    }

    public function show($id)
    {
        $asset = assets::find($id);
        $vendor = Vendor::find($asset->vendor_id);
        $user = User::find($asset->user_id);
        $location = Location::find($asset->location_id);
        return view('AssetManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'location' => $location]);
    }


    public function edit($id)
    {
        $asset = assets::find($id);
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        return view('AssetManagement.editAsset')->with('asset', $asset)->with('users', $users)->with('vendors', $vendors)->with('locations', $locations);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the asset and the input values
        $asset = assets::find($id);
        $input = $request->all();

        // Find the vendor_id corresponding to the input vendor name
        // $vendorName = $input['vendor_name'];
        // $vendor = vendors::where('name', $vendorName)->first();
        // $vendorId = $vendor->id;
        $vendorId = $input['vendor_id'];

        // Find the user_id corresponding to the input user name
        // $userName = $input['user_name'];
        // $user = User::where('name', $userName)->first();
        // $userId = $user->id;
        $userId = $input['user_id'];
        $locationId = $input['location_id'];

        // Update the vendor_id and user_id in the input values and save the asset
        $input['vendor_id'] = $vendorId;
        $input['user_id'] = $userId;
        $input['location_id'] = $locationId;
        $asset->update($input);

        return redirect('Asset')->with('success', 'Asset Info Updated!');
    }

    public function destroy($id)
    {
        assets::destroy($id);
        return redirect('Asset')->with('success', 'Asset Deleted!');
    }
}


//public function index()
//{
    // $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
    // ->join('users', 'users.id', '=', 'assets.user_id')
    // ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name')
    // ->get();
