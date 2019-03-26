<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // //
        Auth::provider('usuarioresponse', function($app, array $config) {
            return new CustomUserProvider($app['hash'], $config['model']);
        });

        // Auth::setProvider(new CustomUserProvider(app(Hasher::class), Usuario::class));
    }
}