<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Pak Admin',
                'username'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('12345678'),
                'role'=>'admin',

            ],
            [
                'name'=>'Mimo',
                'username'=>'Teacher',
                'email'=>'mimo@gmail.com',
                'password'=>bcrypt('12345678'),
                'role'=>'Teacher',

            ],
            [
                'name'=>'Dawei',
                'username'=>'Student',
                'email'=>'dawei@gmail.com',
                'password'=>bcrypt('12345678'),
                'role'=>'Student',

            ],
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
