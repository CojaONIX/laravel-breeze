<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $table = 'forecasts';
    protected $fillable = [
        'city',
        'temperature',
    ];
}
