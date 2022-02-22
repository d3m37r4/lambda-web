<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersManagementController;
use App\Http\Controllers\Admin\RolesManagementController;
use App\Http\Controllers\Admin\ServersManagementController;
use App\Http\Controllers\Admin\ReasonsManagementController;
use App\Http\Controllers\Admin\AccessesManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group([
    'middleware' => ['auth','can:enter_control_panel'],
    'prefix' => env('APP_ADMIN_DIR'),
    'as' => 'admin.',
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
    });
});
