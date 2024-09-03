<?php

use App\Http\Controllers\Dashboard\GameServer\AccessManagementController;
use App\Http\Controllers\Dashboard\GameServer\AccessGroupManagementController;
use App\Http\Controllers\Dashboard\GameServer\GameServerManagementController;
use App\Http\Controllers\Dashboard\GameServer\PlayerManagementController;
use App\Http\Controllers\Dashboard\GameServer\ReasonManagementController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleManagementController;
use App\Http\Controllers\Dashboard\UserManagementController;
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
        Route::delete('users/delete-selected', [UserManagementController::class, 'deleteSelected'])
            ->name('users.delete-selected');
        Route::resource('users', UserManagementController::class)
            ->except(['show']);
    });
    Route::middleware([
        'middleware' => 'can:manage_roles'
    ])->group(function () {
        Route::delete('roles/delete-selected', [RoleManagementController::class, 'deleteSelected'])
            ->name('roles.delete-selected');
        Route::resource('roles', RoleManagementController::class)
            ->except(['show']);
    });
    Route::middleware([
        'middleware' => 'can:manage_servers'
    ])->group(function () {
        Route::resource('servers', GameServerManagementController::class);
        Route::resource('servers.reasons', ReasonManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.accesses', AccessManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.access-groups', AccessGroupManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.players', PlayerManagementController::class)
            ->only(['edit', 'update', 'destroy']);
    });
});
