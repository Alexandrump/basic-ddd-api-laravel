<?php

namespace App\Providers;

use Eyf\Autoroute\Autoroute;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    public function map(Autoroute $autoroute)
    {
        $this->configureRateLimiting();

        $parameters = [
            'api_domain' => env('API_DOMAIN', 'localhost'),
        ];

        $autoroute->load(['api.yaml'] ,$parameters);
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(env('MAX_ATTEMPS_PER_MINUTE', 60));
        });
    }
}
