<?php

namespace App\Http\Controllers\budgetController;

namespace App\Http\Controllers;

use DB;

use App\Models\assets;
use App\Models\User;
use App\Models\Budget;
use App\Models\Maintenances;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class budgetController extends Controller
{ 
    // 
    public function index()
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }

        $assets = assets::all();
        $users = User::all();

        if(Auth::check() && Auth::user()->role_as==1){
            $assets = assets::join('users', 'users.id', '=', 'assets.user_id')
            ->select('assets.*', 'users.name as user_name')
            ->orderBy('assets.id', 'DESC')
            ->get();

        }else{
            $assets = assets::join('users', 'users.id', '=', 'assets.user_id')
            ->select('assets.*', 'users.name as user_name')
            ->where('assets.user_id', '=', Auth::user()->id)
            ->orderBy('assets.id', 'DESC')
            ->get();

        }
        session()->put('assets', $assets);
        session()->put('assetsAction', 'All');
        return view('BudgetManagement.home')->with(['assets' => $assets, 'users' => $users, 'layout' =>$layout]);
    }

    public function edit($id)
    {       
        $asset = assets::find($id);
        $budgets = budget::find($id);
        //$budgets = budget::find($id);
        return view('BudgetManagement.editBudget')->with('asset', $asset)->with('budgets', $budgets);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the asset and the input values
        $asset = assets::find($id);
        $input = $request->all();
        $asset->update($input);
        return redirect('Budget')->with('success', 'Budget Updated!');
    }

    public function show(Request $request, $id)
    {
        $asset = DB::select(DB::raw("SELECT category, SUM(budget) as total FROM assets GROUP BY category;"));
        $data_array=array();
        foreach ($asset as $val) {
            array_push($data_array, "['".$val->category."',".$val->total."],");
        }
        return view('BudgetManagement.graphBudget')->with('data', $data_array);
    }

    public function list(Request $request)
    {
        // $user = Auth::id();
        $budgets = budget::all();
        $assets = assets::join('budget','budget.serial_number','=','assets.serial_number')
        ->select('budget.status', 'assets.serial_number', 'assets.category', 'assets.id', 'budget.updated_at')
        ->get();

        return view ('BudgetManagement.listBudget')->with('assets',$assets);
    }
 
    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = 'request';
        $input['request_time'] = Carbon::now();
        Budget::create($input);
        return redirect('Budget')->with('success', 'New Budget Request Added!');
    }

    public function maintenanceView(Request $request)
    {
        $maintenance = maintenances::all();
        $assets = assets::join('maintenances','maintenances.serial_number','=','assets.serial_number')
        ->select('assets.serial_number', 'assets.category', 'maintenances.approve_time', 'maintenances.cost', 'maintenances.status')
        ->where('maintenances.status', '=', 'approved')
        ->get();

        return view ('BudgetManagement.reportMaintenance')->with('assets',$assets);
    }

    //export Maintenance Report CSV
    public function exportCSV1(Request $request)
    {
        $fileName = 'MaintenanceReport.csv';
        $maintenance = maintenances::all();
        $assets = assets::join('maintenances','maintenances.serial_number','=','assets.serial_number')
        ->select('assets.serial_number', 'assets.category', 'maintenances.approve_time', 'maintenances.cost', 'maintenances.status')
        ->where('maintenances.status', '=', 'approved')
        ->get();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Serial_Number', 'Category','Time', 'Date', 'Cost','Status');

            $callback = function() use($assets, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($assets as $assets) {

                    $row['Serial_Number']  = $assets->serial_number;
                    $row['Category']   = $assets->category;
                    //seperate approvel_time with date and time
                    $row['Time'] = Carbon::parse($assets->approvel_time)->format('H:i:s');  
                    $row['Date'] = Carbon::parse($assets->approvel_time)->format('d-m-Y');   
                    $row['Cost']    = $assets->cost;
                    $row['Status']    = $assets->status;

    
                    fputcsv($file, array($row['Serial_Number'], $row['Category'], $row['Time'], $row['Date'], $row['Cost'], $row['Status']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
    }


    //export Total Budget Report CSV
    public function exportCSV2(Request $request)
    {
        $fileName = 'BudgetReport.csv';
        $assets = assets::all();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Serial_Number', 'Category', 'Budget');

            $callback = function() use($assets, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($assets as $assets) {

                    $row['Serial_Number']  = $assets->serial_number;
                    $row['Category']   = $assets->category;
                    $row['Budget'] = $assets->budget; 

                    fputcsv($file, array($row['Serial_Number'], $row['Category'], $row['Budget']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
    }

}
