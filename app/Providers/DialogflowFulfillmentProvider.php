<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Manager;

class DialogflowFulfillmentProvider extends ServiceProvider
{
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
        $this->app->singleton(Manager::class, function ($app) {
            return new Manager();
        });
    }
}
