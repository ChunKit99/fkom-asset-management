<?php


namespace App\Http\Controllers\assetController;
namespace App\Http\Controllers;
use App\Models\assets;
use App\Models\User;
use App\Models\vendors;
use Illuminate\Http\Request;

class assetController extends Controller
{
    public function index()
    {
        // $assets = assets::with('vendors', 'user')->get();
        $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
        ->join('users', 'users.id', '=', 'assets.user_id')
        ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name')
        ->orderBy('assets.id', 'ASC')
        ->get();
        return view('AssetManagement.index')->with('assets', $assets);
    }

    public function create()
    {
        $vendors = vendors::all();
        $users = User::all();

        return view('AssetManagement.addAsset')->with(['vendors' => $vendors, 'users' => $users]);
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
        $vendor = vendors::find($asset->vendor_id);
        $user = User::find($asset->user_id);

        return view('AssetManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user]);
    }


    public function edit($id)
    {
        $asset = assets::find($id);
        $vendors = vendors::all();
        $users = User::all();
        return view('AssetManagement.editAsset')->with('asset', $asset)->with('users', $users)->with('vendors', $vendors);
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

        // Update the vendor_id and user_id in the input values and save the asset
        $input['vendor_id'] = $vendorId;
        $input['user_id'] = $userId;
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
