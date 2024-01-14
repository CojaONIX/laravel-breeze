<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index()
    {
        $forecasts = Forecast::all();
        return view('forecast', compact('forecasts'));
    }
}
