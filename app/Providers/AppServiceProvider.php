<?php

namespace App\Providers;

use App\Interfaces\ICoordinates;
use App\Library\Coordinates\OpenCageGeocoding;
use App\Models\Address;
use App\Observers\Address\CreatedAddressLatitudeAndLongitude;
use App\Observers\BindUserOnCreatedAddressObserver;
use Illuminate\Support\ServiceProvider;

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
        Address::observe(
            [
                CreatedAddressLatitudeAndLongitude::class,
                BindUserOnCreatedAddressObserver::class
            ]
        );

        $this->app->bind(ICoordinates::class, OpenCageGeocoding::class);
    }
}
