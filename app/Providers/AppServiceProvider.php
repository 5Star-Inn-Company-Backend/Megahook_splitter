<?php

namespace App\Providers;

use App\Models\Plan;
use App\Services\Korapay;
use App\Interfaces\PaymentGateway;
use App\Services\MailChimp\MailchimpNewsletter;
use App\Services\MailChimp\Newsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

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

        $this->app->bind(Newsletter::class, function () {
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us17'
            ]);

            return new MailchimpNewsletter($client);
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
