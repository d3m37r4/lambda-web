<?php

use App\Http\Controllers\API\GameServer\ActionController;
use App\Http\Controllers\API\GameServer\AuthController;
use App\Http\Controllers\API\GameServer\PlayerActionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'game-servers'], function () {
    Route::post('auth', AuthController::class);
    Route::group([
        'prefix' => '{game_server}',
        'middleware' => ['game-server-api', 'access_token']
    ], function () {
        Route::post('info', [ActionController::class, 'info']);
        Route::post('ping', [ActionController::class, 'ping']);
        Route::group(['prefix' => 'players'], function () {
            Route::post('connect', [PlayerActionController::class, 'connect']);
            Route::post('{player}/assign', [PlayerActionController::class, 'assign']);
            Route::post('{player}/disconnect', [PlayerActionController::class, 'disconnect']);
        });
    });
});
