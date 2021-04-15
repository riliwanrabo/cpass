<?php

namespace App\Providers;

use App\Contracts\CurrencyServiceContract;
use App\Enums\Vendor;
use App\Services\CurrencyService\CurrencyService;
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
        $this->app->singleton(CurrencyServiceContract::class, function ($app) {
            return new CurrencyService(Vendor::FIXER);
        });
    }
}
