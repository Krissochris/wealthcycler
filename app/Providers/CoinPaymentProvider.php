<?php

namespace App\Providers;

use App\CoinPayment\LaravelCoinpayments;
use Illuminate\Support\ServiceProvider;

class CoinPaymentProvider extends ServiceProvider
{
    const SINGLETON = 'coinpayments';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(self::SINGLETON, function ($app) {
            return new LaravelCoinpayments($app);
        });
    }
}
