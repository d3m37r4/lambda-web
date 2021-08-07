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

        // TODO: Add it to settings or make it dependent on client parameters.
        CarbonInterval::setLocale('ru');
    }
}
