<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterStep2Controller;

Auth::routes();
Route::group([
    'middleware' => ['web', 'auth']
], function () {
    Route::get('register-step2', [RegisterStep2Controller::class, 'showStep2Form']);
    Route::post('register-step2', [RegisterStep2Controller::class, 'postStep2Form'])->name('register.step2');
});
