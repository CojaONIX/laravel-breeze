<?php

namespace Database\Seeders;

use App\Models\Forecast;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakerForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $console = $this->command->getOutput();
        $count = $console->ask('Koliko gradova zelite da kreirate? (sr_Latn_RS -> max: 24)', 5);
        $count = $count > 24 ? 24 : $count;

        $faker = Factory::create('sr_Latn_RS');

        $dbCities = Forecast::all()->pluck('city')->toArray();
        $addedCount = 0;
        for($i=0; $i<$count; $i++)
        {
            $city = $faker->unique()->city();
            if(!in_array($city, $dbCities)) {
                Forecast::create([
                    'city' => $city,
                    'temperature' => $faker->numberBetween(-10, 30)
                ]);
                $addedCount++;
            }
        }

        $console->info("Uspesno je kreirano $addedCount / $count gradova");
    }
}
