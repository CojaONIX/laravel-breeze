<?php

namespace Database\Seeders;

use App\Models\Forecast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AskForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $console = $this->command->getOutput();
        $city = $console->ask("Unesite ime grada?");
        if($city === null)
        {
            $console->error("Niste uneli ime grada!");
            return;
        }

        if( Forecast::where(['city' => $city])->first() !== null )
        {
            $console->error("Podaci za grad $city vec postoje u bazi!");
            return;
        }

        $temperature = $console->ask("Unesite temperaturu za $city?");
        if($temperature === null)
        {
            $console->error("Niste uneli temperaturu!");
            return;
        }

        Forecast::create([
            'city' => $city,
            'temperature' => $temperature
        ]);
        $console->success("Uspesno ste uneli grad: $city - temperatura: $temperature ");
    }
}
