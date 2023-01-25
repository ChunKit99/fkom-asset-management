<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;
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

        $faker = Faker::create();
        foreach(range(1,2) as $value){
            DB::table('profiles') -> insert([
                'fullname' => $faker -> name,
                'name' => User::find($value)->name,
                'contact' => $faker->phoneNumber,
                'position' => $faker -> randomElement(['Technician', 'Manager']),
                'department' => $faker -> randomElement(['Techincal Department']),
                'location' => $faker -> bothify('Bilik Pensyarah #'),
            ]);
        }  
    }
}
