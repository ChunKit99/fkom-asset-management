<?php

namespace App\Http\Controllers\maintenanceController;
namespace App\Http\Controllers;
use App\Models\Maintenances;
use App\Models\Asset;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use PDF;
use Illuminate\Support\Facades\Validator;
use App\Rules\MaintenanceRecordExists;
use App\Rules\BudgetEnough;

class maintenanceController extends Controller
{
    public function filter(Request $request)
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }

        // Initialize the assets variable with all assets
        $query = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
        ->join('users', 'users.id', '=', 'assets.user_id')
        ->select('maintenances.*');

        $criteria = $request->input('filter_category');
        switch ($criteria) {
            case 'status':
                $status = $request->input('status');
                $query->where('maintenances.status', '=', $status);
                if(Auth::check() && Auth::user()->role_as==1){
                }else{
                    $query->where('users.id', '=', Auth::user()->id);
                }
                break;
        }
        
        $maintenance = $query->orderBy('maintenances.id', 'ASC')->get();
        session()->put('maintenances', $maintenance);
        // Return the view with the assets variable
        return view('MaintenanceManagement.index')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function sort(Request $request)
    {
        
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
            $maintenance = Maintenances::all();
            $category = $request->input('sort_category');

            if ($category == 'default_lo') {
                $maintenance = Maintenances::orderBy('maintenances.id', 'DESC')
                    ->get();
            } else if ($category == 'default_ol') {
                $maintenance = Maintenances::orderBy('maintenances.id', 'ASC')
                    ->get();
            }else if ($category == 'status_a') {
                $maintenance = Maintenances::orderBy('maintenances.status', 'ASC')
                    ->get();
            }else if ($category == 'status_d') {
                $maintenance = Maintenances::orderBy('maintenances.status', 'DESC')
                    ->get();
            }else if ($category == 'serial_number') {
                $maintenance = Maintenances::orderBy('maintenances.serial_number', 'ASC')
                    ->get();
            }else if ($category == 'request_time') {
                $maintenance = Maintenances::orderBy('maintenances.request_time', 'ASC')
                    ->get();
            }else if ($category == 'approve_time') {
                $maintenance = Maintenances::orderBy('maintenances.approve_time', 'ASC')
                    ->get();
            }else if ($category == 'cost') {
                $maintenance = Maintenances::orderBy('maintenances.cost', 'ASC')
                    ->get();
            }else{//location, vendor, user
                $maintenance = Maintenances::orderBy($category, 'ASC')
                    ->get();
            }
        }else{
            $layout = 'layouts.masteruser';
            $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
            ->join('users', 'users.id', '=', 'assets.user_id')
            ->select('maintenances.*')
            ->where('users.id', '=', Auth::user()->id)
            ->get();
            $category = $request->input('sort_category');

            if ($category == 'default_lo') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.id', 'DESC')
                    ->get();
            } else if ($category == 'default_ol') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.id', 'ASC')
                    ->get();
            }else if ($category == 'status_a') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.status', 'ASC')
                    ->get();
            }else if ($category == 'status_d') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.status', 'DESC')
                    ->get();
            }else if ($category == 'serial_number') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.serial_number', 'ASC')
                    ->get();
            }else if ($category == 'request_time') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.request_time', 'ASC')
                    ->get();
            }else if ($category == 'approve_time') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.approve_time', 'ASC')
                    ->get();
            }else if ($category == 'status') {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy('maintenances.status', 'ASC')
                    ->get();
            }else {
                $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
                ->join('users', 'users.id', '=', 'assets.user_id')
                ->select('maintenances.*')
                ->where('users.id', '=', Auth::user()->id)
                    ->orderBy($category, 'ASC')
                    ->get();
            }
        }
        
        session()->put('maintenances', $maintenance);

        return view('MaintenanceManagement.index')->with(['maintenances'=> $maintenance, 'sort_category'=>$category, 'layout' =>$layout]);
    }

    // Generate PDF
    // public function createPDF(Request $request)
    // {
    //     $maintenance = session()->get('maintenances');
    //     // share data to view
    //     // view()->share('pdfview',$data);
    //     $pdf = PDF::loadView(('MaintenanceManagement.pdf'), array('maintenances'=> $maintenance))
    //         ->setPaper('a4', 'portrait');
    //     // download PDF file with download method
    //     return $pdf->download('pdf_file.pdf');
    // }

    public function search(Request $request)
    {
        $serial_number = $request->input('serial_number');
        $maintenance = Maintenances::where('serial_number', $serial_number)->first();
        $asset = Asset::where('serial_number', $serial_number)->first();
        // return the item or redirect to a index with warning if the item is not found
        if ($maintenance) {
            $assets = Asset::find($asset->id);
            $vendor = Vendor::find($assets->vendor_id);
            $user = User::find($assets->user_id);
            $location = Location::find($assets->location_id);
            return view('MaintenanceManagement.viewMaintenance')->with(['maintenances' => $maintenance, 'assets'=>$assets, 'vendor' => $vendor, 'user' => $user, 'location' => $location]);
        } else {
            return redirect('MaintenanceManagement')->with('warning', 'No record found!');
        }
    }

    public function view()
    {
        $assets = Asset::all();
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
            $maintenance = Maintenances::all();
        }else{
            $layout = 'layouts.masteruser';
            $maintenance = Maintenances::join('assets', 'assets.serial_number','=','maintenances.serial_number')
            ->join('users', 'users.id', '=', 'assets.user_id')
        ->select('maintenances.*')
        ->where('users.id', '=', Auth::user()->id)
        ->get();
        }

        return view ('MaintenanceManagement.index')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function add($id)
    {
        $asset = Asset::find($id);
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
        $assets = Asset::find($id);

        return view ('MaintenanceManagement.addMaintenance')->with('assets',$assets);
    }

    public function list(Request $request)
    {
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        $maintenance = Maintenances::all();

        if(Auth::check() && Auth::user()->role_as==0){
            $layout = 'layouts.masteruser';
            $assets = Asset::join('users', 'users.id','=','assets.user_id')
        ->join('location', 'location.id','=','assets.location_id')
        ->join('vendors', 'vendors.id','=','assets.vendor_id')
        ->select('users.name', 'assets.id', 'assets.serial_number', 'assets.category', 'assets.budget', 'location.name as location', 'vendors.name as vendor')
        ->where('users.id', '=', Auth::user()->id)
        ->get();
        }
        return view ('MaintenanceManagement.list')->with(['assets'=> $assets, 'maintenances' => $maintenance]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'serial_number' => [new MaintenanceRecordExists],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        $input['status'] = 'under_review';
        $input['request_time'] = Carbon::now(); 
        Maintenances::create($input);
        
        return redirect('MaintenanceManagement')->with('success', 'New Maintenance Request Added!');
    }

    public function show($id)
    {
        $maintenance = Maintenances::find($id);
        $maintenanceSerialNumber = Asset::where('serial_number', $maintenance->serial_number)->first();
        // dd($maintenanceSerialNumber);
        
        $asset = Asset::find($maintenanceSerialNumber->id);
        $assets = Asset::find($asset->id);
        $vendor = Vendor::find($assets->vendor_id);
        $user = User::find($assets->user_id);
        $location = Location::find($assets->location_id);
        return view('MaintenanceManagement.viewMaintenance')->with(['maintenances' => $maintenance, 'assets' => $assets, 'vendor' => $vendor, 'user' => $user, 'location' => $location]);
    }

    public function submitStatus(Request $request)
    {
        $layout = 'layouts.master';
        
        $input = $request->all();
        $maintenanceUpdate = Maintenances::find($input['maintenance_id']);
        
        $maintenanceUpdate->update([
            'approve_time' => Carbon::now(),
            'status' => $input['status'],
        ]);

        $maintenance = Maintenances::all()
        ->where('status','=','under_review');

        return view('MaintenanceManagement.status')->with('success', 'New Maintenance Request Added!')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function status()
    {
        $layout = 'layouts.master';
        
        $maintenance = Maintenances::all()
        ->where('status','=','under_review');
        // return redirect('MaintenanceManagement.status')->with(['maintenances'=> $maintenance, 'layout' =>$layout])->with('success', 'New Maintenance Request Added!');

        return view ('MaintenanceManagement.status')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function cost()
    {
        $layout = 'layouts.master';
        
        $maintenance = Maintenances::all()
        ->where('status','=','approved');
        // return redirect('MaintenanceManagement.status')->with(['maintenances'=> $maintenance, 'layout' =>$layout])->with('success', 'New Maintenance Request Added!');

        return view ('MaintenanceManagement.cost')->with(['maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function submitCost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cost' => [new BudgetEnough($request)],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $layout = 'layouts.master';
        
        $input = $request->all();
        $maintenanceUpdate = Maintenances::find($input['maintenance_id']);
        
        $maintenanceUpdate->update([
            'cost' => $input['cost'],
            'status' => $input['status'],
        ]);

        $assets = Asset::where('serial_number', $input['serial_number'])->first();
        // dd($maintenanceUpdate->serial_number);
        $budget = Asset::where('serial_number', $input['serial_number'])
        ->value('budget');

        $assets->update([
            'budget' => $budget - $input['cost'],
        ]);

        $maintenance = Maintenances::all()
        ->where('status','=','approved');

        return view('maintenanceManagement.cost')->with('success', 'Cost Added!')->with(['assets' => $assets, 'maintenances'=> $maintenance, 'layout' =>$layout]);
    }

    public function edit($id)
    {
        $maintenance = Maintenances::find($id);
        $asset = Asset::find($id);
        $vendors = Vendor::all();
        $users = User::all();
        $locations = Location::all();
        return view('MaintenanceManagement.editMaintenance')->with('maintenances', $maintenance)->with('asset', $asset)->with('users', $users)->with('vendors', $vendors)->with('locations', $locations);
    }

    public function update(Request $request, $id)
    {
        $maintenance = Maintenances::find($id);
        $input = $request->all();
        $maintenance->update([
            'cost' => $input['cost'],
        ]);

        return redirect('MaintenanceManagement')->with('success', 'Maintenance Info Updated!');
    }

    public function destroy($id)
    {
        Maintenances::destroy($id);
        return redirect('MaintenanceManagement')->with('success', 'Maintenance Request Deleted!');
    }
}