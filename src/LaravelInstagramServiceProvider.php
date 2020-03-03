<?php

namespace Retinens\LaravelInstagram;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class LaravelInstagramServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-instagram.php'),
        ], 'config');

        //Registering package commands.
        $this->commands([
            RefreshCache::class,
        ]);

        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('laravel-instagram:refresh')->everyTenMinutes();
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-instagram');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-instagram', function () {
            return new LaravelInstagram;
        });
    }
}
