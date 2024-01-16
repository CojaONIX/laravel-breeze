<?php

namespace Database\Seeders;

use App\Models\Forecast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultForecastSeeder extends Seeder
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
        $arrCount = count($forecast);
        $addedCount = 0;

        $dbCities = Forecast::all()->pluck('city')->toArray();

        foreach ($forecast as $city => $temperature)
        {
            if(!in_array($city, $dbCities)) {
                Forecast::create([
                    'city' => $city,
                    'temperature' => $temperature
                ]);
                $addedCount++;
            }
        }

        $this->command->getOutput()->info("Uspesno je kreirano $addedCount / $arrCount default gradova");
    }
}
