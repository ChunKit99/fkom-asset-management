<?php

namespace App\Http\Controllers\vendorController;
namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    public function index()
    {
        $Vendor = Vendor::all();
        return view ('VendorManagement.index')->with('vendors', $Vendor);
    
    }

    public function create()
    {
        return view ('VendorManagement.addVendor');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Vendor::create($input);
        return redirect('VendorManagement')->with('flash_message', 'New Vendor Added!'); 
    }

    public function show($id)
    {
        $Vendor = Vendor::find($id);
        return view('VendorManagement.viewVendorInfo')->with('vendors', $Vendor);
    }

    public function edit($id)
    {
        $Vendor = Vendor::find($id);
        return view('VendorManagement.editVendor')->with('vendors', $Vendor);
    }

    public function update(Request $request, $id)
    {
        $Vendor = Vendor::find($id);
        $input = $request->all();
        $Vendor->update($input);
        return redirect('VendorManagement')->with('flash_message', 'Vendor Info Updated');
    }

    public function destroy($id)
    {
        Vendor::destroy($id);
        return redirect('VendorManagement')->with('flash_message', 'Vendor deleted!');
    }
}
