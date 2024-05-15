<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UsersManagementController;
use App\Http\Controllers\Dashboard\RolesManagementController;
use App\Http\Controllers\Dashboard\GameServersManagementController;
use App\Http\Controllers\Dashboard\ReasonsManagementController;
use App\Http\Controllers\Dashboard\AccessesManagementController;
use App\Http\Controllers\Dashboard\AccessGroupsManagementController;
use App\Http\Controllers\Dashboard\PlayersManagementController;

Route::group([
    'middleware' => ['auth','can:enter_control_panel'],
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::middleware([
        'middleware' => 'can:manage_users'
    ])->group(function () {
        Route::resource('users', UsersManagementController::class);
    });
    Route::middleware([
        'middleware' => 'can:manage_roles'
    ])->group(function () {
        Route::delete('roles/delete-selected', [RolesManagementController::class, 'deleteSelected'])
            ->name('roles.delete-selected');
        Route::resource('roles', RolesManagementController::class);
    });
    Route::middleware([
        'middleware' => 'can:manage_servers'
    ])->group(function () {
        Route::resource('servers', GameServersManagementController::class);
        Route::resource('servers.reasons', ReasonsManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.accesses', AccessesManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.access-groups', AccessGroupsManagementController::class)
            ->except(['index', 'show']);
        Route::resource('servers.players', PlayersManagementController::class)
            ->only(['edit', 'update', 'destroy']);
    });
});
