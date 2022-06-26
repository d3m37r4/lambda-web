<?php

use App\Http\Controllers\API\GameServerAuthController;
use App\Http\Controllers\API\GameServerActionsController;
use App\Http\Controllers\API\GameServerPlayersActionsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'servers'], function () {
    Route::post('auth', GameServerAuthController::class);
    Route::group([
        'prefix' => '{server}',
        'middleware' => ['game-server-api', 'access_token']
    ], function () {
        Route::post('info', [GameServerActionsController::class, 'info']);
        Route::post('ping', [GameServerActionsController::class, 'ping']);
        Route::group(['prefix' => 'players'], function () {
            Route::post('connect', [GameServerPlayersActionsController::class, 'connect']);
            Route::post('{player}/disconnect', [GameServerPlayersActionsController::class, 'disconnect']);
        });
    });
});
