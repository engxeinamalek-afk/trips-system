<?php

namespace App\Providers;

use App\Services\BookingService;
use App\Services\Contracts\BookingServiceInterface;
use App\Services\Contracts\TicketServiceInterface;
use App\Services\TripService;
use App\Services\Contracts\TripServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Price\BookingPriceStrategyFactory;
use App\Services\TicketService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TripServiceInterface::class , TripService::class);
        $this->app->bind(BookingServiceInterface::class , BookingService::class);
        $this->app->bind(TicketServiceInterface::class , TicketService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
