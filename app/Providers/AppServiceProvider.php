<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        config(['app.locale' => 'id']);
        // Carbon::setLocale(config('app.locale'));
        Carbon::setLocale('id');
        Paginator::useBootstrapFour();
    }
}
