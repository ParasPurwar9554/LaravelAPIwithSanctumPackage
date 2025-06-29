<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Validation\ValidationException;
use App\Models\Weather;

class WeatherController extends Controller
{
    protected $weatherService;

    function __construct(WeatherService $WeatherService)
    {
        $this->weatherService = $WeatherService;
    }
    
    public function getWeather(Request $request)
    {
        try {
            $request->validate([
                'city' => 'required|string',
            ]);
            $city = $request->input('city');
            $weatherData = $this->weatherService->getWeather($city);
            Weather::create([
                'city' => $city,
                'temperature' => $weatherData['main']['temp'],
                'humidity' => $weatherData['main']['humidity'],
                'pressure' => $weatherData['main']['pressure'],
                'wind_speed' => $weatherData['wind']['speed'],
                'weather_description' => $weatherData['weather'][0]['description'],
            ]);

            return response()->json($weatherData);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
        }   
    }
}
