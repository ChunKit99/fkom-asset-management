<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker =Faker::create();

        Admin::create([
            'name' => $faker->name,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
