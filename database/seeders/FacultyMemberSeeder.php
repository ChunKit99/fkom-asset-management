<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;

use App\Models\FacultyMemberCurd;
use App\Models\User;


class FacultyMemberSeeder extends Seeder
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
            DB::table('members') -> insert([
                'name' => $faker -> name,
                'contact' => $faker->phoneNumber,
                'position' => $faker -> randomElement(['general staff', 'laboratory staff', 'lecturer', 'IT staff']),
                'department' => $faker -> randomElement(['academic', 'Lecturer','IT']),
                'location' => $faker -> randomElement(['middle wing', 'left wing', 'right wing']),
            ]);
        }  
    }
}
