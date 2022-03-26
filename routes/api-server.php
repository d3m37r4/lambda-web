<?php

use App\Http\Controllers\API\ServerController;
use App\Http\Controllers\API\PlayerController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'server'], function () {
    Route::post('auth', [ServerController::class, 'auth']);
    Route::post('info', [ServerController::class, 'info']);
    Route::post('ping', [ServerController::class, 'ping']);
});

Route::group(['prefix' => 'player'], function () {
    Route::post('connect', [PlayerController::class, 'connect']);
    Route::post('disconnect', [PlayerController::class, 'disconnect']);
});
