<?php

namespace App\Observers\Address;

use App\Interfaces\ICoordinates;
use App\Jobs\FetchGeoCoordinatesJob;
use App\Models\Address;

/**
 * This observer will be the hook to handle firing off a job to associate an address with geo coordinates
 */
class CreatedAddressLatitudeAndLongitude
{
    public function created(Address $address)
    {
        FetchGeoCoordinatesJob::dispatch($address);
    }
}
