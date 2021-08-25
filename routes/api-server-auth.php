<?php

use App\Http\Controllers\API\ServerController;
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

Route::group([
//    'middleware' => 'api-server-auth',
    'prefix' => 'server',
], function () {
    Route::post('auth', [ServerController::class, 'auth']);
    Route::post('info', [ServerController::class, 'info']);
    Route::post('ping', [ServerController::class, 'ping']);
});
