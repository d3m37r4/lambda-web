<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersManagementController;
use App\Http\Controllers\Admin\RolesManagementController;
use App\Http\Controllers\Admin\ServersManagementController;
use App\Http\Controllers\Admin\ReasonsManagementController;
use App\Http\Controllers\Admin\AccessesManagementController;
use App\Http\Controllers\Admin\AccessGroupsManagementController;
use App\Http\Controllers\Admin\PlayersManagementController;

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
        Route::resource('roles', RolesManagementController::class);
    });
    Route::middleware([
        'middleware' => 'can:manage_servers'
    ])->group(function () {
        Route::resource('servers', ServersManagementController::class);
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
