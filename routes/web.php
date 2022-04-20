<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterStep2Controller;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'middleware' => ['web', 'auth']
], function () {
    Route::get('register-step2', [RegisterStep2Controller::class, 'showStep2Form']);
    Route::post('register-step2', [RegisterStep2Controller::class, 'postStep2Form'])->name('register.step2');

    Route::resource('users', UsersController::class)
        ->except(['create', 'store', 'destroy']);
});
