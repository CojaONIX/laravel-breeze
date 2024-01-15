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
        // password hash: app/Models/User.php -> $casts -> 'password' => 'hashed'
        $users = [
            [
                "name" => "ADMIN",
                "email" => "admin@admin.com",
                "password" => "adminadmin", // => Hash:make("adminadmin"),
                "role" => "admin"
            ],
            [
                "name" => "USER",
                "email" => "user@user.com",
                "password" => "useruser",
                "role" => "user"
            ]
        ];
        foreach ($users as $user)
        {
            User::create($user);
        }

    }
}
