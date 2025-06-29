<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AIContentController;
use App\Http\Controllers\API\TestContorller;
use App\Http\Controllers\API\WeatherController;
use App\Http\Controllers\API\UserprofileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkLoginKey;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('post',PostController::class);
});

Route::post('/generate-content', [AIContentController::class, 'generate']);
Route::post('/test', [TestContorller::class, 'test']);
Route::post('/get-weather', [WeatherController::class, 'getWeather'])->middleware(checkLoginKey::class);
Route::get('/users', [UserprofileController::class, 'getUsers']);
Route::get('/getProfileByUserId', [UserprofileController::class, 'getProfileByUserId']);
Route::get('/getPostByUserId', [UserprofileController::class, 'getPostByUserId']);
