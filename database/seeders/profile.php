<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
use App\Models\UserDetail;
use App\Models\User;

class profile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $join = User::select('users')->select('id','name')
        ->where('users.name','=','profiles.username')
        ->get();

        $faker = Faker::create();
        foreach(range(1,2) as $value){
            DB::table('profiles') -> insert([
                'fullname' => $faker -> name,
                'name' => $join,
                'contact' => $faker->phoneNumber,
                'position' => $faker -> randomElement(['general staff', 'laboratory staff', 'lecturer', 'IT staff']),
                'department' => $faker -> randomElement(['academic', 'Lecturer','IT']),
                'location' => $faker -> randomElement(['middle wing', 'left wing', 'right wing']),
            ]);
        }  
    }
}
