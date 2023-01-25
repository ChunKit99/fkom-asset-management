<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Asset;

class maintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,10) as $value){
            DB::table('maintenances') -> insert([
                'serial_number' => Asset::find($value)->serial_number,
                'request_time' => Carbon::now()->format('Y-m-d H:i:s'),
                // 'approve_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => $faker -> randomElement(['under_review', 'approved', 'rejected']),
                'cost' => $faker -> randomFloat('2', 100, 500),
            ]);
        }
    }
}
