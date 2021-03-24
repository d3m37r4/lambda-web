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
//        Route::get('settings', function () { return dd(Route::current()->uri()); });

    Route::middleware(['middleware' => 'can:manage_users', /*'prefix' => 'users', 'as' => 'users.'*/])->group(function () {
        Route::resource('users', UsersManagementController::class);
    });



//    Route::group(['middleware' => 'can:manage_users', 'prefix' => 'users', 'as' => 'users.'], function () {
//
////        Route::get('/', [UsersManagementController::class, 'index'])->name('index');
////        Route::post('search', [UsersManagementController::class, 'search'])->name('search');
////
////        Route::match(['get', 'post'], '/create', [UsersManagementController::class, 'createNewUser'])->name('create');
////        Route::match(['get', 'post'], '/{user}/edit', [UsersManagementController::class, 'editUser'])->name('edit');
////        Route::delete('/{user}/delete', [UsersManagementController::class, 'deleteUser'])->name('delete');
//
////    });
});
