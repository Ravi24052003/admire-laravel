<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                "name" => "Ravi",
                "email" => "ravi1@admiresoftech.in",
                "password" => "User@12345",
            ],
            [
                "name" => "Admin",
                "email" => "admireholidays7@gmail.com",
                "password" => "User@12345",
            ],
            [
                "name" => "Shruti",
                "email" => "shrutisinha@gmail.com",
                "password" => "User@12345",
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
