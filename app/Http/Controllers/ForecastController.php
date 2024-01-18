<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use Illuminate\Http\Request;
use Throwable;

class ForecastController extends Controller
{
    public function index()
    {
        $forecasts = Forecast::all();
        return view('forecast', compact('forecasts'));
    }
    public function getAllForecasts()
    {
        $forecasts = Forecast::all();
        return view('admin.forecast.all', compact('forecasts'));
    }

    public function addForecastPage()
    {
        return view('admin.forecast.add');
    }

    public function createForecast(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|min:2|max:64|unique:forecasts',
            'temperature' => 'required|numeric'
        ]);

        Forecast::create([
            'city' => $request->get('city'),
            'temperature' => $request->get('temperature')
        ]);

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast is created.');
    }

    public function editForecastPage(Forecast $forecast)
    {
        return view('admin.forecast.edit', compact('forecast'));
    }

    public function updateForecast(Request $request, Forecast $forecast)
    {
        $validated = $request->validate([
            'city' => 'required|string|min:2|max:64|unique:forecasts,city,'.$forecast->id,
            'temperature' => 'required|numeric'
        ]);

        $forecast->city = $request->get('city');
        $forecast->temperature = $request->get('temperature');

        $forecast->save();

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast ' . $forecast->id . ' is edited.');
    }

    public function deleteForecast(Request $request, Forecast $forecast)
    {
        $forecast->delete();

        return redirect()->route('admin.forecast.all.page')->withSuccess('Forecast is deleted.');
    }

    public function getCityForecast($city)
    {
        $citiesForecast = [
            'Beograd' => ['pon' => 12, 'uto' => 13, 'sre' => 14, 'cet' => 11, 'pet' => 13],
            'Novi Sad'  => ['pon' => 10, 'uto' => 13, 'sre' => 12, 'cet' => 12, 'pet' => 14],
            'Aleksinac' => ['pon' => 11, 'uto' => 9, 'sre' => 11, 'cet' => 14, 'pet' => 13]
        ];

        if(!array_key_exists($city, $citiesForecast))
        {
            return view('cityForecast');
        }

        $cityForecast = $citiesForecast[$city];

        return view('cityForecast', compact('city', 'cityForecast'));
    }

}
