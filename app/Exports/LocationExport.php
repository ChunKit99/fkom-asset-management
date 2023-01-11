<?php

namespace App\Exports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocationExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        ## 1. Export all data
        // return Locarion::all();

        ## 2. Export specific columns
        return Location::select('ID','Location')->get();
    }
   
}
