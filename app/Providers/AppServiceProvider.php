<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
    }
}
