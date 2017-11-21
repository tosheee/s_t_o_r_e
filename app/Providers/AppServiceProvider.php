<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        //Schema::defaultStringLength(191);
       // if(env('APP_ENV') !== 'local')
        //{
          //  $url->forceSchema('https');
        //}
        //URL::forceScheme('https');
        if(env('APP_ENV') === 'local')
        {
            URL::forceScheme('http');
        }
        else
        {
            URL::forceScheme('https');
        }

        if (App::environment('production')) {
            URL::forceScheme('https');
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
