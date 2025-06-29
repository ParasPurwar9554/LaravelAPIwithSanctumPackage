<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
    protected $table = 'weathers';
    protected $fillable = [
        'city',
        'temperature',
        'humidity',
        'pressure',
        'wind_speed',
        'weather_description',
    ];
}
