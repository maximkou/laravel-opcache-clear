<?php

namespace Maximkou\LaravelOpcacheClear;

use Illuminate\Support\ServiceProvider;

/**
 * Class OpcacheClearServiceProvider
 * @package Maximkou\LaravelOpcacheClear
 */
class OpcacheClearServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $resourceDir = realpath(__DIR__.'/../resources');

        include $resourceDir.'/routes.php';

        $this->publishes([
            $resourceDir.'/config/laravel-opcache-clear.php' => config_path('laravel-opcache-clear.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('command.opcache:clear', OpcacheClearCommand::class);

        $this->commands([
            'command.opcache:clear',
        ]);
    }
}
