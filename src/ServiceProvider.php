<?php

namespace clover\Facebook;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/facebook.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('facebook.php'),
        ], 'config');
    }

    public function register()
    {
        session_start();
        
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'facebook'
        );

        $this->app->bind('facebook', function () {
            return new Facebook();
        });
    }
}
