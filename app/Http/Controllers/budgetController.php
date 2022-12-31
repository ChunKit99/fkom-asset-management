<?php

namespace App\Http\Controllers\budgetController;

namespace App\Http\Controllers;

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
        $assets = assets::select('assets.*')
        ->orderBy('assets.category', 'ASC')
        ->get();

        return view('BudgetManagement.graphBudget', ['assets'=>$assets]);
    }
    
}
