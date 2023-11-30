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
                'name'=>'Pak Teacher',
                'username'=>'Teacher',
                'email'=>'teacher@gmail.com',
                'password'=>bcrypt('12345678'),
                'role'=>'Teacher',

            ],
            [
                'name'=>'Student',
                'username'=>'Student',
                'email'=>'student@gmail.com',
                'password'=>bcrypt('12345678'),
                'role'=>'Student',

            ],
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}
