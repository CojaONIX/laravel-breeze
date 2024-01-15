<?php

namespace Database\Seeders;

use App\Models\Forecast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forecast = [
            "Beograd" => 18,
            "Novi Sad" => 19,
            "Aleksinac" => 20,
            "Subotica" => 17
        ];

        foreach ($forecast as $city => $temperature)
        {
            Forecast::create([
                'city' => $city,
                'temperature' => $temperature
            ]);
        }
    }
}
