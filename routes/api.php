<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Zttp\Zttp;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather', function(){

    $apiKey = config('servies.openweather.key');
    $city = request('name');
    $lat  = request('lat');
    $lng  = request('lon');

    $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat=$lat&lon=$lng&exclude=hourly,minutely,alerts&appid=e49fd93f65a3e894bd12fcd0244e5712&units=metric");

    return $response->json();
});
