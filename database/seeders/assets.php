<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\vendors;
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
        foreach(range(1,5) as $value){
            DB::table('assets') -> insert([
                'serial_number' => $faker -> bothify('?#???###J#'),
                //J2nsz429L8
                'location' => $faker -> bothify('FSK##'),
                //FSK12
                'category' => $faker -> randomElement(['computer', 'equipment', 'laboratory', 'printers', 'networking_equipment', 'furniture', 'tools']),
                'budget' => $faker -> randomFloat('2', 0, 2),
                'vendor_id' => User::all()->random()->id,
                'user_id' => User::all()->random()->id,
            ]);
        }
    }
}
