<?php

namespace Actinity\StageLogin;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class StageLoginServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/routes.php");

        $this->loadViewsFrom(__DIR__."/views","stage-login");

        $this->publishes([
            __DIR__.'/config.php' => config_path('stage-login.php'),
        ]);

        RateLimiter::for('stage-login',function(Request $request) {
            return [
                Limit::perMinute(60),
            ];
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'stage-login'
        );
    }
}