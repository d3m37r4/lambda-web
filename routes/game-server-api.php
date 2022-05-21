<?php

use App\Http\Controllers\API\GameServerAuthController;
use App\Http\Controllers\API\GameServerActionsController;
use App\Http\Controllers\API\PlayerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'servers'], function () {
    Route::post('auth', GameServerAuthController::class);
    Route::group([
        'middleware' => ['game-server-api', 'access_token']
    ], function () {
        Route::post('{server}/info', [GameServerActionsController::class, 'info']);
        Route::post('{server}/ping', [GameServerActionsController::class, 'ping']);
        Route::group(['prefix' => 'players'], function () {
            Route::post('connect', [PlayerController::class, 'connect']);
            Route::post('disconnect', [PlayerController::class, 'disconnect']);
        });
    });
});
