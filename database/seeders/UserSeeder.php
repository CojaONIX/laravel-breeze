<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Throwable;

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
            try {
                User::create($user);
            } catch (Throwable $e) {
            }
        }

        $faker = Factory::create();
        $this->command->getOutput()->progressStart(5);
        for($i=0; $i<5; $i++)
        {
            User::create([
                "name" => $faker->name,
                "email" => $faker->email,
                "password" => Hash::make("password"),
                "role" => "user"
            ]);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

    }
}
