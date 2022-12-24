<?php


namespace App\Http\Controllers\assetController;
namespace App\Http\Controllers;
use App\Models\assets;
use App\Models\User;
use App\Models\vendor;
use Illuminate\Http\Request;

class assetController extends Controller
{
    public function index()
    {
        $assets = assets::with('vendor', 'user')->get();
        return view('AssetManagement.index')->with('assets', $assets);
    }

    public function create()
    {
        return view('AssetManagement.addAsset');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        assets::create($input);
        return redirect('Asset')->with('success', 'New Asset Added!');
    }

    public function show($id)
    {
        $assets = assets::find($id);
        return view('AssetManagement.showAssetInfo')->with('assets', $assets);
    }

    public function edit($id)
    {
        $assets = assets::find($id);
        return view('AssetManagement.editAsset')->with('assets', $assets);
    }

    //update
    public function update(Request $request, $id)
    {
        $assets = assets::find($id);
        $input = $request->all();
        $assets->update($input);
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
