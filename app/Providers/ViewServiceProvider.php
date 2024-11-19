<?php

namespace App\Providers;

use App\Services\ExchangeRateService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(ExchangeRateService $exchangeRateService)
    {
        View::composer(['product.*', 'service.*'], function ($view) use ($exchangeRateService) {
            $exchangeRate = $exchangeRateService->getExchangeRate();
            $view->with('exchangeRate', $exchangeRate);
        });
    }
}
