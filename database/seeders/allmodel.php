<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Location;

class allmodel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'User',
               'email'=>'user@example.com',
               'role_as'=> 0,
               'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'User2',
                'email'=>'user2@example.com',
                'role_as'=> 0,
                'password'=> bcrypt('12345678'),
             ],
            [
               'name'=>'Admin',
               'email'=>'admin@example.com',
               'role_as'=> 1,
               'password'=> bcrypt('12345678'),
            ],
        ];

        foreach ($users as $key => $user) 
        {
            User::create($user);
        }

        $faker = Faker::create();
        $users = User::where('role_as', '!=', 1)->get();

        foreach(range(1,10) as $value){
            DB::table('vendors') -> insert([
                'name' => $faker->name,
                'contact' => $faker->phoneNumber,
                'email' => $faker->email
            ]);
            DB::table('location') -> insert([
                'name' => "FSK"  .  (string) $value,
            ]);
            DB::table('assets') -> insert([
                'serial_number' => $faker -> bothify('?#???###J#'),
                'category' => $faker -> randomElement(['computer', 'equipment', 'laboratory', 'printers', 'networking_equipment', 'furniture', 'tools']),
                'budget' => $faker -> randomFloat('2', 100, 500),
                'vendor_id' => Vendor::all()->random()->id,
                'user_id' => $users->random()->id,
                'location_id' => Location::all()->random()->id,
                'image_path' => null,
            ]);
        }
        foreach(range(1,3) as $value){
            DB::table('profiles') -> insert([
                'fullname' => $faker -> name,
                'name' => User::find($value)->name,
                'contact' => $faker->phoneNumber,
                'position' => $faker -> randomElement(['Technician', 'Manager']),
                'department' => 'Techincal Department',
                'location' => $faker -> bothify('Bilik Pensyarah #'),
            ]);
        }

    }
}
