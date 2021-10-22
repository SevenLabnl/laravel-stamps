<?php

namespace SevenLab\Stamps;

use Illuminate\Support\ServiceProvider;
use SevenLab\Stamps\Database\Schema\Macros\StampsMacro;

class StampsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'sevenlab');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'sevenlab');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $stampsMacro = new StampsMacro();
        $stampsMacro->register();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/stamps.php', 'stamps');

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['stamps'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/stamps.php' => config_path('stamps.php'),
        ], 'stamps.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/sevenlab'),
        ], 'stamps.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/sevenlab'),
        ], 'stamps.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/sevenlab'),
        ], 'stamps.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
