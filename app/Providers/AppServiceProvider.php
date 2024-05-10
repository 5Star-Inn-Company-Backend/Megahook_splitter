<?php

namespace App\Providers;

use App\Models\Plan;
use App\Services\Korapay;
use App\Interfaces\PaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGateway::class, function ($app) {
            return new Korapay();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view){

            $plans = Plan::get();
            return $view->with(['plans' => $plans]);
        });
    }
}
