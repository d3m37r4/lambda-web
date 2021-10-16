<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingsManagementController;
use App\Http\Controllers\Admin\UsersManagementController;
use App\Http\Controllers\Admin\RolesManagementController;
use App\Http\Controllers\Admin\ServersManagementController;
use App\Http\Controllers\Admin\ReasonsManagementController;

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
    'prefix' => config('app.admin_dir'),
    'as' => 'admin.',
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::group([
        'middleware' => 'can:manage_settings',
        'prefix' => 'settings',
        'as' => 'settings.',
    ], function () {
        Route::get('/', [SettingsManagementController::class, 'index'])->name('index');
        Route::put('/', [SettingsManagementController::class, 'update'])->name('update');
    });
    Route::resource('users', UsersManagementController::class)
        ->middleware(['middleware' => 'can:manage_users']);
    Route::resource('roles', RolesManagementController::class)
        ->middleware([ 'middleware' => 'can:manage_roles']);
    Route::middleware(['middleware' => 'can:manage_servers'])->group(function () {
        Route::resource('servers', ServersManagementController::class);
        Route::resource('servers.reasons', ReasonsManagementController::class)
            ->except(['index', 'show']);
    });
});
