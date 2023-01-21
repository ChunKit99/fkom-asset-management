<?php

namespace App\Http\Controllers\budgetController;

namespace App\Http\Controllers;

use DB;

use App\Models\Asset;
use App\Models\User;
use App\Models\Budget;
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

        $assets = Asset::all();
        $users = User::all();

        if(Auth::check() && Auth::user()->role_as==1){
            $assets = Asset::join('users', 'users.id', '=', 'assets.user_id')
            ->select('assets.*', 'users.name as user_name')
            ->orderBy('assets.id', 'DESC')
            ->get();

        }else{
            $assets = Asset::join('users', 'users.id', '=', 'assets.user_id')
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
        $asset = Asset::find($id);
        //$budgets = budget::find($id);
        return view('BudgetManagement.editBudget')->with('asset', $asset);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the asset and the input values
        $asset = Asset::find($id);
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
        $assets = Asset::join('budget','budget.serial_number','=','assets.serial_number')
        ->select('budget.status', 'assets.serial_number', 'assets.category', 'assets.id')
        ->get();

        return view ('BudgetManagement.listBudget')->with('assets',$assets);
    }
 
    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = 'Request';
        $input['request_time'] = Carbon::now();
        Budget::create($input);
        return redirect('Budget')->with('success', 'New Budget Request Added!');
    }
}
