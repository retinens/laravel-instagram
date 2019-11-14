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
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-instagram');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-instagram');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-instagram.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-instagram'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-instagram'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-instagram'),
            ], 'lang');*/

//             Registering package commands.
            $this->commands([
                 RefreshCache::class,
             ]);

            $this->app->booted(function () {
                $schedule = app(Schedule::class);
                $schedule->command('laravel-instagram:refresh')->everyTenMinutes();
            });
        }
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
