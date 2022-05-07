<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('components.pagination');

        // TODO: change on CarbonInterval::setLocale(Config::get('app.locale'));
        CarbonInterval::setLocale('ru');

        // Defining default password rules
        Password::defaults(function () {
            return User::PASSWORD_UNCOMPROMISED_COUNT > 0 ?
                Password::min(User::PASSWORD_MIN_LENGHT)
                    ->uncompromised(User::PASSWORD_UNCOMPROMISED_COUNT) :
                Password::min(User::PASSWORD_MIN_LENGHT);
        });
    }
}
