<?php


namespace App\Http\Controllers\assetController;

namespace App\Http\Controllers;

use App\Models\assets;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\UniqueSerialNumber;

class assetController extends Controller
{
    public function filter(Request $request)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
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
                    ->where('vendors.id', '=', $vendor);
                if(Auth::check() && Auth::user()->role_as==1){
                }else{
                    $query->where('users.id', '=', Auth::user()->id);
                }    
                break;
            case 'location':
                $location_id = $request->input('location_id');
                $query->where('assets.location_id', '=', $location_id);
                if(Auth::check() && Auth::user()->role_as==1){
                }else{
                    $query->where('users.id', '=', Auth::user()->id);
                }
                break;
            case 'category':
                $category = $request->input('category');
                $query->where('assets.category', '=', $category);
                if(Auth::check() && Auth::user()->role_as==1){
                }else{
                    $query->where('users.id', '=', Auth::user()->id);
                }
                break;
            case 'vendor':
                $vendor = $request->input('vendor_id');
                $query->where('vendors.id', '=', $vendor);
                if(Auth::check() && Auth::user()->role_as==1){
                }else{
                    $query->where('users.id', '=', Auth::user()->id);
                }
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
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations, 'layout' =>$layout]);
    }

    public function sort(Request $request)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $category = $request->input('sort_category');
        if(Auth::check() && Auth::user()->role_as==1){
            if ($category == 'default_lo') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->orderBy('assets.id', 'DESC')
                    ->get();
            } else if ($category == 'default_ol') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->orderBy('assets.id', 'ASC')
                    ->get();
            }else if ($category == 'budget_a') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->orderBy('assets.budget', 'ASC')
                    ->get();
            }else if ($category == 'budget_d') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->orderBy('assets.budget', 'DESC')
                    ->get();
            }else{//location, vendor, user
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->orderBy($category, 'ASC')
                    ->get();
            }
        }else{
            if ($category == 'default_lo') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->where('assets.user_id', '=', Auth::user()->id)
                    ->orderBy('assets.id', 'DESC')
                    ->get();
            } else if ($category == 'default_ol') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->where('assets.user_id', '=', Auth::user()->id)
                    ->orderBy('assets.id', 'ASC')
                    ->get();
            }else if ($category == 'budget_a') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->where('assets.user_id', '=', Auth::user()->id)
                    ->orderBy('assets.budget', 'ASC')
                    ->get();
            }else if ($category == 'budget_d') {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->where('assets.user_id', '=', Auth::user()->id)
                    ->orderBy('assets.budget', 'DESC')
                    ->get();
            }  else {
                $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
                    ->join('users', 'users.id', '=', 'assets.user_id')
                    ->join('location', 'location.id', '=', 'assets.location_id')
                    ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
                    ->where('assets.user_id', '=', Auth::user()->id)
                    ->orderBy($category, 'ASC')
                    ->get();
            }
        }
        
        session()->put('assets', $assets);
        session()->put('assetsAction', 'Sorted');
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations, 'sort_category'=>$category, 'layout' =>$layout]);
    }

    // Generate PDF
    public function createPDF(Request $request)
    {
        $assets = session()->get('assets');
        // share data to view
        // view()->share('pdfview',$data);
        $pdf = PDF::loadView(('AssetManagement.pdfview'), array('assets' =>  $assets))
            ->setPaper('a4', 'portrait');
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

    public function search2(Request $request)
    {
      $query = $request->input('q');
      if(Auth::check() && Auth::user()->role_as==1){
        $results = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
        ->join('users', 'users.id', '=', 'assets.user_id')
        ->join('location', 'location.id', '=', 'assets.location_id')
        ->where('serial_number', 'like', "%$query%")
        ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
        ->get();
      }else{
        $results = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
        ->join('users', 'users.id', '=', 'assets.user_id')
        ->join('location', 'location.id', '=', 'assets.location_id')
        ->where('serial_number', 'like', "%$query%")
        ->where('assets.user_id', '=', Auth::user()->id)
        ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
        ->get();
      }

    
      return response()->json($results);
    }

    public function search(Request $request)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $serial_number = $request->input('serial_number');
        if(Auth::check() && Auth::user()->role_as==1){
        $asset = assets::where('serial_number', $serial_number)->first();
        }else{
            $asset = assets::where('serial_number', $serial_number)->where('assets.user_id', '=', Auth::user()->id)->first();
        }
        // return the item or redirect to a index with warning if the item is not found
        if ($asset) {
            $vendor = Vendor::find($asset->vendor_id);
            $user = User::find($asset->user_id);
            $location = Location::find($asset->location_id);
            // Get the image record
            $image = $asset->image_path;

            // Generate a URL to the image file using the asset() function
            $image_url = $image ? asset($asset->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png?20210219185637';

            return view('AssetManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'location' => $location, 'image_url' => $image_url, 'layout' =>$layout]);
        } else {
            return redirect('Asset')->with('warning', 'No record found!');
        }
    }
    public function index()
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        if(Auth::check() && Auth::user()->role_as==1){
            $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->orderBy('assets.id', 'DESC')
            ->get();
        }else{
            $assets = assets::join('vendors', 'vendors.id', '=', 'assets.vendor_id')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->join('location', 'location.id', '=', 'assets.location_id')
            ->select('assets.*', 'vendors.name as vendor_name', 'users.name as user_name', 'location.name as location_name')
            ->where('assets.user_id', '=', Auth::user()->id)
            ->orderBy('assets.id', 'DESC')
            ->get();
        }
        session()->put('assets', $assets);
        session()->put('assetsAction', 'All');
        return view('AssetManagement.index')->with(['assets' => $assets, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations, 'layout' =>$layout]);
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
        
        $request->validate([
            'serial_number' => 'required',
            'budget' => 'required|numeric|between:0,99999999999.9999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $validator = Validator::make($request->all(), [
            'serial_number' => [new UniqueSerialNumber],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $input = $request->all();

        if ($request->hasFile('image')) {
            // Store the image file
            $fileName = date('Y_m_d_His') . "_" . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            // Insert the image record
            $image_path = '/storage/' . $path;
        } else {
            $image_path = null;
        }

        // Insert the asset record
        assets::create([
            'serial_number' => $input['serial_number'],
            'location_id' => $input['location_id'],
            'category' => $input['category'],
            'budget' => $input['budget'],
            'vendor_id' => $input['vendor_id'],
            'user_id' => $input['user_id'],
            'image_path' => $image_path,
        ]);

        return redirect('Asset')->with('success', 'New Asset Added!');
    }


    public function show($id)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $asset = assets::find($id);
        if($asset){
            $vendor = Vendor::find($asset->vendor_id);
            $user = User::find($asset->user_id);
            $location = Location::find($asset->location_id);
    
            // Get the image record
            $image = $asset->image_path;
    
            // Generate a URL to the image file using the asset() function
            $image_url = $image ? asset($asset->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png?20210219185637';
    
            return view('AssetManagement.showAssetInfo')->with(['asset' => $asset, 'vendor' => $vendor, 'user' => $user, 'location' => $location, 'image_url' => $image_url, 'layout' =>$layout]);
        }
        return redirect('Asset')->with('warning', 'No record found!');
    }


    public function edit($id)
    {
        $asset = assets::find($id);
        if(!$asset){
            return redirect('Asset')->with('warning', 'No record found!');
        }
        $vendors = Vendor::all();
        $users = User::where('role_as', '!=', 1)->get();
        $locations = Location::all();
        // Get the image record
        $image = $asset->image_path;

        // Generate a URL to the image file using the asset() function
        $image_url = $image ? asset($asset->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png?20210219185637';

        return view('AssetManagement.editAsset')->with(['asset' => $asset, 'vendors' => $vendors, 'users' => $users, 'locations' => $locations, 'image_url' => $image_url]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'serial_number' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // Retrieve the asset and the input values
        $asset = assets::find($id);
        $input = $request->all();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($asset->image_path))) {
                // Delete file
                File::delete(public_path($asset->image_path));
            }
            // Store the image file
            $fileName = date('Y_m_d_His') . "_" . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            // Insert the image record
            $image_path = '/storage/' . $path;
        } else {
            $image_path = $asset->image_path;
        }

        // Update the asset record with the new image ID
        $asset->update([
            'serial_number' => $input['serial_number'],
            'location_id' => $input['location_id'],
            'category' => $input['category'],
            'vendor_id' => $input['vendor_id'],
            'user_id' => $input['user_id'],
            'image_path' => $image_path,
        ]);

        return redirect('Asset')->with('success', 'Asset Info Updated!');
    }

    public function destroy($id)
    {
        $asset = assets::find($id);
        if (File::exists(public_path($asset->image_path))) {
            // Delete file
            File::delete(public_path($asset->image_path));
        }
        assets::destroy($id);
        return redirect('Asset')->with('success', 'Asset Deleted!');
    }
}
