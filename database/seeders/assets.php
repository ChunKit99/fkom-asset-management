<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;
class assets extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::where('role_as', '!=', 1)->get();
        foreach(range(1,15) as $value){
            DB::table('assets') -> insert([
                'serial_number' => $faker -> bothify('?#???###J#'),
                //J2nsz429L8
                'category' => $faker -> randomElement(['computer', 'equipment', 'laboratory', 'printers', 'networking_equipment', 'furniture', 'tools']),
                'budget' => $faker -> randomFloat('2', 100, 500),
                'vendor_id' => Vendor::all()->random()->id,
                'user_id' => $users->random()->id,
                'location_id' => Location::all()->random()->id,
                'image_path' => null,
            ]);
        }
    }
}
