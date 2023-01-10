<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class users extends Seeder
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
    }
    
}