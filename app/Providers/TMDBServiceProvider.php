<?php

namespace App\Providers;

use App\Services\TMDB\TMDBClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class TMDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TMDBClient::class, function ($app) {
            return new TMDBClient(
                baseUrl: config('tmdb.base_url'),
                imageBaseUrl: config('tmdb.image_base_url'),
                apiKey: config('tmdb.api_key')
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Http::macro('tmdb', function () {
            return Http::acceptJson()->baseUrl(config('tmdb.base_url'));
        });
    }
}
