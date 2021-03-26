<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authorize;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersManagementController;

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

Route::group(['middleware' => ['auth','can:enter_control_panel'], 'prefix' => env('APP_ADMIN_PATH'), 'as' => 'admin.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::middleware(['middleware' => 'can:manage_users'])->group(function () {
        Route::resource('users', UsersManagementController::class);
    });
});
