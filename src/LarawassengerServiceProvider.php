<?php

namespace Uzzaircode\Larawassenger;

use Illuminate\Support\ServiceProvider;

class LarawassengerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(Larawassenger::class, function () {
            return new Larawassenger();
        });

        $this->app->alias(Larawassenger::class, 'larawassenger');

        $this->mergeConfigFrom(__DIR__ . '/config/wassenger.php', 'larawassenger');

        $this->publishes([

            __DIR__.'/config/wassenger.php' => config_path('wassenger.php'),

        ], 'larawassenger');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
