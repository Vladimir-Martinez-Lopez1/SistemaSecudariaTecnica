<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'=> 'Vladimir Martinez',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password')
            ]
        ]);
    }
}
