<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Ubp\Ubp;
use App\Components\Ubp\Forex;
use GuzzleHttp\Client;

class UbpServiceProvider extends ServiceProvider
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
        $config = config('ubp');

        $client = new Client([
            'base_uri' => $config['base_path'],
            'headers' => [
                'x-ibm-client-id' => $config['client_id'],
                'x-ibm-client-secret' => $config['client_secret']
            ]
        ]);

        $this->app->singleton(Ubp::class, function ($app) use ($client, $config) {
            return new Ubp($client, $config);
        });

        $this->app->singleton(Forex::class, function ($app) {
            $forex = new Forex($app->make(Ubp::class));
            $forex->loadRates();

            return $forex;
        });
    }
}
