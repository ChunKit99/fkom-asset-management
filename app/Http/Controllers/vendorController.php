<?php

namespace App\Http\Controllers\vendorController;
namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Auth;

class vendorController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->role_as==1){
            $layout = 'layouts.master';
        }else{
            $layout = 'layouts.masteruser';
        }
        $Vendor = Vendor::all();
        return view ('VendorManagement.index')->with('vendors', $Vendor)->with('layout', $layout);
    
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
    public function exportCSV(Request $request)
    {
        $fileName = 'Vendors.csv';
        $vendor = Vendor::all();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('ID', 'Name','Contact','Email');

            $callback = function() use($vendor, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($vendor as $vendor) {
                    $row['ID']  = $vendor->id;
                    $row['Name']    = $vendor->name;
                    $row['Contact']    = $vendor->contact;
                    $row['Email']    = $vendor->email;
    
                    fputcsv($file, array($row['ID'], $row['Name'], $row['Contact'], $row['Email']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
    }
}
