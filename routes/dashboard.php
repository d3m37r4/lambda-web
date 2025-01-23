<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\GameServer\GameServerController;
use App\Http\Controllers\Dashboard\GameServer\PlayerController;
use App\Http\Controllers\Dashboard\GameServer\AccessController;
use App\Http\Controllers\Dashboard\GameServer\AccessGroupController;
use App\Http\Controllers\Dashboard\GameServer\PunishmentReasonController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth','can:enter_control_panel'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::middleware([
        'middleware' => 'can:manage_users'
    ])->group(function () {
        Route::delete('users/delete-selected', [UserController::class, 'deleteSelected'])
            ->name('users.delete-selected');
        Route::resource('users', UserController::class)
            ->except(['show']);
    });
    Route::middleware([
        'middleware' => 'can:manage_roles'
    ])->group(function () {
        Route::delete('roles/delete-selected', [RoleController::class, 'deleteSelected'])
            ->name('roles.delete-selected');
        Route::resource('roles', RoleController::class)
            ->except(['show']);
    });
    Route::middleware([
        'middleware' => 'can:manage_servers'
    ])->group(function () {
        Route::delete('game-servers/delete-selected', [GameServerController::class, 'deleteSelected'])
            ->name('game-servers.delete-selected');
        Route::resource('game-servers', GameServerController::class);
        Route::resource('game-servers.players', PlayerController::class)
            ->only(['edit', 'update', 'destroy']);
        Route::resource('game-servers.accesses', AccessController::class)
            ->except(['index', 'show']);
        Route::resource('game-servers.access-groups', AccessGroupController::class)
            ->except(['index', 'show']);
        Route::resource('game-servers.punishment-reasons', PunishmentReasonController::class)
            ->except(['index', 'show']);
    });
});
