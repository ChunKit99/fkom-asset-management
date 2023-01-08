<?php

namespace App\Http\Controllers\budgetController;

namespace App\Http\Controllers;

use DB;

use App\Models\assets;
use Illuminate\Http\Request;

class budgetController extends Controller
{
    // 
    public function index()
    {
        $assets = assets::all();
        return view('BudgetManagement.home')->with(['assets' => $assets]);
    }

    public function edit($id)
    {
        $asset = assets::find($id);
        return view('BudgetManagement.editBudget')->with('asset', $asset);
    }

    public function update(Request $request, $id)
    {
        // Retrieve the asset and the input values
        $asset = assets::find($id);
        $input = $request->all();
        $asset->update($input);
        return redirect('Budget')->with('success', 'Asset Info Updated!');
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
    
}
