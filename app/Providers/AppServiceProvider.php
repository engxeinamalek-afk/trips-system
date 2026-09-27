<?php

namespace App\Providers;

use App\Services\BookingService;
use App\Services\Contracts\BookingServiceInterface;
use App\Services\TripService;
use App\Services\Contracts\TripServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Price\BookingPriceStrategyFactory;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TripServiceInterface::class , TripService::class);
        $this->app->singleton(BookingServiceInterface::class , BookingService::class);
        $this->app->singleton(BookingPriceStrategyFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
