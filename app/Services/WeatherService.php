<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function getWeather($city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric', 
            'lang' => 'en',
        ]);

        if ($response->successful()) {
            return $response->json(); 
        }

        return [
            'error' => 'Unable to fetch weather data. Please try again later.',
        ];
    }
}
