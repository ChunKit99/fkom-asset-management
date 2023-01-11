<?php

namespace App\Http\Controllers\locationController;
namespace App\Http\Controllers;
use App\Models\Location;
use Illuminate\Http\Request;

class locationController extends Controller
{
    public function index()
    {
        $Location = Location::all();
        return view ('LocationManagement.index')->with('location', $Location);
    
    }

    public function create()
    {
        return view ('LocationManagement.addLocation');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Location::create($input);
        return redirect('LocationManagement')->with('flash_message', 'New Location Added!'); 
    }

    public function show($id)
    {
        $Location = Location::find($id);
        return view('LocationManagement.viewLocationInfo')->with('location', $Location);
    }

    public function edit($id)
    {
        $Location = Location::find($id);
        return view('LocationManagement.editLocation')->with('location', $Location);
    }

    public function update(Request $request, $id)
    {
        $Location = Location::find($id);
        $input = $request->all();
        $Location->update($input);
        return redirect('LocationManagement')->with('flash_message', 'Location Info Updated');
    }

    public function destroy($id)
    {
        Location::destroy($id);
        return redirect('LocationManagement')->with('flash_message', 'Location deleted!');
    }

    public function exportCSV(Request $request)
    {
        $fileName = 'locations.csv';
        $location = Location::all();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('ID', 'Location');

            $callback = function() use($location, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($location as $location) {
                    $row['ID']  = $location->id;
                    $row['Location']    = $location->name;

                    fputcsv($file, array($row['ID'], $row['Location']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
    }
}
